<?php define("DESTINATION","./"."attachments/");define("HOST","http://localhost:8000/");?>
<?php require_once "./vendor/autoload.php";?>
<?php require_once __DIR__."/src/utils/helpers.php";?>

<?php require "src/view/templates/head.php";?>
<div class="container list" >
    <div id="app" class="container list center">
<?php 
    
    $uri = $_SERVER['REQUEST_URI'];
    $uriList = explode("/",$uri);
    $lastPath= $uriList[count($uriList)-1];
    
    # Rotas de Tarefa
    if($lastPath=="" || $lastPath=="home" ||strpos($lastPath,"edit?id=")>-1)
        require __DIR__."/src/controllers/tasks.php";
    
    else if($lastPath=="add")
        require __DIR__."/src/controllers/add.php";
    
    else if($lastPath=="edit")    
        require __DIR__."/src/controllers/edit.php";
    
    else if(strpos($lastPath,"remove?id=")>-1 )
        require __DIR__."/src/controllers/remove.php";   
        
    else if(strpos($lastPath,"task?task_id=")>-1)
        require __DIR__."/src/controllers/task.php";
    # Rotas de Anexo
    else if($lastPath=="attachment")
        require __DIR__."/src/controllers/attachment.php";
    else
        header("Location:".HOST);
    
?>
</div>
</div>