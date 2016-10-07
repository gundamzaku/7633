<?php
/**
 * Created by IntelliJ IDEA.
 * User: dan
 * Date: 2015/8/23
 * Time: 15:12
 */

class Page extends PageAbs{

    public $html;
	private $pPrevHtml;
	private $plistHtml;
	private $pNextHtml;

    public function __construct($avgCell,$currentPage=1,$url=''){
        parent::__construct($avgCell,$currentPage,$url);
    }

    public function getHtml(){
        $this->start();
        //组织成HTMl语法，传回给前端
        if($this->allPage>0){
		
            if($this->pPrev){
                $this->pPrevHtml = '<li><a href="'.$this->url.'p='.$this->pPrev.'">上一页</a></li>';
            }

            $this->setCellHtml();

            if($this->pNext){
                $this->pNextHtml = '<li><a href="'.$this->url.'p='.$this->pNext.'">下一页</a></li>';
            }

			$randNo = time();

			$this->html = <<<EOT
                <nav>
					  <ul class="pagenation">
						$this->pPrevHtml
					    $this->plistHtml
					    $this->pNextHtml
						<li>$this->avgCell 条/页</li>
					  </ul>
					</nav>
EOT;

            return $this->html;
        }
    }

    //设置条数成HTML
    private function setCellHtml(){
		$this->plistHtml = '';
        for($i=0;$i<sizeof($this->cell);$i++){
            if(empty($this->cell[$i]))continue;
            if( $this->cell[$i] == $this->currentPage ){
				$this->plistHtml .= '<li><a href="'.$this->url.'p='.$this->cell[$i].'">'.$this->cell[$i].'</a></li>';
            }else{
   				$this->plistHtml .= '<li><a href="'.$this->url.'p='.$this->cell[$i].'">'.$this->cell[$i].'</a></li>';
			}
        }
    }
}