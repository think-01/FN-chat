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
            <input type="hidden" name="room" value="{{ $users[0]['room'] }}"/>
            <label>
            <select name="from">
                @foreach( $users as $user )
                    <option value="{{ $user['user'] }}">{{ $user['user'] }}</option>
                @endforeach
            </select>
            nadawca</label>
            <input type="submit" value="wyślij wiadomość"/>
            <a href="{{ URL::to('napiszwiadomosc') }}">wyślij wiadomość do innych odbiorców</a>
            <a href="{{ URL::to('konwersacja', $users[0]['room'] ) }}" target="blank">zobacz konwersację</a>
        @endif

    </form>
@stop