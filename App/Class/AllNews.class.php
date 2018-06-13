<?php
Class AllNews{
	//获取所有子类目的文章
	Static Public function GetSonAllNews($id){
		$AllCate = M('cate')->where(array('pid'=>$id))->select();
		$news = M('news')->where(array('cid'=>$id,'del'=>0))->order('uptime DESC')->select();
		if ($AllCate) {
			foreach ($AllCate as $v) {
				$new =M('news')->where(array('cid'=>$v['id'],'del'=>0))->order('uptime DESC')->select();
				if ($new) {
					$news = array_merge($new,$news);
				}
			}
		}
		$up=array();
		foreach ($news as $v) {
			$up[]=$v['uptime'];
		}
		array_multisort($up,SORT_DESC,$news);
		return $news;
	}
	//获取文章条数
	Static Public function GetAllNewsNum($id,$start,$end){
		$news = self::GetSonAllNews($id);
		$news = array_slice($news,$start,$end);
		return $news;
	}
	//分页文章输出
	Static Public function GetNewsPage($id,$num=10,$page_num=1){
		//$id 分类id
		//$num 每一页的文章数
		//$page_num 第几页
		$news = self::GetSonAllNews($id);
		$count = count($news);
		$pages = ceil($count/$num);
		$start = $num*($page_num-1);
		$end = $num*$page_num;
		$news = array_slice($news,$start,$end);
		$page = array();
		for ($i=0; $i < $pages ; $i++) { 
			$page[]= $i+1;
		}
		$list =array(
			'news' => $news,
			'page' => $page
			);
		return $list;
	}
	//上一篇，下一篇
	Static Public function GetUpNewsNum($id,$cid){
		$news = self::GetSonAllNews($cid);
		$news_up_down = array();
		foreach ($news as $k => $v) {
			if ($v['id'] == $id) {
				$news_up_down['up'] = $news[$k-1];
				$news_up_down['down'] = $news[$k+1];
			}
		}
		return $news_up_down;
	}
}