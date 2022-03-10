
<div class="container list task border"> 

    <h1>About Task</h1>    
    <div class="container center">
        <h2>Nome:</h2>
        <p><?= $task->nome?></p>        
    </div>
    
    <div class="container center list">
    
        <h2>Descrição:</h2>
        <p><?= $task->descricao?></p>        
    </div>
    <div class="container center">
        <h2>Concluida:</h2> 
        <div class="border completed <?= $checked?>"></div>
    </div>
    <div class="container center">
        <h2>Prioridade:</h2>
        <p><?= treatPriority($task->prioridade)?></p>        
    </div>
    <div class="container center">
        <h2>Prazo: </h2>
        <p><?=$task->date_time?></p>
    </div>

    <a href="/" class="button edit">Back Tasks</a>
</div>
<div class="attachment border center">
    <form class = "container center list"action="/attachment" enctype="multipart/form-data" method="post">
        <input type="hidden" name="task_id" value="<?=$taskId?>">
        <input class="border" type="file" name="attachment" />
        <button class="button" type="submit">Enviar</button>
    </form>
</div>
