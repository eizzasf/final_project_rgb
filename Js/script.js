function rememberMe() {
    var rememberme = document.forms["loginForm"]["idremember"].checked;
    var email = document.forms["loginForm"]["idemail"].value;
    var passwd = document.forms["loginForm"]["idpasswd"].value;
    console.log("Form data:" + rememberme + "," + email + "," + passwd);
    if (!rememberme) {
        setCookies("cemail", "", 0);
        serCookies("cpasswd", "", 0);
        setCookies("crem", "", 0);
        document.forms["loginForm"]["idemail"].value = "";
        document.forms["loginForm"]["idpasswd"].value = "";
        document.forms["loginForm"]["idremember"].checked = false;
        alert("Credentials removed");
    }else {
        if (email == "" && passwd == "") {
            document.forms["loginForm"]["idremember"].checked = false;
            alert("Please enter your credentials");
            return false;
        } else {
            setCookies("cemail", email, 30);
            setCookies("cpasswd", passwd, 30);
            setCookies("crem", rememberme, 30);
            alert("Credentials Stored Success");
        }
    }
}

function setCookies(cookiename, cookiedata, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cookiename + "=" + cookiedata + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            returnc.substring(name.length, c.length);
        }
    }
    return "";
}

function loadCookies() {
    var username = getCookie("cemail");
    var passwd = getCookie("cpasswd");
    var rememberme = getCookie("crem");
    console.log("COOKIES:" +username, passwd. rememberme);
    document.forms["loginForm"]["idemail"].value = username;
    document.forms["loginForm"]["idpasswd"].value = passwd;
    if(rememberme) {
        document.forms["loginForm"]["idremember"].checked = true;
    } else {
        document.forms["loginForm"]["idremember"].checked = false;
    }
}

function deleteCookie(cname) {
    const d = new Date();
    d.setTime(d.getTime() + (24 * 60 * 60 * 1000));
    let expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + expires +  ";path=/";
}

function acceptCookieConsent() {
    deleteCookie('user_cookie_consent');
    setCookies('user_cookie_consent', 1, 30);
    document.getElementById("cookieNotice").style.display = "none";
}
