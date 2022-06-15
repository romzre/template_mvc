<?php
namespace Core;

Class Entity{


    public function hydrate(array $data)
    {
    
         // Récupérer la class à partir du manager
         $classManager = get_class($this);
        //  $class = "\\App\\Entity\\".str_replace(["Manager","App","\\"],["","",""],$classManager);
 
        

        foreach ($data as $key => $value) {
        
            $method = 'set';
            $key=explode('_',$key);

            foreach ($key as $k => $val) {

                $method .= ucfirst($val);
            }

            if(method_exists($classManager, $method) && $value !=NULL)
            {
                    $this->$method($value);
            }
            
        }
        
        

        
     
       
    }
}

