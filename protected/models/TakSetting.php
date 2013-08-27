<?php

/**
 * This is the model class for table "{{setting}}".
 *
 * The followings are the available columns in table '{{setting}}':
 * @property string $itemid
 * @property string $fromid
 * @property string $item_key
 * @property string $item_value
 * @property string $add_time
 * @property string $add_us
 * @property string $add_ip
 * @property string $modified_time
 * @property string $modified_us
 * @property string $modified_ip
 */
class TakSetting extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{setting}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('itemid, fromid, item_value, add_us, modified_us', 'required'),
			array('itemid, add_us, modified_us', 'length', 'max'=>25),
			array('fromid, add_time, add_ip, modified_time, modified_ip', 'length', 'max'=>10),
			array('item_key', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('itemid, fromid, item_key, item_value, add_time, add_us, add_ip, modified_time, modified_us, modified_ip', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'itemid' => '编号',
			'fromid' => '平台会员ID',
			'item_key' => '键',
			'item_value' => '值',
			'add_time' => '添加时间',
			'add_us' => '添加人',
			'add_ip' => '添加IP',
			'modified_time' => '修改时间',
			'modified_us' => '修改人',
			'modified_ip' => '修改IP',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
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

		$criteria->compare('itemid',$this->itemid,true);
		$criteria->compare('fromid',$this->fromid,true);
		$criteria->compare('item_key',$this->item_key,true);
		$criteria->compare('item_value',$this->item_value,true);
		$criteria->compare('add_time',$this->add_time,true);
		$criteria->compare('add_us',$this->add_us,true);
		$criteria->compare('add_ip',$this->add_ip,true);
		$criteria->compare('modified_time',$this->modified_time,true);
		$criteria->compare('modified_us',$this->modified_us,true);
		$criteria->compare('modified_ip',$this->modified_ip,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TakSetting the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
