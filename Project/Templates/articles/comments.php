
<form action="/project/Project/www/comment/store"method="post">

  <div class="form-group">
  <input type="hidden" name="postId" value="<?=$postId;?>">
    <label for="Text">Comment Text </label>
    <input type="text" class="form-control" id="Text" name = "text" >
</div>
<div class="form-group">
    <label for="select" class="from-label"> Author article </label>
    <select class="form-control" name = "author" id="select">
        <?php foreach($users as $user):?>
            <option value="<?=$user->getId();?>"><?=$user->getNickname();?></option>
            <?php endforeach;?>
        </select>
        </div>        

  <button type="submit" class="btn btn-primary mt-3">Save</button>
</form>