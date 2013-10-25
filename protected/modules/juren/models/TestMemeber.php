<?php

/**
 * 这个模块来自表 "{{test_memeber}}".
 *
 * 数据表的字段 '{{test_memeber}}':
 * @property string $itemid
 * @property string $manageid
 * @property string $company
 * @property string $email
 * @property string $active_time
 * @property string $add_time
 * @property string $add_us
 * @property string $add_ip
 * @property string $modified_time
 * @property string $modified_us
 * @property string $modified_ip
 * @property string $note
 */
class TestMemeber extends ModuleRecord
{

	public $status = 1;
	
	/**
	 * @return string 数据表名字
	 */
	public function tableName()
	{
		return '{{test_memeber}}';
	}
	/**
	 * @return array validation rules for model attributes.字段校验的结果
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('company', 'required'),
			array('active_time, add_time, add_ip, modified_time, modified_ip', 'length', 'max'=>10),
			array('company', 'length', 'max'=>64),
			array('email', 'length', 'max'=>100),
			array('add_us, modified_us', 'length', 'max'=>25),
			array('note', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('itemid, manageid, company, email, active_time, add_time, add_us, add_ip, modified_time, modified_us, modified_ip, note', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules. 表的关系，外键信息
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label) 字段显示的
	 */
	public function attributeLabels()
	{
		return array(
				'itemid' => '会员编号',
				'manageid' => '管理员编号',
				'company' => '公司名字',
				'email' => '邮箱',
				'active_time' => '激活时间',
				'add_time' => '添加时间',
				'add_us' => '添加人',
				'add_ip' => '添加IP',
				'modified_time' => '修改时间',
				'modified_us' => '修改人',
				'modified_ip' => '修改IP',
				'status' => '状态',
				'note' => '备注',
		);
	}


	public function search()
	{
		$cActive = parent::search();
		$criteria = $cActive->criteria;
		$criteria->compare('itemid',$this->itemid,true);
		$criteria->compare('manageid',$this->manageid,true);
		$criteria->compare('company',$this->company,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('active_time',$this->active_time,true);
		$criteria->compare('add_time',$this->add_time,true);
		$criteria->compare('add_us',$this->add_us,true);
		$criteria->compare('add_ip',$this->add_ip,true);
		$criteria->compare('modified_time',$this->modified_time,true);
		$criteria->compare('modified_us',$this->modified_us,true);
		$criteria->compare('modified_ip',$this->modified_ip,true);
		$criteria->compare('note',$this->note,true);
		return $cActive;
	}


	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	//默认继承的搜索条件
    public function defaultScope()
    {
    	$arr = array();
    	$arr['order'] = 'add_time DESC';
    	$condition = array('status=1');
    	$uname = Yii::app()->user->name; 
    	if ($uname!='admin') {
    		$manageid = Tak::getManageid();
    		$condition[] = "manageid=$manageid";
    	}
    	$arr['condition'] = join(" AND ",$condition);
    	return $arr;
    }

    public function getHtmlLink($isbtn=true)
    {
    	$key = Tak::setCryptNum($this->itemid);
    	$htmlOptions = array('class'=>'copy','id'=>$this->itemid);
		$url = Yii::app()->request->hostInfo.'/?'.$key;
		$link = CHtml::link($url,$url,array('target'=>'_blank','title'=>'点击打开'));
		if ($isbtn) {
			$link .= CHtml::button('复制',$htmlOptions);
		}
		
		// $link .= 'asd'.CHtml::button('复制',$htmlOptions);
		return $link;
    }

    public function getMmeber($itemid){
			$sql = "SELECT * FROM {$this->tableName()}
				WHERE itemid = :itemid ";
			$command = Yii::app()->db->createCommand($sql);
			$command->bindValue(':itemid', $itemid);
			$tags = $command->queryRow();			
			if (!$tags) {
				$tags = false;
			}
			return $tags;
    }

	//保存数据前
	protected function beforeSave(){
        //添加数据时候
        if ( $this->isNewRecord ){
        	$this->itemid = 1;
        }else{
        	//修改数据时候
        }
	    
	    $result = parent::beforeSave();
	    return $result;
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
}
