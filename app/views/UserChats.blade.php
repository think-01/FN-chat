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
                    <p><b style="color:red">{{ $message->from }}</b> <b style="color:gray">{{ $message->when }}</b> {{ $message->message }} </p>
                @endforeach
            </div>
        @endforeach
    </div>
@stop