<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<x-app-layout>
    <x-slot name="header">
        <div class="container" id="cont">
            <div class="row col-md-12" style="margin-left: 0px;padding: 0px">
                <div class="col-md-12"><br>
                    @php
                    $str = str_shuffle('ASDKSHDGLKFJG[PQERIRPIEUT548964798494ZMVB');
                    $enc = Crypt::encrypt($str);
                    @endphp
                    <?php
                    if ($all != []){
                    $ssid = $all[0]['ssid'];
                    $pwd = $all[0]['pwd'];
                    $desc = $all[0]['desc'];
                    $id = $all[0]['id'];
                    }else{
                       return abort('404');
                    }
                    ?>
                    <strong>Edit Your WiFi QR Code</strong>
                    <br>
                    <form action="" method="post">
                        <?php
                        echo csrf_field();
                        ?>
                        <div class="form-group">
                            <label for="ssid">SSID:</label>
                            <input type="text" class="form-control" value="{{$ssid}}" id="ssid" placeholder="Enter SSID" name="ssid" required max="255"/>
                        </div>
                        <div class="form-group">
                            <label for="pwd">Password:</label>
                            <input type="password" class="form-control" value="{{$pwd}}" id="pwd" placeholder="Enter password" autocomplete="on" name="pswd" max="255"/>
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
                            <input type="text" value="{{$desc}}" class="form-control" id="description" placeholder="Enter your description" name="description" required max="255"/>
                        </div>
                            <input type="hidden" name="id" value="{{$id}}">
                        <input type="submit" class="btn btn-primary" name="submit" value="Update">
                    </form>
                </div>
            </div>
        </div>
</x-app-layout>
