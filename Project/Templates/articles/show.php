<?php

require __DIR__.'/../header.php';
?>
<div class="card mt-3" style="width:18rem;">
    <div class="card-body">
        <h5 class="card-title"><?=$article->getName()?></h5>
        <p class="card-text"><?=$article->getText()?></p>
        <p class="card-text"><?=$article->getAuthorId()->getNickname()?></p>
        <a href="/project/Project/www/article/edit/<?=$article->getId();?>" class="card-link">Update article</a>
        <a href="/project/Project/www/article/delete/<?=$article->getId();?>" class="card-link">Delete article</a>
        <a href="/project/project/www/comment/create/<?=$article->getId();?>"class="card-link">Add comment</a>
    </div>
</div>
<h3>Comments</h3>
<?php foreach($comments as $comment):?>
<div class="card" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title"><?=$comment->getCommentAuthorId()->getNickname();?></h5>
        <p class="text"><?=$comment->getText();?></p>
        <a href="/project/Project/www/comment/edit/<?=$comment->getId();?>"
        class="/project/Project/www/">Edit comment</a>
        <a href="/project/Project/www/comment/delete/<?=$comment->getId();?>"
        class="/project/Project/www/">Delete comment</a>

    </div>
</div>
<?php endforeach;?>

<?php

require __DIR__.'/../footer.html';