const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function (mix) {
    mix.sass('app.scss')
        .webpack('app.js', null, null, {
            externals: {
                'vue':          'Vue',
                'vuex':         'Vuex',
                'vue-resource': 'VueResource'
            }
        });
});

if (elixir.config.production) {
    elixir(function (mix) {
        mix.version(['css/app.css', 'js/app.js']);
    });
}