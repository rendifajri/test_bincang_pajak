<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=0.8, maximum-scale=0.8, user-scalable=no">
        <title>{{$title}} | Bincang Pajak</title>
        <link href="{{ asset('/') }}vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container-fluid row">
            <div class="col-12">
                <h3>{{$title}}</h3>
                <a href="{{ url('/') }}/create" class="btn btn-success">Create</a>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Inv No</th>
                            <th class="text-center">Issue Date</th>
                            <th class="text-center">Due Date</th>
                            <th class="text-center">Destination</th>
                            <th class="text-center">Subject</th>
                            <th class="text-center">Total Amount</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoice as $row)
                        <tr>
                            <td>{{$row->inv_no}}</td>
                            <td>{{$row->issue_date}}</td>
                            <td>{{$row->due_date}}</td>
                            <td>{{$row->destination->name}}</td>
                            <td>{{$row->subject}}</td>
                            <td class="text-end">{{number_format($row->total_amount)}}</td>
                            <td>
                                <a href="{{ url('/') }}/update/{{$row->id}}" class="btn btn-warning">Update</a>
                                <a href="{{ url('/') }}/delete/{{$row->id}}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <script src="{{ asset('/') }}vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('/') }}vendor/components/jquery/jquery.min.js"></script>
    </body>
</html>