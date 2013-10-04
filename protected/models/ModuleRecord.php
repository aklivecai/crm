<?php
class ModuleRecord extends CActiveRecord
{
	public $mName = "" ;/*当前类名字*/
	public $sName = "" ;/*显示名字*/
	
	public $scondition = ' status>0 ';/*默认搜索条件*/
	public $isLog = true;/*是否记录日志*/

    private $_defaultScopeDisabled = false; /* Flag - whether defaultScope is disabled or not*/

	protected $tableName = '';/*表名*/


	public function init(){
		$this->mName = get_class($this);
		$this->sName = Tk::g($this->mName);
	}

	protected function setItemid($value){
		if ($this->hasAttribute('itemid')) {
			$this->itemid = $value;
		}else{
			$primary = $this->primaryKey();
			$this->{$primary} = $value;
		}
	}

    public function disableDefaultScope()
    {
          $this->_defaultScopeDisabled = true;
          return $this->Owner;
    }

    public function getDefaultScopeDisabled() {
        return $this->_defaultScopeDisabled;
    }


	//默认继承的搜索条件
    public function defaultScope($isOrder=true)
    {
    	if ($this->getDefaultScopeDisabled()) {
    		return array();
    	}

    	if ($isorder) {
    		$arr = array('order'=>'add_time DESC',);
    	}

    	$condition = array($this->scondition);
    	$condition[] = 'fromid='.Tak::getFormid();
    	if (!Tak::checkSuperuser()&&$this->hasAttribute('manageid')) {
    		$condition[] = 'manageid='.Tak::getManageid();
    	}
    	$arr['condition'] = join(" AND ",$condition);
    	return $arr;
    }

   public function scopes()
    {
        return array(
            'published'=>array(
                'condition'=>'status=1',
            ),
            'recently1'=>array(
                'order'=>'add_time DESC',
            ),
            'sort_time'=>array(
                'order'=>'add_time DESC',
            ),
        );
    }   
    
	public function recently($limit=5,$pcondition=false,$order='add_time DESC')
	{
		$condition = $this->defaultScope(false);

		if (is_string($pcondition)) {
			$condition[] = $pcondition;
		}elseif(is_array($pcondition)){
			$condition = array_merge_recursive($condition, $pcondition);
		}
		$criteria = new CDbCriteria(array(
	    	'condition' => join(" AND ",$condition),
	    	'order' => $order
		));
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		    'pagination'=>array(
		        'pageSize'=>$limit,
		    ),
		));
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
		$criteria->order = $stort;
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

    // 设置搜索
    public function setRecycle(){
    	$this->scondition = 'status=0';
    }

    // 还原
    public function setRestore(){
		$result = false;
		if ($this->status!=TakType::STATUS_DEFAULT) {
			$this->status = TakType::STATUS_DEFAULT;
			$this->save();
			$result = true;
		}
		return result;
    }

	//保存数据前
	protected function beforeSave($isok=false){
	    $result = parent::beforeSave();
	    if(!$isok&&$result){
	        //添加数据时候
	        $arr = Tak::getOM();
	        if ( $this->isNewRecord ){
	        	if (!$this->primaryKey) {
	        		$this->setItemid($arr['itemid']);
	        	}	        	
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
		if (!$this->isLog) {
			return false;
		}
		$url = Yii::app()->request->getUrl();
		if (strpos($url,'delete')>0){
		 	$this->logDel();
		 }
		 elseif (strpos($url, 'del')>0){
		 	AdminLog::log(Tk::g('Deletes').$this->sName);
		 }
		 elseif (strpos($url, 'restore')>0){
		 	AdminLog::log(Tk::g('Restore').$this->sName);
		 }
		 elseif ($this->isNewRecord ){
		 	AdminLog::log(Tk::g('Create').$this->sName.' - 编号:'.$this->primaryKey);
		 }else{
			AdminLog::log(Tk::g('Update').$this->sName);
		 }
	}

	public function del(){
		$result = false;
		if ($this->status!=TakType::STATUS_DELETED) {
			$this->status = TakType::STATUS_DELETED;
			$this->save();
			$result = true;
		}
		return result;
	}
	public function dels(){
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
	
	public function getIData($col='add_time',$dtime=false,$sqlWhere=false){

		if (!$sqlWhere) {
			$sqlWhere = $this->defaultScope(false);
			$sqlWhere = join(' AND ',$sqlWhere);
		}
		if (!$dtime) {
			$dtime = Tak::getDateTop();
		}
		$arrSql  = array(' SELECT COUNT(itemid) AS num, \'allData\' AS ikey FROM :tableName WHERE :sqlWhere ');	
		foreach ($dtime as $key => $value) {
			$sql = ' SELECT COUNT(itemid) AS num, \''.$key.'Data\' AS ikey FROM  :tableName WHERE :sqlWhere AND :col BETWEEN '.$value['start'].' AND '.$value['end'];
			$arrSql [] = $sql;
		}
		$sql = join(' UNION ',$arrSql);
		$sql = strtr($sql,array(
			':tableName'=>$this->tableName()
			,':yea' => $dtime['y']['start']
			,':yeaend' => $dtime['y']['end']
			,':month' => $dtime['m']['start']
			,':monthend' => $dtime['m']['end']
			,':day' => $dtime['d']['start']
			,':dayend' => $dtime['d']['end']
			,':sqlWhere' => $sqlWhere
			,':col' => $col
		));	
		// Tak::KD($sql,1);
		$command = Yii::app()->db->createCommand($sql);
		$dataReader=$command->query();
		$tags = array();
		foreach($dataReader as $row) {
			$tags[$row['ikey']] = $row['num'];
		}
		// Tak::KD($tags);
		return $tags;
	}
}	