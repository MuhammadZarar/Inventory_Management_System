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
                        <li class="breadcrumb-item"><a href="{{ route('add_category') }}">Category</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Category</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h3>Edit Category</h3>
                            <hr>
                            <form id="edit_category_form" class="forms-sample">
                                @csrf
                                <div class="category_notify"></div>
                                <div class="form-group">
                                    <label>Category Name</label>
                                    <input type="hidden" name="code" id="code" value="{{ $category->code }}">
                                    <input type="text" name="category" id="category"
                                        class="form-control form-control-sm" placeholder="Name"
                                        value="{{ Str::title($category->name) }}">
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control form-control-sm" name="status" id="status">
                                        <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Deactive</option>
                                    </select>
                                </div>
                                <button type="submit" id="category_btn"
                                    class="btn btn-gradient-primary me-2">Submit</button>
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
                $(document).on("submit", "#edit_category_form", function(e) {
                    e.preventDefault();
                    var formData = new FormData(this);
                    var code = $("#code").val();
                    var category = $("#category").val();
                    var status = $("#status").val();
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
                            url: "{{ route('update_category') }}",
                            type: 'post',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                if (response.status == "true") {
                                    $(".category_notify").html(
                                        `<div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong>Required!</strong> ` + response.msg + `.
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    `), setTimeout(function() {
                                        $("#category_btn").prop('disabled', false);
                                        $(".category_notify").html(``);
                                    }, 2000);
                                }
                                if (response.status == "false") {
                                    $(".category_notify").html(
                                        `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>Required!</strong> ` + response.msg + `.
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
