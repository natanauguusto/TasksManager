<?php if(is_null($_GET['id'])):?>
    <table class="container list center">
        <tbody class="border">
        <tr >
            <th>Tarefa</th>
            <th>Descrição</th>
            <th>Prazo</th>
            <th>Prioridade</th>
            <th>Concluida</th>
            <th>Opções</th>
        </tr>
        <!-- </thead> -->
        <!-- <tbody> -->
        <?php foreach($tasks as $task):?>
        <tr >
            <td>
                <a class="a"href="task?task_id=<?=$task->id?>"><?= $task->nome?></a>
            </td>
            <td><?= $task->descricao?></td>
            <td><?= $task->date_time?></td>
            <td><?= treatPriority($task->prioridade)?></td>
            <td class="container">
                <?php $checked = treatCompleted($task->completed)?"checked":"";?>
                <div class="border completed <?= $checked?>"></div>
            </td>
            <td>
                <a href="edit?id=<?=$task->id?>" class=" a edit">Editar</a>
                <a href="remove?id=<?=$task->id?>" class=" a remove">Excluir</a>
            </td>
        </tr>
        <?php endforeach?>
        </tbody> 
    </table>
<?php endif?>