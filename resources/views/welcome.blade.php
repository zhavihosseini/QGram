<html>
<title>Firebase Messaging Demo</title>
<style>
    div {
        margin-bottom: 15px;
    }
</style>
<body>
<div id="token"></div>
<div id="msg"></div>
<div id="notis"></div>
<div id="err"></div>
<script src="https://www.gstatic.com/firebasejs/7.16.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.16.1/firebase-messaging.js"></script>
<script>
    MsgElem = document.getElementById("msg");
    TokenElem = document.getElementById("token");
    NotisElem = document.getElementById("notis");
    ErrElem = document.getElementById("err");
    // Initialize Firebase
    // TODO: Replace with your project's customized code snippet
    var config = {
            apiKey: "AIzaSyB4xK8vkM9AWOpNBXPiFZS0jgLmoivIJxY",
            authDomain: "q-gram.firebaseapp.com",
            databaseURL: "https://q-gram-default-rtdb.firebaseio.com",
            projectId: "q-gram",
            storageBucket: "q-gram.appspot.com",
            messagingSenderId: "891606874351",
            appId: "1:891606874351:web:e846845ecba7bc57c4431a",
            measurementId: "G-RMLK0JB5E0"
    };
    firebase.initializeApp(config);

    const messaging = firebase.messaging();
    messaging
        .requestPermission()
        .then(function () {
            MsgElem.innerHTML = "Notification permission granted."
            console.log("Notification permission granted.");

            // get the token in the form of promise
            messaging.getToken({vapidKey:"BJ7DLqOgeUD7-Ccusw_c2bt9hhxP66IxvGNKMvYBO6CQE5ztQQWe_GACDFUBuYFieBCVmJEQNjgZhS9RDfPzeps"})
        })
        .then(function(token) {
            TokenElem.innerHTML = "token is : " + token
        })
        .catch(function (err) {
            ErrElem.innerHTML =  ErrElem.innerHTML + "; " + err
            console.log("Unable to get permission to notify.", err);
        });

    let enableForegroundNotification = true;
    messaging.onMessage(function(payload) {
        console.log("Message received. ", payload);
        NotisElem.innerHTML = NotisElem.innerHTML + JSON.stringify(payload);

        if(enableForegroundNotification) {
            const {title, ...options} = JSON.parse(payload.data.notification);
            navigator.serviceWorker.getRegistrations().then(registration => {
                registration[0].showNotification(title, options);
            });
        }
    });
</script>
</body>

</html>
