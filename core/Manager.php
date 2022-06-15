<?php
namespace Core;

use PDO;
use PDOException;

class Manager {

    private static $pdo;

    /**
     * Get the value of pdo
     */ 
    public function getPdo()
    {
        if(self::$pdo == null)
        try
        {
            self::$pdo = new PDO('mysql:host=localhost;dbname=','user','pass', [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
    
        }
        catch(PDOException $pe)
        {
            die("Error : " . $pe->getMessage());
        }
        return self::$pdo;
    }


    public function getAll($table)
    {

        // Récupérer la class à partir du manager
         $classManager = get_class($this);
         $class = "\\App\\Entity\\".str_replace(["Manager","App","\\"],["","",""],$classManager);
         
         $sql = "SELECT * FROM ".$table;
         
         $req = self::getPdo()->prepare($sql);
         $req->execute();
         
         $results = $req->fetchAll(PDO::FETCH_ASSOC);
         
         foreach ($results as $result) {
             $obj = new $class();
             $obj->hydrate($result);
            
                
            $array[] = $obj;
            
        }
        return $array;
    }


    public function getById($id)
    {

        // Récupérer la class à partir du manager
         $classManager = get_class($this);
         $table = str_replace(["Manager","App","\\"],["","",""],$classManager);
         $class = "\\App\\Entity\\".str_replace(["Manager","App","\\"],["","",""],$classManager);
         

         $sql = "SELECT * FROM " .$table. " WHERE id = ".$id;
       
        $req = self::getPdo()->prepare($sql);
        $req->execute();

        $result = $req->fetch(PDO::FETCH_ASSOC);
       
        $obj = new $class();
        $obj->hydrate($result);
            
        return $obj;
    }

    public function insert($data)
    {

        $table = get_class($this);
        $table = str_replace(["Manager","App","\\"],["","",""],$table);
        
      
        $sql = "INSERT INTO ".$table . ' (' ;

        foreach ($data as $key => $value) {
            $sql .= $key.",";
        }

        $sql = substr($sql, 0, -1);
        $sql .= ",created_at) VALUES (";

        foreach ($data as $key => $value) {
            $sql .= ':'.$key.",";
        }

        $sql = substr($sql, 0, -1);
        $sql .= ",NOW())";


        $query = $this->getPdo()->prepare($sql);
        $stmt = $query->execute($data);
     
        return $stmt;

    }

    public function update($id ,$data)
    {

        $table = get_class($this);
        $table = str_replace(["Manager","App","\\"],["","",""],$table);
     
    
        $sql = "UPDATE ".$table . ' SET ' ;

        foreach ($data as $key => $value) {
            $sql .= $key." = :".$key." , ";
        }
        $sql = substr($sql, 0, -2);
        $sql .= "WHERE id = ".$id;

        $query = $this->getPdo()->prepare($sql);
        $stmt = $query->execute($data);
        
        return $stmt;

    }

    public function delete($id)
    {
        $table = get_class($this);
        $table = str_replace(["Manager","App","\\"],["","",""],$table);
        
        
        $sql = "DELETE FROM ".$table. " WHERE id = ".$id;

        $query = $this->getPdo()->prepare($sql);
        $stmt = $query->execute();
        
        return $stmt;
    }
}