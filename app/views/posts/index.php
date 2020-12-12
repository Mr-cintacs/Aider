<?php  require_once APPROOT."/views/inc/header.php"; ?>

<h2><?php echo !empty($data['status'])? "Post Deleted":"" ?></h2>
<h2>Posts</h2>
<div>
    <button ><a href="<?php echo URLROOT.'/posts/add'?>"> Add post</a></button>
<?php foreach($data['posts'] as $posts): ?>

    <div class="posts">
        <p><h4><?php echo $posts->user_id.") ".$posts->title ; ?></h4></p>
        <p><?php echo shortText($posts->body) ?>.......</p>
        <p><?php echo 'created by '."<b>".$posts->name."</b>" ?></p>
        <p><?php echo $posts->post_created_at ?></p>
        
    </div>
    <span>
        <ul>
            <li><button><a href="<?php echo URLROOT."/posts/show/".$posts->post_id ?>">More</a></button></li>
        </ul>
    </span>

<?php endforeach; ?>
</div>
<?php require_once APPROOT."/views/inc/footer.php"; ?>