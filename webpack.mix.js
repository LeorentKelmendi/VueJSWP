const mix = require('laravel-mix');
mix.setPublicPath('.')
mix.js('assets/js/app/app.js', 'public/js/')
  .sass('assets/scss/app/app.scss', 'public/css/');
