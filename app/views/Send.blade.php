@extends('Layout')

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
        form a
        {
            padding: 3px 10px;
            font-size: 14px;;
        }
    </style>
    <script>

    </script>
@stop

@section('body')
    <form method="POST">
        <label><textarea name="message"></textarea>wiadomość</label>
        @if( count($users)==0 )
            <label><input type="text" name="to"/>odbiorcy</label>
            <label><input type="text" name="from"/>nadawca</label>
            <input type="submit" value="wyślij wiadomość"/>
        @else
            <pre>{{ print_r($users) }}</pre>
            <input type="submit" value="wyślij wiadomość"/>
            <a href="{{ URL::to('napiszwiadomosc') }}">wyślij wiadomość do innych odbiorców</a>

        @endif

    </form>
@stop