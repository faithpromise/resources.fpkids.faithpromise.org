<?php

$is_production = App::environment('production');


?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>fpKids Resource Ordering</title>

        <!-- Styles -->
        @if ($is_production)
            <link rel="stylesheet" href="{{ elixir('css/app.css') }}">
        @else
            <link rel="stylesheet" href="/css/app.css">
        @endif
    </head>
    <body>

        <div class="Layout" id="app">
            <router-view></router-view>
        </div>

        <script src="https://cdn.rawgit.com/taylorhakes/promise-polyfill/master/promise.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/vue/2.0.3/vue.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/vue-router/2.0.1/vue-router.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/vue-resource/1.0.3/vue-resource.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/vuex/2.0.0/vuex.min.js"></script>

        @if ($is_production)
            <script src="{{ elixir('js/app.js') }}"></script>
        @else
            <script src="/js/app.js"></script>
        @endif
    </body>
</html>