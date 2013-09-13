<?php

/**
 * 这个模块来自表 "{{events}}".
 *
 * 数据表的字段 '{{events}}':
 * @property string $itemid
 * @property string $fromid
 * @property string $manageid
 * @property string $subject
 * @property string $email
 * @property string $start_time
 * @property string $end_time
 * @property string $color
 * @property string $text_color
 * @property string $location
 * @property string $url
 * @property string $type
 * @property string $priority
 * @property string $event_status
 * @property integer $display
 * @property integer $status
 * @property string $add_time
 * @property string $add_us
 * @property string $add_ip
 * @property string $modified_time
 * @property string $modified_us
 * @property string $modified_ip
 * @property string $note
 */
class Events extends ModuleRecord
{
	
	/**
	 * @return string 数据表名字
	 */
	public function tableName()
	{
		return '{{events}}';
	}
	public $priority = 0;
	public $event_status = 0;
	/**
	 * @return array validation rules for model attributes.字段校验的结果
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('subject', 'required'),
			array('display, status', 'numerical', 'integerOnly'=>true),
			array('itemid, add_us, modified_us', 'length', 'max'=>25),
			array('fromid, add_time, add_ip, modified_time, modified_ip', 'length', 'max'=>10),
			array('subject, location, url, note', 'length', 'max'=>255),
			array('email', 'length', 'max'=>128),
			array('color, text_color, type, priority, event_status', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('itemid, fromid, manageid, subject, email, start_time, end_time, color, text_color, location, url, type, priority, event_status, display, status, add_time, add_us, add_ip, modified_time, modified_us, modified_ip, note', 'safe', 'on'=>'search'),

			array('start_time,end_time','checkTime'),
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
				'subject' => '标题',
				'email' => '邮件',
				'start_time' => '开始时间',
				'end_time' => '结束时间',
				'color' => '背景颜色',
				'text_color' => '文字颜色',
				'location' => '位置',
				'url' => '跳转连接', /*(如联系客户,跳转到联系记录)*/
				'type' => '类型', /*(电话拜访,会议,电子邮件,上门拜访,邮寄,传真,短信,其他)*/
				'priority' => '等级',
				'event_status' => '状态 ', /*(已计划,处理中,未开始,未完成,延期,已完成)*/
				'display' => '显示', /*(0:自己,1：公共)*/
				'status' => '状态', /*(0:回收站,1:正常)*/
				'add_time' => '添加时间',
				'add_us' => '添加人',
				'add_ip' => '添加IP',
				'modified_time' => '修改时间',
				'modified_us' => '修改人',
				'modified_ip' => '修改IP',
				'note' => '备注',
		);
	}

	public function search()
	{
		$cActive = parent::search();
		$criteria = $cActive->criteria;

		$criteria->compare('itemid',$this->itemid,true);
		$criteria->compare('fromid',$this->fromid,true);
		$criteria->compare('manageid',$this->manageid,true);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('start_time',$this->start_time,true);
		$criteria->compare('end_time',$this->end_time,true);
		$criteria->compare('color',$this->color,true);
		$criteria->compare('text_color',$this->text_color,true);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('priority',$this->priority,true);
		$criteria->compare('event_status',$this->event_status,true);
		$criteria->compare('display',$this->display);
		$criteria->compare('status',$this->status);
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
	        if (!$this->end_time) {
				$date = date("Y-m-d",$this->start_time);
				$dayEnd = strtotime($date." 23:59:59");
	        	$this->end_time = $dayEnd ;
	        }
	    }
	    return $result;
	}

	public function getLink($itemid=false){
		if (!$itemid) {
			$itemid = $this->itemid;
		}		
		$link = Yii::app()->createUrl('events/view',array('id'=>$itemid));
		return $link;
	}

	public function getNextUrl(){
		$link = '';
		if ($this->url) {
			$link = CHtml::link('查看地址', $this->url);
		}	
		return $link;	
	}

	public function getHtmlLink($name=false,$itemid=false)
	{
		if (!$name) {
			$name = $this->subject;
		}
		$link = CHtml::link($name, $this->getLink($itemid));
		return $link;
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
