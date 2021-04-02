<?php
class Places{

    // Connection instance
    private $connection;

    // table name
    private $table_name = "places";

    // table columns
    public $id_place;
    public $name;
    public $description;
    public $package;
   

    public function __construct($connection){
        $this->connection = $connection;
    }
    //C
    public function create($name, $description){
        $query = "INSERT INTO " . $this->table_name . " (name, description) VALUES ('".$name."', '".$description."')";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return true;
    }
    //R
    public function read(){
        $query = "SELECT  * FROM " . $this->table_name . " p ORDER BY p.id_place DESC";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
       
    }
    public function readRow($id){
        $query = "SELECT  * FROM " . $this->table_name . " p where id_place = ".$id."";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
       
        
        
    }
    public function request($email, $id_place){
        $query = "INSERT INTO register (`email`, `id_place`,`status`) VALUES ('".$email."', '".$id_place."', 0)";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return true;
    }
    //U
    public function update(){}
    //D
    public function delete(){}    
}