<?php 

use Natan\ManagerTasks\database\DataBase;
namespace Natan\ManagerTasks\database;

class ORM {
    private $database;

    public function __construct(){
        $this->database=new DataBase();
        return $this;
    }
    private function getObject($object){
        if(!is_object($object)) 
            throw new exception("Not is Object!");
        else    
            return $object;        
        die();
    }
    
    private function objectToArray($object)
    {
        $object=$this->getObject($object);
        return (array)$object;
    }
    private function keys(object $object)
    {
        $array = $this->objectToArray($object);
        $classname=get_class($object);
        $keys = array_keys($array);
        
        foreach($keys as $i=>$value){
            $value= \str_replace($classname,"",$value);            
            $keys[$i]=$value;            
        }
        return $keys;
    }
    private function tablename(object $object)
    {
        $classname=get_class($object);
        $array=explode('\\',$classname);
        return strtolower($array[array_key_last($array)]).'s';
    }
    
    private function tabledata(object $object)
    {
        $array = $this->objectToArray($object);
        $classname=get_class($object);        
        $keys = $this->keys($object);
        $data=[];
        $i=0;
        foreach($array as $key=>$value)
        {
            $isKey=strcmp($classname.$keys[$i],$key);                        
            if($isKey) 
            {
                $data[":{$keys[$i]}"]=strip_tags("'".$value."'"); 
            }
            else
            {
                throw new \exception("Object '{$classname}' in conflict with keys!");
                die();
            }            
            $i++;
        }        
        return $data;
    }
    public function save(object $object)
    {
        try
        {
            
            $keys = $this->keys($object);
            $table = $this->tablename($object);
            $dbname= $this->database->getSettings()['database']['dbname'];
            $data = ($this->tabledata($object));              
            $columns = implode(",",$keys);
            $values = "".implode(", ",array_values($data));
            
            $query = "INSERT INTO {$dbname}.{$table} ({$columns}) VALUES ({$values});";
            $query= strip_tags(($query));

            // echo $query;
            return $this->database->getConnection()->prepare($query)->execute($data);            
        }
        catch(\PDOException $e)
        {
            echo $this->database->getMessageHTML($e->getMessage());
            die();
        }catch(\Exception $e){

            echo $this->database->getMessageHTML($e->getMessage());
            die();
        }
        return false;
    }
    public function edit($object,$id)
    {
        try
        {
            $dbname = $this->database->getSettings()['database']['dbname'];
            $query = "UPDATE {$dbname}.{$this->tablename($object)} SET ";
            $keys= $this->keys($object);
            $data = $this->tabledata($object);
            
            foreach($keys as $key)
            {
                $query.="{$key}=".$data[":".$key].",";
            }
            $query=substr_replace($query,"",-1);  
            $query.=" WHERE id={$id};";
            echo $query;
            $this->database->loadSQL(strip_tags($query));
            return true;
        }catch(\PDOException $e)
        {

            echo $this->database->getMessageHTML($e->getMessage());
            die();
        }catch(\Exception $e){

            echo $this->database->getMessageHTML($e->getMessage());
            die();
        }
        return false;
        
    }
    public function remove($object, $id)
    {
        $dbname=$this->database->getSettings()['database']['dbname'];
        $table="";
        if(is_object($object))
            $table = $this->tablename($object);
        else if(\is_string($object))
            $table = $object;
        else
            throw new \exception("Argument not is a String or Object!");
            
        try
        {

            $query = strip_tags("DELETE FROM {$dbname}.{$table} WHERE id={$id};");            
            
            $this->database->getConnection()->prepare($query)->execute();            
            return true;
        }catch(\PDOException $e){
            echo $this->getMessageHTML($e->getMessage());
            return false;
        }
        return false;
    }
    public function search($object,$id){
        $dbname=$this->database->getSettings()['database']['dbname'];
        $table = "";
        
        try
        {
            if(is_object($object))
                $table = $this->tablename($object);
            else if(\is_string($object))
                $table = $object;
            else
                throw new \exception("Argument not is a String or Object!");
            $query=strip_tags("SELECT * FROM {$dbname}.{$table} WHERE id={$id};");
            // echo $query; 
            $searched=$this->database->getConnection()->query($query)->fetch();#All(PDO::FETCH_ASSOC);
            // print_r($searched);
            if (count($searched)>0)
                return (object)$searched;
            return [];
        }catch(\PDOException $e)
        {
            echo $this->getMessageHTML($e->getMessage());
            die();
        }
    }
    public function searchFK($object,$fk,$id){
        $dbname=$this->database->getSettings()['database']['dbname'];
        $table = "";
        
        try
        {
            if(is_object($object))
                $table = $this->tablename($object);
            else if(\is_string($object))
                $table = $object;
            else
                throw new \exception("Argument not is a String or Object!");
            $query=strip_tags("SELECT * FROM {$dbname}.{$table} WHERE {$fk}={$id};");
            // echo $query; 
            $searched=$this->database->getConnection()->query($query)->fetch();#All(PDO::FETCH_ASSOC);
            // print_r($searched);
            if (count($searched)>0)
                return (object)$searched;
            return [];
        }catch(\PDOException $e)
        {
            echo $this->getMessageHTML($e->getMessage());
            die();
        }
    }
    public function listAll($object,$condition)
    {
        //echo "Condição ".$condition;
        $dbname=$this->database->getSettings()['database']['dbname'];
        if(!empty($condition))
            $condition=" WHERE ".$condition;
        
        try{
            if(is_object($object))
                $table = $this->tablename($object);
            else if(\is_string($object))
                $table = $object;
            else
                throw new \exception("Argument not is a String or Object!");
            $sql =strip_tags("SELECT * FROM {$dbname}.{$table} {$condition};");
            //echo $sql;
            $stmt = $this->database->getConnection()->query($sql);
            $list = [];
            while ($row = $stmt -> fetch(\PDO::FETCH_ASSOC)){                
                $list[]=(object)$row;
            }
            return $list;
        }catch(\PDOException $e){
            echo $this->getMessageHTML($e->getMessage());
            die();
        }
    }

    

    /**
     * Get the value of database
     */ 
    public function getDatabase()
    {
        return $this->database;
    }
}
?>