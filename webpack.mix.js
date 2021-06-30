const mix = require('laravel-mix');
let WebpackShellPlugin = require('webpack-shell-plugin');

let with_vendor = !(process.env.NO_VENDOR=== 'true' ? true : false);

let inputAssetsPath = 'resources/assets_imet/assets';
let outputAssetsPath = 'public/assets';

mix.setPublicPath(outputAssetsPath);
mix.options({
    processCssUrls: false
});


// # ------------------------------------- #
// # ---------  Compile Vendors  --------- #
// # ------------------------------------- #
if(with_vendor){

    // Fonts and flags files
    mix.copyDirectory(inputAssetsPath+'/fonts/', outputAssetsPath+'/fonts/');
    mix.copyDirectory('node_modules/@fortawesome/fontawesome-free/webfonts/', outputAssetsPath+'/fonts/');
    mix.copyDirectory('node_modules/flag-icon-css/flags/4x3', outputAssetsPath+'/flags/4x3');
    mix.copyDirectory('node_modules/flag-icon-css/flags/1x1', outputAssetsPath+'/flags/1x1');
    mix.copyDirectory('node_modules/leaflet/dist/images', outputAssetsPath+'/images');
    mix.copyDirectory('node_modules/leaflet.awesome-markers/dist/images', outputAssetsPath+'/images');

    // CSS
    mix.sass(inputAssetsPath+'/sass/vendor.scss',   outputAssetsPath+'/vendor.css');

    // JS
    mix.js(inputAssetsPath+'/js/vendor.js', outputAssetsPath+'/vendor.js').sourceMaps();
    mix.js(inputAssetsPath+'/js/vendor_mapping.js', outputAssetsPath+'/vendor_mapping.js');
}

// # ------------------------------------- #
// # ----------  Compile Custom  --------- #
// # ------------------------------------- #

// CSS
mix.sass(inputAssetsPath+'/sass/app.scss',   outputAssetsPath+'/custom.css');
mix.sass(inputAssetsPath+'/sass/pdf.scss', outputAssetsPath+'/pdf.css');

// JS
mix.js(inputAssetsPath+'/js/mapping.js', outputAssetsPath+'/mapping.js');
mix.js(inputAssetsPath+'/js/app.js', outputAssetsPath+'/custom.js');
mix.js(inputAssetsPath+'/js/pdf.js', outputAssetsPath+'/pdf.js');

// lang (from laravel)
mix.webpackConfig({
    plugins: [
        // Add shell command plugin configured to create JavaScript language file
        new WebpackShellPlugin({onBuildStart:['php artisan lang:js --quiet public/assets/lang.js'], onBuildEnd:[]})
    ]
});


// # ------------------------------------- #
// # -------------  Versioning  ---------- #
// # ------------------------------------- #

mix.version([
    outputAssetsPath+'/vendor.css',
    outputAssetsPath+'/vendor.js',
    outputAssetsPath+'/vendor_mapping.js',
    outputAssetsPath+'/custom.css',
    outputAssetsPath+'/custom.js',
    outputAssetsPath+'/pdf.css',
    outputAssetsPath+'/pdf.js',
    outputAssetsPath+'/mapping.js',
    outputAssetsPath+'/lang.js'
]);


