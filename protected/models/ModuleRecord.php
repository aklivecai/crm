<?php
class ModuleRecord extends CActiveRecord
{
	public $mName = "" ;
	public $sName = "" ;
	protected $tableName = '';

	public function init(){
		$this->mName = get_class($this);
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

    public function getPageSize(){
		if (isset($_GET['setPageSize'])) {
			$setPageSize = (int)$_GET['setPageSize'];
			if ($setPageSize>=0
				&&$setPageSize!=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize'])
				) {
				Yii::app()->user->setState('pageSize',$setPageSize);
			}			
			unset($_GET['pageSize']); 
			$pageSize = $setPageSize;
		}else{
			$pageSize = Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);			
		}
		return $pageSize;
    }
	public function search()
	{
		$criteria = new CDbCriteria;
		$pageSize = $this->getPageSize();
		if (isset($_GET['dt'])&&isset($_GET['col'])
			&&$this->hasAttribute($_GET['col'])
		 ){
			$date = Tak::searchData($_GET['dt']);
			if ($date) {	
				$criteria->addBetweenCondition($_GET['col'], $date['start'], $date['end']);
			}
		}		
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

	public function checkTime($attribute,$params){

		$time = $this->$attribute;
		if ($time=='') {
			$this->$attribute = 0;
			return true;
		}
		if (!is_numeric($time)) {
			$time = strtotime($time);
		}
		$time = Tak::isTimestamp($time);
		if ($time) {
			$this->$attribute = $time;
		}else{
			$this->addError($attribute,'联系时间错误！');
		}
	}

	//保存数据前
	protected function beforeSave($isok=false){
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
	protected function beforeValidate(){
		 $result = parent::beforeValidate();
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
		 	AdminLog::log('Create');
		 }else{
			AdminLog::log(Tk::g('Update').$this->sName);
		 }
	}

	function del(){
		$result = false;
		if ($this->status!=TakType::STATUS_DELETED) {
			$this->status = TakType::STATUS_DELETED;
			$this->save();
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
		WHERE
			 fromid = :fromid
		     AND manageid = :manageid
		";
		$sql = strtr($sql,array(':tableName'=>$this->tableName()
			,':last_login_ip' => $arr['ip']
		));
		$query = Yii::app()->db->createCommand($sql);
		$query->execute();	
		AdminLog::log('登录操作');
		return true;
	}	
}	