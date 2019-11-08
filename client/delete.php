<?php
require_once "database.php";

$sql = 'DELETE FROM post WHERE post_id = '.$_GET["delete"];

$dbo->exec($sql);

header("location:index.php");