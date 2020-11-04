const mix = require('laravel-mix');
let WebpackShellPlugin = require('webpack-shell-plugin');

let inputAssetsPath = 'resources/assets';
let outputAssetsPath = 'public/assets';
let nodeModulesPath = 'node_modules';

mix.setPublicPath(outputAssetsPath);
mix.options({
    processCssUrls: false
});

//  #######  Fonts and flags files  #######
mix.copyDirectory(inputAssetsPath+'/fonts/', outputAssetsPath+'/fonts/');
mix.copyDirectory(nodeModulesPath+'/@fortawesome/fontawesome-free/webfonts/', outputAssetsPath+'/fonts/');
mix.copyDirectory(nodeModulesPath+'/flag-icon-css/flags/4x3', outputAssetsPath+'/flags/4x3');
mix.copyDirectory(nodeModulesPath+'/flag-icon-css/flags/1x1', outputAssetsPath+'/flags/1x1');
mix.copyDirectory(nodeModulesPath+'/leaflet/dist/images', outputAssetsPath+'/images');
mix.copyDirectory(nodeModulesPath+'/leaflet.awesome-markers/dist/images', outputAssetsPath+'/images');


// #######  Compile SASS to CSS  #######
mix.sass(inputAssetsPath+'/sass/vendor.scss',   outputAssetsPath+'/vendor.css');
mix.sass(inputAssetsPath+'/sass/app.scss',   outputAssetsPath+'/custom.css');
mix.sass(inputAssetsPath+'/sass/pdf.scss', outputAssetsPath+'/pdf.css');


// #######  Compile JS  #######
mix.webpackConfig({
    plugins: [
        // Add shell command plugin configured to create JavaScript language file
        new WebpackShellPlugin({onBuildStart:['php artisan lang:js --quiet public/assets/lang.js'], onBuildEnd:[]})
    ]
});
mix.js(inputAssetsPath+'/js/vendor.js', outputAssetsPath+'/vendor.js').sourceMaps();
mix.js(inputAssetsPath+'/js/vendor_mapping.js', outputAssetsPath+'/vendor_mapping.js');
mix.js(inputAssetsPath+'/js/mapping.js', outputAssetsPath+'/mapping.js');
mix.js(inputAssetsPath+'/js/app.js', outputAssetsPath+'/custom.js');
mix.js(inputAssetsPath+'/js/pdf.js', outputAssetsPath+'/pdf.js');


// #######  Versioning JS and CSS  #######
mix.version([
    outputAssetsPath+'/vendor.css',
    outputAssetsPath+'/custom.css',
    outputAssetsPath+'/pdf.css',
    outputAssetsPath+'/pdf.js',
    outputAssetsPath+'/vendor.js',
    outputAssetsPath+'/mapping.js',
    outputAssetsPath+'/vendor_mapping.js',
    outputAssetsPath+'/lang.js',
    outputAssetsPath+'/custom.js'
]);


