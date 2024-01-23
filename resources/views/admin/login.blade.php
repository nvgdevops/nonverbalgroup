<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>The Social Edge</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="The Nonverbal Group - Develop Behavioral Awareness, Sharpen Your Communication & Gain a Social Edge" name="description" />
        <meta content="The Nonverbal Group" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo URL("/") ?>/assets/images/favicon.ico">

		<!-- App css -->
		<link href="<?php echo URL("/") ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
		<link href="<?php echo URL("/") ?>/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

		<link href="<?php echo URL("/") ?>/assets/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" disabled />
		<link href="<?php echo URL("/") ?>/assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet"  disabled />

		<!-- icons -->
		<link href="<?php echo URL("/") ?>/assets/css/icons.min.css" rel="stylesheet" type="text/css" />

    </head>

    <body class="authentication-bg">
        
        <div class="account-pages my-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-10">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="row g-0">
                                    <div class="col-lg-6 p-4">
                                    @error('email')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                        <div class="mx-auto">
                                            <h3 class="bold">The Social Edge</h3>
                                        </div>

                                        <h6 class="h5 mb-0 mt-3">Admin Panel</h6>
                                        <p class="text-muted mt-1 mb-2">
                                            Enter your email address and password to access admin panel.
                                        </p>

                                        <form action="{{ route('admin.authenticate') }}" method="post" class="authentication-form">
                                        @csrf
                                            <div class="mb-2">
                                                <label class="form-label">Email Address</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="icon-dual" data-feather="mail"></i>
                                                    </span>
                                                    <input type="email" class="form-control" id="email" name="email">
                                                </div>
                                            </div>

                                            <div class="mb-2">
                                                <label class="form-label">Password</label>
                                                <!--<a href="pages-recoverpw.html" class="float-end text-muted text-unline-dashed ms-1">Forgot your password?</a>-->
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="icon-dual" data-feather="lock"></i>
                                                    </span>
                                                    <input type="password" class="form-control" id="password" name="password">
                                                </div>
                                            </div>
                                            @error('password')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror

                                            <div class="mb-3">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="checkbox-signin" checked>
                                                    <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                                </div>
                                            </div>

                                            <div class="mb-3 text-center d-grid">
                                                <button class="btn btn-primary btn-dark" type="submit">Log In</button>
                                            </div>
                                        </form>
                                        <div class="row">
                                            <div class="col-12 text-center">
                                                The Nonverbal Group
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 d-none d-md-inline-block">
                                        <div class="auth-page-sidebar">
                                            <div class="overlay"></div>
                                            <div class="auth-user-testimonial">
                                                <p class="fs-24 fw-bold text-white mb-1">The Nonverbal Group</p>
                                                <p class="lead">Develop Behavioral Awareness, Sharpen Your Communication & Gain a Social Edge</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                       

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <!-- Vendor js -->
        <script src="<?php echo URL("/") ?>/assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="<?php echo URL("/") ?>/assets/js/app.min.js"></script>
        
    </body>
</html>