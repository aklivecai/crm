<?php

/**
 * This is the model class for table "{{Clientele}}".
 *
 * The followings are the available columns in table '{{Clientele}}':
 * @property long $itemid
 * @property string $fromid
 * @property long $manageid
 * @property string $rating
 * @property integer $annual_revenue
 * @property string $industry
 * @property string $profession
 * @property string $origin
 * @property integer $employees
 * @property string $accountname
 * @property string $email
 * @property string $address
 * @property string $telephone
 * @property string $fax
 * @property string $web
 * @property string $visibility
 * @property string $add_time
 * @property long $add_us
 * @property string $add_ip
 * @property string $modified_time
 * @property long $modified_us
 * @property string $modified_ip
 * @property string $note
 */
class Clientele extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{Clientele}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('itemid, fromid, manageid, industry, profession, accountname, add_us, modified_us', 'required'),
			array('annual_revenue, employees', 'numerical', 'integerOnly'=>true),
			array('rating, industry, profession, origin, accountname, email', 'length', 'max'=>100),
			array('address, note', 'length', 'max'=>255),
			array('telephone, fax, web', 'length', 'max'=>50),
			array('visibility', 'length', 'max'=>11),
			array('add_time, modified_time', 'length', 'max'=>10),
			array('add_ip, modified_ip', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('itemid, fromid, manageid, rating, annual_revenue, industry, profession, origin, employees, accountname, email, address, telephone, fax, web, visibility, add_time, add_us, add_ip, modified_time, modified_us, modified_ip, note', 'safe', 'on'=>'search'),
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
			'itemid' => 'Itemid',
			'fromid' => 'Fromid',
			'manageid' => 'Manageid',
			'rating' => 'Rating',
			'annual_revenue' => 'Annual Revenue',
			'industry' => 'Industry',
			'profession' => 'Profession',
			'origin' => 'Origin',
			'employees' => 'Employees',
			'accountname' => 'Accountname',
			'email' => 'Email',
			'address' => 'Address',
			'telephone' => 'Telephone',
			'fax' => 'Fax',
			'web' => 'Web',
			'visibility' => 'Visibility',
			'add_time' => 'Add Time',
			'add_us' => 'Add Us',
			'add_ip' => 'Add Ip',
			'modified_time' => 'Modified Time',
			'modified_us' => 'Modified Us',
			'modified_ip' => 'Modified Ip',
			'note' => 'Note',
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

		$criteria->compare('itemid',$this->itemid);
		$criteria->compare('fromid',$this->fromid,true);
		$criteria->compare('manageid',$this->manageid);
		$criteria->compare('rating',$this->rating,true);
		$criteria->compare('annual_revenue',$this->annual_revenue);
		$criteria->compare('industry',$this->industry,true);
		$criteria->compare('profession',$this->profession,true);
		$criteria->compare('origin',$this->origin,true);
		$criteria->compare('employees',$this->employees);
		$criteria->compare('accountname',$this->accountname,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('telephone',$this->telephone,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('web',$this->web,true);
		$criteria->compare('visibility',$this->visibility,true);
		$criteria->compare('add_time',$this->add_time,true);
		$criteria->compare('add_us',$this->add_us);
		$criteria->compare('add_ip',$this->add_ip,true);
		$criteria->compare('modified_time',$this->modified_time,true);
		$criteria->compare('modified_us',$this->modified_us);
		$criteria->compare('modified_ip',$this->modified_ip,true);
		$criteria->compare('note',$this->note,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Clientele the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
