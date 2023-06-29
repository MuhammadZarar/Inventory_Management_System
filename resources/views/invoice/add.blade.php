@include('layouts/header')
<!-- partial -->
<div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_sidebar.html -->
    @include('layouts/sidebar')
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> Invoice</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('add_invoice') }}">Invoice</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Invoice</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h3>Create Invoice</h3>
                            <hr>
                            <form id="add_invoice_form" class="forms-sample">
                                @csrf
                                <div class="invoice_notify"></div>
                                <div class="row">
                                    <div class="col-6 col-md-4">
                                        <div class="form-group row">
                                            <h3>From,</h3>
                                            <div class="col-12">
                                                <label>Name:</label>
                                                <input type="text" class="form-control" name="name" id="name"
                                                    placeholder="Enter Customer Name" />
                                                <br>
                                                <label>Contact:</label>
                                                <input type="text" class="form-control" name="contact" id="contact"
                                                    placeholder="Enter Customer Contact" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4 offset-md-4">
                                        <div class="form-group row">
                                            <h3>To,</h3>
                                            <div class="col-12">
                                                <label>Invoice no:</label>
                                                <input type="text" class="form-control" name="invoice_no"
                                                    id="invoice_no">
                                                <br>
                                                <label>Date:</label>
                                                <input type="text" class="form-control" name="date" id="date"
                                                    value="{{ date('Y-m-d') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-center">
                                            <thead class="bg-dark text-white">
                                                <tr>
                                                    <th width="30%"> Item Name </th>
                                                    <th width="10%"> Price </th>
                                                    <th width="10%"> Qty </th>
                                                    <th width="10%"> Net Amount </th>
                                                    <th width="10%"> Discount </th>
                                                    <th width="10%"> Gross Amount </th>
                                                    <th width="10%"> Action </th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody">
                                                <tr id="trow">
                                                    <td width="30%">
                                                        <select class="form-control form-control-lg product_id item_id">
                                                            <option>Select Item</option>
                                                            @foreach ($product as $product)
                                                                <option value="{{ $product->product_id }}">
                                                                    {{ Str::title($product->name) }} /
                                                                    {{ Str::title($product->product_type) }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td width="10%" id="product_item_price">
                                                        <input type="text" id="item_price" value="0"
                                                            class="form-control form-control-sm item_price" disabled />
                                                    </td>
                                                    <td width="10%" id="product_item_qty">
                                                        <input type="text" id="item_qty" value="0"
                                                            class="form-control form-control-sm item_qty" />
                                                    </td>
                                                    <td width="10%" id="product_net_amount">
                                                        <input type="text" id="net_amount" value="0"
                                                            class="form-control form-control-sm net_amount_total item_net_amount"
                                                            disabled />
                                                    </td>
                                                    <td width="10%" id="product_discount">
                                                        <input type="text" id="discount" value="0"
                                                            class="form-control form-control-sm discount_amount_total item_discount" />
                                                    </td>
                                                    <td width="10%" id="product_gross_amount">
                                                        <input type="text" id="gross_amount" value="0"
                                                            class="form-control form-control-sm gross_amount_total item_gross_amount"
                                                            disabled />
                                                    </td>
                                                    <td width="10%">
                                                        <button type="button"
                                                            class="btn btn-sm btn-outline-danger btn-icon-text removeRow">Delete</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-6 col-md-8">
                                        <input type="submit" class="btn btn-success" id="invoice_btn" value="Save">
                                        <button type="button" class="btn btn-danger" id="add_row">Add Row</button>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="form-group row">
                                            <label class="col-6 col-sm-6 col-form-label text-end">Sub Total</label>
                                            <div class="col-6 col-sm-6">
                                                <input type="text" class="form-control" name="sub_total"
                                                    value="0" id="sub_total" disabled>
                                            </div>
                                            <label class="col-6 col-sm-6 col-form-label text-end">Discount</label>
                                            <div class="col-6 col-sm-6">
                                                <input type="text" class="form-control" name="sub_discount"
                                                    value="0" id="sub_discount" disabled>
                                            </div>
                                            <label class="col-6 col-sm-6 col-form-label text-end">Grand Total</label>
                                            <div class="col-6 col-sm-6">
                                                <input type="text" class="form-control" name="grand_total"
                                                    value="0" id="grand_total" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        @include('layouts/footer')
        <script>
            $(document).ready(function() {
                $(document).on("click", "#add_row", function(e) {
                    e.preventDefault();
                    $("#trow").clone().find("input:text").val("0").end().appendTo("#tbody");
                });

                $(document).on("click", ".removeRow", function() {
                    $(this).closest("tr").remove();
                    let sub_total = 0;
                    $(".net_amount_total").each(function() {
                        sub_total += Math.round($(this).val());
                    });
                    $("#sub_total").val(sub_total);

                    let sub_discount = 0;
                    $(".discount_amount_total").each(function() {
                        sub_discount += Math.round($(this).val());
                    });
                    $("#sub_discount").val(sub_discount);

                    let grand_total = 0;
                    $(".gross_amount_total").each(function() {
                        grand_total += Math.round($(this).val());
                    });
                    $("#grand_total").val(grand_total);

                });

                $(document).on("change", ".product_id", function() {
                    let product_id = $(this).val();
                    let item_price = $(this).parent().next().find("#item_price");
                    $.ajax({
                        url: '/invoice-product/' + product_id,
                        type: 'get',
                        cache: false,
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            $(item_price).val(response.product.price);
                        }
                    })
                });

                $(document).on("keyup", "#item_qty", function() {
                    let item_qty = $(this).val();
                    let item_price = $(this).parent().siblings("#product_item_price").children("#item_price")
                        .val();
                    let total = item_qty * item_price;
                    let net_amount = $(this).parent().next().children("#net_amount").val(total);
                    let gross_amount = $(this).parent().next().next().next().children("#gross_amount").val(
                        total);
                    let sub_total = 0;
                    $(".net_amount_total").each(function() {
                        sub_total += Math.round($(this).val());
                    });
                    $("#sub_total").val(sub_total);

                    let sub_discount = 0;
                    $(".discount_amount_total").each(function() {
                        sub_discount += Math.round($(this).val());
                    });
                    $("#discount_amount_total").val(sub_discount);

                    let grand_total = 0;
                    $(".gross_amount_total").each(function() {
                        grand_total += Math.round($(this).val());
                    });
                    $("#grand_total").val(grand_total);

                });

                $(document).on("keyup", "#discount", function() {
                    let discount = $(this).val();
                    let net_amount = $(this).parent().siblings("#product_net_amount").children("#net_amount")
                        .val();
                    let total = net_amount - discount;
                    let gross_amount = $(this).parent().next().children("#gross_amount").val(total);

                    let sub_discount = 0;
                    $(".discount_amount_total").each(function() {
                        sub_discount += Math.round($(this).val());
                    });
                    $("#sub_discount").val(sub_discount);

                    let v1 = $("#sub_total").val();
                    let v2 = $("#sub_discount").val();
                    $("#grand_total").val(v1 - v2);

                });

                $(document).on("submit", "#add_invoice_form", function(e) {
                    e.preventDefault();
                    let name = $("#name").val();
                    let contact = $("#contact").val();
                    let invoice_no = $("#invoice_no").val();
                    let date = $("#date").val();
                    let sub_total = $("#sub_total").val();
                    let sub_discount = $("#sub_discount").val();
                    let grand_total = $("#grand_total").val();
                    let formData = new FormData(this);
                    let item_id = new Array();
                    let item_price = new Array();
                    let item_qty = new Array();
                    let item_net_amount = new Array();
                    let item_discount = new Array();
                    let item_gross_amount = new Array();
                    $('.item_id').each(function() {
                        item_id.push($(this).val());
                    });
                    $('.item_price').each(function() {
                        item_price.push($(this).val());
                    });
                    $('.item_qty').each(function() {
                        item_qty.push($(this).val());
                    });
                    $('.item_net_amount').each(function() {
                        item_net_amount.push($(this).val());
                    });
                    $('.item_discount').each(function() {
                        item_discount.push($(this).val());
                    });
                    $('.item_gross_amount').each(function() {
                        item_gross_amount.push($(this).val());
                    });
                    formData.append('sub_total', sub_total);
                    formData.append('sub_discount', sub_discount);
                    formData.append('grand_total', grand_total);
                    formData.append('item_id', JSON.stringify(item_id));
                    formData.append('item_price', JSON.stringify(item_price));
                    formData.append('item_qty', JSON.stringify(item_qty));
                    formData.append('item_net_amount', JSON.stringify(item_net_amount));
                    formData.append('item_discount', JSON.stringify(item_discount));
                    formData.append('item_gross_amount', JSON.stringify(item_gross_amount));
                    $("#invoice_btn").prop('disabled', true);
                    if (name == '' || contact == '' || invoice_no == '' || date == '') {
                        $(".invoice_notify").html(`
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Required!</strong> Fill all Field.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        `), setTimeout(function() {
                            $(".invoice_notify").html(``);
                            $("#invoice_btn").prop('disabled', false);
                        }, 2000);
                    } else {
                        $.ajax({
                            url: "{{ route('store_invoice') }}",
                            type: 'post',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                if (response.status == "true") {
                                    $(".invoice_notify").html(
                                        `<div class="alert alert-success alert-dismissible fade show" role="alert">
                                      <strong>Message!</strong> ` + response.msg + `.
                                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                  `), setTimeout(function() {
                                        $("#invoice_btn").prop('disabled', false);
                                        $(".invoice_notify").html(``);
                                        let lastId = response.lastId;
                                        window.location = '/print-invoice/' + lastId;
                                    }, 2000);
                                }
                                if (response.status == "false") {
                                    $(".invoice_notify").html(
                                        `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                      <strong>Message!</strong> ` + response.msg + `.
                                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                  `), setTimeout(function() {
                                        $("#invoice_btn").prop('disabled', false);
                                        $(".invoice_notify").html(``);
                                    }, 2000);;
                                }
                            }
                        });
                    }
                });
            });
        </script>
