<?php
namespace src\models;
use Services\Db;
use Users\Users;

abstract class ActiveRecordEntity{
    protected $id;

    public function __set(string $property, string $value){
        //echo 'Create property '.$this->underscoreCamelCase($property).' with value '.$value.'</br>';
        $propertyName = $this->underscoreCamelCase($property);
        $this->$propertyName=$value;
    }

    
    public function underscoreCamelCase(string $name){
        return lcfirst(str_replace('_', '', ucwords($name, '_')));

    }

    public function getId(){return $this->id;}

    public static function findAll(){
        $db = Db::getInstance();
        $sql = 'SELECT * FROM `'.static::getTableName().'`';
        $articles = $db->query($sql, [], static::class); 
        return $articles;
    }

    public static function getById(int $id){
        $db = Db::getInstance();
        $sql = 'SELECT * FROM `'.static::getTableName().'` WHERE `id`=:id';
        $entities = $db->query($sql, [':id' => $id], static::class);
        return $entities ? $entities[0]:null;
        //return $db->query($sql, [':id' => $id], static::class);
    }

    private function mapToDbProperties():array{
        //$mapped = [];
        $reflector = new \ReflectionObject($this);
        $properties = $reflector->getProperties();
        $propertiesName =[];
         foreach($properties as $property){
            $propertyName = $property->getName();
             //echo $property->getName().'</br>';
             $propertyNameToDbFormat = $this->camelcaseToUnderScore($propertyName);
             $propertiesName[$propertyNameToDbFormat] = $this->$propertyName;
            // $mapped [] = $this->camelcaseToUnderScore($property->getName());
         }
         return $propertiesName;
    }

    public function camelcaseToUnderScore(string $name){
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $name));
    }

    public function save(){
        $propertiesName = $this->mapToDbProperties();
        if($propertiesName['id']===null) $this->insert($propertiesName);
        else $this->update($propertiesName);
        //var_dump($propertiesName);
    }
    
    public function insert($propertiesName){
        $name = [];
        $params = [];
        $paramToValue = [];
        foreach($propertiesName as $key=>$value){
            $param = ':'.$key;
            $name [] = '`'.$key.'`';
            $params [] = $param;
            $paramToValue[$param] = $value;
        }
        $sql = 'INSERT INTO '.static::getTableName().' ('.implode(',',$name).')
            VALUES ('.implode(',', $params).')';
        $db = Db::getInstance();
        $db->query($sql, $paramToValue, static::class);
        //var_dump($sql);
    }
    public function update($propertiesName){
        $db = Db::getInstance();
        $keyToParam = [];
        $param2Value = [];
        foreach($propertiesName as $key=>$value){
            $param = ':'.$key;
            $keyToParam[] = '`'.$key.'`='.$param;
            $param2Value[$param] = $value;
        }
        $sql = 'UPDATE '.static::getTableName().' SET ' .implode(',', $keyToParam).' WHERE `id`='.$this->id;
       // var_dump($sql);
        $db->query($sql, $param2Value, static::class);
        
    }

    public function delete(){
        $db= Db::getInstance();
        $sql = 'DELETE FROM `'.static::getTableName().'` WHERE `id`=:id';   
        $db->query($sql, [':id'=>$this->id],static::class);
    
    }

    public static function findAllComments(int $postId){
        $db = Db::getInstance();
        $sql = 'SELECT * FROM `'.static::getTableName().'` WHERE `post_id`=:id';
        $comment = $db->query($sql, [':id'=>$postId], static::class); 
        return $comment;
    }
    abstract static function getTableName();


}