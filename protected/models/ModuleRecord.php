<?php
class ModuleRecord extends MRecord
{
	public $scondition = ' status>0 ';/*默认搜索条件*/
	//默认继承的搜索条件
    public function defaultScope($isOrder=true)
    {
    	if ($this->getDefaultScopeDisabled()) {
    		return array();
    	}
    	$arr = array();

    	if ($isOrder) {
    		$arr['order'] = ' add_time DESC ';
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
		if (is_array($condition)&&$condition['condition']) {
			$condition = array($condition['condition']);
		}else{
			$condition = array();
		}

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


	public function search()
	{

		$criteria = parent::search();
		return $criteria;
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

    // 设置搜索
    public function setRecycle(){
    	$this->scondition = 'status=0';
    }

    // 还原
    public function setRestore(){
		$result = false;
		if ($this->status!=TakType::STATUS_DEFAULT) {
			$this->status = TakType::STATUS_DEFAULT;
			if($this->save()){
				$result = true;
			}else{
				 $arr = $this->getErrors();
			}
		}
		return result;
    }

	//保存数据前
	protected function beforeSave($isok=false){
	    $result = parent::beforeSave($isok);
	    if(!$isok&&$result){
	        //添加数据时候
	        $arr = Tak::getOM();
	        if ( $this->isNewRecord ){
	        	if ($this->hasAttribute('manageid')) {
	        		$this->manageid = $arr['manageid'];
	        	}      	
	        	if ($this->hasAttribute('fromid')) {
	        		$this->fromid = $arr['fromid'];
	        	}
	        	if (!$this->add_us) {
	        		$this->add_us = $arr['manageid'];
	        	}
	        	if (!$this->add_time) {
	        		$this->add_time = $arr['time'];
	        	}
	        	if (!$this->add_ip) {
	        		$this->add_ip = $arr['ip'];
	        	}
	        	
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
	protected function afterDelete(){
		 $result = parent::afterDelete();
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
			if($this->save()){
				$result = true;
			}else{
				 $arr = $this->getErrors();
			}
		}
		return $result;
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
}	