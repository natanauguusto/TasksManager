<?php 
print_r($_POST);
use Natan\ManagerTasks\models\Task;
use Natan\ManagerTasks\database\ORM;
    if(!empty($_POST['name'])){
        try{                
            $task=(new Task())->setTask($_POST['name'],$_POST['description'],!isset($_POST['completed'])?false:$_POST['completed'],$_POST['priority'],$_POST['date_time']);        
            (new ORM())->save($task);        
            echo " Ok";
            
        }catch (\Exception $e){
            require "error.php";
        }
        catch (\PDOException $e){
            require "error.php";
        }        
    }
    header("Location:".HOST);
?>