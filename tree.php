<?php
$area=array(
	array('id'=>1,'name'=>'河南省','pid'=>0),
	array('id'=>2,'name'=>'山东省','pid'=>0),
	array('id'=>3,'name'=>'广东省','pid'=>0),
	array('id'=>4,'name'=>'郑州市','pid'=>1),
	array('id'=>5,'name'=>'青岛市','pid'=>2),
	array('id'=>6,'name'=>'广州市','pid'=>3),
        array('id'=>7,'name'=>'二七区','pid'=>4),
	array('id'=>8,'name'=>'李沧区','pid'=>5),
	array('id'=>9,'name'=>'白云区','pid'=>6),
	array('id'=>10,'name'=>'佛山市','pid'=>3),
	array('id'=>'11','name'=>'顺德区','pid'=>10),
	array('id'=>'12','name'=>'杏坛镇','pid'=>11),
	array('id'=>'13','name'=>'罗水村','pid'=>12),
);


echo "<table border=1>";
foreach($area as $v){
	echo "<tr><td>{$v['id']}</td><td>{$v['name']}</td><td>{$v['pid']}</td></tr>";
}
echo "</table>";


//传递一个子节点id和数据表，找到祖辈节点 ---面包屑导航
function getAncestor($arr,$id){
	static $tree=array();
	foreach($arr as $k=>$v){
		if($v['id']==$id){
			$tree[]=$v;	
			getAncestor($arr,$v['pid']);	
		}
	}
	return $tree;
}

//传递一个数据表，找到子孙并归类出曾级关系
function getSon($arr,$pid=0,$level=0){
	static $tree=array();
	foreach($arr as $k=>$v){
		if($v['pid']==$pid){
			$v['level']=$level;
			$tree[]=$v;
			getSon($arr,$v['id'],$level+1);
			
		}
	}
	return $tree;
}
//echo "<pre>";
//print_r( getAncestor($area,7) );



//echo "<pre>";
//print_r( getSon($area) );
$res=getSon($area);
foreach($res as $v){
	echo str_repeat("---",$v['level'])."{$v['id']}-{$v['name']}"."<br>";
}

?>