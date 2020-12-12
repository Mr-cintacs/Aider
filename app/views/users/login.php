<?PHP require_once APPROOT.'/views/inc/header.php' ; ?>
<div>
    <form method="post" action="<?php echo URLROOT; ?>/users/login">
       
        <label for="email">E-mail</label>
        <input type="email" name='email'>
        <span><?php echo empty($data['email_err'])? "" : $data['email_err'] ; ?></span>
        <br>
        <label for="password">Password</label>
        <input type="password" name='password'>
        <span><?php echo empty($data['password_err'])? "" : $data['password_err'] ;?></span>
        <br>
        
        <input type="submit" value ="submit">
    </form>
</div>

<?php require_once APPROOT. '/views/inc/footer.php' ; ?>