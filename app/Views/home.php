<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>

<body class="templatemo-bg-image-1">
    <div class="container">
        <div class="col-md-12">
            <form class="form-horizontal templatemo-login-form-2" role="form" action="#" method="post">
                <div class="row">
                    <div class="col-md-12">
                        <h1>
                            Dhon Studio<br>
                            <text class="h4">Single Sign On</text>
                        </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="templatemo-one-signin col-md-6">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="username" class="control-label">Username</label>
                                <div class="templatemo-input-icon-container">
                                    <i class="fa fa-user"></i>
                                    <input type="text" class="form-control" id="username" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="password" class="control-label">Password</label>
                                <div class="templatemo-input-icon-container">
                                    <i class="fa fa-lock"></i>
                                    <input type="password" class="form-control" id="password" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> Remember me
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="submit" value="LOG IN" class="btn btn-warning">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <a href="forgot-password.html" class="text-center">Register</a>
                            </div>

                            <div class="col-md-12">
                                <a href="forgot-password.html" class="text-center">Cannot login?</a>
                            </div>
                        </div>
                    </div>
                    <div class="templatemo-other-signin col-md-6">
                        <label class="margin-bottom-15">
                            One-click sign in using other services.
                        </label>
                        <a class="btn btn-block btn-social btn-facebook margin-bottom-15">
                            <i class="fa fa-facebook"></i> Sign in with Facebook
                        </a>
                        <!-- <a class="btn btn-block btn-social btn-twitter margin-bottom-15">
                            <i class="fa fa-twitter"></i> Sign in with Twitter
                        </a> -->
                        <a class="btn btn-block btn-social btn-google-plus">
                            <i class="fa fa-google-plus"></i> Sign in with Google
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

<?= $this->endSection(); ?>