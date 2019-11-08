<?php
    date_default_timezone_set('Asia/Ho_Chi_Minh');
      $today = date('Y-m-d H:i:s');
      $datetoday = date('Y-m-d');
      $timenow = date('H:i:s');

function query($db,$sql){
  $smile = $db->prepare($sql);
  $result = $smile->execute();
  return ($result) ? true : false;
}


function select_list($db,$sql){
	try{
	    json_encode($db);
  $smile = $db->prepare($sql);
  $smile->execute();
  } catch (PDOException $e) {
    return 2;
}
  $result = $smile->fetchAll();
  return $result;	
}

function select_info($db,$sql){
  $smile = $db->prepare($sql);
  $smile->execute();
  $result = $smile->fetch();
  return $result;	
}


function getlist($db,$tbname){
	try {
	$sql = 'select * from '.$tbname;
	$smile = $db->prepare($sql);
	$smile->execute();
	} catch (PDOException $e) {
    return 2;
}
	$result = $smile->fetchAll();	
return $result;
}


function getlist_where($db,$tbname,$rules){
	$sql = 'select * from '.$tbname.' where ';
	foreach($rules as $key => $val){
		$sql .= $key." = '".$val."' AND";
	}
	$sql .= " 0=0";
	$smile = $db->prepare($sql);
	$smile->execute();
	$result = $smile->fetchAll();	
return $result;
}


function lastinsertid($db){
	return $db->lastInsertId();
}

function get_total($db,$tbname){
	$sql = 'select * from '.$tbname;
	$smile = $db->prepare($sql);
	$smile->execute();
	$result = $smile->rowCount();	
return $result;	
}


function get_total_where($db,$tbname,$rules){
	$sql = 'select * from '.$tbname.' where ';
	foreach($rules as $key => $val){
		$sql .= $key." = '".$val."' AND ";
	}
	$sql .= " 0=0";
	$smile = $db->prepare($sql);
	$smile->execute();
	$result = $smile->rowCount();	
return $result;	
}

function get_info($db,$tbname,$rules){
	$sql = 'select * from '.$tbname.' where ';
	foreach($rules as $key => $val){
		$sql .= $key." = '".$val."' AND";
	}
	$sql .= " 0=0";
	$smile = $db->prepare($sql);
	$smile->execute();
	$result = $smile->fetch();	
  return $result;
}


function insertdb($db,$dbname,$data){
      date_default_timezone_set('Asia/Ho_Chi_Minh');
      $today = date('Y-m-d H:i:s');
       $datetoday = date('Y-m-d');
       $timenow = date('H:i:s');
 $sql = 'insert into '.$dbname.'(';
  foreach($data as $key => $val){
    $sql .= $key.",";
  }//end foreach;
	$sql = rtrim($sql,",");
  $sql .= ")";
  
  $sql .= "VALUES(";
  foreach($data as $key => $val){
    $sql .= "'".$val."',";
  }//end foreach;  
  $sql = rtrim($sql,",");
  $sql .= ')';
  $smile = $db->prepare($sql);
  $result = $smile->execute();
  return ($result) ? true : false;
} //end insert function;


function updatedb($db,$tbname,$data,$id){
	$sql = 'UPDATE '.$tbname.' SET ';
	foreach($data['data'] as $key => $val){
		$sql .= $key.' = "'.$val.'",';
	}
	rtrim($sql,",");
	$sql .= ' WHERE id = '.$id;
	foreach($data['where'] as $key => $val){
		$sql .= 'AND '.$key.' = '.$val;
	}

  $smile = $db->prepare($sql);
  $result = $smile->execute();
  return ($result) ? true : false;

}


function deletedb($db,$tbname,$data){
	$sql = 'DELETE from '.$tbname.' WHERE ';
	$sql .= ' WHERE 0 = 0';
	foreach($data as $key => $val){
		$sql .= 'AND '.$key.' = '.$val;
	}
	  $smile = $db->prepare($sql);
  $result = $smile->execute();
  return ($result) ? true : false;	
}


 ?>