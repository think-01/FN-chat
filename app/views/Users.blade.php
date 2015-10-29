@extends('Layout')

@section('header')
    <style>
        .container a
        {
            display:block;
            font-size:14px;
            padding: 3px 10px;
        }
        .pagination
        {
            list-style: none;
            font-size:18px;
            margin:1 auto;
            display:block;
            text-align: center;
            width:100%;
            position:fixed;
            bottom:20px;
        }
        .pagination li
        {
            display:inline;
            padding:3px 20px;
        }
    </style>
@stop

@section('body')
    <div class="container">
    @foreach ($users as $user)
        <a href="{{ URL::to('wiadomosciuzytkownika', $user->id) }}">User #{{ $user->id }}</a>
    @endforeach
    </div>

    {{ $users->links() }}
@stop