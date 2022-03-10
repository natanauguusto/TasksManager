<?php
namespace Natan\ManagerTasks\models;
use \DateTime;
class Task{
    private int $id;
    private string $nome;
    private string $descricao;
    private string $completed;
    private int $prioridade;
    private string $date_time;
    
    public function setTask(string $nome,string $descricao="",bool $completed=false,int $prioridade=1,string $date_time=""){
        $date_time= $date_time==''?(new DateTime('NOW'))->format("Y-m-d"):$date_time;
        
        $this->setNome($nome);
        $this->setDescricao($descricao);
        $this->setCompleted($completed==true?'1':'0');
        $this->setPrioridade($prioridade);
        $this->setDate_Time($date_time);
        return $this;
    }
    
    public function getTask(){
        return "{$this->nome},'{$this->descricao}',{$this->prioridade},{$this->date_time}";
    }
    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of descricao
     */ 
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set the value of descricao
     *
     * @return  self
     */ 
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get the value of completed
     */ 
    public function getCompleted()
    {
        return $this->completed;
    }

    /**
     * Set the value of completed
     *
     * @return  self
     */ 
    public function setCompleted($completed)
    {
        $this->completed = $completed;

        return $this;
    }

    /**
     * Get the value of prioridade
     */ 
    public function getPrioridade()
    {
        switch($this->prioridade){
            case 1:return "Baixa";
            case 2:return "Media";
            case 3:return "Alta";
        }
        return "";
    }

    /**
     * Set the value of prioridade
     *
     * @return  self
     */ 
    public function setPrioridade($prioridade)
    {
        $this->prioridade = $prioridade;

        return $this;
    }

    /**
     * Get the value of date_time
     */ 
    public function getDate_time()
    {
        return $this->date_time;
    }

    /**
     * Set the value of date_time
     *
     * @return  self
     */ 
    public function setDate_time($date_time)
    {
        $this->date_time = $date_time;
        return $this;
    }
}
?>