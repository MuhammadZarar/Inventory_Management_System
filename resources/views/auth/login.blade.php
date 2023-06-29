<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon-16x16.png') }}" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo mx-auto">
                                <center><img src="{{ asset('assets/images/logo.png') }}" width="100%"></center>
                            </div>
                            <center>
                                <h4>Hello! let's get Sign in</h4>
                                {{-- <h6 class="font-weight-light">Sign in to continue.</h6> --}}
                            </center>
                            <form id="login_form" class="pt-3">
                                @csrf
                                <div class="login_notify"></div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg" placeholder="Username"
                                        name="email" id="email">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" id="password"
                                        class="form-control form-control-lg" placeholder="Password">
                                </div>
                                <div class="mt-2 text-end">
                                    <input type="submit"
                                        class="btn btn-block btn-gradient-primary btn-sm font-weight-medium auth-form-btn"
                                        value="SIGN IN" id="login_btn" />
                                </div>
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" class="form-check-input"> Keep me signed in </label>
                                    </div>
                                    <a href="#" class="auth-link text-black">Forgot password?</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/misc.js') }}"></script>
    <!-- endinject -->
    <script>
        $(document).ready(function() {
            $(document).on("submit", "#login_form", function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                var email = $("#email").val();
                var password = $("#password").val();
                $("#login_btn").prop('disabled', true);
                if (email == '' || password == '') {
                    $(".login_notify").html(`
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Required!</strong> Fill all Field.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `), setTimeout(function() {
                        $(".login_notify").html(``);
                        $("#login_btn").prop('disabled', false);
                    }, 2000);
                } else {
                    $.ajax({
                        url: "{{ route('check_login') }}",
                        type: 'Post',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response.status == "true") {
                                $(".login_notify").html(
                                    `<div class="alert alert-success alert-dismissible fade show" role="alert">
                                  <strong>Required!</strong> ` + response.msg + `.
                                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                              `), setTimeout(function() {
                                    $("#login_btn").prop('disabled', false);
                                    $(".login_notify").html(``);
                                    $("#login_form")[0].reset();
                                    window.location = "/dashboard";
                                }, 2000);
                            }
                            if (response.status == "false") {
                                $(".login_notify").html(
                                    `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                  <strong>Required!</strong> ` + response.msg + `.
                                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                              `), setTimeout(function() {
                                    $("#login_btn").prop('disabled', false);
                                    $(".login_notify").html(``);
                                }, 2000);;
                            }
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>
