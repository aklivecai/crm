<?php
class MRecord extends CActiveRecord
{
	public $mName = "" ;/*当前类名字*/
	public $sName = "" ;/*显示名字*/
	
	public $isLog = true;/*是否记录日志*/

    private $_defaultScopeDisabled = false; /* Flag - whether defaultScope is disabled or not*/

	protected $tableName = '';/*表名*/

	protected $linkName = null; /*连接的显示的字段名字*/

	public function init(){
		$this->mName = get_class($this);
		$this->sName = Tk::g($this->mName);
	}

	public function primaryKey()
	{
		return 'itemid';
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
		// $criteria->order = $stort;
		$pageSize = $this->getPageSize();
		$colV = Yii::app()->request->getQuery('dt', false);
		if ($colV&&$colV!=''&&isset($_GET['col'])
			&&$this->hasAttribute($_GET['col'])
		 ){
			$date = Tak::searchData($colV);
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
	        if ( $this->isNewRecord ){
	        	if (!$this->primaryKey) {
	        		$this->setItemid(Tak::fastUuid());
	        	}elseif($this->primaryKey==1){
	        		$this->setItemid(null);
	        	}
	        }else{
	        	//修改数据时候
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
	}

	protected function afterDelete(){
		parent::afterDelete();
		if ($this->isLog) {
			$this->logDel();
		}		
	}
	protected function logDel(){
		AdminLog::log(Tk::g('Delete').$this->sName);
	}
	
	public function getIData($col='add_time',$dtime=false,$swhere=false){
		$sqlWhere = $this->defaultScope(0);
		if (is_array($sqlWhere)&&$sqlWhere['condition']) {
			$sqlWhere = $sqlWhere['condition'];
		}else{
			$sqlWhere = '';
		}
		if (!$sqlWhere) {
			$sqlWhere .= join(' AND ',$sqlWhere);
		}
		if (!$dtime) {
			$dtime = Tak::getDateTop();
		}
		$arrSql  = array(' SELECT COUNT(:itemid) AS num, \'allData\' AS ikey FROM :tableName WHERE :sqlWhere ');	
		foreach ($dtime as $key => $value) {
			$sql = ' SELECT COUNT(:itemid) AS num, \''.$key.'Data\' AS ikey FROM  :tableName WHERE :sqlWhere AND :col BETWEEN '.$value['start'].' AND '.$value['end'];
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
			,':itemid' => $this->primaryKey()
		));	
		 // Tak::KD($sql,1);
		$command = Yii::app()->db->createCommand($sql);
		$dataReader=$command->query();
		$tags = array();
		foreach($dataReader as $row) {
			$tags[$row['ikey']] = $row['num'];
		}
		// Tak::KD($tags,1);
		return $tags;
	}

	public function getLink($itemid=false,$action='view'){
		if (!$itemid) {
			$itemid = $this->primaryKey;
		}		
		$link = Yii::app()->createUrl(strtolower($this->mName).'/'.$action,array('id'=>$itemid));
		return $link;
	}		
	public function getHtmlLink($name=false,$itemid=false,$htmlOptions=array(),$action='view')
	{
		if (!$name&&$this->linkName!==null) {
			$name = $this->{$this->linkName};
		}
		$link = CHtml::link($name, $this->getLink($itemid,$action),$htmlOptions);
		return $link;
	}
	public function getHtmlPreviewLink($name=false,$itemid=false,$htmlOptions=array()){
		$link = $this->getHtmlLink($name,$itemid,$htmlOptions,'preview');
		return $link;
	}

}	