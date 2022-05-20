<!DOCTYPE html>
<html>
<head>
    <title>Geo Edit</title>
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
<div class="container">
    <h3 style="text-align: center">Multiple Deleted <strong>Geo</strong> Row</h3>
    <button style="margin-bottom: 10px;" class="btn btn-danger delete_all center-block justify-content-center" data-url="{{ url('myproductsszDeleteAlls') }}">Delete All Selected</button>
    <table class="table table-bordered">
        <tr>
            <th><input type="checkbox" id="master"></th>
            <th>ID</th>
            <th>NO</th>
            <th>latitude</th>
            <th>longitude</th>
            <th>describe</th>
            <th>Time</th>
            <th>Userid</th>
            <th>Action</th>
        </tr>
        @if($geos->count())
            @foreach($paginate as $key => $product)
                <tr id="tr_{{$product->id}}">
                    <td><input type="checkbox" class="sub_chk" data-id="{{ $product->id }}"></td>
                    <td>{{$product->id}}</td>
                    <td>{{ ++$key }}</td>
                    <td>{{ $product->latitude }}</td>
                    <td>{{ $product->longitude}}</td>
                    <td>{{ $product->describe}}</td>
                    <td>{{ $product->time}}</td>
                    <td>{{ $product->userid}}</td>
                    <td>
                        <a href="{{ url('myproductssz',$product->id) }}" class="btn btn-danger btn-sm"
                           data-tr="tr_{{$product->id}}"
                           data-toggle="confirmation"
                           data-btn-ok-label="Delete" data-btn-ok-icon="fa fa-remove"
                           data-btn-ok-class="btn btn-sm btn-danger"
                           data-btn-cancel-label="Cancel"
                           data-btn-cancel-icon="fa fa-chevron-circle-left"
                           data-btn-cancel-class="btn btn-sm btn-default"
                           data-title="Are you sure you want to delete ?"
                           data-placement="left" data-singleton="true">
                            Delete
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
