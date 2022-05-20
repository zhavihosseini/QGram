<html>
<head>
    <script src="{{asset("html5-qrcode-master/minified/html5-qrcode.min.js")}}"></script>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<style>
    button{
        outline: none;
        border: 0px;
        background-color: lightgray;
        color: black;
    }
</style>
<x-app-layout>
    <body>
    <div class="container">
        <br><br>
        <div class="card-header">
            Scan Your QR Code with Q Gram Scanner
        </div>
        <div class="row center-block justify-content-center" style="margin-left: 0px;margin-top: 30px">
            <div id="qr-reader"></div>
        </div>
        <div class="row center-block justify-content-center" style="margin-left: 0px">
            <div id="qr-reader-results" style="color: green"></div>
        </div>
    </div>
    </body>
    <script>
        var resultContainer = document.getElementById('qr-reader-results');
        var lastResult, countResults = 0;

        function onScanSuccess(qrCodeMessage) {
            if (qrCodeMessage !== lastResult) {
                ++countResults;
                lastResult = qrCodeMessage;
                resultContainer.innerHTML
                    += `<div>[${countResults}] - ${qrCodeMessage}</div>`;
            }
        }

        var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess);
    </script>
</x-app-layout>
</html>
