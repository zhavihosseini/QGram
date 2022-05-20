$(document).ready(function() {

    $(".film-title").click(function() {
        $(".tag-cloud").show();
    });

    $(".fa-close").click(function() {
        $(".tag-cloud").hide();
    });

});
(function() {
    var $background = document.querySelector('main form [name="background"]');
    var $backgroundAlpha = document.querySelector('main form [name="backgroundAlpha"]');
    var $foreground = document.querySelector('main form [name="foreground"]');
    var $foregroundAlpha = document.querySelector('main form [name="foregroundAlpha"]');
    var $level = document.querySelector('main form [name="level"]');
    var $section = document.querySelector('main section');
    var $padding = document.querySelector('main form [name="padding"]');
    var $size = document.querySelector('main form [name="size"]');
    var $value = document.querySelector('main form [name="value"]');

    var qr = window.qr = new QRious({
        element: document.getElementById('qrious'),
        size: 250,
        value: 'Q Gram'
    });

    $background.addEventListener('change', function() {
        qr.background = $background.value || null;
    });

    $backgroundAlpha.addEventListener('change', function() {
        qr.backgroundAlpha = $backgroundAlpha.value || null;
    });

    $foreground.addEventListener('change', function() {
        qr.foreground = $foreground.value || null;
    });

    $foregroundAlpha.addEventListener('change', function() {
        qr.foregroundAlpha = $foregroundAlpha.value || null;
    });

    $level.addEventListener('change', function() {
        qr.level = $level.value;
    });

    $padding.addEventListener('change', function() {
        if ($padding.validity.valid) {
            qr.padding = $padding.value !== '' ? $padding.value : null;
        }
    });

    $size.addEventListener('change', function() {
        if (!$size.validity.valid) {
            return;
        }

        qr.size = $size.value || null;

        $section.style.minWidth = qr.size + 'px';
    });

    $value.value = 'Q Gram';
    $value.addEventListener('input', function() {
        qr.value = $value.value;
    });
})();
function dwn() {
    var aa = document.getElementById('qrious').src;
    var a = document.createElement("a");
    a.href = aa; //Image Base64 Goes here
    a.download = "QGRAM.png"; //File name Here
    a.click();
}

    function currentTime() {
        var date = new Date(); /* creating object of Date class */
        var hour = date.getHours();
        var min = date.getMinutes();
        var sec = date.getSeconds();
        var midday = "AM";
        midday = (hour >= 12) ? "PM" : "AM"; /* assigning AM/PM */
        hour = (hour == 0) ? 12 : ((hour > 12) ? (hour - 12): hour); /* assigning hour in 12-hour format */
        hour = changeTime(hour);
        min = changeTime(min);
        sec = changeTime(sec);
        document.getElementById("digit_clock_time").innerText = hour + " : " + min + " : " + sec + " " + midday; /* adding time to the div */

        var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        var days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

        var curWeekDay = days[date.getDay()]; // get day
        var curDay = date.getDate();  // get date
        var curMonth = months[date.getMonth()]; // get month
        var curYear = date.getFullYear(); // get year
        var date = curWeekDay+", "+curDay+" "+curMonth+" "+curYear; // get full date


        var t = setTimeout(currentTime, 1000); /* setting timer */
    }

function changeTime(k) { /* appending 0 before time elements if less than 10 */
    if (k < 10) {
        return "0" + k;
    }
    else {
        return k;
    }
}

currentTime();
