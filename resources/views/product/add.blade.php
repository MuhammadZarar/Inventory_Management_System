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
                        <li class="breadcrumb-item"><a href="{{ route('list_product') }}">Juice</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Juice</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h3>Add Product</h3>
                            <hr>
                            <form id="add_product_form" class="forms-sample">
                                @csrf
                                <div class="product_notify"></div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="product" id="product"
                                        class="form-control form-control-sm" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <label>Type</label>
                                    <select class="form-control form-control-sm" name="type" id="type">
                                        @if (count($category) > '0')
                                            @foreach ($category as $category)
                                                <option value="{{ $category->category_id }}">
                                                    {{ Str::title($category->name) }}
                                                </option>
                                            @endforeach
                                        @else
                                            <option selected disabled>Data not Available</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="number" name="price" id="price"
                                            class="form-control form-control-sm" value="0" />
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-gradient-primary me-2"
                                    id="add_product_submit">Submit</button>
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
                $(document).on("submit", "#add_product_form", function(e) {
                    e.preventDefault();
                    var formData = new FormData(this);
                    var product = $("#product").val();
                    var type = $("#type").val();
                    var price = $("#price").val();
                    $("#add_product_submit").prop('disabled', true);
                    if (product == '' || type == '' || price == '') {
                        $(".product_notify").html(`
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Required!</strong> Fill all Field.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        `), setTimeout(function() {
                            $(".product_notify").html(``);
                            $("#add_product_submit").prop('disabled', false);
                        }, 2000);
                    } else {
                        $.ajax({
                            url: "{{ route('store_product') }}",
                            type: 'post',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                if (response.status == "true") {
                                    $(".product_notify").html(
                                        `<div class="alert alert-success alert-dismissible fade show" role="alert">
                                      <strong>Message!</strong> ` + response.msg + `.
                                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                  `), setTimeout(function() {
                                        $("#add_product_submit").prop('disabled', false);
                                        $(".product_notify").html(``);
                                        $("#add_product_form")[0].reset();
                                    }, 2000);
                                }
                                if (response.status == "false") {
                                    $(".product_notify").html(
                                        `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                      <strong>Message!</strong> ` + response.msg + `.
                                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                  `), setTimeout(function() {
                                        $("#add_product_submit").prop('disabled', false);
                                        $(".product_notify").html(``);
                                    }, 2000);;
                                }
                            }
                        });
                    }
                });
            });
        </script>
