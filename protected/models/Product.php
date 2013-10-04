<?php

/**
 * 这个模块来自表 "{{product}}".
 *
 * 数据表的字段 '{{product}}':
 * @property string $itemid
 * @property string $fromid
 * @property string $name
 * @property string $typeid
 * @property string $material
 * @property string $spec
 * @property string $unit
 * @property integer $stocks
 * @property string $add_time
 * @property string $add_us
 * @property string $add_ip
 * @property string $modified_time
 * @property string $modified_us
 * @property string $modified_ip
 * @property string $note
 */
class Product extends ModuleRecord
{
	
	/**
	 * @return string 数据表名字
	 */
	public function tableName()
	{
		return '{{product}}';
	}

	/**
	 * @return array validation rules for model attributes.字段校验的结果
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array(' name, typeid, spec', 'required'),
			array('stocks, status', 'numerical', 'integerOnly'=>true),
			array('itemid, add_us, modified_us', 'length', 'max'=>25),
			array('fromid, typeid, unit, add_time, add_ip, modified_time, modified_ip', 'length', 'max'=>10),
			array('name, material, spec', 'length', 'max'=>100),
			array('note', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('itemid, fromid, name, typeid, material, spec, unit, stocks, add_time, add_us, add_ip, modified_time, modified_us, modified_ip, note, status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules. 表的关系，外键信息
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		$condition = array("item='product'");
    	$condition[] = 'fromid='.Tak::getFormid();
		return array(
			'iType' => array(
				self::BELONGS_TO
				, 'TakType'
				, 'typeid'
				, 'select' => 'typename'
				, 'condition'=> join(" AND ",$condition)
				),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label) 字段显示的
	 */
	public function attributeLabels()
	{
		return array(
				'itemid' => '产品编号',
				'fromid' => '平台会员ID',
				'name' => '产品名字',
				'typeid' => '分类',
				'material' => '材料',
				'spec' => '规格',
				'unit' => '单位',
				'stocks' => '库存', /*(可负)*/
				'add_time' => '添加时间',
				'add_us' => '添加人',
				'add_ip' => '添加IP',
				'modified_time' => '修改时间',
				'modified_us' => '修改人',
				'modified_ip' => '修改IP',
				'note' => '介绍',
				'status' => '状态', /*(0:回收站,1:正常)*/
		);
	}

	public function search()
	{
		$cActive = parent::search();
		$criteria = $cActive->criteria;

		$criteria->compare('itemid',$this->itemid,true);
		$criteria->compare('fromid',$this->fromid,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('typeid',$this->typeid,true);
		$criteria->compare('material',$this->material,true);
		$criteria->compare('spec',$this->spec,true);
		$criteria->compare('unit',$this->unit,true);
		$criteria->compare('stocks',$this->stocks);
		$criteria->compare('add_time',$this->add_time,true);
		$criteria->compare('add_us',$this->add_us,true);
		$criteria->compare('add_ip',$this->add_ip,true);
		$criteria->compare('modified_time',$this->modified_time,true);
		$criteria->compare('modified_us',$this->modified_us,true);
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