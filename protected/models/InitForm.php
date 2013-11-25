<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class InitForm extends CFormModel
{
	public $username;
	public $password;
	public $fromid;

	public function __construct()
	{
		parent::__construct();
	}	

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username, password,fromid', 'required'),
			// rememberMe needs to be a boolean
			// password needs to be authenticated
			array('fromid','fromiDecode'),
			array('password', 'authenticate'),
		);
	}

	public function fromiDecode($attribute,$params)
	{ 
		if(!$this->fromid){
			$this->addError('fromid','非法操作！！');
		}
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'username'=>'激活帐号',
			'password'=>'密码',
			'fromid'=>'商铺编号',
		);
	}

	public function authenticate($attribute,$params)
	{
		if($this->username!=$this->password||$this->username!='admin'){
			$str = '激活帐号或者密码错误！';
			$this->addError('password',$str);
		}
			
	}

	public function install($admin='admin',$password='c0b266594634df51f07796e7ca31107e'){
		$connection = Yii::app()->db;
		$transaction = $connection->beginTransaction();
		$sqls = array();
		try
		{
			$time = Tak::now();
			$itemid = Tak::fastUuid();
			$ip = Tak::IP2Num(Tak::getip());
			$arr = array(
				':time'=>$time,
				':ip'=>$ip,
				':userid'=>$itemid,
				':itemid'=>$itemid,
				':uname'=>$this->username,
				':fromid'=>$this->fromid,
				':tab_Manage'=>'{{manage}}',
				':tab_rabc'=>'{{rbac_authassignment}}',
				':tab_AddressG'=>'{{address_groups}}',
				':tab_AddressB'=>'{{address_book}}',
				':tab_type'=>'{{type}}',
				':tab_admin_log'=>'{{admin_log}}',
				':tab_test_memeber'=>'{{test_memeber}}',
			);
			
			//插入管理帐号
			$sqls[] = "INSERT INTO :tab_Manage VALUES(:fromid,:userid,'$admin','$password','gXmz','管理员','',:time,0,0,0,0,1,'','',0);";

		    //插入权限
		    $sqls[] = "INSERT INTO :tab_rabc (`itemname`,`fromid`,`userid`,`bizrule`,`data`) VALUES ('Admin',:fromid, :userid, '', 'N;');";

		    // #通讯录组
		    $sqls[] = "INSERT INTO :tab_AddressG (`address_groups_id`, `fromid`, `name`, `display`, `add_time`, `add_us`, `add_ip`, `modified_time`, `modified_us`, `modified_ip`, `note`, `listorder`, `status`) VALUES (:itemid, :fromid, '销售部', 0, :time, :userid, 0, 0, 0, 0, '', 0, 1);";

		    //#通讯录
		    $sqls[] = " INSERT INTO :tab_AddressB  (`itemid`, `groups_id`, `fromid`, `name`, `email`, `phone`, `address`, `department`, `position`, `sex`, `longitude`, `latitude`, `location`, `display`, `add_time`, `add_us`, `add_ip`, `modified_time`, `modified_us`, `modified_ip`, `note`, `status`) VALUES (:itemid, :itemid, 1, '张三', '', '', '', '', '业务经理', 1, '', '', '', 1, :time, :userid, 0, 0, 0, 0, '', 1);";

		    //产品分类
		    $sqls[] = " INSERT INTO :tab_type (`typeid`, `fromid`, `typename`, `item`, `listorder`) VALUES (:time, :fromid, '默认分类', 'product', 0);";

		    $sqls[] = " INSERT INTO :tab_admin_log (`itemid`, `fromid`, `manageid`, `user_name`, `qstring`, `info`, `ip`, `add_time`) VALUES (:userid, :fromid, :userid, ':uname', '', '激活初始化数据', :ip, :time);";

		    //开始激活用户时间
		    $sqls[] = " UPDATE :tab_test_memeber SET  `active_time` =  ':time' WHERE `itemid` = :fromid;";

		    foreach ($sqls as $value) {
		    	$sql = strtr($value,$arr);
		    	$connection->createCommand($sql)->execute();
		    }
		}
		catch(Exception $e) // 如果有一条查询失败，则会抛出异常
		{
		    $transaction->rollBack();
		    return false;
		}		
		return true;
	}
}
