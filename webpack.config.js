var Encore = require('@symfony/webpack-encore');

Encore
    // the project directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // the public path used by the web server to access the previous directory
    // .setPublicPath('/build')
    .setPublicPath('http://www.promohoteltunisie.com/octa/public/build/')
    .setManifestKeyPrefix('build/')

    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    // uncomment to create hashed filenames (e.g. app.abc123.css)
     .enableVersioning(Encore.isProduction())

    // uncomment to define the assets of the project
     .addEntry('js/app', './assets/js/app.js')
     .addStyleEntry('css/app', './assets/scss/app.scss')

    // uncomment if you use Sass/SCSS files
     .enableSassLoader(function(sassOptions) {}, {
             resolveUrlLoader: false
     })

    // uncomment for legacy applications that require $/jQuery as a global variable
     .autoProvidejQuery()

     // show OS notifications when builds finish/fail
    .enableBuildNotifications()
;

if (Encore.isProduction()) {
    Encore.configureFilenames({
        images: '[path][name].[hash:8].[ext]',
        fonts: '[path][name].[hash:8].[ext]'
    });
} else {
    Encore.configureFilenames({
        images: '[path][name].[ext]',
        fonts: '[path][name].[ext]'
    });
}

module.exports = Encore.getWebpackConfig();
