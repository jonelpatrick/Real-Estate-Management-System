<?php

     class database
    {

        function __construct($pdo){
            $this->pdo = $pdo;
        }

        function select($sql){

            $query = $this->pdo->prepare($sql);
            $status=$query->execute();

            if (isset($status)) {
              $results=$query->fetchAll(PDO::FETCH_ASSOC);
              return !empty($results) ? $results : NULL;
            } else {
              echo "\nPDO::errorInfo():\n"; 
              print_r($query->errorInfo()); 
            }
             
        }                
    } 
?>