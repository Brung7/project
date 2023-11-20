<?php
namespace src\Controllers;
use src\models\Articles\Articles;
use src\View\View;
use src\models\Users\Users;
use src\models\Comments\Comments;

class CommentController{
private $view;

    public function __construct(){
        $this->view = new View(__DIR__.'/../../templates/');

    }
    
    public function create(int $postId){
        $users= Users::findAll();
        $this->view->renderHtml('articles/createComment.php', ['users'=>$users, 'postId'=>$postId]);
    }
    public function store(){
        $comment = new Comments;
        $comment->setPostId($_POST['postId']);
        $comment->setText($_POST['text']);
        $comment->setAuthorId($_POST['author']);
        $comment -> save();
        return header('Location: http://localhost/project/Project/www/article/'.$comment->getPostId());}


    public function update(int $id){
        $comment = Comments::getById($id);
        $comment->setText($_POST['text']);
        $comment -> save();
        return header('Location: http://localhost/project/Project/www/article/'.$comment->getPostId());
          
    }

    public function edit(int $id){
        $users = Users::findAll();
        $comment = Comments::getById($id);
        $this->view->renderHtml('articles/editComment.php', ['comment'=>$comment, 'users'=>$users]);

    }

    public function delete(int $id){
        $comment = Comments::getById($id);
        $comment->delete();
        return header('Location: http://localhost/project/Project/www/article/'.$comment->getPostid());
    }
}