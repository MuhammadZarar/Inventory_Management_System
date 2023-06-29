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
                                    <h2 class="mt-2">Juices List</h2>
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
                                            <th> Name </th>
                                            <th> Type </th>
                                            <th> Price </th>
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

                product_get();

                function product_get() {
                    $.ajax({
                        url: "{{ route('get_product') }}",
                        type: 'get',
                        success: function(response) {
                            $('tbody').html(response);
                        }
                    });
                }

                $(document).on("click", ".product_delete", function(e) {
                    e.preventDefault();
                    var code = $(this).attr('data-id');
                    $.ajax({
                        url: '/delete-product/' + code,
                        type: 'delete',
                        cache: false,
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.status == "true") {
                                $(".product_notify").html(`
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Message!</strong> ` + response.msg + `.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                `), setTimeout(function() {
                                    $(".product_notify").html(``);
                                    product_get();
                                }, 2000);
                            }
                            if (response.status == "false") {
                                $(".product_notify").html(`
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Message!</strong> ` + response.msg + `.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>                                
                                `), setTimeout(function() {
                                    $(".product_notify").html(``);
                                    product_get();
                                }, 2000);
                            }
                        }
                    })
                });
            });
        </script>
