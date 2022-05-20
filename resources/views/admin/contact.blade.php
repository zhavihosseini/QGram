<!DOCTYPE html>
<html>
<head>
    <title>Contact Edit</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
@if($countss ===0)
    <p class="text-center align-content-center" style="font-weight: bold;margin-bottom: 20%;margin-top: 20%;font-size:50px">Not Row Yet in DB Number <strong style="color: red">({{$countss}})</strong></p>
@else
    <div class="container" style="overflow-x: auto;max-width: 100%">
        <h3 style="text-align: center">Multiple Deleted <strong>Contact ({{$countss}}) </strong> Row</h3>
        <button style="margin-bottom: 10px;" class="btn btn-danger delete_all center-block justify-content-center" data-url="{{ url('myproductDeletecontactus') }}">Delete All Selected</button>
        <table class="table table-bordered">
            <tr style="vertical-align: middle">
                <th style="vertical-align: middle"><input type="checkbox" id="master"></th>
                <th style="vertical-align: middle">ID</th>
                <th style="vertical-align: middle">NO</th>
                <th style="vertical-align: middle">name</th>
                <th style="vertical-align: middle">email</th>
                <th style="vertical-align: middle">subject</th>
                <th style="vertical-align: middle">message</th>
                <th style="vertical-align: middle">time</th>
                <th style="vertical-align: middle">Action</th>
            </tr>
            @if($contact->count())
                @foreach($paginate as $key => $product)
                    <tr id="tr_{{$product->id}}">
                        <td style="vertical-align: middle"><input type="checkbox" class="sub_chk" data-id="{{ $product->id }}"></td>
                        <td style="vertical-align: middle">{{$product->id}}</td>
                        <td style="vertical-align: middle">{{ ++$key }}</td>
                        <td style="vertical-align: middle">{{ $product->name }}</td>
                        <td style="vertical-align: middle">{{ $product->email}}</td>
                        <td style="vertical-align: middle">{{ $product->subject}}</td>
                        <td style="vertical-align: middle">{{ $product->message}}</td>
                        <td style="vertical-align: middle">{{ $product->time}}</td>
                        <td style="vertical-align: middle">
                            <a href="{{ url('myproductscontactus',$product->id) }}" class="btn btn-danger btn-sm"
                               data-tr="tr_{{$product->id}}"
                               data-toggle="confirmation"
                               data-btn-ok-label="Delete" data-btn-ok-icon="fa fa-remove"
                               data-btn-ok-class="btn btn-sm btn-danger"
                               data-btn-cancel-label="Cancel"
                               data-btn-cancel-icon="fa fa-chevron-circle-left"
                               data-btn-cancel-icon="fa fa-chevron-circle-left"
                               data-btn-cancel-class="btn btn-sm btn-default"
                               data-title="Are you sure you want to delete ?"
                               data-placement="left" data-singleton="true">
                                Delete
                            </a>
                            @php
                            $id = $product->id;
                            $hashids = new \Hashids\Hashids();
                            $idds = $hashids->encode($id);
                            $hash = \Illuminate\Support\Facades\Crypt::encrypt($idds);
                            @endphp
                            <a href="<?php echo route('contactusers',['id'=>$hash])?>" class="btn btn-primary btn-sm float-right">
                                Send Email
                            </a>
                        </td>
                    </tr>
                @endforeach
            @endif
            @endif
        </table>
        <div class="d-flex justify-content-center">
            {!! $paginate->appends(['sort' => 'department'])->links() !!}
        </div>
    </div> <!-- container / end -->
</body>
<script type="text/javascript">
    $(document).ready(function () {


        $('#master').on('click', function(e) {
            if($(this).is(':checked',true))
            {
                $(".sub_chk").prop('checked', true);
            } else {
                $(".sub_chk").prop('checked',false);
            }
        });


        $('.delete_all').on('click', function(e) {


            var allVals = [];
            $(".sub_chk:checked").each(function() {
                allVals.push($(this).attr('data-id'));
            });


            if(allVals.length <=0)
            {
                alert("Please select row.");
            }  else {


                var check = confirm("Are you sure you want to delete this row?");
                if(check == true){


                    var join_selected_values = allVals.join(",");


                    $.ajax({
                        url: $(this).data('url'),
                        type: 'DELETE',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: 'ids='+join_selected_values,
                        success: function (data) {
                            if (data['success']) {
                                $(".sub_chk:checked").each(function() {
                                    $(this).parents("tr").remove();
                                });
                                alert(data['success']);
                            } else if (data['error']) {
                                alert(data['error']);
                            } else {
                                alert('Whoops Something went wrong!!');
                            }
                        },
                        error: function (data) {
                            alert(data.responseText);
                        }
                    });


                    $.each(allVals, function( index, value ) {
                        $('table tr').filter("[data-row-id='" + value + "']").remove();
                    });
                }
            }
        });


        $('[data-toggle=confirmation]').confirmation({
            rootSelector: '[data-toggle=confirmation]',
            onConfirm: function (event, element) {
                element.trigger('confirm');
            }
        });


        $(document).on('confirm', function (e) {
            var ele = e.target;
            e.preventDefault();


            $.ajax({
                url: ele.href,
                type: 'DELETE',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    if (data['success']) {
                        $("#" + data['tr']).slideUp("slow");
                        alert(data['success']);
                    } else if (data['error']) {
                        alert(data['error']);
                    } else {
                        alert('Whoops Something went wrong!!');
                    }
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });


            return false;
        });
    });
</script>
</html>
