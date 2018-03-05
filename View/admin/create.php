<?php include("View/parts/header.php"); ?>

<div class="container">
    <div class="panel-body">
        <div class="row">
                <div class="col-lg-12">
                        <form id="create-form" action="<?php echo \Helpers\UriManager::getUrl('user/create'); ?>" method="post" role="form" style="display: block;">
                            <?php include('View/form/userFields.php'); ?>
                            <div class="form-group">
                                    Admin: <input type="checkbox" name="is_admin" id="is_admin" tabindex="1" <?php if(isset($old['is_admin']) && $old['is_admin'] == 1) echo "checked"; ?>>
                            </div>
                            <div class="form-group">
                                    <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                    <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Create">
                                            </div>
                                    </div>
                            </div>
                        </form>
                </div>
        </div>
    </div>
</div>



<?php include("View/parts/footer.php"); ?>
