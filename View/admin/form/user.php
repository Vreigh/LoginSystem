<form id="register-form" action="<?php echo \Helpers\UriManager::getUrl('user?id=' . $old['id']); ?>" method="post" role="form" style="display: block;">
    <?php include('View/form/userFields.php'); ?>
    TO JEST FORMULARZ TWORZENIA
    <div class="form-group">
            <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                            <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Submit">
                    </div>
            </div>
    </div>
</form>

