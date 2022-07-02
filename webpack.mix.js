let mix = require('laravel-mix');

// const path = require('path');
// const glob = require('glob');
// const ExtractTextPlugin = require('extract-text-webpack-plugin');
// const PurgecssPlugin = require('purgecss-webpack-plugin');
//
// const purgecss = new PurgecssPlugin();

require('laravel-mix-purgecss');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

// mix.webpackConfig({
//     plugins: [
//         new ExtractTextPlugin('[name].css?[hash]'),
//         new PurgecssPlugin({
//             paths: glob.sync(`${PATHS.src}/*`)
//         })
//     ]
// });

mix.js('resources/js/app.js', 'public/assets/js');

mix.sass('resources/scss/app.scss', 'public/assets/css/app.css');


if (mix.inProduction()) {
    // mix.purgeCss();
    mix.version();
}

