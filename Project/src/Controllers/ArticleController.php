<?php

namespace src\Controllers;
use src\models\ActiveRecordEntity;
use src\models\Articles\Articles;
use src\View\View;
use src\models\Users\Users;
use src\models\Comments\Comments;

class ArticleController{
    private $view;

    public function __construct(){
        $this->view = new View(__DIR__.'/../../templates/');

    }
    public function index(){
        $articles = Articles::findAll();
        //var_dump($articles);
        $this->view->renderHtml('articles/view.php',['articles'=>$articles]);
        
    }

    public function create(){
        $users= Users::findAll();
        $this->view->renderHtml('articles/create.php', ['users'=>$users]);
    }
    public function store(){
        $article = new Articles;
        $article->setName($_POST['name']);
        $article->setText($_POST['text']);
        $article->setAuthorId($_POST['author']);
        $article -> save();
        return header('Location: http://localhost/project/Project/www');}

    public function show($id){
        $article = Articles::getById($id);
        $comments = Comments::findAllComments($id);
       $this->view->renderHtml('articles/show.php', ['article'=>$article, 'comments'=>$comments]);
    }

    public function update($id){
        $article = Articles::getById($id);
        $article->setName($_POST['name']);
        $article->setText($_POST['text']);
        $article->setAuthorId($_POST['author']);
        $article -> save();
        $this->show($id);    
    }

    public function edit(int $id){
        $users = Users::findAll();
        $article = Articles::getById($id);
        $this->view->renderHtml('articles/edit.php', ['article'=>$article, 'users'=>$users]);

    }

    public function delete(int $id){
        $article = Articles::getById($id);
        if(Comments::findAllComments($article->getId())!=null){
            $comments = Comments::findAllComments($article->getId());
            foreach($comments as $comment){
                $comment->delete();
            }
        }
        $article->delete();
        return header('Location: http://localhost/project/Project/www');
    }
}