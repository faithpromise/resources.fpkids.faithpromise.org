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

        <svg xmlns="http://www.w3.org/2000/svg" style="display:none;">
            <defs>
                <symbol id="hand-right" viewBox="0 0 28 28">
                    <path class="path1" d="M4 21c0-0.547-0.453-1-1-1s-1 0.453-1 1 0.453 1 1 1 1-0.453 1-1zM26 12c0-1.062-0.953-2-2-2h-9c0-0.984 1.5-2 1.5-4 0-1.5-1.172-2-2.5-2-0.438 0-1.234 1.813-1.406 2.172-0.187 0.344-0.375 0.688-0.578 1.016-0.516 0.828-1.109 1.547-1.75 2.266-1 1.141-2.109 2.547-3.766 2.547h-0.5v10h0.5c2.734 0 5.406 2 8.437 2 1.75 0 2.953-0.734 2.953-2.609 0-0.297-0.031-0.594-0.078-0.875 0.656-0.359 1.016-1.25 1.016-1.969 0-0.375-0.094-0.75-0.281-1.078 0.531-0.5 0.828-1.125 0.828-1.859 0-0.5-0.219-1.234-0.547-1.609h5.172c1.078 0 2-0.922 2-2zM28 11.984c0 2.188-1.813 4.016-4 4.016h-2.641c-0.047 0.656-0.25 1.281-0.578 1.859 0.031 0.219 0.047 0.453 0.047 0.672 0 1-0.328 2-0.938 2.781 0.031 2.953-1.984 4.688-4.875 4.688-1.75 0-3.406-0.484-5.031-1.078-0.953-0.344-2.5-0.922-3.484-0.922h-4.5c-1.109 0-2-0.891-2-2v-10c0-1.109 0.891-2 2-2h4.5c0.75 0 1.813-1.344 2.266-1.859 0.562-0.641 1.094-1.281 1.563-2.016 0.906-1.453 1.578-4.125 3.672-4.125 2.484 0 4.5 1.359 4.5 4 0 0.688-0.109 1.359-0.344 2h5.844c2.156 0 4 1.828 4 3.984z"></path>
                </symbol>
                <symbol id="cart" viewBox="0 0 28 28">
                    <path class="path1" d="M27.453 22l0.547 4.891c0.031 0.281-0.063 0.562-0.25 0.781-0.187 0.203-0.469 0.328-0.75 0.328h-26c-0.281 0-0.562-0.125-0.75-0.328-0.187-0.219-0.281-0.5-0.25-0.781l0.547-4.891h26.906zM26 8.891l1.344 12.109h-26.688l1.344-12.109c0.063-0.5 0.484-0.891 1-0.891h4v2c0 1.109 0.891 2 2 2s2-0.891 2-2v-2h6v2c0 1.109 0.891 2 2 2s2-0.891 2-2v-2h4c0.516 0 0.938 0.391 1 0.891zM20 6v4c0 0.547-0.453 1-1 1s-1-0.453-1-1v-4c0-2.203-1.797-4-4-4s-4 1.797-4 4v4c0 0.547-0.453 1-1 1s-1-0.453-1-1v-4c0-3.313 2.688-6 6-6s6 2.688 6 6z"></path>
                </symbol>
                <symbol id="chevron-left" viewBox="0 0 21 28">
                    <path class="path1" d="M18.297 4.703l-8.297 8.297 8.297 8.297c0.391 0.391 0.391 1.016 0 1.406l-2.594 2.594c-0.391 0.391-1.016 0.391-1.406 0l-11.594-11.594c-0.391-0.391-0.391-1.016 0-1.406l11.594-11.594c0.391-0.391 1.016-0.391 1.406 0l2.594 2.594c0.391 0.391 0.391 1.016 0 1.406z"></path>
                </symbol>
            </defs>
        </svg>

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