<?php

use Natan\ManagerTasks\database\ORM;
    
    if(!isset($_GET["task_id"]))
        header("Location".HOST);
    $taskId=$_GET["task_id"];    
    $condition="task_id=".$taskId;
    ///echo "CONDIÇÂO ".$condition;
    $attachments = (new ORM())->listAll("attachments",$condition);
    ///echo "CONDIÇÂO ".$condition;
    $task = (new ORM())->search("tasks",$taskId);
    $checked=treatCompleted($task->completed);
    
    require __DIR__."/../view/pages/task.php";
    if(count($attachments)>0)
        require __DIR__."/../view/templates/attachments.php";
    else
        echo "<h2>Nenhum Anexo</h2>";
        
?>
