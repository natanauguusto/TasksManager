<?php 

use Natan\ManagerTasks\models\Task;
use Natan\ManagerTasks\database\ORM;
    try{        
        $taskId = $_POST['id'];
        echo $taskId;
        $task=(new Task())->setTask($_POST['name'],$_POST['description'],!isset($_POST['completed'])?false:$_POST['completed'],$_POST['priority'],$_POST['date_time']);
        (new ORM())->edit($task,$taskId);
        echo " Ok";
        
    }catch (\Exception $e){
        echo "<div class='container' ><span class='msg error>".$e->getMessage()."</span></div>";
    }
    catch (\PDOException $e){
        echo "<div class='container' ><span class='msg error>".$e->getMessage()."</span></div>";
    }
    header("Location:".HOST);
?>