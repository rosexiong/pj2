<?php
require 'Conf/blog.inc.php';
require BLOGPATH.'Libs/Class/page.class.php';
require BLOGPATH.'Libs/Function/fun.php';

$gj_id = $_GET["gj_id"]; 

if($gj_id!=0){
	$where= "gjs_id='{$gj_id}'";
}else{
	$where= "1=1";
}
$sql="SELECT * FROM `css` WHERE {$where}";

$gzs = $db->get_all($sql,MYSQLI_ASSOC);


foreach($gzs  as $k=>$v){ 
    $select[] = array("id"=>$v['id'],"name"=>$v['name']); 
} 

echo json_encode($select); 
?>