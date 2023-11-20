<?php
namespace src\models\Comments;
use src\models\Users\Users;
use Services\Db;
use src\models\ActiveRecordEntity;

class Comments extends ActiveRecordEntity{
    protected $postId;
    protected $text;
    protected $authorId;
    protected $id;

    public function setId(int $id){$this->id = $id;}

    public function setPostId(int $postId){$this->postId = $postId;}

    public function setText(string $text){$this->text = $text;}
    
    public function setAuthorId(int $authorId){$this->authorId = $authorId;}

    public function getId(){return $this->id;}

    public function getPostId(){return $this->postId;}

    public function getText(){return $this->text;}

    public function getAuthorId(){return $this->authorId;}

    public function getCommentAuthorId():Users{
        $db = Db::getInstance();
        $user = $db->query('SELECT * FROM `users` WHERE `id`=:id', [':id'=>$this->authorId], Users::class);
        return $user[0];
    }

    public static function getTableName(){
        return 'comments';
    }

}