<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<style>
    #snackbar1{
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

    @-webkit-keyframes fadein {
        from {bottom: 0; opacity: 0;}
        to {bottom: 30px; opacity: 1;}
    }

    @keyframes fadein {
        from {bottom: 0; opacity: 0;}
        to {bottom: 30px; opacity: 1;}
    }

    @-webkit-keyframes fadeout {
        from {bottom: 30px; opacity: 1;}
        to {bottom: 0; opacity: 0;}
    }

    @keyframes fadeout {
        from {bottom: 30px; opacity: 1;}
        to {bottom: 0; opacity: 0;}
    }
</style>
<x-app-layout>
   {{-- <x-slot name="header">
    </x-slot>--}}
    <br>
        <div class="container" id="cont">
            <div class="row col-md-12" style="margin-left: 0px;padding: 0px">
                <div class="col-md-12">
                    <strong>Create Your WiFi QR Code</strong>
                    <br>
                    <div class="card-body">
                    <form action="<?php echo route('wifiQRCODE')?>" method="post">
                        <?php
                        echo csrf_field();
                        ?>
                        <div class="form-group">
                            <label for="ssid">SSID:</label>
                            <input type="text" class="form-control" id="ssid" placeholder="Enter SSID" name="ssid" required max="255"/>
                        </div>

                        <div class="form-group">
                            <label for="pwd">Password:</label>
                            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd" max="255" autocomplete="on"/>
                        </div>
                        <div class="form-group">
                            <label for="sel1">Hidden:</label>
                            <select class="form-control" id="sel2" name="hidden">
                                <option>Hidden</option>
                                <option>none</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sel1">Encryption:</label>
                            <select class="form-control" id="sel1" name="enc">
                                <option>WPA/WPA2</option>
                                <option>WEP</option>
                                <option>none</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <input type="text" class="form-control" id="description" placeholder="Enter your description" name="description" required max="255"/>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    <div class="v container">
                        <div class="row">
                            <div class="panel panel-default widget col-md-12">
                                <div class="panel-heading">
                                    <span class="glyphicon glyphicon-comment"></span>
                                    <strong class="panel-title" style="font-size:20px">
                                        Your wifi QR </strong>
                                    <span class="label label-info">
                                @if(empty($count))
                                            <strong style="color: red">0</strong>
                                        @else
                                            <strong style="color: red">{{$count}}</strong>
                                        @endif
                   </span>
                                </div>
                                @if(empty($all))
                                    <p>This section is null</p>
                                @else
                                    @foreach($all as $alls)
                                        @php
                                            $qr = $alls['qr'];
                                            $description = $alls['description'];
                                            $time = $alls['time'];
                                            $idd = $alls['id'];
                                            $id = Crypt::encrypt($idd);
                                        @endphp
                                        <div class="panel-body">
                                            <ul class="list-group">
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-xs-2 col-md-2" id="qrr">
                                                           {{$qr}}
                                                        </div>
                                                        <div class="col-xs-10 col-md-10">
                                                            <div>
                                                                    {{$description}}</a>
                                                                <div class="mic-info">
                                                                    {{$time}}
                                                                </div>
                                                            </div>
                                                            <div class="action">
                                                                <form method="get" action="<?php echo route('edit',['id'=>$id])?>" class="inline-flex">
                                                                    @csrf
                                                                    <input type="submit" class="btn btn-success btn-sm" value="Edit">
                                                                    <input type="hidden" name="id" value="{{$id}}">
                                                                </form>
                                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal">Delete</button>
                                                                <!-- Modal -->
                                                                <div class="container">
                                                                    <div class="modal fade" id="myModal" role="dialog">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h4 class="w-100 text-center" style="color: red;font-size: 25px;font-weight: bold;text-align: center">Warning!</h4>
                                                                                </div>
                                                                                <div class="modal-body w-100 text-center">
                                                                                    <p style="font-size: 20px">Are you sure you want to delete this Qr Code??</p>
                                                                                </div>
                                                                                <div class="modal-footer justify-content-between">
                                                                                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                                                                                    <a href="<?php echo route('delete',['id'=>$id])?>">
                                                                                        <button type="button" class="btn btn-danger">Yes,Delete This!</button>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <br>
                                                @endforeach
                                                @endif
                                            </ul>
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
    @if(session('deletee'))
        <div class="container-fluid float-left" id="snackbar1"><strong>{{ session('deletee') }}</strong></div>
    @endif
    @if(session('edited'))
        <div class="container-fluid float-left" id="snackbar1"><strong>{{ session('edited') }}</strong></div>
    @endif
</x-app-layout>
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });

    var x = document.getElementById("snackbar1");
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
</script>
