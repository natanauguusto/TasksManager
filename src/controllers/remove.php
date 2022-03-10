<?php 
    $taskId = $_GET['id'];    
    use Natan\ManagerTasks\database\ORM;
    if(!(new ORM())->remove("tasks",$taskId)):            
?>
    <span class="msg error">Erro ao Remover Tarefa de ID <?=$taskId?></span>
<?php endif?>

<?php header("Location:".HOST);?>



