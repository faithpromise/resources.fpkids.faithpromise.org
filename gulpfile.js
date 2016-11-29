const elixir = require('laravel-elixir');

var del  = require('del');
var push = require('git-push');

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

elixir(mix => {
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
    elixir(mix => {
        version('css/app.css');
    })
}

gulp.task('clean_release', del.bind(null, ['_release/*', '!_release/.git'], { dot: true }));

gulp.task('copy_release', ['clean_release'], () => {
    gulp.src(
        [
            '**/*',
            '!_release{,/**}',
            '!node_modules{,/**}',
            '!storage{,/**}',
            '!public/storage',
            '!public/web.config',
            '!public/.htaccess',
            '!tests{,/**}',
            '!vendor{,/**}',
            '!**/*.+(env|gitattributes|gitignore|md|DS_Store)',
            '!composer.json',
            '!gulpfile.js',
            '!phpunit.xml',
            '!yarn.lock'
        ], { base: '.' }
    )
        .pipe(gulp.dest('./_release'));
});

gulp.task('deploy', (cb) => {
    var remote = {
        name: 'production', url: 'http://github.com/faithpromise/resources.fpkids.faithpromise.org', branch: 'release'
    };
    push('./_release', remote, cb)
});

// 'public/**/*.+(map|css|js|jpg|jpeg|png|gif|svg|php|txt|ico)',