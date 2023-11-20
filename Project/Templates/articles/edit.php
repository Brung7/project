<?php
require __DIR__.'/../header.php';
?>
<form action="/project/Project/www/article/update/<?=$article->getId();?>"method="post">
  <div class="form-group">
    <label for="Name">Name article</label>
    <input type="text" class="form-control" id="Name" name = "name" value="<?=$article->getName();?>">
  </div>
  <div class="form-group">
    <label for="Text">Text article</label>
    <input type="text" class="form-control" id="Text" name = "text" value="<?=$article->getText();?>">
</div>
<div class="form-group">
    <label for="select" class="from-label"> Author article </label>
    <select class="form-control" name = "author" id="select">
        <option value="<?=$article->getAuthorId()->getId();?>"><?=$article->getAuthorId()->getNickname();?>
</option>
        <?php foreach($users as $user):?>
            <option value="<?=$user->getId();?>"><?=$user->getNickname();?></option>
            <?php endforeach;?>
        </select>
        </div>        

  <button type="submit" class="btn btn-primary mt-3">Update</button>
</form>

<?php
require __DIR__.'/../footer.html';