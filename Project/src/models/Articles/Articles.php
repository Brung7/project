<?php
namespace src\models\Articles;
use src\models\Users\Users;
use Services\Db;
use src\models\ActiveRecordEntity;


class Articles extends ActiveRecordEntity{
        
        protected $name;
        protected $text;
        protected $authorId;


        public function setName(string $name){$this->name = $name;}

        public function setText(string $text){$this->text = $text;}

        public function setAuthorId(int $authorId){$this->AuthorId = $authorId;}

        public function getName(){return $this->name;}
        
        public function getText(){return $this->text;}
    
        

        public function getAuthorId():Users{

            $db = Db::getInstance();
            $user = $db->query('SELECT * FROM `users` WHERE `id`=:id', [':id'=>$this->authorId], Users::class);
            return $user[0];


        }

        public static function getTableName(){
            return 'articles';
        }
    }









?>