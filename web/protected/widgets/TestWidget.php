<?php
class TestWidget extends CWidget
{
    public $datetime = ''; 

    public function run()
    {
        $datetime = empty($this->datetime) ? date('Y-m-d H:i:s') : $this->datetime;
        $this->render('test', array('datetime'=>$datetime));
    }
}
