<?php
/**
 * 分类页（抽象类）
 * User: dan
 * Date: 2015/8/22
 * Time: 15:37
 */

abstract class PageAbs
{
    public $firstPage;//默认第一页
    protected $sortOffset;//偏移量，指前后分页数组里能放几个页数
    public $avgCell;//平均页数
    public $url;//当前页面的地址，加上分页参数的
    public $currentPage;//当前页数
    public $allNum;  //总条数
    public $allPage; //共几页
    protected $prevCurrent;//当前上一页的结束页
    protected $prevCell;	//上一页的阵列
    protected $nextOffset;//下一页用的偏移量
    protected $nextCurrent;//当前下一页的开始页
    protected $nextCell;//下条的下一页[数组]
    protected $cell;//合并后的数组
    protected $pNext;//下一页
    protected $pPrev;//上一页
    /*
	 * @Method:
	 * 	__construct
	 * @Purpose:
	 * 	構造
	 * @Param:
	 * 	$avgCell:	    平均页数
	 * 	$currentPage:	当前第几页,默认是第一页
	 * 	$url:	        当前页面的地址
	 * @Return:
     *  无
     */
    function __construct($avgCell,$currentPage=1,$url='') {

        $this->firstPage	= 1;	//默认第一页
        $this->sortOffset	= 2;	//一页显示几条内容.默认是三
        $this->avgCell		= $avgCell;  //平均页数.[传入]
        $this->url			= $url;
        $this->currentPage	= intval($currentPage);  //当前页数是多少[传入]
        if(empty($this->currentPage))$this->currentPage = 1;
    }
    /*
	 * @Method:
	 * 	setAllNum
	 * @Purpose:
	 * 	设置总行数
	 * @Param:
	 * 	$_allNum:	    总行数
	 * @Return:
     *  无
     */
    public function setAllNum($_allNum){
        $this->allNum = $_allNum;
    }

    /*
	 * @Method:
	 * 	setAllPage
	 * @Purpose:
	 * 	设置总页数
	 * @Param:
	 * 	无
	 * @Return:
     *  无
     */
    protected function setAllPage(){
        $this->allPage	= ceil( $this->allNum/$this->avgCell );
    }

    /*
	 * @Method:
	 * 	getAllPage
	 * @Purpose:
	 * 	得到总页数
	 * @Param:
	 * 	无
	 * @Return:
     *  $this->allPage
     */
    public function getAllPage(){
        return $this->allPage;
    }

    /*
	 * @Method:
	 * 	hasNextPage
	 * @Purpose:
	 * 	是否存在下一页
	 * @Param:
	 * 	无
	 * @Return:
     *  true:存在
     *  false:不存在
     */
    protected function hasNextPage(){
        if($this->allPage - $this->currentPage > 0){
            return true;
        }else{
            return false;
        }
    }

    /*
	 * @Method:
	 * 	hasPrevPage
	 * @Purpose:
	 * 	是否存在上一页
	 * @Param:
	 * 	无
	 * @Return:
     *  true:存在
     *  false:不存在
     */
    protected function hasPrevPage(){
        if( $this->currentPage > $this->firstPage ){
            return true;
        }else{
            return false;
        }
    }
    /*
	 * @Method:
	 * 	hasFirstPage
	 * @Purpose:
	 * 	是否存在第一页
	 * @Param:
	 * 	无
	 * @Return:
     *  true:存在
     *  false:不存在
     */
    public function hasFirstPage(){
        if( $this->allPage > 1 ){
            return true;
        }else{
            return false;
        }
    }

    /*
	 * @Method:
	 * 	hasEndPage
	 * @Purpose:
	 * 	是否存在最后一页
	 * @Param:
	 * 	无
	 * @Return:
     *  true:存在
     *  false:不存在
     */
    protected function hasEndPage(){
        if( $this->allPage > 1 ){
            return true;
        }else{
            return false;
        }
    }
    /*
	 * @Method:
	 * 	getCurrentPage
	 * @Purpose:
	 * 	得到当前页
	 * @Param:
	 * 	无
	 * @Return:
     *  $this->currentPage  当前页数
     */
    public function getCurrentPage(){
        return $this->currentPage;
    }
    /*
	 * @Method:
	 * 	getFirstPage
	 * @Purpose:
	 * 	得到首页
	 * @Param:
	 * 	无
	 * @Return:
     *  $this->firstPage  首页页数
     */
    public function getFirstPage(){
        return $this->firstPage;
    }
    /*
	 * @Method:
	 * 	getSortOffset
	 * @Purpose:
	 * 	得到首页
	 * @Param:
	 * 	无
	 * @Return:
     *  $this->sortOffset  一页几条
     */
    public function getSortOffset(){
        return $this->sortOffset;
    }
    /*
	 * @Method:
	 * 	getAllNum
	 * @Purpose:
	 * 	得到一共多少页
	 * @Param:
	 * 	无
	 * @Return:
     *  $this->allNum  一共多少页
     */
    public function getAllNum(){
        return $this->allNum;
    }
    /*
	 * @Method:
	 * 	setUrl
	 * @Purpose:
	 * 	设置分页参数
     *  有可能被继承复写，因为URL规则不一定就是传统的
	 * @Param:
	 * 	无
	 * @Return:
     *  无
     */
    protected function setUrl(){
        $this->url = trim($this->url);
        if(preg_match("/[\?]{1}/",$this->url)){
            $this->url .= "&";
        }else{
            $this->url .= "?";
        }
    }
    /*
    * @Method:
    * 	getUrl
    * @Purpose:
    * 	得到当页的url
    * @Param:
    * 	无
    * @Return:
    *  $this->url
    */
    public function getUrl(){
        return $this->url;
    }
    /*
    * @Method:
    * 	setPrevCell
    * @Purpose:
    * 	设置分页的阵列（前）
    * @Param:
    * 	无
    * @Return:
    */
    protected function setPrevCell(){

        $this->prevCurrent = $this->currentPage;							//当前页传给变量.
        /*
         * 如果当前页减去第一页比设置的偏移量大于等于的话.
         * 说明可以放置前三位页数.
         */
        if( $this->currentPage - $this->firstPage >= $this->sortOffset){
            for( $i = 0;$i < $this->sortOffset;$i++ ){						//循环放入.
                $this->prevCell[$i] = --$this->prevCurrent;
            }
        }else{ 																//否则的话.
            for( $i = 0;$i < $this->currentPage;$i++ ){						//调I.I小于当前页的话.++
                if( $this->prevCurrent == 1 )break;
                $this->prevCell[$i] = --$this->prevCurrent;
            }
        }
        if($this->prevCell == null)$this->prevCell[0] = '';
    }
    /*
    * @Method:
    * 	setPrevCell
    * @Purpose:
    * 	设置分页的阵列（后）
    * @Param:
    * 	无
    * @Return:
    */
    protected function setNextCell(){
        $this->nextCurrent = $this->currentPage;

        if( $this->allPage - $this->currentPage >= $this->sortOffset){
            for( $i = 0;$i < $this->sortOffset;$i++ ){
                $this->nextCell[$i] = ++$this->nextCurrent;
            }
        }else{
            $this->nextOffset = $this->allPage - $this->currentPage;
            for( $i = 0;$i<$this->nextOffset;$i++ ){
                $this->nextCell[$i] = ++$this->nextCurrent;
            }
        }
        if($this->nextCell == null)$this->nextCell[0] = '';
    }
    /*
    * @Method:
    * 	setCellOffset
    * @Purpose:
    * 	补充分页的阵列
    * @Param:
    * 	无
    * @Return:
    */
    protected function setCellOffset(){
        /*
         * 上条排序不足.
         * 看少几条.补给下条排序.
         * 如果上条排序小于偏移量.
         */
        if( sizeof($this->prevCell) < $this->sortOffset ){

            $setCellOffset = $this->sortOffset - sizeof($this->prevCell);	//偏移量减去上条的值.得到小多少数值.

            for( $i = 0;$i<$setCellOffset;$i++ ){							//调置变量I.给下条补位.
                if( $this->nextCurrent >= $this->allPage )break;
                array_push($this->nextCell,++$this->nextCurrent);
            }
        }

        /*
         * 下条排序不足.
         * 看少几条.补给上条排序.
         * 如果下条排序小于偏移量.补给上条
         */
        if( sizeof($this->nextCell) < $this->sortOffset ){

            $setCellOffset = $this->sortOffset - sizeof($this->nextCell);	//偏移量减去下条的值.得到小多少数值.

            for( $i=0;$i<$setCellOffset;$i++ ){
                if($this->prevCurrent <= 1)break;
                array_push($this->prevCell,--$this->prevCurrent);
            }
        }
        if($this->prevCell != null){
            sort($this->prevCell);												    //给上条从低到高排序.
            array_push($this->prevCell,$this->currentPage);						//将当前页压入数组.
        }

        $this->cell = array_merge($this->prevCell ,$this->nextCell);		//合并数组
    }
	
	//得到当前页的起始数
	public function getLimitOffset($avgCell,$currentPage=1){
		if(empty($currentPage) || $currentPage < 1 ){
			$currentPage = 1;
		}
		return ($currentPage - 1)*$avgCell;
	}
    /*
    * @Method:
    * 	setNextPage
    * @Purpose:
    * 	设置下一页
    * @Param:
    * 	无
    * @Return:
    */
    protected function setNextPage(){
        if( $this->hasNextPage() && ( $this->currentPage+1<=$this->allPage) )
            $this->pNext = $this->currentPage+1;
    }
    /*
    * @Method:
    * 	setPrevPage
    * @Purpose:
    * 	设置上一页
    * @Param:
    * 	无
    * @Return:
    */
    protected function setPrevPage(){
        if( $this->hasPrevPage() && ( $this->currentPage-1>0 ) )
            $this->pPrev = $this->currentPage-1;
    }

    protected function start(){

        $this->setAllPage();
        $this->setUrl();
        $this->setPrevCell();
        $this->setNextCell();
        $this->setCellOffset();
        $this->setNextPage();
        $this->setPrevPage();
    }
}