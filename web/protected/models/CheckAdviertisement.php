<?php
class CheckAdviertisement extends CFormModel{

	public $title;
	public $icon;

	public function rules(){
		return array(
			array('title', 'required','message'=>'标题不能为空'),
			array('icon',  
                'file',
                'allowEmpty'=>true,   
                'types'=>'jpg,png,gif',  
                'maxSize'=>1024*1024*1,
                'tooLarge'=>'文件大于1M，上传失败！请上传小于1M的文件！',
				'wrongType'=>'错误的文件格式，必须为jpg,png,gif'
            ), 
		);
	}

}