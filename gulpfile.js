const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir((mix) => {
    // element-ui css解析
    Elixir.webpack.mergeConfig({
        module: {
            loaders: [{
                test: /\.css$/,
                loader: 'style!css'
            }]
        }
    })

    mix.sass('app.scss')
       .webpack('main.js');
});
