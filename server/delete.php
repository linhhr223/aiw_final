<?php
require_once "config.php";

$sql = 'DELETE FROM post WHERE post_id = '.$_GET["delete"];

$dbo->exec($sql);

header("location:/client/index.php");