<?php 
    
    use Natan\ManagerTasks\database\ORM as ORM;
    
    $orm= new ORM();
    $tasks=$orm->listAll("tasks","");
    
    require __DIR__."/../../src/view/pages/tasks.php";        
    
?>