<?PHP require_once APPROOT.'/views/inc/header.php' ; ?>
<div>
    <form method="post" action="<?php echo URLROOT ?>/users/register">
        <label for="name">Name</label>
        <input type="text" name='name'>
        <span><?php echo empty($data['name_err'])?"":$data['name_err'];?></span>
        <br>
        <label for="email">E-mail</label>
        <input type="email" name='email'>
        <span><?php echo (empty($data['email'])?"":$data['email_err']); ?></span>
        <br>
        <label for="password">Password</label>
        <input type="password" name='password'>
        <span><?php echo (empty($data['password_err'])? "":$data['password_err']) ;?></span>
        <br>
        <label for="confirm_password">Confirm Password</label>
        <input type="password" name='confirm_password'>
        <span><?php echo (empty($data['confirm_password_err'])? "":$data['confirm_password_err']) ;?></span>
        <br>
        <input type="submit" value ="submit">
    </form>
</div>

<?php require_once APPROOT. '/views/inc/footer.php' ; ?>