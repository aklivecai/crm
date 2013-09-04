<?php

/**
 * 这个模块来自表 "{{contact}}".
 *
 * 数据表的字段 '{{contact}}':
 * @property string $itemid
 * @property string $fromid
 * @property string $manageid
 * @property string $clienteleid
 * @property string $prsonid
 * @property string $type
 * @property integer $stage
 * @property string $contact_time
 * @property string $next_contact_time
 * @property string $next_subject
 * @property string $accessory
 * @property string $add_time
 * @property string $add_us
 * @property string $add_ip
 * @property string $modified_time
 * @property string $modified_us
 * @property string $modified_ip
 * @property string $note
 * @property integer $status
 */
class Contact extends ModuleRecord
{
	
	/**
	 * @return string 数据表名字
	 */
	public function tableName()
	{
		return '{{contact}}';
	}

	/**
	 * @return array validation rules for model attributes.字段校验的结果
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('clienteleid, prsonid', 'required'),
			array('stage, status', 'numerical', 'integerOnly'=>true),
			array(' add_us, modified_us', 'length', 'max'=>25),
			array('contact_time, next_contact_time, add_time, add_ip, modified_time, modified_ip', 'length', 'max'=>10),
			array('type', 'length', 'max'=>15),
			array('next_subject, accessory, note', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('itemid, fromid, manageid, clienteleid, prsonid, type, stage, contact_time, next_contact_time, next_subject, accessory, add_time, add_us, add_ip, modified_time, modified_us, modified_ip, note, status', 'safe', 'on'=>'search'),

			array('next_contact_time,contact_time','checkTime'),
		);
	}

	/**
	 * @return array relational rules. 表的关系，外键信息
	 */
	public function relations()
	{

		return array(
			'iClientele' => array(self::BELONGS_TO
				, 'Clientele'
				, 'clienteleid'
				,'condition'=>''
				,'order'=>''
				// ,'on'=>'iClientele.itemid=clienteleid'
				),
			'iContactpPrson' => array(self::BELONGS_TO
				, 'ContactpPrson'
				, 'prsonid'
				,'condition'=>''
				,'order'=>''
				 // ,'on'=>'prsonid=iContactpPrson.itemid'
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
				'clienteleid' => '客户编号',
				'prsonid' => '联系人编号',
				'type' => '类型', /*(电话,电子邮件,上门,邮寄,短信,其他)*/
				'stage' => '销售阶段', /*(1：初期沟通,2:立项评估,3:需求分析,4:方案制定,5:招投标,6:商务谈判,7:合同签订,8:得单,9:失单)*/
				'contact_time' => '联系时间',
				'next_contact_time' => '下次联系时间',
				'next_subject' => '下次议题',
				'accessory' => '附件',
				'add_time' => '添加时间',
				'add_us' => '添加人',
				'add_ip' => '添加IP',
				'modified_time' => '修改时间',
				'modified_us' => '修改人',
				'modified_ip' => '修改IP',
				'note' => '备注',

				'status' => '状态', /*(0:回收站,1:正常)*/
				'iContactpPrson.nicename' => '联系人',
				'iClientele.clientele_name' => '客户',
		);
	}

	public function search()
	{
		$cActive = parent::search();
		$criteria = $cActive->criteria;

		$criteria->compare('itemid',$this->itemid,true);
		$criteria->compare('fromid',$this->fromid,true);
		$criteria->compare('manageid',$this->manageid,true);
		$criteria->compare('clienteleid',$this->clienteleid,true);
		$criteria->compare('prsonid',$this->prsonid,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('stage',$this->stage);
		$criteria->compare('contact_time',$this->contact_time,true);
		$criteria->compare('next_contact_time',$this->next_contact_time,true);
		$criteria->compare('next_subject',$this->next_subject,true);
		$criteria->compare('accessory',$this->accessory,true);
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
	protected function beforeValidate(){
		return parent::beforeValidate();
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
