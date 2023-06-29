@include('layouts/header')
<!-- partial -->
<div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_sidebar.html -->
    @include('layouts/sidebar')
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> Juices</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('add_product') }}">Juice</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Juice</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6 col-lg-6 text-start">
                                    <h2 class="mt-2">Daily Sales Report</h2>
                                </div>
                                <div class="col-6 col-lg-6 text-end">
                                    <button type="button" class="btn btn-gradient-primary btn-icon-text"> Print <i
                                            class="mdi mdi-printer btn-icon-append"></i>
                                    </button>
                                    {{-- <h4 class="card-title">Juices List</h4> --}}
                                </div>
                            </div>
                            <hr>
                            <div class="table-responsive">
                                <div class="product_notify"></div>
                                <table class="table table-bordered text-center">
                                    <thead style="background-color: #b66dff; color: black; font-weight: bolder">
                                        <tr>
                                            <th style="width: 40%"> Client Name </th>
                                            <th style="width: 20%"> Net Amount </th>
                                            <th style="width: 20%"> Discount </th>
                                            <th style="width: 20%"> Gross Amount </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($invoice as $item)
                                            <tr>
                                                <td>{{ $item->name }}</td>
                                                <td>
                                                    <input type="text" class="form-control get_sub_total text-center" style="border: none" value="{{ $item->sub_total }}">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control get_sub_discount text-center" style="border: none" value="{{ $item->sub_discount }}">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control get_grand_total text-center" style="border: none" value="{{ $item->grand_total }}">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <br><br>
                            <div class="table-responsive">
                                <div class="product_notify"></div>
                                <table class="table table-bordered table-sm text-center p-0">
                                    <thead style="background-color: #b66dff; color: black; font-weight: bolder">
                                        <tr>
                                            <th> Total Net Amount </th>
                                            <th> Total Discount </th>
                                            <th> Total Gross Amount </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <td>
                                            <input type="text" class="form-control set_sub_total text-center" style="border: none">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control set_sub_discount text-center" style="border: none">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control set_grand_total text-center" style="border: none">
                                        </td>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        @include('layouts/footer')
        <script>
            $(document).ready(function() {

                let get_sub_total = 0;
                $(".get_sub_total").each(function() {
                    get_sub_total += Math.round($(this).val());
                });
                $(".set_sub_total").val(get_sub_total);
                
                let get_sub_discount = 0;
                $(".get_sub_discount").each(function() {
                    get_sub_discount += Math.round($(this).val());
                });
                $(".set_sub_discount").val(get_sub_discount);

                let get_grand_total = 0;
                $(".get_grand_total").each(function() {
                    get_grand_total += Math.round($(this).val());
                });
                $(".set_grand_total").val(get_grand_total);
            });
        </script>
