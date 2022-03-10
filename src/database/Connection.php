<?php 
namespace Natan\ManagerTasks\database;

use PDO;

class Connection extends PDO{
    
    public function getMessageHTML($msg)
    {
        return "<span class='msg error'>{$msg}</span>";
    }
    public function __construct($settings=[])
    {
        if(!$settings) 
            throw new exception("Unable acess file");
        $dns = $settings['database']['driver'].
        ':host='.$settings['database']['host'].
        (!empty($settings['database']['port'])?
        (';port='.$settings['database']['port']):"").";charset=utf8"
        .';dbname='. $settings['database']['dbname'];
        
        try
        {
         
            # XAMPP ACESS
                // $user="root";$password="";
            # SERVER MYSQL MACHINE LOCAL
            $user=$settings['database']['username'];
            $password=$settings['database']['password'];
            $options=[
                PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_CASE=>PDO::CASE_LOWER
            ];
            
            parent::__construct($dns,$user,$password,$options);
            

            
        }
        catch (\PDOException $e)
        {
            $this->getMessageHTML("Erro ao conectar ao Banco De Dados.<br>".$e->getMessage());
            die();
        }
    }
    

}
?>