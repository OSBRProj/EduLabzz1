const mix = require('laravel-mix');

//
//  Main css & js
//
mix.js('resources/js/app.js', 'public/assets/js/app.min.js')
.sass('resources/sass/app.scss', 'public/assets/css/app.min.css');

//
//  Browser sync
//
mix.browserSync({
    proxy: 'localhost/jpiaget-web/public',
    files: [
        "public/assets/css/app.min.css",
        "public/assets/js/app.min.js",
        //Sync files .PHP
        "resources/views/**/*.php",
        "resources/views/pages/albums/admin/**/*.php"
    ]
});


// Mural da turma de gestao
mix.babel([
    'resources/js/pages/gestao/turmas/mural.js'
], 'public/assets/js/pages/gestao/turmas/mural.min.js');


// Gestão de audios
mix.babel([
    'resources/js/pages/gestao/audios.js'
], 'public/assets/js/pages/gestao/audios.min.js');

mix.babel([
    'resources/js/pages/gestao/albuns.js'
], 'public/assets/js/pages/gestao/albuns.min.js');

mix.babel([
    'resources/js/pages/gestao/playlists.js'
], 'public/assets/js/pages/gestao/playlists.min.js');

mix.babel([
    'resources/js/pages/gestao/roteiros.js'
], 'public/assets/js/pages/gestao/roteiros.min.js');
