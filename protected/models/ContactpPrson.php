<?php

/**
 * 这个模块来自表 "{{contactp_prson}}".
 *
 * 数据表的字段 '{{contactp_prson}}':
 * @property string $itemid
 * @property string $fromid
 * @property string $manageid
 * @property string $clientele
 * @property string $nicename
 * @property integer $sex
 * @property string $department
 * @property string $position
 * @property string $email
 * @property string $phone
 * @property string $mobile
 * @property string $fax
 * @property string $qq
 * @property string $address
 * @property string $last_time
 * @property string $add_time
 * @property string $add_us
 * @property string $add_ip
 * @property string $modified_time
 * @property string $modified_us
 * @property string $modified_ip
 * @property string $note
 * @property integer $status
 */
class ContactpPrson extends ModuleRecord
{
	
	/**
	 * @return string 数据表名字
	 */
	public function tableName()
	{
		return '{{contactp_prson}}';
	}

	/**
	 * @return array validation rules for model attributes.字段校验的结果
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nicename, clientele', 'required'),
			array('sex, status', 'numerical', 'integerOnly'=>true),
			array('itemid, add_us, modified_us', 'length', 'max'=>25),
			array('fromid, manageid, clientele, last_time, add_time, add_ip, modified_time, modified_ip', 'length', 'max'=>10),
			array('nicename', 'length', 'max'=>64),
			array('department, position', 'length', 'max'=>100),
			array('email, phone, mobile, fax, address, note', 'length', 'max'=>255),
			array('qq', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('itemid, fromid, manageid, clientele, nicename, sex, department, position, email, phone, mobile, fax, qq, address, last_time, add_time, add_us, add_ip, modified_time, modified_us, modified_ip, note, status', 'safe', 'on'=>'search'),
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
			'iClientele' => array(self::BELONGS_TO
				, 'Clientele'
				, 'clientele'
				,'condition'=>''
				,'order'=>''
				),
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
				'clientele' => '客户',
				'nicename' => '名字',
				'sex' => '性别',
				'department' => '部门',
				'position' => '职位', /*(也可以写工作工作描述)*/
				'email' => 'Email',
				'phone' => '办公电话',
				'mobile' => '手机',
				'fax' => '传真',
				'qq' => 'QQ',
				'address' => '联系地址',
				'last_time' => '最后联系时间', /*(客户联系记录中修改)*/
				'add_time' => '添加时间',
				'add_us' => '添加人',
				'add_ip' => '添加IP',
				'modified_time' => '修改时间',
				'modified_us' => '修改人',
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
		$criteria->compare('manageid',$this->manageid,true);
		$criteria->compare('clientele',$this->clientele,true);
		$criteria->compare('nicename',$this->nicename,true);
		$criteria->compare('sex',$this->sex);
		$criteria->compare('department',$this->department,true);
		$criteria->compare('position',$this->position,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('qq',$this->qq,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('last_time',$this->last_time,true);
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

	public function getUrl()
	{
		return Yii::app()->createUrl('contactpPrson/view', array(
			'itemid'=>$this->itemid,
			'title'=>$this->nicename,
		));
	}	

	//删除信息后
	protected function afterDelete(){
		parent::afterDelete();
	}	
}
