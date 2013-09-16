<?php
class Clientele extends ModuleRecord
{
	
	/**
	 * @return string 数据表名字
	 */
	public function tableName()
	{
		return '{{clientele}}';
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

	//默认继承的搜索条件
    public function defaultScope()
    {
    	$arr = parent::defaultScope();
    	$condition = array($arr['condition']);
    	// $condition[] = 'display>0';
    	$arr['condition'] = join(" AND ",$condition);
    	return $arr;
    }

	public function search()
	{
		$cActive = parent::search();
		$criteria = $cActive->criteria;
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

		return $cActive;
	}
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}	

	public function getLink($itemid=false){
		if (!$itemid) {
			$itemid = $this->itemid;
		}		
		$link = Yii::app()->createUrl('clientele/view',array('id'=>$itemid));
		return $link;
	}	
	public function getHtmlLink($name=false,$itemid=false)
	{
		if (!$name) {
			$name = $this->clientele_name;
		}
		$link = CHtml::link($name, $this->getLink($itemid));
		return $link;
	}	
}
