<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <style>
        body, html
        {
            padding:0;
            margin:0;
            font-size: 10px;
            padding-bottom:20px;
        }
        .footer
        {
            font-size: 16px;
            font-weight: bold;
            color:white;
            display:block;
            width:100%;
            background-color: brown;
            padding:3px 10px;
            position:fixed;
            bottom:0;
        }
        .footer b
        {
            color:yellow;
        }
    </style>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    @yield('header')
</head>
<body>
@yield('body')
<div class="footer">
    {{ $signal or 'Execution time' }}: <b>{{ (microtime(true) - LARAVEL_START) }}</b> sec.
</div>
</body>
</html>