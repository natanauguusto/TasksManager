<?php
namespace Natan\ManagerTasks\controllers;

use Natan\ManagerTasks\models\Task;
use Natan\ManagerTasks\database\ORM;
use Natan\ManagerTasks\models\Attachment;

class Web 
{
    private Task $task ;
    private Attachment $attachment;
    private ORM $orm;

    public function __construct(){
        $this->task=new Task();
        $this->attachment=new Attachment();
        $this->orm=new ORM();        
    }
    public function add(array $data){
        if(!empty($data['name'])){
            try{                
                $task=(new Task())->setTask($data['name'],$data['description'],!isset($data['completed'])?false:$data['completed'],$data['priority'],$data['date_time']);        
                if(!$this->orm->save($task)){
                    echo "<span class='msg error'>Erro ao Adicionar Tarefa de ID {$taskId}></span>";    
                }else{
                    header("Location:".HOST);
                }
                return true;
            }catch (\Exception $e){
                require "error.php";
                die();
            }
            catch (\PDOException $e){
                require "error.php";
                die();
            }        
        }        
        header("Location:".HOST);
    }

    public function edit(array $data):bool{
        
        try{        
            $taskId = $data['id'];
            //var_dump($data);
            $this->task->setTask($data['name'],$data['description'],!isset($data['completed'])?false:$data['completed'],$data['priority'],$data['date_time']);
            if(!$this->orm->edit($this->task,$taskId)){
                echo "<span class='msg error'>Erro ao Editar Tarefa de ID {$taskId}></span>";
                die();  
            }else{
                header("Location:".HOST);
            }
            return true;
            
        }catch (\Exception $e){
            require "error.php";
            die();
        }
        catch (\PDOException $e){
            require "error.php";
            die();
        }
        return false;
    }

    public function remove(array $data):bool{
        try{

            $taskId = $data['id'];
            $attachments=$this->orm->listAll("attachments","task_id=".$taskId);
            
            if($attachments){
                foreach($attachments as $attachment){
                    $this->orm->remove("attachments",$attachment->id);
                    removeFile($attachment->nome);
                }
            }
                
            if(!$this->orm->remove("tasks",$taskId)){
                echo "<span class='msg error'>Erro ao Remover Tarefa de ID {$taskId}></span>";
            }
            header("Location:".HOST);      
            return true;  
        }catch (\Exception $e){
            require "error.php";
            die();
        }
        catch (\PDOException $e){
            require "error.php";
            die();
        }
        return false;
        
    }

    public function tasks(?array $data):bool{        
        
        $tasks = $this->orm->listAll("tasks");
        
        $task=false; 
        $id=$data['id'];
        $action="add";
        $buttonSubmit="Cadastrar";
        //echo $id;
        if (!is_null($id)){
            $task=$this->orm->search("tasks",$id);
            $completed=treatCompleted($task->completed);       
            $action = "edit";
            $buttonSubmit="Editar";
        }  
        $actionPage ="{$action}";
        
        require __DIR__."/../../src/view/pages/tasks.php";
    }

    public function task(array $data):bool{
        try{
        if(!isset($data["task_id"]))
            header("Location".HOST);
        $taskId=$data["task_id"];    
        $condition="task_id=".$taskId;
        ///echo "CONDIÇÂO ".$condition;
        $attachments = $this->orm->listAll("attachments",$condition);
        ///echo "CONDIÇÂO ".$condition;
        $task = $this->orm->search("tasks",$taskId);
        $checked=treatCompleted($task->completed);
        
        require __DIR__."/../view/pages/task.php";
        if(count($attachments)>0)
            require __DIR__."/../view/templates/attachments.php";
        else
            echo "<h2>Nenhum Anexo</h2>";
        }catch (\Exception $e){
            require "error.php";
            die();
        }
        catch (\PDOException $e){
            require "error.php";
            die();
        }
        return false;
        
    }

    public function attachment(?array $data,?array $files){
        $taskId=$data["task_id"];
        $upload=false;
        try
        {    
            if(isset($files["attachment"])){
                $filename = $files['attachment']['name'];
                $extension = explode(".",$filename);        
                $extension = $extension[count($extension)-1];                
                $attach=($this->attachment)->setAttachment($filename,$extension,$taskId);
                $exists=count($this->orm->listAll("attachments"," nome='{$filename}'"))>0;
                $upload=uploadFile('attachment');
                
                if($upload & !$exists){                                  
                    if(($this->orm)->save($attach))
                        header('Location:'.HOST.'/task/task_id?='.$taskId);
                    else{
                        $e = new Exception("Não foi possivel salvar arquivo");
                        require "error.php";
                    }
                }else{
                    echo "<div class='container center list'>
                                <span class='container list msg error'>
                                    Erro ao Salvar Anexo!.
                                    - Pasta attachments está na raiz?
                                    - Arquivo ja existe?
                                <span>
                                <a href='task?task_id={$taskId}' class='button remove'>Back</a>
                        </div>";
                }
            }    
        }catch (\Exception $e){
            require "error.php";
            die();
        }
        catch (\PDOException $e){
            require "error.php";
            die();
        }
        return false;
    }
    
}