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

                    <?php
                    if ($all != []){
                        $latitude = $all[0]['latitude'];
                        $longitude = $all[0]['longitude'];
                        $describe = $all[0]['describe'];
                        $id = $all[0]['id'];
                    }else{
                        return abort('404');
                    }
                    ?>
                    <div class="container" id="cont">
                        <div class="row col-md-12" style="margin-left: 0px;padding: 0px">
                            <div class="col-md-12">
                                <strong>Edit Your Geo Location Code</strong>
                                <br>
                                <form action="" method="post">
                                    <?php
                                    echo csrf_field();
                                    ?>
                                        <div class="form-group">
                                            <label for="latitude">Latitude:</label>
                                            <input type="text" class="form-control bx-bitcoin" id="latitude" value="{{$latitude}}" placeholder="Enter Latitude..." name="latitude" max="255"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="longitude">Longitude:</label>
                                            <input type="text" class="form-control bx-bitcoin" id="longitude" value="{{$longitude}}" placeholder="Enter Longitude..." name="longitude" max="255"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="describe">Description:</label>
                                            <input type="text" class="form-control bx-bitcoin" value="{{$describe}}" id="describe" placeholder="Enter Description..." name="describe" max="255"/>
                                        </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <input type="hidden" name="id" value="{{$id}}"/>
                                </form>
                            </div>
                        </div>
                    </div>
</x-app-layout>
