<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Ferma Project</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{asset('/css/bulma.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('/fontawesome/css/all.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('/css/ferma.css')}}">
    </head>
    <body>
        <div id="app">            
            <div class="page">
                <div  class="section-container">
                    <div class="page-section page-setup" id="section1">
                        <nav-bar></nav-bar>
                        <figure class="ferma-logo">
                            <img src="/images/ferma_logo.png">
                        </figure>
                        <h1 class="title is-4 titling">Report Bad Roads Or Bad Traffic Areas</h1>
                        <carousel></carousel>
                        <modal-trigger></modal-trigger>
                    </div>                    
                </div>
            </div>
            
        </div>
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
