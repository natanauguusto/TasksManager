<?php require_once __DIR__."/vendor/autoload.php";?>
<?php

use Natan\ManagerTasks\models\Task;
use Natan\ManagerTasks\database\ORM;
    
    $task = new Task();
    $orm = new ORM();

    # SET Task
    $task->setTask("Estudar Docker","Containers,Images e Volumes",1,1,"2022-03-10");
    
    # save Task
    $orm->save($task);
    # list tasks
    $tasks = $orm->listAll($task);
    foreach($tasks as $task)
        print_r($task);
    # remove task

?>