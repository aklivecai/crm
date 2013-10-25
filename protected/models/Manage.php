<?php

/**
 * This is the model class for table "{{Manage}}".
 *
 * The followings are the available columns in table '{{Manage}}':
 * @property string $fromid
 * @property long $manageid
 * @property string $user_name
 * @property string $user_pass
 * @property string $salt
 * @property string $user_nicename
 * @property string $user_email
 * @property string $add_time
 * @property string $add_ip
 * @property string $last_login_time
 * @property string $last_login_ip
 * @property integer $login_count
 * @property string $user_status
 * @property string $note
 * @property string $activkey
 * @property integer $active_time
 */
class Manage extends ModuleRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{Manage}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_name, user_pass', 'required'),
			array('login_count', 'numerical', 'integerOnly'=>true),
			array('user_name', 'length', 'max'=>60),
			array('user_pass', 'length', 'min'=>6),
			array('user_pass, user_nicename, activkey', 'length', 'max'=>64),
			array('salt, add_time, last_login_time', 'length', 'max'=>10),
			array('user_email', 'length', 'max'=>100),
			array('user_status', 'length', 'max'=>11),
			array('note', 'length', 'max'=>255),
			array('add_ip, last_login_ip', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_name, user_pass, salt, user_nicename, user_email, add_time, last_login_time, login_count, user_status, note,active_time', 'safe', 'on'=>'search'),

			array('user_name','authenticate'),
		);
	}

	//默认继承的搜索条件
    public function defaultScope()
    {
    	$arr = array('order'=>'add_time DESC',);
    	return $arr;
    }

	/**
	 * 检验用户名是否重复
	 */
	public function authenticate($attribute,$params)
	{
		$sql = ' LOWER(user_name)=:user_name AND fromid=:fromid ';
		$arr = array(':user_name' => strtolower($this->user_name));
		$arr[':fromid'] = $this->fromid?$this->fromid:Tak::getFormid();

		if ($this->manageid) {
			$sql .=' AND manageid<>:manageid ';
			$arr[':manageid'] = $this->manageid ;
		}
		// Tak::KD($arr,1);
		// 查找满足指定条件的结果中的第一行
		$m = $this->find($sql,$arr);
		if($m!=null)
			$this->addError('user_name','登录帐号 有重复');
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
		$criteria = new CDbCriteria;
		if (!Tak::getAdmin()) {
			$criteria->addCondition("fromid=".Tak::getFormid());
		}		

		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('user_nicename',$this->user_nicename,true);
		$criteria->compare('user_email',$this->user_email,true);
		$criteria->compare('add_time',$this->add_time,true);
		$criteria->compare('last_login_time',$this->last_login_time,true);
		$criteria->compare('login_count',$this->login_count);
		$criteria->compare('user_status',$this->user_status,true);
		$criteria->compare('note',$this->note,true);

		$pageSize = parent::getPageSize();

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array( 
				'pageSize' => $pageSize, 
			), 
		));
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	function del(){
		$result = false;
		if ($this->user_status!=0) {
			$this->user_status = 0;
			$this->save();
			$result = true;
		}
		return result;
	}

	public function attributeLabels()
	{
		return array(
			'fromid' => '平台会员ID',
			'manageid' => '管理员编号',
			'user_name' => '登录帐号',
			'user_pass' => '登录密码',
			'salt' => '登录检验码',
			'user_nicename' => '名字',
			'user_email' => '邮箱',
			'add_time' => '添加时间',
			'add_ip' => '添加IP',
			'last_login_time' => '最后登录',
			'last_login_ip' => '最后登录IP',
			'login_count' => '登录次数',
			'user_status' => '状态',
			'note' => '备注',
			'activkey' => '激活Key',
			'active_time' => '最后活动',
		);
	}
	
	//保存数据前
	protected function beforeSave(){
	    $result = true||parent::beforeSave(true);
	    if($result){
	        //添加数据时候
	        if ( $this->isNewRecord ){
	        	$arr = Tak::getOM();
	        	$this->manageid = $arr['itemid'];
	        	$this->add_time = $arr['time'];
	        	$this->add_ip = $arr['ip'];
	        	$this->fromid = $arr['fromid']; 
	        	$this->salt = $this->generateSalt();
	        	
	        	if (!$this->user_status) {
	        		$this->user_status = TakType::STATUS_DEFAULT;
	        	}
            	$this->user_pass = $this->hashPassword($this->user_pass, $this->salt);
	        }else{
	        //修改数据时候
	        	if (!Tak::isValidMd5($this->user_pass)) {
	        		$this->user_pass = $this->hashPassword($this->user_pass, $this->salt);
	        		
	        	}
			    if (!isset($this->user_status)) {
			    	$this->user_status = TakType::STATUS_DELETED;
			    }	        	

	        }
	    }
	    return $result;
	}

	//
	protected function afterSave(){
		parent::afterSave();
		// return $result;
	}

	public  function upActivkey()
	{
		$arr = Tak::getOM();
		$sql = " UPDATE :tableName SET
		    active_time = :active_time
		WHERE
			 fromid = :fromid
		     AND manageid = :manageid
		";
		$sql = strtr($sql,array(':tableName' => $this->tableName()
			,':active_time' => $arr['time']
			,':fromid' => $arr['fromid']
			,':manageid' => $arr['manageid']
		));
		$query = Yii::app()->db->createCommand($sql);
		$query->execute();	
		 AdminLog::log('退出操作');
		return true;

	}

	// 更新登录次数，时间信息
	public  function upLogin(){
		$arr = Tak::getOM();
		$sql = " UPDATE :tableName SET
		    last_login_ip = :last_login_ip
		    ,login_count = login_count+1
		    ,last_login_time = :last_login_time
		WHERE
			 fromid = :fromid
		     AND manageid = :manageid
		";
		$sql = strtr($sql,array(':tableName'=>$this->tableName()
			,':last_login_ip' => $arr['ip']
			,':last_login_time' => $arr['time']
			,':fromid' => $arr['fromid']
			,':manageid' => $arr['manageid']
		));
		$query = Yii::app()->db->createCommand($sql);
		$query->execute();	
		AdminLog::log('登录操作');
		return true;
	}	

    /**
     * Checks if the given password is correct.
     * @param string the password to be validated
     * @return boolean whether the password is valid
     */
    public function validatePassword($password)
    {
    	$chPass = $password;
    	if(!Tak::isValidMd5($password)){
    		$chPass = $this->hashPassword($password,$this->salt);
    	}
    	return $chPass===$this->user_pass;       
    }

    /**
     * Generates the password hash.
     * @param string password
     * @param string salt
     * @return string hash
     */
    public function hashPassword($password,$salt)
    {
        return md5($salt.$password);
    }

    /**
     * 生成一个激活Key
     * @return string
     */
    public function generateActivkey()
    {
        return md5(uniqid($this->user_name.$this->user_pass, true));
    }

    /**
     * 生成一个SALT码
     */
    public function generateSalt()
    {
        $seed = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";   //   输出字符集
        for( $i=0; $i<5; $i++)
            $seed = str_shuffle($seed);
        $salt = substr( $seed , 0, 4 );
        return  $salt;
    }
}	