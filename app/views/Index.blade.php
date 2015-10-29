@extends('layout')

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
@stop

