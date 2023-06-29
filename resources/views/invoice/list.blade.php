@include('layouts/header')
<!-- partial -->
<div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_sidebar.html -->
    @include('layouts/sidebar')
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> Invoices</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('list_invoice') }}">Invoice</a></li>
                        <li class="breadcrumb-item active" aria-current="page">List Juice</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6 col-lg-6 text-start">
                                    <h2 class="mt-2">Invoices List</h2>
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
                                <table class="table table-bordered table-sm text-center">
                                    <thead style="background-color: #b66dff; color: black; font-weight: bolder">
                                        <tr>
                                            <th> User Name </th>
                                            <th> Net Amount </th>
                                            <th> Discount Amount </th>
                                            <th> Grand Amount </th>
                                            <th> Status </th>
                                            <th> Created At </th>
                                            <th> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
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
                invoice_get();

                function invoice_get() {
                    $.ajax({
                        url: "{{ route('get_invoice') }}",
                        type: 'get',
                        success: function(response) {
                            $('tbody').html(response);
                        }
                    });
                }
            });
        </script>
