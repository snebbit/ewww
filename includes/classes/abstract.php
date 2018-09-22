<?php
class Ewww{
    
    public $db;

    public function __construct(){
        $this->db = new mysqli(_db_host, _db_user, _db_pass, _db_db);
    }
    
    function query($qstring){
        if(!$this->db) SELF::__construct();
        $result=$this->db->query($qstring) or die(mysqli_error($this->db));
        return $result;
    }
    
}
?>