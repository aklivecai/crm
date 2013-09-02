<?php

/**
 * This is the model class for table "{{Manage}}".
 *
 * The followings are the available columns in table '{{Manage}}':
 * @property string $fromid
 * @property long $manageid
 * @property string $user_name
 * @property string $user_pass
 * @property string $salt
 * @property string $user_nicename
 * @property string $user_email
 * @property string $add_time
 * @property string $add_ip
 * @property string $last_login_time
 * @property string $last_login_ip
 * @property integer $login_count
 * @property string $user_status
 * @property string $note
 * @property string $activkey
 * @property integer $active_time
 */
class Module extends CActiveRecord
{
	public $mName = __CLASS__ ;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{'.__CLASS__.'}}';
	}
	public function init(){
		$this->mName = get_class(this);
		$this->sName = Tk::g($this->mName);
	}

	//默认继承的搜索条件
    public function defaultScope()
    {
    	$arr = array('order'=>'add_time DESC',);
    	$condition = array('status>0');
    	$condition[] = 'fromid='.Tak::getFormid();
    	if (!Tak::checkSuperuser()) {
    		$condition[] = 'manageid='.Tak::getManageid();
    	}
    	$arr['condition'] = join(" AND ",$condition);
    	return $arr;
    }

	public function search()
	{
		$criteria = new CDbCriteria;
		$pageSize = Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array( 
				'pageSize' => $pageSize, 
			), 
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Manage the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}	
	
	//保存数据前
	public function beforeSave($isok=false){
	    $result = parent::beforeSave();
	    if(!$isok&&$result){
	        //添加数据时候
	        $arr = Tak::getOM();
	        if ( $this->isNewRecord ){
	        	$this->itemid = $arr['itemid'];
	        	$this->manageid = $arr['manageid'];
	        	$this->add_us = $arr['manageid'];
	        	$this->add_time = $arr['time'];
	        	$this->add_ip = $arr['ip'];
	        	$this->fromid = $arr['fromid']; 
	        }else{
	        	//修改数据时候
	        	$this->modified_us = $arr['manageid'];
	        	$this->modified_time = $arr['time'];
	        	$this->modified_ip = $arr['ip'];
	        }
	    }
	    return $result;
	}

	//
	protected function afterSave(){
		parent::afterSave();
		$url = Yii::app()->request->getUrl();
		 if(false){
			 
		 }elseif (strpos($url,'delete')>0){
		 	$this->logDel();
		 }
		 elseif ($this->isNewRecord ){
		 	AdminLog::log('Create'.$this->manageid);
		 }else{
			AdminLog::log(Tk::g('Update').$this->sName);
		 }
	}

	function del(){
		$result = false;
		if ($this->user_status!=0) {
			$this->user_status = 0;
			$this-save();
			$result = true;
		}
		return result;
	}

	protected function afterDelete(){
		parent::afterDelete();
		$this->logDel();
	}
	protected function logDel(){
		AdminLog::log(Tk::g('Delete').$this->sName);
	}
	
	public  function upLogin(){
		$arr = Tak::getOM();
		$sql = " UPDATE :tableName SET
		    last_login_ip = :last_login_ip
		    ,login_count = login_count+1
		    ,last_login_time = :last_login_time
		WHERE
			 fromid = :fromid
		     AND manageid = :manageid
		";
		$sql = strtr($sql,array(':tableName'=>$this->tableName()
			,':last_login_ip' => $arr['ip']
			,':last_login_time' => $arr['time']
			,':fromid' => $arr['fromid']
			,':manageid' => $arr['manageid']
		));
		$query = Yii::app()->db->createCommand($sql);
		$query->execute();	
		AdminLog::log('登录操作');
		return true;
	}	
}	