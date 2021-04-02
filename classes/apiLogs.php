<?php
class ApiLogs{

    // Connection instance
    private $connection;

    // table name
    private $table_name = "api_logs";

    // table columns
    public $id_api_log;
    public $request;
    public $token;
    public $called_at;
   

    public function __construct($connection){
        $this->connection = $connection;
    }
    //C
    public function create($req, $token, $called_at){
        $query = "INSERT INTO " . $this->table_name . " (request, token, called_at) VALUES ('".$req."', '".$token."', '".$called_at."')";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return true;
    }
    //R
    public function read(){

    }
    public function readRow($req){
        $query = "SELECT  called_at,token FROM " . $this->table_name . " p where request = '".$req."' ORDER BY p.id_api_log DESC limit 1";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
       
        
        
    }
    public function readCountsByToken($token){
        $count = 0;
        $query = "SELECT  count(*) as nums FROM " . $this->table_name . " p where token = '".$token."' ORDER BY p.id_api_log DESC limit 1";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch();
        if(!empty($result)){
            $count = $result['nums'];
        }
        return $count;
        
    }
    //U
    public function update(){}
    //D
    public function delete(){}    
}