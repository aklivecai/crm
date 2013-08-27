<?php  
class Tak {  
    public static function KD($msg,$isexit=false){
        if (is_array($msg)||is_object($msg)){
            echo  "<pre>";
            print_r($msg);
            echo  "<pre>";
        }else{ 
            $str = $msg;
            $str = mb_convert_encoding($str,'gbk','UTF-8');
            echo "<h1>$str</h1>";
        }
        if ($isexit) exit;
    }
    public static function getAdmin(){
        return Yii::app()->user->fromid==1;
    }
    public static function getFormid(){
        return Yii::app()->user->fromid;
    }
    /*加密数字*/
    public static function setCryptKey($str){
        $key = new TakCrypt();
        return $key->encode($str);
    }
    /*解密数字*/
    public static function getCryptKey($str){
        $key = new TakCrypt();
        return $key->decode($str);
    }
    /*日期显示*/
    public static function timetodate($time = 0, $type = 6) {
        if(!$time) return '';
        $types = array('Y-m-d', 'Y', 'm-d', 'Y-m-d', 'm-d H:i', 'Y-m-d H:i', 'Y-m-d H:i:s');
        if(isset($types[$type])) $type = $types[$type];
        return date($type, $time);
    }
    /*获取操作数*/
    public static function getOM(){

        $ip = Yii::app()->user->getState('ip')!=''?Yii::app()->user->getState('ip'):false;
        if (!$ip) {
            $ip = self::getip();
            $ip = self::IP2Num($ip);
            Yii::app()->user->setState('ip', $ip);   
        }
        // self::KD($ip);
        // self::KD($ip,1);
        $arr = array(
            'time' => self::now()
            ,'ip'  => $ip
            ,'itemid' => self::fastUuid()
        );
        return $arr;
    }
    /*获取当前时间*/
    public static function now(){
        return time();
    }
    /*唯一数字*/
    public static function fastUuid($suffix_len=3){
        //! 计算种子数的开始时间
        static $being_timestamp = 1336681180;// 2012-5-10

        $time = explode(' ', microtime());
        $id = ($time[1] - $being_timestamp) . sprintf('%06u', substr($time[0], 2, 6));
        if ($suffix_len > 0)
        {
            $id .= substr(sprintf('%010u', mt_rand()), 0, $suffix_len);
        }
        return $id;
    }   
    /*判断字符串是不是MD5加密的*/
    public static function isValidMd5($md5 ='')
    {
        return   preg_match('/^[a-f0-9]{32}$/', $md5);
    }
    /*网址判断*/
    public static function isUrl($str){
        return preg_match("/^http:\/\/[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&_~`@[\]\’:+!]*([^<>\"])*$/", $str);
    }       
    /*IP转成无符号数值*/
   public static function IP2Num($ip)
    {
        $result = '';
        if ($ip!='') {
            $result = bindec(decbin(ip2long($ip)));
        }
        return $result;
    }
    /*无符号转成IP地址*/
    public static function Num2IP($num){
        $result = '';
        if ($num!=''&&$num>0) {
            $result = long2ip($num); 
        }
        return $result;
    }  
   
    public static function getip(){
            static $realip = NULL;         
            if ($realip !== NULL){
                return $realip;
            }
            if (isset($_SERVER)){
                if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
                {
                    $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
                    /* 取X-Forwarded-For中第一个非unknown的有效IP字符串 */
                    foreach ($arr AS $ip)
                    {
                        $ip = trim($ip);         
                        if ($ip != 'unknown')
                        {
                            $realip = $ip;         
                            break;
                        }
                    }
                }
                elseif (isset($_SERVER['HTTP_CLIENT_IP']))
                {
                    $realip = $_SERVER['HTTP_CLIENT_IP'];
                }
                else
                {
                    if (isset($_SERVER['REMOTE_ADDR']))
                    {
                        $realip = $_SERVER['REMOTE_ADDR'];
                    }
                    else
                    {
                        $realip = '0.0.0.0';
                    }
                }
            }else{
                if (getenv('HTTP_X_FORWARDED_FOR')){
                    $realip = getenv('HTTP_X_FORWARDED_FOR');
                }elseif (getenv('HTTP_CLIENT_IP')){
                    $realip = getenv('HTTP_CLIENT_IP');
                }else{
                    $realip = getenv('REMOTE_ADDR');
                }
            }
         
            preg_match("/[\d\.]{7,15}/", $realip, $onlineip);
            $realip = !empty($onlineip[0]) ? $onlineip[0] : '0.0.0.0';
         
            return $realip;   
    }
}  