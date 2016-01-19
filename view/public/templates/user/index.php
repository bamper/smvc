
<div class="main-content">
    <div class="main-content-inner">
    </div>

    <div class="page-content">
        <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <td>User ID</td>
                    <td>User login</td>
                    <td>User role</td>
                    <td>User access token</td>
                    <td>User email</td>
                    <td width="40">Actions</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach($users as $user):?>
                    <tr>
                        <td><?=$user['user_id']?></td>
                        <td><?=$user['login']?></td>
                        <td><?=$user['role']?></td>
                        <td><?=$user['access_token']?></td>
                        <td><?=$user['email']?></td>
                        <td width="40" class="center" >
                            <a href="/user/edit/id/<?=$user['user_id']?>">
                                <i class="menu-icon fa fa-pencil"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach?>
            </tbody>
        </table>
    </div>
</div>