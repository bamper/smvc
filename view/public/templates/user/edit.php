<?php
use SMVC\Core\Kernel\CSRF;
?>
<div class="main-content">
    <div class="main-content-inner">
    </div>

    <div class="page-content">
        <form data-toggle="validator" id="user_add_form" action="/user/update" method="post" role="form">
            <input type="hidden" name="user_id" value="<?=$user_data[0]['user_id']?>">
            <div class="form-group">
                <label for="inputName" class="control-label">Login</label>
                <input type="text" class="form-control" id="inputName" name="login" value="<?=$user_data[0]['login']?>" maxlength="15" placeholder="Cina Saffary" required>
            </div>
            <div class="form-group">
                <label for="inputEmail" class="control-label">Email</label>
                <input type="email" class="form-control" id="inputEmail" name="email" value="<?=$user_data[0]['email']?>" placeholder="Email" data-error="Invalid email address" required>
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group" id="passwordHandler">
                <label class="control-label" for="inputPassword">Password</label>
                <input type="password" data-minlength="6" class="form-control" id="inputPassword" name="password" placeholder="Password" required>
                <label for="confirmPassword" class="control-label">Confirm Password</label>
                <input type="password" class="form-control" id="inputPasswordConfirm" data-match="#inputPassword" data-match-error="Passwords, does not match!" placeholder="Confirm" required>
            </div>
<!--                <label class="control-label" for="savePassword"></label>-->
            <input type="checkbox" class="form-group-sm" id="savePassword">&nbsp;Save current password
            <div class="form-group">
                <label for="selectRole" class="control-label">Role</label>
                <select name="role" class="form-control" id="selectRole">
                    <?php foreach($roles as $role):?>
                        <option value="<?=$role['role_id']?>" <?= ($user_data[0]['role'] ==$role['role_id']) ? 'selected' : '' ?>><?= $role['role_name']?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <?= CSRF::getHiddenInputString() ?>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>