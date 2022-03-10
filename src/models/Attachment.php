<?php 
namespace Natan\ManagerTasks\models;
class Attachment{
    private int $id;
    private string $task_id;
    private string $nome;
    private string $file_ext;

    public function setAttachment($nome,$file_ext,$task_id){
        
        $this->setNome($nome);
        $this->setFile_ext($file_ext);
        $this->setTask_id($task_id);    
        
        return $this;
    }
    

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of task_id
     */ 
    public function getTask_id()
    {
        return $this->task_id;
    }

    /**
     * Get the value of nome
     */ 
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Get the value of file_ext
     */ 
    public function getFile_ext()
    {
        return $this->file_ext;
    }

    /**
     * Set the value of task_id
     *
     * @return  self
     */ 
    public function setTask_id($task_id)
    {
        $this->task_id = $task_id;

        return $this;
    }

    /**
     * Set the value of task_id
     *
     * @return  self
     */ 

    /**
     * Set the value of nome
     *
     * @return  self
     */ 
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Set the value of file_ext
     *
     * @return  self
     */ 
    public function setFile_ext($file_ext)
    {
        $this->file_ext = $file_ext;

        return $this;
    }
}
?>