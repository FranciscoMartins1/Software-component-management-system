function saveLanguage() {
    var selectElement = document.getElementById("google_translate_element");
    var selectedLanguage = selectElement.querySelector('.goog-te-combo').value;
    localStorage.setItem('selectedLanguage', selectedLanguage);
}

window.onload = function() {
    var savedLanguage = localStorage.getItem('selectedLanguage');

    if (savedLanguage) {
        var selectElement = document.getElementById("google_translate_element");
        selectElement.querySelector('.goog-te-combo').value = savedLanguage;
    }
};

function googleTranslateElementInit() {
    new google.translate.TranslateElement({
        pageLanguage: 'en',
        includedLanguages: 'en,pt,es,fr',
    }, 'google_translate_element');
}

var script = document.createElement('script');
script.type = 'text/javascript';
script.src = '//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';
document.getElementsByTagName('head')[0].appendChild(script);