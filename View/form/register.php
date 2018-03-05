<form id="register-form" action="<?php echo \Helpers\UriManager::getUrl('register') ?>" method="post" role="form" style="<?php isset($hideRegister) ? print("display: none;") : print("display: block;")?>">
    <?php include('userFields.php'); ?>
    <div class="form-group">
            <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                            <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
                    </div>
            </div>
    </div>
</form>

