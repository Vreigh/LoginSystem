<form id="login-form" action="<?php echo \Helpers\UriManager::getUrl(''); ?>" method="post" role="form" style="display: block;">
    <div class="form-group">
            <input type="text" name="l_email" id="email" tabindex="1" class="form-control" placeholder="Email" value="<?php if(isset($old['l_email'])) echo $old['l_email']; ?>">
    </div>
    <?php isset($errors['l_email']) ? \Helpers\Helper::displayErrors($errors['l_email']) : ''; ?>
    <div class="form-group">
            <input type="password" name="l_password" id="password" tabindex="2" class="form-control" placeholder="Password">
    </div>
    <?php isset($errors['l_password']) ? \Helpers\Helper::displayErrors($errors['l_password']) : ''; ?>
    <?php isset($errors['l_general']) ? \Helpers\Helper::displayErrors($errors['l_general']) : ''; ?>
    <div class="form-group">
            <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                            <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
                    </div>
            </div>
    </div>
</form>
