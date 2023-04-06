const mix = require('laravel-mix');

function findFiles(dir) {
    const fs = require('fs');
    return fs.readdirSync(dir).filter(file => {
        return fs.statSync(`${dir}/${file}`).isFile();
    });
}
function buildSass(dir, dest) {
    findFiles(dir).forEach(function (file) {
        if ( ! file.startsWith('_')) {
            mix.sass(dir + '/' + file, dest);
        }
    });
}

buildSass('resources/sass', 'public/css');

mix.js('resources/js/app.js', 'public/js');
