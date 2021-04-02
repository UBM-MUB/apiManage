<?php
/**
 * Class Configuration.
 */
class Configuration{

    // Connection instance
    private $connection;

    // table name
    private $table_name = "configuration";

    // table columns
    public $id_configuration;
    public $name;
    public $value;

    //duration is in seconds
    const DURATION =1;
    const LIMIT = 2;

   

    public function __construct($connection){
        $this->connection = $connection;
    }
    
    public function readRow($id){
        $query = "SELECT  * FROM " . $this->table_name . " p where id_configuration = ".$id."";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
       
        
        
    }
    public function duration(){
        $result = self::readRow(self::DURATION);
        if(!empty($result)){
            return $result['value'];
        }else{
            return 60; 
        }
        
    }
    public function requestLimit(){
        $result = self::readRow(self::LIMIT);
        if(!empty($result)){
            return $result['value'];
        }else{
            return 10; 
        }
        
    }
    public function request($email, $id_place){
        $query = "INSERT INTO register (`email`, `id_place`,`status`) VALUES ('".$email."', '".$id_place."', 0)";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return true;
    }
    public function resetConfigurations($duration,$limit){
        $result1 = self::update($duration,self::DURATION);
        $result2 = self::update($limit,self::LIMIT);
        return true;
       
        
        
    }
    //U
    public function update($val,$id){
        $query = "UPDATE " . $this->table_name . " SET value='".$val."' WHERE id_configuration=".$id."";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return true;
    }
    //D
    public function delete(){}    
}