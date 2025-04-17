document.addEventListener("DOMContentLoaded", function() {
    // Check if the user has already accepted cookies
    if (!getCookie("cookiesAccepted")) {
        document.getElementById("cookieConsentInn").style.display = "block";
    }
});
 document.getElementById("closeCookieConsent").addEventListener("click", function() {
        setCookie("cookiesAccepted", "true", 365);
        document.getElementById("cookieConsentInn").style.display = "none";
    });
// Function to set a cookie
function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

// Function to get a cookie
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}