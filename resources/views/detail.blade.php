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
                <div class="alert alert-danger alert-dismissible fade show" role="alert" id="pesanAlertDanger" style="display:none">
                    <span id="pesanError"></span>
                    <button type="button" class="btn-close" aria-label="Close" onclick="$('#pesanAlertDanger').hide()"></button>
                </div>
                <div class="alert alert-success alert-dismissible fade show" role="alert" id="pesanAlertSuccess" style="display:none">
                    <span id="pesanSuccess"></span>
                    <button type="button" class="btn-close" aria-label="Close" onclick="$('#pesanAlertSuccess').hide()"></button>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Invoice No</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="inv_no" placeholder="Ex : 001" value="{{$invoice->inv_no}}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Issue Date</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="issue_date" placeholder="Ex : 2022-01-11" value="{{$invoice->issue_date}}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Due Date</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="due_date" placeholder="Ex : 2022-02-11" value="{{$invoice->due_date}}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Destination</label>
                    <div class="col-sm-4">
                        <select id="destination_id" class="form-select" disabled>
                            <option value="" selected disabled>Choose Destination</option>
                            @foreach($destination as $row)
                            <option value="{{$row->id}}" {{$invoice->destination_id == $row->id ? "selected" : "" }}>{{$row->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Subject</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="subject" placeholder="Ex : Spring Marketing Campaign" value="{{$invoice->subject}}" readonly>
                    </div>
                </div>
                <table class="table table-bordered">
                    <tbody>
                    </tbody>
                    <tbody>
                        <tr>
                            <th class="text-center">Item Type</th>
                            <th class="text-center">Description</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Unit Price</th>
                            <th class="text-center">Amount</th>
                        </tr>
                    </tbody>
                    <tbody id="invoice_item">
                        @foreach($invoice->invoiceItem as $row)
                        <tr>
                            <td>{{$row->item->item_type}}</td>
                            <td>{{$row->item->name}}</td>
                            <td class="text-end">{{$row->qty}}</td>
                            <td class="text-end">{{$row->price}}</td>
                            <td class="text-end">{{$row->amount}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tbody>
                        <tr>
                            <th colspan="3"></th>
                            <th class="text-center">Total</th>
                            <th class="text-end" id="total_amount">{{$invoice->total_amount}}</th>
                        </tr>
                    </tbody>
                </table>
                <div class="row mb-3">
                    <div class="col-12 text-end">
                        <a href="{{ url('/') }}" class="btn btn-primary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('/') }}vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('/') }}vendor/components/jquery/jquery.min.js"></script>
    </body>
</html>