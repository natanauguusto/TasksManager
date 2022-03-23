<?php define("DESTINATION","./"."attachments/");define("HOST","http://localhost:8000/");?>
<?php require_once "./vendor/autoload.php";?>
<?php require_once __DIR__."/src/utils/helpers.php";?>

<?php require "src/view/templates/head.php";?>
<div class="container list" >
    <div id="app" class="container list center">
<?php 
    use Natan\ManagerTasks\controllers\Web;
    $uri = $_SERVER['REQUEST_URI'];
    $uriList = explode("/",$uri);
    $lastPath= $uriList[count($uriList)-1];
    $web = new Web();
    # Rotas de Tarefa
    if($lastPath=="" || $lastPath=="home" ||strpos($lastPath,"edit?id=")>-1)
        $web->tasks($_GET);
    else if($lastPath=="add")
        $web->add($_POST);    
    else if($lastPath=="edit")    
        $web->edit($_POST);    
    else if(strpos($lastPath,"remove?id=")>-1 )
        $web->remove($_GET);
    else if(strpos($lastPath,"task?task_id=")>-1)
        $web->task($_GET);        
    # Rotas de Anexo
    else if($lastPath=="attachment")
        $web->attachment($_POST,$_FILES);
    else
        header("Location:".HOST);
    
?>
</div>
</div>