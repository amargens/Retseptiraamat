
window.onload = function() {
    
}


function changeLang(lang) {
    var translate = new Translate();
    var currentLng = lang;//'en'
    var attributeName = 'data-tag';
    translate.init(attributeName, currentLng);
    translate.process(); 
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function checkCookie() {
    var user = getCookie("username");
    if (user != "") {
        alert("Welcome again " + user);
    } else {
        user = prompt("Please enter your name:", "");
        if (user != "" && user != null) {
            setCookie("username", user, 365);
        }
    }
}

function sendstats(){
    var keyVals = { checkBrowser : checkBrowser(), getTime : getTime(), title : title };
    $.ajax({
        type: "POST",
        url: "sendstats",
        data: keyVals,
        dataType: "text",
        success: function(msg){
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
        }
    });
}

function checkBrowser() {
        // Opera 8.0+
    var isOpera = (!!window.opr && !!opr.addons) || !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;

    // Firefox 1.0+
    var isFirefox = typeof InstallTrigger !== 'undefined';

    // Safari 3.0+ "[object HTMLElementConstructor]" 
    var isSafari = /constructor/i.test(window.HTMLElement) || (function (p) { return p.toString() === "[object SafariRemoteNotification]"; })(!window['safari'] || safari.pushNotification);

    // Internet Explorer 6-11
    var isIE = /*@cc_on!@*/false || !!document.documentMode;

    // Edge 20+
    var isEdge = !isIE && !!window.StyleMedia;

    // Chrome 1+
    var isChrome = !!window.chrome && !!window.chrome.webstore;

    // Blink engine detection
    var isBlink = (isChrome || isOpera) && !!window.CSS;
    
    if (isFirefox) {
        return 'Firefox';
    } else if (isChrome) {
        return 'Chrome';
    } else if (isSafari) {
        return 'Safari';
    } else if (isOpera) {
        return 'Opera';
    } else if (isIE) {
        return 'IE';
    } else if (isEdge) {
        return 'Edge';
    } else {
        return 'other';
    }
}

function getTime(){
    var d = new Date();
    var h = d.getHours();
    if (h < 2) {
        return '0-2';
    } else if (h < 4) {
        return '2-4';
    } else if (h < 6) {
        return '4-6';
    } else if (h < 8) {
        return '6-8';
    } else if (h < 10) {
        return '8-10';
    } else if (h < 12) {
        return '10-12';
    } else if (h < 14) {
        return '12-14';
    } else if (h < 16) {
        return '14-16';
    } else if (h < 18) {
        return '16-18';
    } else if (h < 20) {
        return '18-20';
    } else if (h < 22) {
        return '20-22';
    } else {
        return '22-24';
    }
}
