CONTACT


Tutorial: Web Push notification using Firebase
JUL
22
2020
Another Step towards Progressive Web Application
Progressive Web App (PWA) is defining the future form of web app. Google has predicted that PWA is going to replace a lot of mobile apps in coming 2-3 years. It's not a surprise that Founder of Tapzo's summarized in his article The mobile app industry's worst-kept secret has reflected that lack of storage is the main reason 60-80% users are uninstalling the native mobile app within 90 days.

In comparison to web app, mobile app is able to access to the mobile native features like push notification, camera and others that the web app does not have. Well, the great news is, with the arrival of PWA, the web app is now finally able to access more native features.

Let's dive in to learn one of the very key benefit PWA is offering: engagement.

Push Notification In Web App
Push notification has been one of the effective ways to improve retention rate and increase user engagement. The timely received push notification remind users to react to online messaging, go to check out the cart before the offers and sales end, and even to notify users that their kingdom is under attacked by the enemy player so users can react before it's too late.

The magic of the push notification is that it allows the devices to get update from the server without draining your battery. Once you have enabled the push notification, you are able to receive the alert even without visiting the website.

Example: How a Marketing Site keep us more engaged
neilpatel.com is one of the great SEO marketing sites which has made good use of the push notification. Once you allow the site to send you notifications, you will see the pop-up notification first thing you open the Chrome browser, that shows you the newest blog from the site on the daily basis. This really improves our engagement with the site for more than 50% than in the past.

Therefore, you need to have push notification for your web app. In fact, it is not that difficult to enable it, and we will show you the detailed step by step how to develop a push notification demo web app very shortly.

What's Firebase Cloud Messaging
Firebase Cloud Messaging (FCM) is a service offered by Google to let you relay server messages to registered devices and web app. FCM service is free of charge with some limitations. The size is limited to 2KB or 4KB depending on the type of data, and the message will be kept for default duration of 4 weeks before it gets deleted.

FCM offers an array of helpful tools to help you create the right engagements with users. You can create A/B testing to see which what are the optimal wording and presentation to use. You can study the users' behaviour via the analytics data provided.

Firebase Predictions is latest and perhaps the most exciting features added the to platform. Predictions apply Google's machine learning to your analytics data to predict the users' likely action based on users' behaviour.

For example of a game app, a user who is likely to spend money to upgrade the game equipment, when he/she fail to pass the stage, the app will offer the option to let user purchase more advanced equipment to continue the game. On the other hand, for free players, the app will trigger an advertisement to let the user watch to continue the game.

Besides FCM, you can also consider Amazon Simple Notification Service (SNS) and OneSignal. Both are also popular and used by a lot of developers. If you are keen to see how both services work, we can write another demo app next time.

Demo Tutorial
In this article, we will walk you through an easy to follow tutorial on how you can enable push notification using FCM. We will also share with you some of the small tips what to take note of so you can have this up as quickly as possible.

Tutorial Step 1: Register Firebase account
Head to Firebase site and click "Go To Console". Once signed in you will see the following page. Click "Add Project" to create a new project. Give your project a name, and choose the country/region that reflects your currency and revenue reporting.

Firebase console page
Firebase console page

Tutorial Step 2: Getting your Project & Web App Credentials Info
(Updated: 23 Jul 2020) Recent update requires user to register web app, as you will need the appId value. Give the web app a name, then click next and you will get your config like this. The config can be retrieved "Your apps" section in the Project Setting as well after you have created it.firebase-create-web

Now, Click on the clog icon beside the "Project Overview" at the top left > choose "Project Settings". Then click on "Cloud Messaging" at the settings page like below. Take note of the Server Key and Sender ID, you will need this later. You can ignore the "Legacy server key" and use "Server Key". Otherwise. you will face a problem when running the curl to test sending the notification.

get server key from settings page
Firebase Project Settings for Cloud Messaging

Tutorial Step 3: Create the Simple HTML
Without further ado, let's start writing the simple HTML code. The page will show us the token and any message sent by the Firebase to us later.

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
<script>
    MsgElem = document.getElementById("msg")
    TokenElem = document.getElementById("token")
    NotisElem = document.getElementById("notis")
    ErrElem = document.getElementById("err")
</script>
</body>
</html>
