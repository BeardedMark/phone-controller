<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Label\LabelAlignment;
use Endroid\QrCode\Label\Font\OpenSans;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;

class PhoneController extends Controller
{
    public function index(Request $request)
    {
        $phoneTarget = $request['to'] ?: null;
        return view('pages.phones.index', compact('phoneTarget'));
    }

    public function create(Request $request)
    {
        $phone = $request['phone'] ? $this->formatPhoneNumber($request['phone']) : null;
        return view('pages.phones.create', compact('phone'));
    }

    public function about()
    {
        return view('pages.phones.about');
    }

    public function privacy()
    {
        return view('pages.phones.privacy');
    }

    public function show(Request $request)
    {
        // $url = 'https://cleaner.dadata.ru/api/v1/clean/phone';
        // $token = '0dadf8898e7067fe3be74dcea5511e9db40a2f4';
        // $secret = '73843a4515d3526b61f3b9396ec61262cdb34e20';

        // $data = [$phone];

        // $response = Http::withHeaders([
        //     'Content-Type' => 'application/json',
        //     'Accept' => 'application/json',
        //     'Authorization' => 'Token ' . $token,
        //     'X-Secret' => $secret,
        // ])
        //     ->withoutVerifying() // Отключение проверки сертификата
        //     ->post($url, $data);

        // if (!$response->successful()) {
        //     // Вывод статуса и тела ответа
        //     echo "Ошибка:\n";
        //     echo "HTTP статус: " . $response->status() . "\n";
        //     echo "Тело ответа: " . $response->body() . "\n";

        //     // Вывод дополнительной информации, если требуется
        //     if ($response->clientError()) {
        //         echo "Клиентская ошибка (4xx)\n";
        //     }
        //     if ($response->serverError()) {
        //         echo "Серверная ошибка (5xx)\n";
        //     }
        // }

        $phone = $request['phone'] ? $this->formatPhoneNumber($request['phone']) : null;
        $header = $request['header'];
        $comment = $request['comment'];
        $name = $request['name'];
        $lastname = $request['lastname'];
        $organization = $request['organization'];

        $qrcode = $this->qrcode($request);

        // Формирование Title
        $titleParts = [];

        // Формируем заголовок с приоритетом на персонализацию
        if ($name || $lastname) {
            $titleParts[] = trim("Свяжитесь с {$name} {$lastname}");
        } elseif ($organization) {
            $titleParts[] = "Контакты компании {$organization}";
        } else {
            $titleParts[] = "Контактный номер телефона";
        }

        if ($phone) {
            $titleParts[] = "({$phone})";
        }

        $title = implode(' ', array_filter($titleParts));

        // Формирование Description
        $titleParts = [];

        // Добавляем имя и фамилию
        if ($name) {
            $titleParts[] = $name;
        }
        if ($lastname) {
            $titleParts[] = $lastname;
        }

        // Добавляем организацию или комментарий
        if ($organization) {
            $titleParts[] = $organization;
        } elseif ($header) {
            $titleParts[] = $comment;
        }

        if ($phone) {
            $titleParts[] = $phone;
        }

        $title = implode(' ', $titleParts);

        // Формирование Description
        $descriptionParts = [];

        // Используем имя и фамилию
        if ($name) {
            $descriptionParts[] = $name;
        }
        if ($lastname) {
            $descriptionParts[] = $lastname;
        }

        // Добавляем организацию или комментарий
        if ($organization) {
            $descriptionParts[] = $organization;
        } elseif ($comment) {
            $descriptionParts[] = $comment;
        }

        // Добавляем телефон
        if ($phone) {
            $descriptionParts[] = $phone;
        }

        // Формируем итоговое описание
        $description = implode(' ', $descriptionParts);


        return view('pages.phones.show', compact('title', 'description', 'header', 'comment', 'phone', 'name', 'lastname', 'organization', 'qrcode'));
    }

    public function qrcode(Request $request)
    {
        $vCardData = "BEGIN:VCARD\nVERSION:3.0\n";

        // Основные данные
        $vCardData .= $request->has('lastname') || $request->has('name')
            ? "N:{$request->input('lastname', '')};{$request->input('name', '')}\n"
            : "";
        $vCardData .= $request->has('name') || $request->has('lastname')
            ? "FN:{$request->input('name', '')} {$request->input('lastname', '')}\n"
            : "";

        // Организация и должность
        $vCardData .= $request->has('organization') ? "ORG:{$request->organization}\n" : "";
        $vCardData .= $request->has('header') ? "TITLE:{$request->header}\n" : "";

        // Контакты
        $vCardData .= $request->has('work_phone') ? "TEL;WORK;VOICE:{$request->work_phone}\n" : "";
        $vCardData .= $request->has('home_phone') ? "TEL;HOME;VOICE:{$request->home_phone}\n" : "";
        $vCardData .= $request->has('phone') ? "TEL;CELL:{$request->phone}\n" : "";
        $vCardData .= $request->has('fax') ? "TEL;FAX:{$request->fax}\n" : "";
        $vCardData .= $request->has('email') ? "EMAIL:{$request->email}\n" : "";
        $vCardData .= $request->has('website') ? "URL:{$request->website}\n" : "";

        // Адрес
        if ($request->hasAny(['street', 'city', 'region', 'postal_code', 'country'])) {
            $street = $request->input('street', '');
            $city = $request->input('city', '');
            $region = $request->input('region', '');
            $postalCode = $request->input('postal_code', '');
            $country = $request->input('country', '');
            $vCardData .= "ADR;WORK:;;$street;$city;$region;$postalCode;$country\n";
        }

        // День рождения
        $vCardData .= $request->has('date') ? "BDAY:{$request->date}\n" : "";

        // Фото
        $vCardData .= $request->has('photo') ? "PHOTO;VALUE=URI:{$request->photo}\n" : "";

        // Примечание
        $vCardData .= $request->has('comment') ? "NOTE:{$request->comment}\n" : "";

        // Социальные сети (неофициальное расширение X-SOCIALPROFILE)
        // $vCardData .= $request->has('instagram') ? "X-SOCIALPROFILE;type=instagram:{$request->instagram}\n" : "";
        // $vCardData .= $request->has('linkedin') ? "X-SOCIALPROFILE;type=linkedin:{$request->linkedin}\n" : "";
        // $vCardData .= $request->has('facebook') ? "X-SOCIALPROFILE;type=facebook:{$request->facebook}\n" : "";
        // $vCardData .= $request->has('phonetact') ? "X-SOCIALPROFILE;type=phonetact:{$request->twitter}\n" : "";

        // Завершение vCard
        $vCardData .= "END:VCARD";

        $builder = new Builder(
            writer: new PngWriter(),
            data: $vCardData,
            encoding: new Encoding('UTF-8'),
            errorCorrectionLevel: ErrorCorrectionLevel::High,
            size: 200,
            margin: 0

            // logoPath: storage_path('phonetact-qr.png'),
            // logoResizeToWidth: 55,
            // logoPunchoutBackground: true,
        );

        $result = $builder->build();

        $base64 = base64_encode($result->getString());

        // Возвращаем строку в представление
        return "data:image/png;base64,{$base64}";

        // Возвращаем изображение
        // return response($result->getString(), 200)
        //     ->header('Content-Type', 'image/png');
    }

    public function formatPhoneNumber(string $number): string
    {
        $digits = preg_replace('/\D/', '', $number);

        if (strpos($digits, '8') === 0) {
            $digits = '7' . substr($digits, 1);
        } elseif (strpos($digits, '7') !== 0) {
            $digits = '7' . $digits;
        }

        return '+' . $digits;
    }
}
