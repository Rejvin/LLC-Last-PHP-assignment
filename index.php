<?php

class DB {
	private $conn;
	private $table; 
	private $where; 
	private $select; 
		
	function __construct($host,$user,$pass,$db)
	{
		if (!empty($db)) {
			$this->conn = mysqli_connect($host,$user,$pass,$db);
		}else{
			die('Query Problem' . mysqli_error($conn));
		}
	}

	function table($Tname){
		$this->table = " ".$Tname." ";
		return $this;
	}

	function select($selectwhere = array()){
		$where = implode(", ", $selectwhere);
		$sql = " SELECT ";
		$this->select = $sql." ".$where." FROM ";
		return $this;
	}
	
	function where($whr,$opr,$val){
		$where = $whr." ".$opr." ".$val;
		$sql = " WHERE ";
		$this->where = $sql." ".$where;
		return $this;
	}

	function get(){
		$sql = $this->select.$this->table.$this->where;		
		$result = mysqli_query($this->conn,$sql);
		if($result){
			return  $result;
		}else{
			return false;
		}		
	}
}

$db = new DB("localhost","root","","llc-php");  
$user = $db->where('id','=','3')->select(['*'])->table('users')->get();

while($userInfo = mysqli_fetch_assoc($user)){
	echo $userInfo['name']."<br>";
	echo $userInfo['email']."<br>";
}
 
