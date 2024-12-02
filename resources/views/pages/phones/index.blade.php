@extends('layouts.page')
@section('title', 'Phonetact - Легкий способ связаться по номеру телефона')
@section('description', 'Воспользуйтесь номером телефона для отправки сообщений, звонков или создания QR-кода контакта. Phonetact — минималистичный и удобный инструмент для общения')

@section('content')
<div class="flex-col-lg font-center">
    <div>
        <h1 class="font-size-lgr">Связаться по номеру телефона</h1>
        <p>Написать {{ $phoneTarget ?: 'по номеру телефона'}} не добавляя в контакты</p>
    </div>
    
    @component('pages.components.numpad')
    @endcomponent
</div>
@endsection
