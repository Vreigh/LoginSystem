<form id="register-form" action="<?php echo $userFormAction?>" method="post" role="form" style="<?php isset($hideRegister) ? print("display: none;") : print("display: block;")?>">
    <div class="form-group">
            <input type="text" name="name" id="name" tabindex="1" class="form-control" placeholder="Name" value="<?php if(isset($old['name'])) echo $old['name']; ?>">
    </div>
    <?php isset($errors['name']) ? \Helpers\Helper::displayErrors($errors['name']) : ''; ?>
    <div class="form-group">
            <input type="text" name="surname" id="surname" tabindex="1" class="form-control" placeholder="Surname" value="<?php if(isset($old['surname'])) echo $old['surname']; ?>">
    </div>
    <?php isset($errors['surname']) ? \Helpers\Helper::displayErrors($errors['surname']) : ''; ?>
    <div class="form-group">
            <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="<?php if(isset($old['email'])) echo $old['email']; ?>">
    </div>
    <?php isset($errors['email']) ? \Helpers\Helper::displayErrors($errors['email']) : ''; ?>
    <div class="form-group">
            <input type="text" name="address" id="address" tabindex="1" class="form-control" placeholder="Address" value="<?php if(isset($old['address'])) echo $old['address']; ?>">
    </div>
    <?php isset($errors['address']) ? \Helpers\Helper::displayErrors($errors['address']) : ''; ?>
    <div class="form-group">
            <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
    </div>
    <?php isset($errors['password']) ? \Helpers\Helper::displayErrors($errors['password']) : ''; ?>
    <div class="form-group">
            <input type="password" name="password_confirm" id="password_confirm" tabindex="2" class="form-control" placeholder="Confirm Password">
    </div>
    <?php isset($errors['password_confirm']) ? \Helpers\Helper::displayErrors($errors['password_confirm']) : ''; ?>
    <?php isset($errors['general']) ? \Helpers\Helper::displayErrors($errors['general']) : ''; ?>
    <div class="form-group">
            <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                            <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Sumbmit">
                    </div>
            </div>
    </div>
</form>

