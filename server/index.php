<?php
include_once "config.php";
include_once "functions.php";
	header('Content-type: application/json');


if(isset($_GET['getlist']))
{
        $tablename = $_GET['getlist'];
        $sql = "select * from ".$tablename;
        if(isset($_GET['order']))
            $sql .= " order by ".$_GET['order'];
        if(isset($_GET['ordertype']))
            $sql.= " ".$_GET['ordertype'];
        if(isset($_GET['limit'])){
            $arr = explode(',', $_GET["limit"]);
            $sql .= " limit ".$arr[0].",".$arr[1];
        }
        $list = select_list($dbo,$sql);
        if($list != 2){
                $result = array("status" => "success","result" => $list);
        }else
            $result = array("status" => "error","result" => "Something wrong!Unable to get list");
    echo json_encode($result);
	
}


elseif(isset($_GET['category']))
{
		$sql = "select * from post where cat_id = ".$_GET['category'];
		if(isset($_GET['order']))
			$sql .= " order by ".$_GET['order'];
		if(isset($_GET['ordertype']))
			$sql.= " ".$_GET['ordertype'];
		if(isset($_GET['limit'])){
			$arr = explode(',', $_GET["limit"]);
			$sql .= " limit ".$arr[0].",".$arr[1];
		}
		$sql1 = 'select * from category where cat_id ='.$_GET['category'];
		$catinfo = select_info($dbo,$sql1);
		$info = select_list($dbo,$sql);
		$result = array("status" => "success","result" => $info,"catinfo" => $catinfo);
	    echo json_encode($result);
	
}


elseif(isset($_GET['tag']))
{
		$sql = "SELECT * FROM `post` join posttags on posttags.post_id = post.post_id JOIN tags on tags.tag_id = posttags.tag_id WHERE word like '%".$_GET['tag']."%'";
		$sql .= " group by post.post_id";
		if(isset($_GET['order']))
			$sql .= " order by ".$_GET['order'];
		if(isset($_GET['ordertype']))
			$sql.= " ".$_GET['ordertype'];
		if(isset($_GET['limit'])){
			$arr = explode(',', $_GET["limit"]);
			$sql .= " limit ".$arr[0].",".$arr[1];
		}

		$info = select_list($dbo,$sql);
		$result = array("status" => "success","result" => $info);
	echo json_encode($result);
}


elseif(isset($_GET['post']))
{
		$sql = "select * from post join category on category.cat_id = post.cat_id where post_id = ".$_GET['post'];
		$info = select_info($dbo,$sql);
		$result = array("status" => "success","result" => $info);
	echo json_encode($result);
}

elseif(isset($_GET['update']))
{
    $sql = "";
}

elseif(isset($_GET['feature']))
{
		$sql = "select * from post where feature = '0'";
		if(isset($_GET['order']))
			$sql .= " order by ".$_GET['order'];
		if(isset($_GET['ordertype']))
			$sql.= " ".$_GET['ordertype'];
		if(isset($_GET['limit'])){
			$arr = explode(',', $_GET["limit"]);
			$sql .= " limit ".$arr[0].",".$arr[1];
		}
		$info = select_list($dbo,$sql);
		$result = array("status" => "success","result" => $info);
	echo json_encode($result);
}


elseif(isset($_GET['cmt']))
{
		$sql = "select * from comment";
			if(isset($_GET['postid']))
				$sql .= " where post_id =".$_GET['postid'];
			if(isset($_GET['cmtdate']))
				$sql .= " order by created ".$_GET['cmtdate'];
			if(isset($_GET['cmtlimit']))
				$sql .= " limit 0,".$_GET['cmtlimit'];
			$cmt = select_list($dbo,$sql);
		$result = array("status" => "success","result" => $cmt);
		echo json_encode($result);
}


elseif(isset($_POST['username']) AND isset($_POST['idpost']) AND isset($_POST['email']) AND isset($_POST['content']))
{
	$info = array(
		"post_id" => $_POST['idpost'],
		"user_name" => $_POST['username'],
		"user_email" => $_POST['email'],
		"content" => $_POST['content']
		);
	insertdb($dbo,"comment",$info);
	$result = array("status" => "success","result" => "Thành công");
	echo json_encode($result);
}

else
{
	echo "Server is working normal";
}	

 ?>