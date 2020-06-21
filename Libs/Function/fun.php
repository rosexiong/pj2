<?php 
/**操作成功提示**/
function ok_info($url,$langinfo){
	if(empty($url)){
		echo("<script type='text/javascript'> alert('$langinfo');history.go(-1);</script>");		
	}else{
		echo("<script type='text/javascript'> alert('$langinfo'); window.location.href='$url'; 
		</script>");  
	}
	exit;
}

function xy_rep($str){ 
return str_replace(array('#', '@', '\'','or'),'', $str);
}

function str_cut($string, $length, $dot = '...',$charset) {
	$strlen = strlen($string);
	if($strlen <= $length) return $string;
	$string = str_replace(array(' ','&nbsp;', '&amp;', '&quot;', '&#039;', '&ldquo;', '&rdquo;', '&mdash;', '&lt;', '&gt;', '&middot;', '&hellip;'), array('∵',' ', '&', '"', "'", '“', '”', '—', '<', '>', '·', '…'), $string);
	$strcut = '';
	if(strtolower($charset) == 'utf-8') {
		$length = intval($length-strlen($dot)-$length/3);
		$n = $tn = $noc = 0;
		while($n < strlen($string)) {
			$t = ord($string[$n]);
			if($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
				$tn = 1; $n++; $noc++;
			} elseif(194 <= $t && $t <= 223) {
				$tn = 2; $n += 2; $noc += 2;
			} elseif(224 <= $t && $t <= 239) {
				$tn = 3; $n += 3; $noc += 2;
			} elseif(240 <= $t && $t <= 247) {
				$tn = 4; $n += 4; $noc += 2;
			} elseif(248 <= $t && $t <= 251) {
				$tn = 5; $n += 5; $noc += 2;
			} elseif($t == 252 || $t == 253) {
				$tn = 6; $n += 6; $noc += 2;
			} else {
				$n++;
			}
			if($noc >= $length) {
				break;
			}
		}
		if($noc > $length) {
			$n -= $tn;
		}
		$strcut = substr($string, 0, $n);
		$strcut = str_replace(array('∵', '&', '"', "'", '“', '”', '—', '<', '>', '·', '…'), array(' ', '&amp;', '&quot;', '&#039;', '&ldquo;', '&rdquo;', '&mdash;', '&lt;', '&gt;', '&middot;', '&hellip;'), $strcut);
	} else {
		$dotlen = strlen($dot);
		$maxi = $length - $dotlen - 1;
		$current_str = '';
		$search_arr = array('&',' ', '"', "'", '“', '”', '—', '<', '>', '·', '…','∵');
		$replace_arr = array('&amp;','&nbsp;', '&quot;', '&#039;', '&ldquo;', '&rdquo;', '&mdash;', '&lt;', '&gt;', '&middot;', '&hellip;',' ');
		$search_flip = array_flip($search_arr);
		for ($i = 0; $i < $maxi; $i++) {
			$current_str = ord($string[$i]) > 127 ? $string[$i].$string[++$i] : $string[$i];
			if (in_array($current_str, $search_arr)) {
				$key = $search_flip[$current_str];
				$current_str = str_replace($search_arr[$key], $replace_arr[$key], $current_str);
			}
			$strcut .= $current_str;
		}
	}
	return $strcut.$dot;
}

function injCheck($sql_str) { 
	$check = preg_match('/select|insert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile/', $sql_str);
	if ($check) {
		ok_info('/index.php','非法字符');
		exit;
	} else {
		return $sql_str;
	}
}

//获得主题
function getZhuti(){
	 return array('Scenery','City','People','Animal','Building','Wonder','Other');
}
function getgj(){
	global $db;
	$data = array();
	$sql="select * from gjs where 1=1";
	
		$result=$db->get_all($sql,MYSQL_ASSOC);
	
		if(!empty($result)){
				foreach($result as $k=>$v){
					$data[$v['id']]=$v['name'];
				}
		}
		return $data;
}
function getcs(){
	global $db;
	$data = array();
	$sql="select * from css where 1=1";
	
		$result=$db->get_all($sql,MYSQL_ASSOC);
	
		if(!empty($result)){
				foreach($result as $k=>$v){
					$data[$v['id']]=$v['name'];
				}
		}
		return $data;
}
function checkLogin(){
	if(!isset($_SESSION['loginuser']['id'])||empty($_SESSION['loginuser']['id'])){
		echo("<script type='text/javascript'> alert('请登录再操作');window.location.href='./index.php';</script>");	
	}
}
?>