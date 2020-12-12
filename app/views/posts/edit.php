<?php require APPROOT.'/views/inc/header.php'; ?>

<h2>Edit post</h2>
<div>
    <form  method="post" action="<?php echo URLROOT.'/posts/edit/'.$data['id'] ?> " >

        <label for="title">title</label>
        <input type="title" name='title' value="<?php echo $data['title'] ?>">
        <span><?php echo empty($data['title_err'])? "" : $data['title_err'] ; ?></span>
        <br>
        <label for="body">body</label>
        <input type="body" name='body' value="<?php echo $data['body'] ?> ">
        <span><?php echo empty($data['body_err'])? "" : $data['body_err'] ;?></span>
        <br>
        
        <input type="submit" value ="submit">
    </form>
</div>

<?php require APPROOT.'/views/inc/footer.php'; ?>