<?php

/**
 * 这个模块来自表 "{{type}}".
 *
 * 数据表的字段 '{{type}}':
 * @property string $fromid
 * @property string $typeid
 * @property string $typename
 * @property string $item
 * @property integer $listorder
 */
class TakType extends CActiveRecord
{
	//信息状态
	const STATUS_DELETED = 0;
	const STATUS_DEFAULT = 1;

	//是否公开
	const DISPLAY_PRITAVE = 0;
	const DISPLAY_DEFAULT = 1;
	
	private static $_items = array(
		'status' => array('0'=>'锁定','1'=>'启用')
		,'display' => array('1'=>'公共','0'=>'私有')
		,'sex' => array('0'=>'保密','1'=>'男','2'=>'女')
		,'pageSize' => array('0'=>'默认','10'=>10,'20'=>20,'50'=>50,'100'=>100),
	);
	
	/**
	 * @return string 数据表名字
	 */
	public function tableName()
	{
		return '{{type}}';
	}
	public static function getStatus($type,$typeid,$fromid=0)
	{
			/*label-important,
label-warning,
label-success,
label-info,
label-inverse,*/
		$content = '';
		if(!isset(self::$_items[$type]))
			self::loadItems($type,$fromid);
		$content =  isset(self::$_items[$type][$typeid]) ? self::$_items[$type][$typeid] : false;
		if ($content)
		{
			$className = 'label ';
			$typeid>0&&$className .='label-success';
			$content = CHtml::tag('span', array('class'=>$className), $content);
		}
		return $content;
	}

	public static function loadGroups($type='AddressGroups'){
		$models = AddressGroups::model()->getList();
		foreach($models as $key => $value)
			self::$_items[$type][$key]=$value;

	}
	
	public static function items($type,$fromid=0)
	{
		if(!isset(self::$_items[$type]))
			self::loadItems($type,$fromid);
		return self::$_items[$type];
	}
	
	public static function item($type,$typeid,$fromid=0)
	{
		if(!isset(self::$_items[$type]))
			self::loadItems($type,$fromid);
		return isset(self::$_items[$type][$typeid]) ? self::$_items[$type][$typeid] : false;
	}
	
	private static function loadItems($type,$fromid=0)
	{
		if ($type=='AddressGroups') {
			self::loadGroups($type);
			return null;
		}
		self::$_items[$type]=array();
		$models=self::model()->findAll(array(
			'condition'=>'item=:item AND fromid=:fromid',
			'params'=>array(':item'=>$type,':fromid'=>$fromid),
			'order'=>'listorder DESC,typeid ASC',
		));
		foreach($models as $model)
			self::$_items[$type][$model->typeid]=$model->typename;
	}
	
	//默认继承的搜索条件
    public function defaultScope(){
    	$arr = parent::defaultScope();
    	$arr = array('order'=>'listorder DESC',);
    	return $arr;
    }	
	/**
	 * @return array validation rules for model attributes.字段校验的结果
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fromid, typeid, item', 'required'),
			array('listorder', 'numerical', 'integerOnly'=>true),
			array('fromid, typeid', 'length', 'max'=>10),
			array('typename', 'length', 'max'=>255),
			array('item', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('fromid, typeid, typename, item, listorder', 'safe', 'on'=>'search'),
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
				'fromid' => '平台会员ID',
				'typeid' => '值',
				'typename' => '名字',
				'item' => '类型',
				'listorder' => '排序',
		);
	}

	/**
	 * 默认查询搜索的条件
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('fromid',$this->fromid,true);
		$criteria->compare('typeid',$this->typeid,true);
		$criteria->compare('typename',$this->typename,true);
		$criteria->compare('item',$this->item,true);
		$criteria->compare('listorder',$this->listorder);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TakType the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
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
