<?php
use SMVC\Core\Kernel\CSRF;
?>
<div class="main-content">
    <div class="main-content-inner">
</div>

<div class="page-content">
    <form data-toggle="validator" id="user_add_form" action="/user/create" method="post" role="form">
        <div class="form-group">
            <label for="inputName" class="control-label">Login</label>
            <input type="text" class="form-control" id="inputName" name="login" maxlength="15" placeholder="Cina Saffary" required>
        </div>
        <div class="form-group">
            <label for="inputEmail" class="control-label">Email</label>
            <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email" data-error="Invalid email address" required>
            <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
            <label class="control-label" for="inputPassword">Password</label>
            <input type="password" data-minlength="6" class="form-control" id="inputPassword" name="password" placeholder="Password" required>
            <label for="confirmPassword" class="control-label">Confirm Password</label>
            <input type="password" class="form-control" id="inputPasswordConfirm" data-match="#inputPassword" data-match-error="Passwords, does not match!" placeholder="Confirm" required>
        </div>
        <div class="form-group">
            <label for="selectRole" class="control-label">Role</label>
            <select name="role" class="form-control" id="selectRole">
                <?php foreach($roles as $role):?>
                    <option value="<?=$role['role_id']?>"><?= $role['role_name']?></option>
                <?php endforeach ?>
            </select>
        </div>
        <?= CSRF::getHiddenInputString() ?>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>