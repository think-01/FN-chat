@extends('layout')

@section('header')
    <style>
        form
        {
            padding:10px;
            width:70%;
        }
        label
        {
            font-size: 12px;
            display:block;
            width:100%;
            margin-bottom:20px;
        }
        label input
        {
            width:100%;
        }
        label textarea
        {
            width:100%;
            resize: none;
            height:300px;
        }
    </style>
    <script>

    </script>
@stop

@section('body')
    <form method="POST">
        <label><textarea name="message"></textarea>wiadomość</label>
        <label><input type="text" name="to"/>odbiorcy</label>
        <label><input type="text" name="from"/>nadawcy</label>
        <input type="submit" value="wyślij wiadomość"/>
    </form>
@stop