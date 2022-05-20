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
                        $amount = $all[0]['amount'];
                        $receiver = $all[0]['receiver'];
                        $message = $all[0]['message'];
                        $id = $all[0]['id'];
                    }else{
                        return abort('404');
                    }
                    ?>
                    <div class="container" id="cont">
                        <div class="row col-md-12" style="margin-left: 0px;padding: 0px">
                            <div class="col-md-12">
                                <strong>Edit Your Bitcoin QR Code</strong>
                                <br>
                                <form action="" method="post">
                                    <?php
                                    echo csrf_field();
                                    ?>
                                    <div class="form-group">
                                        <label for="Amount">Amount:</label>
                                        <input type="text" class="form-control bx-bitcoin" id="amount" value="{{$amount}}" placeholder="Enter Amount 0.334BTC" name="amount" max="255"/>
                                    </div>

                                    <div class="form-group">
                                        <label for="Receiver">Receiver:</label>
                                        <input type="text" class="form-control" id="receiver" placeholder="Enter Bitcoin Address" value="{{$receiver}}" name="receiver" max="255"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="Message">Message:</label>
                                        <input type="text" class="form-control" id="message" placeholder="Enter your Message" name="Message" value="{{$message}}" required max="255"/>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <input type="hidden" name="id" value="{{$id}}"/>
                                </form>
                </div>
            </div>
        </div>
</x-app-layout>
