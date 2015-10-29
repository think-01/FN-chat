@extends('layout')

@section('header')
    <style>
        .chat
        {
            font-size: 16px;
            padding:10px;
        }
    </style>
@stop

@section('body')
    <div class="chat">
    @foreach ($chat as $message )
        <p><b style="color:red">{{ $message->from }}</b> <b style="color:gray">{{ $message->when }}</b> {{ $message->message }} </p>
    @endforeach
    </div>
@stop