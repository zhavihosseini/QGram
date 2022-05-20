
<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<script>
    window.OneSignal = window.OneSignal || [];
    OneSignal.push(function() {
        OneSignal.init({
            appId: "a34e9977-1d82-41a2-8f82-33c0cbcd712d",
            notifyButton: {
                enable: true,
            },
            allowLocalhostAsSecureOrigin: true,
        });
    });
</script>
<meta charset="utf-8">
<link href="assets/css/dash.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="//js.pusher.com/3.1/pusher.min.js"></script>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    .widget .panel-body { padding:0px; }
    .widget .list-group { margin-bottom: 0; }
    .widget .panel-title { display:inline }
    .widget li.list-group-item {border-radius: 0;border: 0;border-top: 1px solid #ddd;}
    .widget li.list-group-item:hover { background-color: rgba(86,61,124,.1); }
    .widget .mic-info { color: #666666;font-size: 11px; }
    .widget .action { margin-top:5px; }
    .widget .comment-text { font-size: 12px; }
    .widget o.btn-block { brder-top-left-radius:0px;border-top-right-radius:0px; }
</style>
<x-app-layout>
    {{--<x-slot name="header">

    </x-slot>--}}
        <div class="navbar">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#notifications-panel" class="dropdown-toggle" data-toggle="dropdown">
                        <i data-count="0" class="notification-icon">Notification(<span class="notif-count" style="color: red">0</span>)</i>
                    </a>
                    <div class="dropdown-container">
                        <ul class="dropdown-menu" style="padding: 8px;position: absolute">
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    <script type="text/javascript">
        var notificationsWrapper   = $('.dropdown');
        var notificationsToggle    = notificationsWrapper.find('a[data-toggle]');
        var notificationsCountElem = notificationsToggle.find('i[data-count]');
        var notificationsCount     = parseInt(notificationsCountElem.data('count'));
        var notifications          = notificationsWrapper.find('ul.dropdown-menu');

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('c7abb0455afafa7ed0ad', {
            encrypted: true,
        });

        // Subscribe to the channel we specified in our Laravel Event
        var channel = pusher.subscribe('status-liked');

        // Bind a function to a Event (the full Laravel class)
        channel.bind('App\\Events\\StatusLiked', function(data) {
            var existingNotifications = notifications.html();
            var avatar = Math.floor(Math.random() * (71 - 20 + 1)) + 20;
            var newNotificationHtml = `
          <li class="notification active">
              <div class="media">
                <div class="media-left">
                </div>
                <div class="media-body">
                  <strong class="notification-title">`+data.message+`</strong>
                  <div class="notification-meta">
                    <small class="timestamp">about a minute ago</small>
                  </div>
                </div>
              </div>
          </li>
        `;
            notifications.html(newNotificationHtml + existingNotifications);

            notificationsCount += 1;
            notificationsCountElem.attr('data-count', notificationsCount);
            notificationsWrapper.find('.notif-count').text(notificationsCount);
            notificationsWrapper.show();
        });
    </script>
    @if(session('success'))
    <div class="container-fluid">
    <div class="alert success" style="width: 100%;border-radius: 0px;">
        <span class="closebtn">&times;</span>
        <strong>Success&nbsp;!&nbsp;</strong>{{ session('success') }}
    </div>
    </div>
    @endif
    @if(session('username'))
        <div class="container-fluid">
            <div class="alert danger" style="width: 100%;border-radius: 0px;">
                <span class="closebtn">&times;</span>
                <strong>WARNING&nbsp;!&nbsp;</strong>{{ session('username') }}
            </div>
        </div>
    @endif
    <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <x-jet-welcome />
                    </div>
                </div>
            </div>
</x-app-layout>
<script src="{{asset('assets/js/dash.js')}}"></script>
