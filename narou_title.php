<?php
$orders = array("hyoka", "hyokaasc");
foreach ($orders as $order){
	$label = $order == "hyoka" ? '__label__1, ' : '__label__0, ';
	$URL='http://api.syosetu.com/novelapi/api/?order=' . $order . '&length=10000-&out=json&of=t&lim=100';
	$genres =  array(201,202);
	foreach($genres as $genre) {
		for ($i = 1; $i < 2001; $i = $i + 100) {
			$api = $URL.'&'.'genre='.$genre.'&'.'st='.$i;
			$file = file_get_contents($api);
			$listarray=json_decode($file,true);
			foreach ($listarray as $k => $v) {
				if($k==0){continue;}
				$search = array('(',')', "'", '"', ";");
				$v['title'] = str_replace($search,'',$v['title']);
				$v['title'] = str_replace('&','and',$v['title']);
				$title = null;
				$title = shell_exec("echo " . $v['title'] . "| mecab -Owakati");
				//var_dump($v['title']);
				if(empty($title)){
					continue;
				}
				$text = $label.$title;
				file_put_contents('tensei.txt', $text, FILE_APPEND);
			}
		}
	}
}
