<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{config('app.name')}}</title>
    <link rel="icon" href="{{asset('images/favicon.png')}}" sizes="16x16" type="image/png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/vue-toastr-2/dist/vue-toastr-2.min.css">
    
    @if (config('app.env') == 'local')
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
    @else
        <link rel="stylesheet" href="{{asset(mix('css/app.css'), true)}}">
    @endif
</head>
<body>
    <div id="app">
        <router-view></router-view>
    </div>

    <script src="https://unpkg.com/vue-toastr-2/dist/vue-toastr-2.js"></script>
    @if (config('app.env') == 'local')
        <script src="{{asset('js/app.js')}}"></script>
    @else
        <script src="{{asset(mix('js/app.js'), true)}}"></script>
    @endif
    
</body>
</html>
