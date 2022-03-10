<?php
namespace Natan\ManagerTasks\database;

use Natan\ManagerTasks\database\Connection;

class DataBase{
    private Connection $connection;
    private $settings;
    public function __construct($file='dev.ini'){
        $this->settings= parse_ini_file($file,TRUE);
        if(!$this->settings)
            throw new exception("Unable acess file");        
        $this->connection=new Connection($this->settings);
        $sql=file_get_contents(__DIR__.'/database.sql');
        $this->loadSQL($sql);
    }

    public function getMessageHTML($msg)
    {
        return "<div class='container'><span class='msg error center'>{$msg}</span></div>";
    }
    public function loadSQL($sql='',$data=null)
    {     
        try{
            if(!empty($sql)){
                $stmt=$this->connection->prepare($sql);
                return $stmt->execute($data);
            }else
                throw new exception("SQL Query is Empty!");
        }catch(\PDOException $e){
            $this->getMessageHTML($e->getMessage());
            return false;
        }
        return false;
    }

    /**
     * Get the value of connection
     */ 
    public function getConnection()
    {
        return $this->connection;
    }

    public function closeConnection(){
        $this->connection->close();
    }
    /**
     * Get the value of settings
     */ 
    public function getSettings()
    {
        return $this->settings;
    }

}
?>