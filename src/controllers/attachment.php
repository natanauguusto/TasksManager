<?php 

use Natan\ManagerTasks\database\ORM;
use Natan\ManagerTasks\models\Attachment;
    $taskId=$_POST["task_id"];
    $upload=false;
    
    if(isset($_FILES["attachment"])){
        $filename = $_FILES['attachment']['name'];
        $extension = explode(".",$filename);        
        $extension = $extension[count($extension)-1];                
        $attachment=(new Attachment())->setAttachment($filename,$extension,$taskId);
        print_r($_FILES['attachment']);
        $upload=uploadFile('attachment');
        
        if($upload ){
            
            if((new ORM())->save($attachment))
                header('Location:'.HOST.'/task/task_id?='.$taskId);
        }
    }    
    
?>
<div class="container center list">
    <span class="msg error">
        Erro ao Salvar Anexo!.Verifique se já existe.
    <span>
    <a href="task?task_id=<?=$taskId?>" class='button remove'>Back</a>
</div>
