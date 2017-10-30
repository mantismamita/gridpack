const FontFaceObserver = require('fontfaceobserver');

console.log('these are on every page', FontFaceObserver );

const titleFont = new FontFaceObserver('Roboto Slab');

titleFont.load().then(function () {
    console.log('Roboto Slab has loaded.');
});

titleFont.load().then(function () {
    sessionStorage.fontsLoaded = true;
}).catch(function () {
    sessionStorage.fontsLoaded = false;
});

if (sessionStorage.fontsLoaded) {
    var html = document.documentElement;

    html.classList.add('fonts-loaded');
}