<?php include("parts/header.php")?>

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-login">
                        <div class="panel-heading">
                                <div class="row">
                                        <div class="col-xs-6">
                                                <a href="#" <?php isset($hideLogin) ? '' : print("class=\"active\"")?> id="login-form-link">Login</a>
                                        </div>
                                        <div class="col-xs-6">
                                                <a href="#" <?php isset($hideRegister) ? '' : print("class=\"active\"")?> id="register-form-link">Register</a>
                                        </div>
                                </div>
                                <hr>
                        </div>
                        <div class="panel-body">
                                <div class="row">
                                        <div class="col-lg-12">
                                                <?php include("form/login.php") ?>
                                                <?php include("form/register.php") ?>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
    </div>
</div>

<?php include("parts/footer.php")?>