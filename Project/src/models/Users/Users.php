<?php
namespace src\models\Users;
use src\models\ActiveRecordEntity;
use src\models\Articles;
class Users extends ActiveRecordEntity{

    
        protected $nickname;
        protected $email;
        protected $isConfirmed;
        protected $password;
        protected $role;
        protected $authToken;
        protected $createdAt;


        public function getNickname(){
            return $this->nickname;
        }

        public static function getTableName(){
            return 'Users';
        }
        
    }











?>    