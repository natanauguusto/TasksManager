<?php 
    
    function treatPriority(int $priority):string{
        switch($priority){
            case 1:return "Baixa";
            case 2:return "Media";
            case 3:return "Alta";
        }
        return "";
    }
    function treatCompleted(string $completed):bool{
        return $completed=="1";
    }
    function treatDate(){
        
    }
    function treatTask($task){
        if (is_object($task))
            return $task;
        return false;
    }

    function uploadFile($userfile){
        try{
            // if(is_uploaded_file($userfile)){
                $pathFile=DESTINATION.$_FILES[$userfile]['name'];
                echo $pathFile;
                return move_uploaded_file($_FILES[$userfile]['tmp_name'],$pathFile);
                
            // }
            return false;
        }catch(Exception $e){
            require "error.php";
            return false;
        }
        return false;
    }
        
    
    function downloadFile($file){
        return DESTINATION.$file;
    }
?>