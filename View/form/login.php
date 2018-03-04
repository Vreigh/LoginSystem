<form id="login-form" action="<?php echo \Helpers\UriManager::getUrl(''); ?>" method="post" role="form" style="display: block;">
    <div class="form-group">
            <input type="email" name="login_email" id="login_email" tabindex="1" class="form-control" placeholder="Email" value="<?php if(isset($old['login_email'])) echo $old['login_email']; ?>">
    </div>
    <?php isset($errors['login_email']) ? \Helpers\Helper::displayErrors($errors['login_email']) : ''; ?>
    <div class="form-group">
            <input type="password" name="login_password" id="login_password" tabindex="2" class="form-control" placeholder="Password">
    </div>
    <?php isset($errors['login_password']) ? \Helpers\Helper::displayErrors($errors['login_password']) : ''; ?>
    <?php isset($errors['login_general']) ? \Helpers\Helper::displayErrors($errors['login_general']) : ''; ?>
    <div class="form-group">
            <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                            <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
                    </div>
            </div>
    </div>
</form>
