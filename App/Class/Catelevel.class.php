<?php
//无限极分类
Class Catelevel{

	//一维数组
	Static Public function unlimitedForLevel ($cate,$html = '__',$pid = 0,$level = 0){
		$arr = array();
		foreach ($cate as $v) {
			if($v['pid'] == $pid){
				$v['level'] =$level + 1;
				$v['html'] = str_repeat($html, $level);
				$arr[] = $v;
				$arr = array_merge($arr, self::unlimitedForLevel($cate,$html,$v['id'],$level + 1));

			}
		}
		return $arr;
	}
}