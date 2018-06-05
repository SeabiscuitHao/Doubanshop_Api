<?php
namespace Home\Controller;
use Think\Controller;
use app\Home\Modle\BannerModel;
class IndexController extends Controller {
	public function index () {
       
        $lists = D('Goods')->getList();
        
        foreach ($lists as $key => $value) {
            $tagInfo = '';
            $tags_id = $value['tag_id'];
            $arrTags = explode(',', $tags_id);
            foreach ($arrTags as $k => $v) {
                $tags = D('tags')->getBasicInfo($v);
                $tagInfo .= $tags['tag'] . ',';
            }
            $tagInfo = rtrim($tagInfo,',');
            $value['tag_id'] = $tagInfo;
            $lists[$key] = $value;
        }
		$banner = D('banner')->getBanner();
		$this->assign(array(
			'lists'		=> $lists,
			'banner'	=> $banner
		));
		$this->display();
	}

    public function info() {
        $id = $_GET['id'];
        $lists = D('Goods')->getInfoById($id);
        $this->assign('lists',$lists);
        $this->display();
    }
	
}