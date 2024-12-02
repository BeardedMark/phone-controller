<div class="flex-col flex-{{isset($flex) ? $flex : 'start' }}">
    <a class="font-color-contrast font-color-accent-hover speed-norm" href="{{ route('phones.index') }}">Ввести номер</a>
    <a class="font-color-contrast font-color-accent-hover speed-norm" href="{{ route('phones.create') }}">Создать
        карточку</a>
</div>

<div class="flex-col flex-{{ isset($flex) ? $flex : 'start' }}">
    <a class="font-color-contrast font-color-accent-hover speed-norm"
        href="{{ route('phones.show', ['phone' => '9876543210', 'header' => 'Заголовок', 'comment' => 'Комментарий', 'name' => 'Имя', 'lastname' => 'Фамилия', 'organization' => 'Организация']) }}">Пример</a>
        <a class="font-color-contrast font-color-accent-hover speed-norm" href="{{ route('phones.about') }}">Описание</a>
</div>

<div class="flex-col flex-{{ isset($flex) ? $flex : 'start' }}">
    <a class="font-color-contrast font-color-accent-hover speed-norm"
        href="{{ route('phones.index', ['to' => 'WhatsApp']) }}">для WhatsApp</a>
    <a class="font-color-contrast font-color-accent-hover speed-norm"
        href="{{ route('phones.index', ['to' => 'Telegram']) }}">для Telegram</a>
    <a class="font-color-contrast font-color-accent-hover speed-norm"
        href="{{ route('phones.index', ['to' => 'Viber']) }}">для Viber</a>
</div>

{{-- <div class="flex-col flex-{{ isset($flex) ? $flex : 'start' }}">
    <a class="lock-opacity font-size-sm font-color-second font-color-accent-hover speed-norm" href="">Скачать
        ярлык</a>
    <a class="lock-opacity font-size-sm font-color-second font-color-accent-hover speed-norm" href="">Скачать
        расширение</a>
</div> --}}
