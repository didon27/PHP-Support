<!DOCTYPE html>
<html>

<head>
    <title>Test task for PHP Support Developer</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
</head>

<body>

    <br />
    <div class="container box">
        <h3 align="center">Test task for PHP Support Developer</h3><br />
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-4">Total tasks - <b><span id="total_records"></span></b>  
                </div>
                    <div class="col-md-6">
                    <p class="text-filter">Filters:</p>
                        <div class="input-group input-daterange">
                        <select name="status" id="status">
                            <option value="">Status</option>
                            <option value="At work">At work</option>
                            <option value="Done">Done</option>
                        </select>  
                            <input type="text" name="date" id="date" readonly class="form-control" placeholder="Date"/>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="button" name="filter" id="filter" class="btn btn-info btn-sm">Filter</button>
                        <button type="button" name="refresh" id="refresh" class="btn btn-warning btn-sm">Refresh</button>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th width="35%">Task</th>
                                <th width="15%">Status</th>
                                <th width="25%">Author</th>
                                <th width="25%">Publication Date</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    {{ csrf_field() }}
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<script>
    $(document).ready(function() {

        var date = new Date();

        $('.input-daterange').datepicker({
            todayBtn: 'linked',
            format: 'yyyy-mm-dd',
            autoclose: true
        });

        var _token = $('input[name="_token"]').val();

        tasksFilter();

        function tasksFilter(date = '' , status = '') {
            $.ajax({
                url: "{{ route('tasksfilter') }}",
                method: "POST",
                data: {
                    date: date,
                    status: status,
                    _token: _token
                },
                dataType: "json",
                success: function(data) {
                    var output = '';
                    $('#total_records').text(data.length);
                    for (var count = 0; count < data.length; count++) {
                        output += '<tr>';
                        output += '<td>' + data[count].post_title + '</td>';
                        output += '<td>' + data[count].status + '</td>';
                        output += '<td>' + data[count].author + '</td>';
                        output += '<td>' + data[count].date + '</td></tr>';
                    }
                    $('tbody').html(output);
                }
            })
        }

        $('#filter').click(function() {
            var date = $('#date').val();
            var status = $('#status').val();
            if (date != '' || status != '') {
                tasksFilter(date, status);
            } else {
                alert('Both Date is required');
            }
        });

        $('#refresh').click(function() {
            $('#date').val('');
            $('#status').val('');
            tasksFilter();
        });


    });
</script>