@extends('Layout')

@section('header')
    <script>
        $(function() {
            $( "#accordion" ).accordion({
                collapsible: true,
                heightStyle: "content"
            });
        });
    </script>
@stop

@section('body')
    <div id="accordion">
        @foreach ($chat as $room => $messages )
            <h3>Room #{{ $room }}</h3>
            <div>
                @foreach ($messages as $message )
                    <p><b>
                            <a style="color:blue" href="{{ URL::to('wiadomosciuzytkownika',$message->from) }}">
                            {{ $message->from }}</a></b> <b style="color:gray">{{ $message->when }}</b> {{ $message->message }} </p>
                @endforeach
            </div>
        @endforeach
    </div>
@stop