@extends('layouts.page')
@section('title', 'Создайте карточку контакта с QR-кодом на Phonetact')
@section('description', 'Быстро создайте персональную карточку контакта с QR-кодом и уникальной ссылкой. Делитесь своими данными удобно и современно — попробуйте бесплатно')

@section('content')
    <div class="flex-col-lg font-center">
        <div>
            <h1 class="font-size-lgr">Создать карточку контакта</h1>
            <p>Получите прямую ссылку на ваши контакты</p>
        </div>

        <form id="createCardForm" action="{{ route('phones.show') }}" method="get" class="flex-col-md flex-center">
            <fieldset class="flex-col-sm flex-jc-between font-center">
                <input type="text" id="header" name="header" placeholder="Заголовок"
                    class="font-center back-color-prime bord-rad-md pad-md frame-shadow-hover speed-norm w-100">
                <div class="flex-col-sm flex-jc-between">
                    <input type="text" id="lastname" name="lastname" placeholder="Фамилия"
                        class="font-center back-color-prime bord-rad-md pad-md frame-shadow-hover speed-norm w-100">
                    <input type="text" id="name" name="name" placeholder="Имя"
                        class="font-center back-color-prime bord-rad-md pad-md frame-shadow-hover speed-norm w-100">
                </div>
                <div class="flex-col-sm flex-jc-between">
                    <input type="text" id="organization" name="organization" placeholder="Организация"
                        class="font-center back-color-prime bord-rad-md pad-md frame-shadow-hover speed-norm w-100">
                    <input type="tel" id="phone" name="phone" placeholder="Телефон" value="{{ $phone }}"
                        class="font-center back-color-prime bord-rad-md pad-md frame-shadow-hover speed-norm w-100">
                </div>
                <input type="text" id="comment" name="comment" placeholder="Комментарий"
                    class="font-center back-color-prime bord-rad-md pad-md frame-shadow-hover speed-norm w-100">
            </fieldset>

            {{-- <p class="font-size-lg font-color-accent">Контакты</p>
        <p class="font-size-lg font-color-accent">Персональные данные</p>

        <fieldset class="flex-col-sm font-center">
            <div class="flex-row-sm flex-jc-between">
                <input type="tel" id="phone" name="phone" placeholder="Основной телефон" class="font-center back-color-prime bord-rad-md pad-md frame-shadow-hover speed-norm w-100">
                <input type="tel" id="secondphone" name="secondphone" placeholder="Дополнительный телефон" class="font-center back-color-prime bord-rad-md pad-md frame-shadow-hover speed-norm w-100">
            </div>
            
            <div class="flex-row-sm flex-jc-between">
                <input type="email" id="email" name="email" placeholder="Электронная почта" class="font-center back-color-prime bord-rad-md pad-md frame-shadow-hover speed-norm w-100">
                <input type="url" id="website" name="website" placeholder="Веб-сайт" class="font-center back-color-prime bord-rad-md pad-md frame-shadow-hover speed-norm w-100">
            </div>
        </fieldset>

        <p class="font-size-lg font-color-accent">Геолокация</p>

        <fieldset class="flex-col-sm font-center">
            <div class="flex-row-sm flex-jc-between">
                <input type="text" id="postcode" name="postcode" placeholder="Почтовый индекс" class="font-center back-color-prime bord-rad-md pad-md frame-shadow-hover speed-norm w-100">
                <input type="text" id="country" name="country" placeholder="Страна" class="font-center back-color-prime bord-rad-md pad-md frame-shadow-hover speed-norm w-100">
                <input type="text" id="region" name="region" placeholder="Регион" class="font-center back-color-prime bord-rad-md pad-md frame-shadow-hover speed-norm w-100">
            </div>

            <div class="flex-row-sm flex-jc-between">
                <input type="text" id="city" name="city" placeholder="Город" class="font-center back-color-prime bord-rad-md pad-md frame-shadow-hover speed-norm w-100">
                <input type="text" id="street" name="street" placeholder="Улица" class="font-center back-color-prime bord-rad-md pad-md frame-shadow-hover speed-norm w-100">
            </div>
        </fieldset>

        <p class="font-size-lg font-color-accent">Дополнительно</p>

        <fieldset class="flex-row-sm flex-jc-between font-center">
            <input type="url" id="photo-url" name="photo-url" placeholder="Ссылка на фото" class="font-center back-color-prime bord-rad-md pad-md frame-shadow-hover speed-norm w-100">
            <input type="date" id="date" name="date" placeholder="Дата" class="font-center back-color-prime bord-rad-md pad-md frame-shadow-hover speed-norm w-100">
        </fieldset> --}}

            <button type="submit"
                class="font-color-prime font-color-prime-hover pad-x-md pad-y-sm bord-rad-md back-color-accent transform-up-hover speed-norm">Создать
                карточку
            </button>
        </form>
    </div>

    <script>
        document.getElementById('createCardForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Останавливаем стандартное поведение
            const inputs = Array.from(event.target.elements);

            inputs.forEach(input => {
                // Проверяем наличие свойства value, чтобы избежать ошибок
                if (input.type !== "submit" && typeof input.value === "string" && input.value.trim() ===
                    "") {
                    input.removeAttribute('name'); // Удаляем атрибут name для пустых полей
                }
            });
            event.target.submit(); // Отправляем форму после обработки
        });
    </script>
@endsection
