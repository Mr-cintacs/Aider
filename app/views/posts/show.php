<?php require APPROOT.'/views/inc/header.php'; ?>
<button><a href="<?php echo URLROOT.'/posts' ?>">BACK</a></button>
<h2>Details</h2>
<div>
    <h4>Title</h4>
    <p><?php echo $data['post']->title ?></p>
    <h4>Body</h4>
    <p><?php echo $data['post']->body ?></p>
    <h4>Created at</h4>
    <p><?php echo $data['post']->created_at ?></p>
    <h4>Original Poster</h4>
    <p><?php echo $data['user']->name ?></p>
</div>
<?php if($data['user']->id == $_SESSION['id']): ?>
    <ul>
        <li><a href="<?php echo URLROOT.'/posts/edit/'.$data['post']->id ?>">Edit</a></li>
        <li>
            <form action="<?php echo URLROOT.'/posts/delete/'.$data['post']->id?>" method="post">
                <input type="submit" value="Delete">
            </form>
        </li>
    </ul>
<?php endif; ?>
<?php require APPROOT.'/views/inc/footer.php'; ?>