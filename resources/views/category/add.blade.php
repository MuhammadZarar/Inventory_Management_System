@include('layouts/header')
<!-- partial -->
<div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_sidebar.html -->
    @include('layouts/sidebar')
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> Category</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('add_product') }}">Category</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Category</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h3>Add Category</h3>
                            <hr>
                            <form id="category_form" class="forms-sample">
                                @csrf
                                <div class="category_notify"></div>
                                <div class="form-group">
                                    <label>Category Name</label>
                                    <input type="text" name="category" id="category" class="form-control form-control-sm" placeholder="Name">
                                </div>
                                <button type="submit" id="category_btn" class="btn btn-gradient-primary me-2">Submit</button>
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
                $(document).on("submit", "#category_form", function(e) {
                    e.preventDefault();
                    var formData = new FormData(this);
                    var category = $("#category").val();
                    $("#category_btn").prop('disabled', true);
                    if (category == '') {
                        $(".category_notify").html(`
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Required!</strong> Fill all Field.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        `), setTimeout(function() {
                            $(".category_notify").html(``);
                            $("#category_btn").prop('disabled', false);
                        }, 2000);
                    } else {
                        $.ajax({
                            url: "{{ route('store_category') }}",
                            type: 'post',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                if (response.status == "true") {
                                    $(".category_notify").html(
                                        `<div class="alert alert-success alert-dismissible fade show" role="alert">
                                      <strong>Message!</strong> ` + response.msg + `.
                                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                  `), setTimeout(function() {
                                        $("#category_btn").prop('disabled', false);
                                        $(".category_notify").html(``);
                                        $("#category_form")[0].reset();
                                    }, 2000);
                                }
                                if (response.status == "false") {
                                    $(".category_notify").html(
                                        `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                      <strong>Message!</strong> ` + response.msg + `.
                                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                  `), setTimeout(function() {
                                        $("#category_btn").prop('disabled', false);
                                        $(".category_notify").html(``);
                                    }, 2000);;
                                }
                            }
                        });
                    }
                });
            });
        </script>
