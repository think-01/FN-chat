@extends('Layout')

@section('header')
    <style>
        a
        {
            display:block;
            font-size: 20px;
            padding: 3px 10px;
        }
    </style>
@stop

@section('body')
    <a href="{{ URL::to('uzytkownicy') }}">Lista użytkowników</a>
    <a href="{{ URL::to('wiadomosciuzytkownika') }}">Wiadomości losowego użytkownika</a>
    <a href="{{ URL::to('wyslijlosowawiadomosc') }}">Wyślij losową wiadomość</a>
    <a href="{{ URL::to('napiszwiadomosc') }}">Wyślij własną wiadomość</a>
    <br/>
    <br/>
    <a href="https://github.com/think-01/FN-chat" target="blank">Źródła</a>
    <a href="https://github.com/think-01/FN-chat/blob/master/init.sql" target="blank">Skrypt inicjujący bazę</a>
@stop

