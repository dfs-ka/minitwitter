<?php
class Post extends CActiveRecord
{   
	public function init()
	{
	}
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return 'post';
	}	
	
    public function relations()
    {
        return array(
        );
    }
}