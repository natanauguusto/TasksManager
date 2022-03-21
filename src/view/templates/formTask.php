<?php
    

    // $task = false;
    // $id = $data['id'];
    // $completed= false;
    // $action = 'add';
    // $buttonSubmit = "Cadastrar";
    // if (!is_null($id)){
    //    $task=$orm->search("tasks",$id);
    //    $completed=treatCompleted($task->completed); 
    //    $action = "edit";
    //    $buttonSubmit="Editar";
    // }  
    // $actionPage ="{$action}";
    
?>
<form class="container border list" action="<?=$actionPage?>" method="POST">
    <input type="hidden" name="id" value="<?=$id?>"/>
    <div class="container list left">
        <label for="">Tarefa:</label>
        <input type="text" name="name" value="<?=$task?$task->nome:''?>">
    </div class="container list left">
    <div class="container list left">
        <label for="">Descrição:</label>
        <textarea name="description"><?=$task?$task->descricao:''?></textarea>
    </div>
    <div class="container center">
    <div class="container list left">        
        <label for="">Prazo:</label>
        <input type="date" name="date_time" value="<?=$task?$task->date_time:''?>">
    </div>
    <div class="container left">
        <label for="" class="center">Concluida:</label>
        <input type="checkbox" 
            <?php if($completed):?> checked <?php endif?>
        name="completed" value="1"/>
    </div>
    <div class="container left list">
        <label for="">Prioridade:</label>
        <div class="container center left">
        <input type="radio" name="priority" checked <?php if(($task?$task->prioridade=='1':false)):?> checked <?php endif?>
            value="1" > Baixa
        </div >
        <div class="container center left">
            <input type="radio" name="priority" <?php if(($task?$task->prioridade=='2':false)):?> checked <?php endif?>
                value="2" > Media
        </div>
        <div class="container center left">
            <input type="radio" name="priority" <?php if(($task?$task->prioridade=='3':false)):?> checked <?php endif?>
                value="3" > Alta
        </div>        
    </div>
    </div>
    <?php if(!is_null($id)):?>
        <a href="/" class="button remove"> Cancelar </a>
    <?php endif?>
    <button class="button <?= $action?>"type="submit"><?=$buttonSubmit?></button>
    
</form>