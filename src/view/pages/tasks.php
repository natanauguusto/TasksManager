<!DOCTYPE html>




    <div class="container list center">
        <h1>TasksManager</h1>
        
        <?php require __DIR__."/../templates/formTask.php";?>
        <?php if(is_null($id)):?>
            <?php require __DIR__."/../templates/tasks.php";?>
        <?php endif?>
        
    </div>
