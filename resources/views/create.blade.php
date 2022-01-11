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
                        <input type="text" class="form-control" id="inv_no" placeholder="Ex : 001">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Issue Date</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="issue_date" placeholder="Ex : 2022-01-11">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Due Date</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="due_date" placeholder="Ex : 2022-02-11">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Destination</label>
                    <div class="col-sm-4">
                        <select id="destination_id" class="form-select">
                            <option value="" selected disabled>Choose Destination</option>
                            @foreach($destination as $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Subject</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="subject" placeholder="Ex : Spring Marketing Campaign">
                    </div>
                </div>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>
                                <select id="header_item_type" class="form-select" onchange="changeItemType(this.value)">
                                    <option value="" selected disabled>Choose Item Type</option>
                                    @foreach($item_type as $row)
                                    <option value="{{$row->item_type}}">{{$row->item_type}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select id="header_item_by_type" class="form-select" onchange="changeItem(this.value)">
                                </select>
                            </td>
                            <td><input type="text" class="form-control text-end" id="header_qty" placeholder="Ex : 3" onchange="calHeader()" /></td>
                            <td><input type="text" class="form-control text-end" id="header_price" placeholder="Ex : 30.000" onchange="calHeader()" /></td>
                            <td><input type="text" class="form-control text-end" id="header_amount" placeholder="Ex : 90.000" readonly /></td>
                            <td><button type="button" onclick="addItem()" class="btn btn-success" style="width:100%">Add</button></td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <th class="text-center">Item Type</th>
                            <th class="text-center">Description</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Unit Price</th>
                            <th class="text-center">Amount</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </tbody>
                    <tbody id="invoice_item">
                    </tbody>
                    <tbody>
                        <tr>
                            <th colspan="3"></th>
                            <th class="text-center">Total</th>
                            <th class="text-end" id="total_amount">0</th>
                            <th></th>
                        </tr>
                    </tbody>
                </table>
                <div class="row mb-3">
                    <div class="col-12 text-end">
                        <a href="{{ url('/') }}" class="btn btn-danger">Cancel</a>
                        <button type="button" onclick="create()" class="btn btn-success">Create</button>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('/') }}vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('/') }}vendor/components/jquery/jquery.min.js"></script>
        <script>
            var item = <?=json_encode($item)?>;
            var item_by_type = <?=json_encode($item_by_type)?>;
            function changeItemType(val){
                // console.log(val);
                // console.log(item_by_type[val]);
                $("#header_item_by_type").html("");
                var last_id = 0;
                item_by_type[val].forEach(element => {
                    // console.log(element);
                    $("#header_item_by_type").append("<option value=\""+element.id+"\">"+element.name+"</option>");
                    last_id = element.id;
                });
                changeItem(last_id);
            }
            function changeItem(val){
                $("#header_price").val(item[val]["price"]);
                calHeader();
            }
            function calHeader(){
                if(isInt($("#header_qty").val()) && isInt($("#header_price").val())){
                    var header_amount = $("#header_qty").val() * $("#header_price").val();
                    $("#header_amount").val(header_amount);
                }
            }
            function calSum() {
                var total_amount = 0;
                // console.log($(".amount").eq(0).val());
                $(".amount").each(function(index, element) {
                    // console.log(element);
                    total_amount += parseInt(element.value);
                });
                $("#total_amount").html(total_amount);
            }
            function addItem(){
                var tempItem = item[$("#header_item_by_type").val()];
                $("#invoice_item").append(
                    "<tr>"+
                        "<td>"+item[$("#header_item_by_type").val()]["item_type"]+"<input type=\"hidden\" class=\"item_id\" value=\""+item[$("#header_item_by_type").val()]["id"]+"\"></td>"+
                        "<td>"+item[$("#header_item_by_type").val()]["name"]+"</td>"+
                        "<td class=\"text-end\">"+$("#header_qty").val()+"<input type=\"hidden\" class=\"qty\" value=\""+$("#header_qty").val()+"\"></td>"+
                        "<td class=\"text-end\">"+$("#header_price").val()+"<input type=\"hidden\" class=\"price\" value=\""+$("#header_price").val()+"\"></td>"+
                        "<td class=\"text-end\">"+$("#header_amount").val()+"<input type=\"hidden\" class=\"amount\" value=\""+$("#header_amount").val()+"\"></td>"+
                        "<td><button type=\"button\" onclick=\"$(this).closest('tr').remove();calSum()\" class=\"btn btn-danger\" style=\"width:100%\">Delete</button></td>"+
                    "</tr>"
                );
                calSum();
            }
            function create(){
                var data = {
                    "destination_id": $("#destination_id").val(),
                    "inv_no": $("#inv_no").val(),
                    "issue_date": $("#issue_date").val(),
                    "due_date": $("#due_date").val(),
                    "subject": $("#subject").val(),
                    "item": []
                };
                $(".item_id").each(function(index, element) {
                    // console.log(element);
                    data["item"].push({
                        item_id: $(".item_id").eq(index).val(),
                        qty: $(".qty").eq(index).val(),
                        price: $(".price").eq(index).val()
                    });
                });
                console.log(data);
                $.post("{{ url('/') }}/api/invoice", data)
                    .done(function(data){
                        // console.log(data);
                        $("#pesanAlertDanger").hide();
                        $("#pesanSuccess").html(
                            data.message+
                            "<button type=\"button\" class=\"btn-close\" aria-label=\"Close\" onclick=\"$('#pesanAlertSuccess').hide()\"></button>"
                        );
                        $("#pesanAlertSuccess").show();
                        setTimeout(function(){window.location.href = "{{ url('/') }}";}, 3000);
                    })
                    .fail(function(data){
                        data = data.responseJSON;
                        console.log(data);
                        $("#pesanAlertDanger").hide();
                        if(data.status != "success"){
                            if(typeof data.message == "string"){
                                $("#pesanError").html(
                                    data.message+
                                    "<button type=\"button\" class=\"btn-close\" aria-label=\"Close\" onclick=\"$('#pesanAlertDanger').hide()\"></button>"
                                );
                            }
                            else{
                                var pesanError = "";
                                Object.entries(data.message).forEach(element => {
                                    Object.entries(element[1]).forEach(ele => {
                                        pesanError += ele[1]+"<br>";
                                    });
                                });
                                pesanError = pesanError.slice(0, -4);
                                $("#pesanError").html(
                                    pesanError+
                                    "<button type=\"button\" class=\"btn-close\" aria-label=\"Close\" onclick=\"$('#pesanAlertDanger').hide()\"></button>"
                                    );
                            }
                            $("#pesanAlertDanger").show();
                        }
                    });
            }

            function isInt(value) {
                return !isNaN(value) && parseInt(Number(value)) == value && !isNaN(parseInt(value, 10));
            }
        </script>
    </body>
</html>