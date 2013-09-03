<?php

/**
 * 这个模块来自表 "{{clientele}}".
 *
 * 数据表的字段 '{{clientele}}':
 * @property string $itemid
 * @property string $fromid
 * @property string $manageid
 * @property string $clientele_name
 * @property string $rating
 * @property integer $annual_revenue
 * @property string $industry
 * @property string $profession
 * @property string $origin
 * @property integer $employees
 * @property string $email
 * @property string $address
 * @property string $telephone
 * @property string $fax
 * @property string $web
 * @property integer $display
 * @property integer $status
 * @property string $last_time
 * @property string $add_time
 * @property string $add_us
 * @property string $add_ip
 * @property string $modified_time
 * @property string $modified_us
 * @property string $modified_ip
 * @property string $note
 */
class Clientele extends CActiveRecord
{
	
	/**
	 * @return string 数据表名字
	 */
	public function tableName()
	{
		return '{{clientele}}';
	}

	public function getName()
	{
		return __CLASS__;
	}

	/**
	 * @return array validation rules for model attributes.字段校验的结果
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array(' clientele_name, industry, profession', 'required'),
			array('annual_revenue, employees, display, status', 'numerical', 'integerOnly'=>true),
			array('itemid, manageid, add_us, modified_us', 'length', 'max'=>25),
			array('fromid, last_time, add_time, add_ip, modified_time, modified_ip', 'length', 'max'=>10),
			array('clientele_name, rating, industry, profession, origin, email', 'length', 'max'=>100),
			array('address, note', 'length', 'max'=>255),
			array('telephone, fax, web', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('itemid, fromid, manageid, clientele_name, rating, annual_revenue, industry, profession, origin, employees, email, address, telephone, fax, web, display, status, last_time, add_time, add_us, add_ip, modified_time, modified_us, modified_ip, note', 'safe', 'on'=>'search'),
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
				'manageid' => '会员ID',
				'clientele_name' => '客户名字',
				'rating' => '客户等级',
				'annual_revenue' => '年营业额',
				'industry' => '客户类型', /*(新客户,意向客户,潜在客户,正式客户,VIP客户)*/
				'profession' => '客户行业',
				'origin' => '来源', /*(电话营销,主动来电,老客户,朋友介绍,广告杂志,互联网,其它)*/
				'employees' => '员工数量',
				'email' => '邮箱',
				'address' => '地址',
				'telephone' => '电话',
				'fax' => '传真',
				'web' => '网站',
				'display' => '显示情况', /*(0:自己,1：公共)*/
				'status' => '状态', /*(0:回收站,1:正常)*/
				'last_time' => '最后联系时间', /*(客户联系记录中修改)*/
				'add_time' => '添加时间',
				'add_us' => '添加人',
				'add_ip' => '添加IP',
				'modified_time' => '修改时间',
				'modified_us' => '修改人',
				'modified_ip' => '修改IP',
				'note' => '备注',
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

		$criteria->compare('itemid',$this->itemid,true);
		$criteria->compare('fromid',$this->fromid,true);
		$criteria->compare('manageid',$this->manageid,true);
		$criteria->compare('clientele_name',$this->clientele_name,true);
		$criteria->compare('rating',$this->rating,true);
		$criteria->compare('annual_revenue',$this->annual_revenue);
		$criteria->compare('industry',$this->industry);
		$criteria->compare('profession',$this->profession);
		$criteria->compare('origin',$this->origin,true);
		$criteria->compare('employees',$this->employees);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('telephone',$this->telephone,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('web',$this->web,true);
		$criteria->compare('display',$this->display);
		$criteria->compare('status',$this->status);
		$criteria->compare('last_time',$this->last_time,true);
		$criteria->compare('add_time',$this->add_time,true);
		$criteria->compare('add_us',$this->add_us,true);
		$criteria->compare('add_ip',$this->add_ip,true);
		$criteria->compare('modified_time',$this->modified_time);
		$criteria->compare('modified_us',$this->modified_us,true);
		$criteria->compare('modified_ip',$this->modified_ip,true);
		$criteria->compare('note',$this->note,true);

		// $criteria->addBetweenCondition('add_time', $date['date_start'], $date['date_end']);

		if (isset($_GET['dt'])&&isset($_GET['col'])
			&&$this->hasAttribute($_GET['col'])
		 ){
			$date = Tak::searchData($_GET['dt']);
			if ($date) {		
				// $criteria->addInCondition($_GET['dt']., array());		
				$criteria->addBetweenCondition($_GET['col'], $date['start'], $date['end']);
			}
		}
		
		if (isset($_GET['setPageSize'])) {
			$setPageSize = (int)$_GET['setPageSize'];
			if ($setPageSize>0
				&&$setPageSize!=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize'])
				) {
				Yii::app()->user->setState('pageSize',$setPageSize);
			}			
			unset($_GET['pageSize']); 
			$pageSize = $setPageSize;
		}else{
			$pageSize = Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);			
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
	 * @return Clientele the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	//默认继承的搜索条件
    public function defaultScope(){
    	$arr = parent::defaultScope();
    	$arr = array('order'=>'add_time DESC');
    	$arr['condition'] = ' status>0 AND fromid='.Tak::getFormid();
    	if (!Tak::checkSuperuser()) {

    	}
    	return $arr;
    }	


	//保存数据前
	protected function beforeSave(){
	    $result = parent::beforeSave();
	    if($result){
	        //添加数据时候
	        if ( $this->isNewRecord ){
	        	$arr = Tak::getOM();
	        	$this->itemid = $arr['itemid'];
	        	$this->manageid = $arr['manageid'];
	        	$this->add_us = $arr['manageid'];
	        	$this->add_time = $arr['time'];
	        	$this->add_ip = $arr['ip'];
	        	$this->fromid = $arr['fromid']; 
	        }else{
	        	//修改数据时候
	        	$arr = Tak::getOM();
	        	$this->modified_us = $arr['manageid'];
	        	$this->modified_time = $arr['time'];
	        	$this->modified_ip = $arr['ip'];
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
	public function del(){
		$this->status = 0;
		$this->save();
	}
	public function getM($id){

	}
}
