<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>users</title>

        <!-- Bootstrap Core CSS -->
        <link href="{{asset('AdMinn/css/bootstrap.min.css')}}" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="{{asset('AdMinn/css/metisMenu.min.css')}}" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="{{asset('AdMinn/css/startmin.css')}}" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <style>
        #snackbar1 {
            visibility: hidden;
            min-width: 250px;
            background-color: green;
            color: #fff;
            text-align: center;
            border-radius: 2px;
            padding: 16px;
            position: fixed;
            z-index: 1;
            bottom: 30px;
            font-size: 17px;
            margin: 10px;
        }

        #snackbar1.show {
            visibility: visible;
            -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
            animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }
    </style>
    <body>
<?php
$name = \Illuminate\Support\Facades\Auth::user()->toArray()['name'];
?>
        <div id="wrapper">
            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="navbar-header">
                    <a class="navbar-brand" href=""><div class="digital_clock_wrapper">
                            <div id="digit_clock_time"></div>
                        </div></a>
                </div>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <ul class="nav navbar-nav navbar-left navbar-top-links">
                    <li><a href="<?php echo route('home')?>"><i class="fa fa-home fa-fw"></i> Website</a></li>
                </ul>
                <ul class="nav navbar-right navbar-top-links">
                    <li class="dropdown navbar-inverse">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-bell fa-fw"></i> <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu dropdown-alerts">
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-comment fa-fw"></i> New Comment
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                        <span class="pull-right text-muted small">12 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-envelope fa-fw"></i> Message Sent
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-tasks fa-fw"></i> New Task
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a class="text-center" href="#">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i> secondtruth <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                            </li>
                            <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li class="sidebar-search">
                                <div class="input-group custom-search-form">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                </span>
                                </div>
                                <!-- /input-group -->
                            </li>
                            <li>
                                <a href="<?php echo route('dashboard')?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                            </li>
                            <li>
                                <a href="<?php echo route('indexxx')?>"><i class="fa fa-trash-o"></i> Multi Delete bitcoin ({{$bitz}})</a>
                            </li>
                            <li>
                                <a href="<?php echo route('indexxxx')?>"><i class="fa fa-trash-o"></i> Multi Delete Email ({{$emailzz}})</a>
                            </li>
                            <li>
                                <a href="<?php echo route('indez')?>"><i class="fa fa-trash-o"></i> Multi Delete Geo ({{$geoz}})</a>
                            </li>
                            <li>
                                <a href="<?php echo route('indezz')?>"><i class="fa fa-trash-o"></i> Multi Delete Message ({{$mesg}})</a>
                            </li>
                            <li>
                                <a href="<?php echo route('indexphone')?>"><i class="fa fa-trash-o"></i> Multi Delete Phone ({{$phonezz}})</a>
                            </li>
                            <li>
                                <a href="<?php echo route('indexurl')?>"><i class="fa fa-trash-o"></i> Multi Delete Url ({{$urlz}})</a>
                            </li>
                            <li>
                                <a href="<?php echo route('indexwifi')?>"><i class="fa fa-trash-o"></i> Multi Delete Wifi ({{$wifiz}})</a>
                            </li>
                            <li>
                                <a href="<?php echo route('sendemailusers')?>"><i class="fa fa-mail-reply-all"></i> Send Email To All</a>
                            </li>
                            <li>
                                <a href="<?php echo route('contactadmin')?>"><i class="fa fa-file-contract"></i> Contact ({{$contact}})</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>

            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">All Users ({{$count-1}})</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading" style="text-align: center;font-weight: bold">
                                    List Of All Users Without Admin
                                </div>
                                <div class="panel-body bg-dark" style="overflow-y: auto;max-width: 10200px">
                                    <table class="table table-hover table-dark" style="border-bottom: 1px solid lightgrey">
                                        <thead>
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Name and Family</th>
                                            <th scope="col">Username</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Email Verified</th>
                                            <th scope="col">utype</th>
                                            <th scope="col">Profile Photo</th>
                                            <th scope="col">Create At</th>
                                            <th scope="col">Update At</th>
                                            <th scope="col">Google Id</th>
                                            <th scope="col">Profile Photo Url</th>
                                            <th scope="col">This</th>
                                            <th scope="col">Condition</th>
                                            <th scope="col">Bitcoin</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Geo</th>
                                            <th scope="col">Message</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Url</th>
                                            <th scope="col">Wifi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($all as $alls)
                                            @php
                                                $id = $alls['id'];
                                                $name = $alls['name'];
                                                $username = $alls['username'];
                                                $email = $alls['email'];
                                                $emailv = $alls['email_verified_at'];
                                                $utype = $alls['utype'];
                                                $profilepath = $alls['profile_photo_path'];
                                                $create = $alls['created_at'];
                                                $updateat = $alls['updated_at'];
                                                $googleid = $alls['google_id'];
                                                $photourl = $alls['profile_photo_url'];
                                                $last_seen = $alls['last_seen'];
                                                $bitcoin = \App\Models\bitcoin::get_by_Count($id);
                                                $emailc = \App\Models\email::get_by_Count($id);
                                                $geo = \App\Models\geo::get_by_Count($id);
                                                $message = \App\Models\message::get_by_Count($id);
                                                $phone = \App\Models\phone::get_by_Count($id);
                                                $url = \App\Models\url::get_by_Count($id);
                                                $wifi = \App\Models\wifi::get_by_Count($id);
                                                $hashids = new \Hashids\Hashids();
                                                $idds = $hashids->encode($id);
                                                $hash = \Illuminate\Support\Facades\Crypt::encrypt($idds);
                                            @endphp
                                            @if($utype === 'ADM')+
                                        <tr style="background-color: green;color: white;font-weight: bold;text-align: center">
                                            <th scope="row" style="vertical-align: middle">{{$id}}</th>
                                            <td style="vertical-align: middle"><img src="{{$photourl}}" width="50px" height="50px" style="border-radius: 50%" class="justify-content-center flex"></td>
                                            <td style="vertical-align: middle">{{$name}}</td>
                                            <td style="vertical-align: middle">{{$username}}</td>
                                            <td style="vertical-align: middle">{{$email}}</td>
                                            <td style="vertical-align: middle">{{$emailv}}</td>
                                            <td style="vertical-align: middle">{{$utype}}</td>
                                            <td style="vertical-align: middle">{{$profilepath}}</td>
                                            <td style="vertical-align: middle">{{$create}}</td>
                                            <td style="vertical-align: middle">{{$updateat}}</td>
                                            <td style="vertical-align: middle">{{$googleid}}</td>
                                            <td style="vertical-align: middle">{{$photourl}}</td>
                                            <td style="vertical-align: middle">
                                                <button type="button" class="btn" data-toggle="modal" data-target=".bd-example-modal-smm" style="color: black">Delete</button>
                                                <div class="modal fade bd-example-modal-smm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-sm">
                                                        <div class="modal-content" style="padding: 7px;text-align: center;color: black">
                                                            Are You Sure To Delete This??<form action="<?php echo route('deletedss',['id'=>$hash])?>" method="get">
                                                                <input type="submit" value="Delete" style="color: black;width: 100%">
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <form action="<?php echo route('session',['id'=>$hash])?>" method="get">
                                                    <input type="submit" value="Session" style="color: black">
                                                </form>
                                            </td>
                                            <td style="vertical-align: middle">
                                                    @if(Cache::has('user-is-online-'.$id))
                                                        Online
                                                    @else
                                                        {{\Carbon\Carbon::parse($last_seen)->diffForHumans()}}
                                                    @endif
                                            </td>
                                            <td style="vertical-align: middle">{{$bitcoin}}</td>
                                            <td style="vertical-align: middle">{{$emailc}}</td>
                                            <td style="vertical-align: middle">{{$geo}}</td>
                                            <td style="vertical-align: middle">{{$message}}</td>
                                            <td style="vertical-align: middle">{{$phone}}</td>
                                            <td style="vertical-align: middle">{{$url}}</td>
                                            <td style="vertical-align: middle">{{$wifi}}</td>
                                        @if(!empty($googleid))
                                                <td style="color: green;vertical-align: middle">Google</td>
                                            @else
                                                <td style="color: darkred;vertical-align: middle">QGram</td>
                                            @endif
                                        </tr>
                                            @else
                                                <tr style="vertical-align: middle">
                                                <th scope="row" style="vertical-align: middle">{{$id}}</th>
                                                    <td style="vertical-align: middle"><img src="{{$photourl}}" width="50px" height="50px" style="border-radius: 50%" class="justify-content-center flex"></td>
                                                <td style="vertical-align: middle;text-align: center">{{$name}}</td>
                                                <td style="vertical-align: middle;text-align: center">{{$username}}</td>
                                                <td style="vertical-align: middle;text-align: center">{{$email}}</td>
                                                <td style="vertical-align: middle;text-align: center">{{$emailv}}</td>
                                                <td style="vertical-align: middle;text-align: center">{{$utype}}</td>
                                                <td style="vertical-align: middle;text-align: center">{{$profilepath}}</td>
                                                <td style="vertical-align: middle;text-align: center">{{$create}}</td>
                                                <td style="vertical-align: middle;text-align: center">{{$updateat}}</td>
                                                <td style="vertical-align: middle;text-align: center">{{$googleid}}</td>
                                                <td style="vertical-align: middle;text-align: center">{{$photourl}}</td>
                                                    <td style="vertical-align: middle;text-align: center">
                                                        <button type="button" class="btn" data-toggle="modal" data-target=".bd-example-modal-sm">Delete</button>
                                                        <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-sm">
                                                                <div class="modal-content" style="padding: 7px;text-align: center">
                                                                   Are You Sure To Delete This??<form action="<?php echo route('deletedss',['id'=>$hash])?>" method="get">
                                                                        <input type="submit" value="Delete" style="color: black;width: 100%">
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <form action="<?php echo route('session',['id'=>$hash])?>" method="get">
                                                            <input type="submit" value="Session" style="color: black">
                                                        </form>
                                                    </td>
                                                    <td style="vertical-align: middle;text-align: center">
                                                    @if(Cache::has('user-is-online-'.$id))
                                                    <span style="color: green">Online</span>
                                                    @else
                                                        {{\Carbon\Carbon::parse($last_seen)->diffForHumans()}}
                                                    @endif
                                                        </td>
                                                    <td style="vertical-align: middle;text-align: center">{{$bitcoin}}</td>
                                                    <td style="vertical-align: middle;text-align: center">{{$emailc}}</td>
                                                    <td style="vertical-align: middle;text-align: center">{{$geo}}</td>
                                                    <td style="vertical-align: middle;text-align: center">{{$message}}</td>
                                                    <td style="vertical-align: middle;text-align: center">{{$phone}}</td>
                                                    <td style="vertical-align: middle;text-align: center">{{$url}}</td>
                                                    <td style="vertical-align: middle;text-align: center">{{$wifi}}</td>
                                                @if(!empty($googleid))
                                                    <td style="color: green;font-weight: bold;vertical-align: middle;text-align: center">Google</td>
                                                    @else
                                                        <td style="color: darkred;vertical-align: middle;text-align: center">Q Gram</td>
                                                    @endif
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">All Qr Codes ({{$all_qr}})</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading" style="text-align: center;font-weight: bold">
                                    List Of All Qr codes
                                </div>
                                <div class="panel-body bg-dark hover:text-gray-900" style="overflow-y: auto;max-width: 10200px">
                                    <div class="col-md-12">
                                        <div class="panel-heading panel-default" style="text-align: center;background-color: lightgrey">
                                            Bitcoin ({{$bitz}})
                                        </div>
                                        <div class="panel-body panel-default" style="text-align: center;font-weight: bold;overflow-y: auto;max-width: 1000px">
                                            @foreach($all_bit as $bit)
                                                @php
                                                $id = $bit['id'];
                                                $time = $bit['time'];
                                                $userid = $bit['userid'];
                                                $amount = $bit['amount'];
                                                $reciever = $bit['receiver'];
                                                $message = $bit['message'];
                                                  $hashids = new \Hashids\Hashids();
                                                $idds = $hashids->encode($id);
                                                $hash = \Illuminate\Support\Facades\Crypt::encrypt($idds);
                                                @endphp
                                                <table class="table table-dark" style="background-color: lightgrey">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">Id</th>
                                                        <th scope="col">Time</th>
                                                        <th scope="col">Userid</th>
                                                        <th scope="col">Amount</th>
                                                        <th scope="col">Reciever</th>
                                                        <th scope="col">Message</th>
                                                        <th scope="col">This</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <th scope="row">{{$id}}</th>
                                                        <td>{{$time}}</td>
                                                        <td>{{$userid}}</td>
                                                        <td>{{$amount}}</td>
                                                        <td>{{$reciever}}</td>
                                                        <td>{{$message}}</td>
                                                        <td>
                                                                <form method="get" action="<?php echo route('deletebitz',['id'=>$hash])?>">
                                                                    <input type="submit" value="Delete"/>
                                                                </form>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="panel-heading panel-default" style="text-align: center;background-color: lightgrey;">
                                            Email ({{$emailzz}})
                                        </div>
                                        <div class="panel-body panel-default" style="text-align: center;font-weight: bold;overflow-y: auto;max-width: 1000px">
                                            @foreach($emails as $em)
                                                @php
                                                    $id = $em['id'];
                                                    $email = $em['email'];
                                                    $subject = $em['subject'];
                                                    $message = $em['message'];
                                                    $time = $em['time'];
                                                    $userid = $em['userid'];
                                                    $hashids = new \Hashids\Hashids();
                                                    $idds = $hashids->encode($id);
                                                    $hash = \Illuminate\Support\Facades\Crypt::encrypt($idds);
                                                @endphp
                                                <table class="table table-dark" style="background-color: lightgrey">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">Id</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">Subject</th>
                                                        <th scope="col">Message</th>
                                                        <th scope="col">Time</th>
                                                        <th scope="col">Userid</th>
                                                        <th scope="col">This</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <th scope="row">{{$id}}</th>
                                                        <td>{{$email}}</td>
                                                        <td>{{$subject}}</td>
                                                        <td>{{$message}}</td>
                                                        <td>{{$time}}</td>
                                                        <td>{{$userid}}</td>
                                                        <td>  <form method="get" action="<?php echo route('deleteemailz',['id'=>$hash])?>">
                                                                <input type="submit" value="Delete"/>
                                                            </form></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="panel-heading panel-default" style="background-color: lightgrey;text-align: center">
                                            Geo ({{$geoz}})
                                        </div>
                                        <div class="panel-body panel-default" style="text-align: center;font-weight: bold;overflow-y: auto;max-width: 1000px">
                                            @foreach($geos as $geo)
                                                @php
                                                    $id = $geo['id'];
                                                    $latitude = $geo['latitude'];
                                                    $longitude = $geo['longitude'];
                                                    $describe = $geo['describe'];
                                                    $time = $geo['time'];
                                                    $userid = $geo['userid'];
                                                    $hashids = new \Hashids\Hashids();
                                                    $idds = $hashids->encode($id);
                                                    $hash = \Illuminate\Support\Facades\Crypt::encrypt($idds);
                                                @endphp
                                                <table class="table table-dark" style="background-color: lightgrey">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">Id</th>
                                                        <th scope="col">Latitude</th>
                                                        <th scope="col">Longitude</th>
                                                        <th scope="col">Describe</th>
                                                        <th scope="col">Time</th>
                                                        <th scope="col">Userid</th>
                                                        <th scope="col">This</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <th scope="row">{{$id}}</th>
                                                        <td>{{$latitude}}</td>
                                                        <td>{{$longitude}}</td>
                                                        <td>{{$describe}}</td>
                                                        <td>{{$time}}</td>
                                                        <td>{{$userid}}</td>
                                                        <td>
                                                            <form method="get" action="<?php echo route('deleteGeo',['id'=>$hash])?>">
                                                                <input type="submit" value="Delete"/>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="panel-heading panel-default" style="text-align: center;background-color: lightgrey">
                                            Message ({{$mesg}})
                                        </div>
                                        <div class="panel-body panel-default" style="text-align: center;font-weight: bold;overflow-y: auto;max-width: 1000px">
                                            @foreach($messagess as $messg)
                                                @php
                                                    $id = $messg['id'];
                                                    $number = $messg['number'];
                                                    $messagz = $messg['message'];
                                                    $time = $messg['time'];
                                                    $userid = $messg['userid'];
                                                    $hashids = new \Hashids\Hashids();
                                                    $idds = $hashids->encode($id);
                                                    $hash = \Illuminate\Support\Facades\Crypt::encrypt($idds);
                                                @endphp
                                                <table class="table table-dark" style="background-color: lightgrey">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">Id</th>
                                                        <th scope="col">Number</th>
                                                        <th scope="col">Message</th>
                                                        <th scope="col">Time</th>
                                                        <th scope="col">Userid</th>
                                                        <th scope="col">This</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <th scope="row">{{$id}}</th>
                                                        <td>{{$number}}</td>
                                                        <td>{{$messagz}}</td>
                                                        <td>{{$time}}</td>
                                                        <td>{{$userid}}</td>
                                                        <td>
                                                            <form method="get" action="<?php echo route('Messagessz',['id'=>$hash])?>">
                                                                <input type="submit" value="Delete"/>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="panel-heading panel-default" style="text-align: center;background-color: lightgrey">
                                        Phone ({{$phonezz}})
                                        </div>
                                        <div class="panel-body panel-default" style="text-align: center;font-weight: bold;overflow-y: auto;max-width: 1000px">
                                            @foreach($phones as $phn)
                                                @php
                                                    $id = $phn['id'];
                                                    $phnn = $phn['phone'];
                                                    $time = $phn['time'];
                                                    $userid = $phn['userid'];
                                                    $hashids = new \Hashids\Hashids();
                                                    $idds = $hashids->encode($id);
                                                    $hash = \Illuminate\Support\Facades\Crypt::encrypt($idds);
                                                @endphp
                                                <table class="table table-dark" style="background-color: lightgrey">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">Id</th>
                                                        <th scope="col">Phone</th>
                                                        <th scope="col">Time</th>
                                                        <th scope="col">Userid</th>
                                                        <th scope="col">This</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <th scope="row">{{$id}}</th>
                                                        <td>{{$phnn}}</td>
                                                        <td>{{$time}}</td>
                                                        <td>{{$userid}}</td>
                                                        <td>
                                                            <form method="get" action="<?php echo route('phonezzze',['idv'=>$hash])?>">
                                                                <input type="submit" value="Delete"/>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="panel-heading panel-default" style="text-align: center;background-color: lightgrey">
                                            Url ({{$urlz}})
                                        </div>
                                        <div class="panel-body panel-default" style="text-align: center;font-weight: bold;overflow-y: auto;max-width: 1000px">
                                            @foreach($urls as $urll)
                                                @php
                                                    $id = $urll['id'];
                                                    $urlll = $urll['url'];
                                                    $time = $urll['time'];
                                                    $describes = $urll['describe'];
                                                    $userid = $urll['userid'];
                                                    $hashids = new \Hashids\Hashids();
                                                    $idds = $hashids->encode($id);
                                                    $hash = \Illuminate\Support\Facades\Crypt::encrypt($idds);
                                                @endphp
                                                <table class="table table-dark" style="background-color: lightgrey">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">Id</th>
                                                        <th scope="col">Url</th>
                                                        <th scope="col">Describe</th>
                                                        <th scope="col">Time</th>
                                                        <th scope="col">Userid</th>
                                                        <th scope="col">This</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <th scope="row">{{$id}}</th>
                                                        <td>{{$urlll}}</td>
                                                        <td>{{$describes}}</td>
                                                        <td>{{$time}}</td>
                                                        <td>{{$userid}}</td>
                                                        <td>
                                                            <form method="get" action="<?php echo route('urlzzcb',['idv'=>$hash])?>">
                                                                <input type="submit" value="Delete"/>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="panel-heading panel-default" style="text-align: center;background-color: lightgrey">
                                            Wifi ({{$wifiz}})
                                        </div>
                                        <div class="panel-body panel-default" style="text-align: center;font-weight: bold;">
                                            @foreach($wifis as $wifiis)
                                                @php
                                                    $id = $wifiis['id'];
                                                    $ssid = $wifiis['ssid'];
                                                    $pwd = $wifiis['pwd'];
                                                    $hidden = $wifiis['hidden'];
                                                    $enc = $wifiis['enc'];
                                                    $time = $wifiis['time'];
                                                    $describes = $wifiis['desc'];
                                                    $userid = $wifiis['userid'];
                                                @endphp
                                                <table class="table table-dark" style="background-color: lightgrey">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">Id</th>
                                                        <th scope="col">Ssid</th>
                                                        <th scope="col">Pwd</th>
                                                        <th scope="col">Hidden</th>
                                                        <th scope="col">Enc</th>
                                                        <th scope="col">description</th>
                                                        <th scope="col">Userid</th>
                                                        <th scope="col">Time</th>
                                                        <th scope="col">This</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <th scope="row">{{$id}}</th>
                                                        <td>{{$ssid}}</td>
                                                        <td>{{$pwd}}</td>
                                                        <td>{{$hidden}}</td>
                                                        <td>{{$enc}}</td>
                                                        <td>{{$describes}}</td>
                                                        <td>{{$userid}}</td>
                                                        <td>{{$time}}</td>
                                                        <td>
                                                            <form method="get" action="<?php echo route('wifisz',['idw'=>$hash])?>">
                                                                <input type="submit" value="Delete"/>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@if(session('success'))
    <div class="container-fluid float-left" id="snackbar1"><strong>{{ session('success') }}</strong></div>
@endif
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://kit.fontawesome.com/9067ae8a47.js" crossorigin="anonymous"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="{{asset('AdMinn/js/bootstrap.min.js')}}"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="{{asset('AdMinn/js/metisMenu.min.js')}}"></script>

        <!-- Custom Theme JavaScript -->
        <script src="{{asset('AdMinn/js/startmin.js')}}"></script>
    <script type="text/javascript">
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

</script>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });

        var x = document.getElementById("snackbar1");
        x.className = "show";
        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
    </script>
    </body>
</html>
<script>
    import Input from "@/Jetstream/Input";
    export default {
        components: {Input}
    }
</script>
