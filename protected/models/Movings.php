<?php

/**
 * 这个模块来自表 "{{movings}}".
 *
 * 数据表的字段 '{{movings}}':
 * @property string $itemid
 * @property string $fromid
 * @property integer $type
 * @property string $numbers
 * @property string $time
 * @property string $typeid
 * @property string $enterprise
 * @property string $us_launch
 * @property string $time_stocked
 * @property string $add_time
 * @property string $add_ip
 * @property string $modified
 * @property string $modified_ip
 * @property string $note
 * @property integer $status
 */
class Movings extends ModuleRecord
{

	public $type = 1;

	public $types = array(1=>'Purchase',2=>'Sell');
	
	/**
	 * @return string 数据表名字
	 */
	public function tableName()
	{
		return '{{movings}}';
	}

	public function init(){
		parent::init();
		$this->setSName();
	}	

	public function initak($type){
			if ($type&&$this->types[$type]) {
				$this->type  = $type;
				$this->setType($type);
				$this->setSName();
			}
	}

	public function setType($type){
		$this->scondition .= " AND type = '$type' ";
	}	

	public function setSName(){
		$this->sName = Tk::g($this->types[$this->type]);
	}

	/**
	 * @return array validation rules for model attributes.字段校验的结果
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('itemid, fromid, typeid, enterprise, time', 'required'),
			array('type, status', 'numerical', 'integerOnly'=>true),
			array('itemid', 'length', 'max'=>25),
			array('fromid, time, typeid, us_launch, time_stocked, add_time, add_ip, modified, modified_ip', 'length', 'max'=>10),
			array('numbers, enterprise', 'length', 'max'=>100),
			array('note', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('itemid, fromid, type, numbers, time, typeid, enterprise, us_launch, time_stocked, add_time, add_ip, modified, modified_ip, note, status', 'safe', 'on'=>'search'),
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
				'itemid' => '编号',
				'fromid' => '平台会员ID',
				'type' => '类型', /*(1:入库|2:出库)*/
				'numbers' => '实体单号',
				'time' => '日期',
				'typeid' => '类型',
				'enterprise' => '单位名称',
				'us_launch' => '经手人',
				'time_stocked' => '确认操作日期',
				'add_time' => '添加时间',
				'add_ip' => '添加IP',
				'modified' => '修改时间',
				'modified_ip' => '修改IP',
				'note' => '备注',
				'status' => '状态', /*(0:回收站,1:正常)*/
		);
	}

	public function search()
	{
		$cActive = parent::search();
		$criteria = $cActive->criteria;

		$criteria->compare('itemid',$this->itemid,true);
		$criteria->compare('fromid',$this->fromid,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('numbers',$this->numbers,true);
		$criteria->compare('time',$this->time,true);
		$criteria->compare('typeid',$this->typeid,true);
		$criteria->compare('enterprise',$this->enterprise,true);
		$criteria->compare('us_launch',$this->us_launch,true);
		$criteria->compare('time_stocked',$this->time_stocked,true);
		$criteria->compare('add_time',$this->add_time,true);
		$criteria->compare('add_ip',$this->add_ip,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('modified_ip',$this->modified_ip,true);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('status',$this->status);
		return $cActive;
	}


	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	//默认继承的搜索条件
    public function defaultScope()
    {
    	$arr = parent::defaultScope();
    	$condition = array($arr['condition']);
    	// $condition[] = 'display>0';
    	$arr['condition'] = join(" AND ",$condition);
    	return $arr;
    }

	//保存数据前
	protected function beforeSave(){
	    $result = parent::beforeSave();
	    if($result){
	        //添加数据时候
	        if ( $this->isNewRecord ){

	        }else{
	        	//修改数据时候
	        }
	    }
	    return $result;
	}

	//保存数据后
	protected function afterSave(){
		parent::afterSave();
	}	

	//删除信息后
	protected function afterDelete(){
		parent::afterDelete();
	}	
}
