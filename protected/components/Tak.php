<?php  
class Tak {  
    public static function KD($msg,$isexit=false){
        if (is_object($msg)){
            echo  "<pre>";
            print_r($msg);
            echo  "<pre>";
        }elseif(is_array($msg)){
                foreach ($msg as $key => $value) {
                    self::KD($value);
                }
                
        }else{ 
            $str = $msg;
            $str = mb_convert_encoding($str,'gbk','UTF-8');
            echo "<h1>$str</h1>";
        }
        if ($isexit) exit;
    }
    public static function checkSuperuser(){
        return Yii::app()->user->checkAccess(Rights::module()->superuserName);
    }
    public static function checkAccess($operation,$params=array(),$allowCaching=true){
        return Yii::app()->user->checkAccess($operation,$params);

    }
    public static function isGuest()
    {
        return Yii::app()->user->isGuest;
    }    
    public static function getAdmin(){
        return Yii::app()->user->fromid==1;
    }
    public static function getManageid(){
        $result = -1;
        if (isset(Yii::app()->user->id)) {
            $result = Yii::app()->user->id;
        }
        return  $result;
    }
    public static function getFormid(){
        $result = -1;
        if (isset(Yii::app()->user->fromid)) {
            $result = Yii::app()->user->fromid;
        }
        return  $result;
    }

    //随机数
   public static function createCode($codelen=4) {
        $charset = 'abcdefghkmnprstuvwxyzABCDEFGHKMNPRSTUVWXYZ23456789'; //随机因子
        $_len = strlen($charset)-1;
        $code = '';
        for ($i=0;$i<$codelen;$i++) {
                $code .= $charset[mt_rand(0,$_len)];
        }
        return $code;
    }    
    public static function formatNumber($num){
        $result = number_format($num,0,'',',');
        return $result;
    }

    public static function setCryptNum($str){
        $result = is_numeric($str);
        if ($result) {
            $result = base_convert($str, 10, 36);
                $arr = str_split($result);
                $length = count($arr);
                $str1 = self::createCode(1);
                $strb = $arr[$length-1];
                $arr[$length] = $strb;
                $arr[$length-1] = $str1;
            $result = join($arr);
            $result = strtoupper($result);
        }
        return $result;
    }

    public static function getCryptNum($str){
        // $result = !is_numeric($str)?strtolower($str):false;
        $result = strtolower($str);
        if ($result) {
            // self::KD($result);
                $arr = str_split($result);
                $length = count($arr)-1;
                $arr[$length-1] = $arr[$length];
                unset($arr[$length]);
            $result = join($arr);
// self::KD($result);
            $result = base_convert($result, 36, 10);
            if (!is_numeric($result)) {
                $result = false;;
            }
            // self::KD($result,1);
        }
        return $result;
    }

    public static function getRandTime(){
     //新时间截定义,基于世界未日2012-12-21的时间戳。 
        $endtime=1356019200;//2012-12-21时间戳 
        $curtime=time();//当前时间戳 
        $newtime=$curtime-$endtime;//新时间戳 
        $rand=rand(0,99);//两位随机 
        $all=$rand.$newtime; 
        return $all;
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
    public static function timetodate($time = 0, $type = 0) {
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
            ,'manageid' => self::getManageid()
            ,'fromid' => self::getFormid()
        );
        return $arr;
    }

    /*获取当前时间*/
    public static function now(){
        return time();
    }

    /*获取时间结束一天*/
    public static function getDayEnd($time=false){
        if (!$time) {
            $time = time();
        }
        $date = date("Y-m-d",$time);
        $dayEnd = strtotime($date." 23:59:59");
        return $dayEnd;
    }

    public static function getDateTop($key=false){
        $t = time(); 
        $t1 = mktime(0,0,0,date("m",$t),date("d",$t),date("Y",$t)); 
        $t2 = mktime(0,0,0,date("m",$t),1,date("Y",$t)); 
        $t3 = mktime(0,0,0,date("m",$t)-1,1,date("Y",$t)); 
        $t4 = mktime(0,0,0,1,1,date("Y",$t)); 
        $e1 = mktime(23,59,59,date("m",$t),date("d",$t),date("Y",$t)); 
        $e2 = mktime(23,59,59,date("m",$t),date("t"),date("Y",$t)); 
        $e3 = mktime(23,59,59,date("m",$t)-1,date("t",$t3),date("Y",$t)); 
        $e4 = mktime(23,59,59,12,31,date("Y",$t)); 
       $datas =array(
        'd'=>array(
            'name' =>'今天',
            'start' => $t1,
            'end' => $e1,
        ),
        'm'=>array(
            'name' =>'这个月',
            'start'=> $t2,
            'end' => $e2,
        ),
        'y'=>array(
            'name' =>'今年',
            'start'=> $t4,
            'end' => $e4,
        ),);  

        if ($key) {
            return isset($datas[$key])?$datas[$key]:false;
        }else{
            return $datas;
        }           

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
        return  preg_match('/^[a-f0-9]{32}$/', $md5);
    }

    /*网址判断*/
    public static function isUrl($str){
        return preg_match("/^http:\/\/[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&_~`@[\]\’:+!]*([^<>\"])*$/", $str);
    }  

    /*判断一个数字是不是 时间数
         return ( 1 === preg_match( '~^[1-9][0-9]*$~', $string ) );
         return if (preg_match('/[0-9]{4}-[0-9]{2}-[0-9]{2}/', $timestamp));
         return date("Y") - date("Y", strtotime($date));
         return preg_match('/[^\d]/', $str)&&strtotime($str)
    */
    public static function isTimestamp($timestamp) {
        $timestamp = (int)$timestamp;
        // self::KD(strtotime(date('Y-m-d H:i:s',$timestamp)));
        if(strtotime(date('Y-m-d H:i:s',$timestamp)) === $timestamp) {
            return $timestamp;
        } else return false;
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

    public static function giiColAdmin($col){
        $result = self::giiCol($col);
        if (!$result) {
            $result = strpos('::,status,display,modified_time,',",$col,")>0;
        }
        return $result;
    }

    public static function giiColNot($col){
        $result = self::giiCol($col);
        if (!$result) {
            $result = strpos('::,add_time,modified_time,last_time,',",$col,")>0;
        }
        return $result;  
    }

    public static function giiCol($col){
        $result = strpos('::,itemid,fromid,manageid,add_us,add_ip,modified_us,modified_ip,',",$col,")>0;
        return $result;
    }

    public static function getEditMenu($itemid,$isNewRecord=true){
           $items = array(  
                array(
                  'icon' =>'isw-edit',
                  'url' => 'javascript:;',
                  'label'=>Tk::g('Save'),
                  'linkOptions'=>array('class'=>'save','submit'=>array()),
                )
            );
            if ($isNewRecord) {
                $action = 'Create';
            }else{
                $action = 'Update';
                array_push($items
                    ,array(
                      'icon' =>'isw-zoom',
                      'url' => array('view','id'=>$itemid),
                      'label'=>Tk::g('View'),
                    )
                    ,array(
                      'icon' =>'isw-plus',
                      'url' => array('create'),
                      'label'=>Tk::g('Create New'),
                    )
                    ,array(
                      'icon' =>'isw-delete',
                      'url' => array('delete','id'=>$itemid),
                      'label'=>Tk::g('Delete'),
                      'linkOptions'=>array('class'=>'delete'),
                    )
                );
            }
            array_push($items
                ,array(
                  'icon' =>'isw-refresh',
                  'url' => Yii::app()->request->url,
                  'label'=>Tk::g('Refresh'),
                )
                ,array(
                  'icon' =>'isw-left',
                  'url' => ''.Yii::app()->request->urlReferrer,
                  'label'=>Tk::g('Return'),
                )
            ); 
        return $items;       
    }

    public static function getViewMenu($itemid){
        $items = array(
            'Action' => array('label'=>Tk::g('Action'), 'icon'=>'fire', 'url'=>'', 'active'=>true),
            'View' => array('label'=>Tk::g('View'), 'icon'=>'eye-open'),
            'Admin' => array('label'=>Tk::g('Admin'), 'icon'=>'th','url'=>array('admin')),
            'Create' => array('label'=>Tk::g('Create'), 'icon'=>'pencil','url'=>array('create')),
            'Update' => array('label'=>Tk::g('Update'), 'icon'=>'edit','url'=>array('update', 'id'=>$itemid)),
            'Delete' => array('label'=>Tk::g('Delete'), 'icon'=>'trash','url'=>array('delete', 'id'=>$itemid),'linkOptions'=>array('class'=>'delete')),
        );
        return $items;    
    }

    public static function getListMenu(){
       $listMenu = array(  
            'Create'=>array(
              'icon' =>'isw-plus',
              'url' => array('create'),
              'label'=>Tk::g('Create'),
            )
            );
       if(self::checkSuperuser()){
            $listMenu['Recycle'] = array(
              'icon' =>'isw-delete',
              'url' => array('recycle'),
              'label'=>Tk::g('Recycle'),
            );
        }
         /* ,array(
              'icon' =>'isw-edit',
              'url' => '#',
              'label'=>Tk::g('Update'),
              'linkOptions'=>array('class'=>'edit'),
            )    
            ,array(
              'icon' =>'isw-delete',
              'url' => '#',
              'label'=>Tk::g('Delete'),
              'linkOptions'=>array('class'=>'delete-select','submit'=>array('click'=>"$.fn.yiiGridView.update('menu-grid');")),
            )*/

         $listMenu['Refresh'] =array(
              'icon' =>'isw-refresh',
              'url' => Yii::app()->request->url,
              'label'=>Tk::g('Refresh'),
              'linkOptions'=>array('class'=>'refresh'),
            );
           
       return $listMenu;    
    }   

    public static function searchData($key=false){
       $nowDate = date("Y").'-'.date("m").'-'.date("d");
       $now = self::getDayEnd();
       $datas =array(
        '10'=>array(
            'name' =>'当天',
            'start' => strtotime($nowDate),
            'end' => $now,
        ),
        '20'=>array(
            'name' =>'最近三天',
            'start'=> strtotime("$nowDate -3 day"),
            'end' => $now,
        ),
        '30'=>array(
            'name' =>'最近一周',
            'start'=> strtotime("$nowDate -1 week"),
            'end' => $now,
        ),
        '40'=>array(
            'name' =>'最近半月',
            'start'=> strtotime("$nowDate -15 day"),
            'end' => $now,
        ),
        '50'=>array(
            'name' =>'最近一月',
            'start'=> strtotime("$nowDate -1 month"),
            'end' => $now,
        ),
        '60'=>array(
            'name' =>'最近两月',
            'start'=> strtotime("$nowDate -2 month"),
            'end' => $now,
        ),
        '70'=>array(
            'name' =>'最近三月',
            'start'=> strtotime("$nowDate -3 month"),
            'end' => $now,
        ),
        '80'=>array(
            'name' =>'最近六月',
            'start'=> strtotime("$nowDate -6 month"),
            'end' => $now,
        ),);  

        if ($key) {
            return isset($datas[$key])?$datas[$key]:false;
        }else{
            return $datas;
        }
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
    
    public static function getFileSrc($str){
        $path_info = pathinfo($str );  
        $extension = $path_info['extension'];
        $file1 = md5($str);
        $file2 = self::getPathBySplitStr($file1);

        self::KD($str);
        exit;
        $dir = Yii::app()->params['upload'].str_replace($file1,'',$file2);
        self::MkDirs($dir);
        $file2 .= '.'.$extension;
        file_put_contents($file2, file_get_contents($str));
        return $file2;
    }

    /*
       获取文件路径
        48d4cb4ef423f858a9576a4e75ecd598ae966a1d -- 48/d4/cb/4e/48d4cb4ef423f858a9576a4e75ecd598ae966a1d
    */
    public static function getPathBySplitStr($str) {
        $parts = str_split(substr($str,0,8), 2);
        $path = join("/", $parts);
        $path = $path . "/" . $str;
        return $path;
    }   

    /*
    生成目录
    */
    public static function MkDirs($dir, $mode = 0777, $recursive = true) {
        if (is_null($dir) || $dir == "") {
            return false;
        }
        if (is_dir($dir) || $dir == "/") {
            return true;
        }
        self::MkDirs(dirname($dir), $mode, $recursive);
        mkdir($dir,$mode);
        return false;
    }

    public static function get(){
        $auth=Yii::app()->authManager;

    }

    //左栏菜单 
    public static function getMainMenu(){
        $controlName = Yii::app()->getController()->id;
        $arr = array(
            'manage'=>'manage'
            ,'AddressBook'=>',AddressBook,AddressGroups,'
            ,'events'=>'events'
            ,'file'=>'file'
            ,'invite'=>',invite,'
            ,'job'=>',job,'
            ,'order'=>',order,'
            ,'training'=>',training,'
            ,'training'=>',training,'
            ,'clientele'=>',clientele,contactpPrson,contact,'
            ,'Pss'=>',purchase,stocks,product,sell,'
            );
        $items = array(
            array(
              'icon' =>'isw-grid',
              'url' => array('/site/index'),
              'label'=>'<span class="text">主页</span>',
            ),
            'manage' => array(
              'icon' =>'isw-users',
              'label'=>'<span class="text">'.Tk::g(array('Manage','Setting')).'</span>',
              'url'=>array('/manage/admin'),
               'visible'=>self::checkAccess('Manage.*'),
              'items'=>array(
                    array(
                       'icon' =>'user',
                      'label'=>'<span class="text">'.Tk::g(array('Manage','Permissions')).'</span>', 
                      'url'=>array('/rights/assignment/view'), 
                      'visible'=>self::checkSuperuser(),
                    ), 
                array('icon'=>'plus','label'=>'<span class="text">'.Tk::g(array('Create','Manage')).'</span>',  'url'=>array('/manage/create'),),               
                array('icon'=>'th','label'=>'<span class="text">'.Tk::g(array('Manage','Admin')).'</span>',  'url'=>array('/manage/admin'),),
                // array('icon'=>'trash','label'=>'<span class="text">'.Tk::g('Recycle').'</span>',  'url'=>array('/manage/recycle'),),
              ),
            ), 
            'clientele' => array(
              'icon' =>'isw-bookmark',
              'label'=>'<span class="text">我的客户</span>',
              'url'=>array('/clientele/admin'),
              'visible'=>self::checkAccess('Market')||self::checkAccess('Clientele.*'),
              'items'=>array(
                array('icon'=>'plus','label'=>'<span class="text">'.Tk::g(array('Clientele','Create')).'</span>',  'url'=>array('/clientele/create'),),
                array('icon'=>'th','label'=>'<span class="text">'.Tk::g(array('Clientele','Admin')).'</span>',  'url'=>array('/clientele/admin'),
                ),
                array('icon'=>'th','label'=>'<span class="text">联系人管理</span>',  'url'=>array('/contactpPrson/admin'),),
                array('icon'=>'th','label'=>'<span class="text">联系记录</span>',  'url'=>array('/contact/adminGroup'),),
                array('icon'=>'trash','label'=>'<span class="text">'.Tk::g('Recycle').'</span>',  'url'=>array('/clientele/recycle'),),
              ),
            ), 
            'addressbook' => array(
              'icon' =>'isw-archive',
              'label'=>'<span class="text">通讯录</span>',
              'visible'=>self::checkAccess('AddressBook.Admin'),
              'items'=>array(
                array('icon'=>'plus','label'=>'<span class="text">'.Tk::g('Create').'部门</span>',  'url'=>array('/AddressGroups/admin'),),
                array('icon'=>'plus','label'=>'<span class="text">'.Tk::g(array('Create','AddressBook')).'</span>',  'url'=>array('/addressBook/create'),),
                array('icon'=>'th-list','label'=>'<span class="text">'.Tk::g(array('Admin','AddressBook')).'</span>', 'url'=>array('/addressBook/admin')),
              ),
            ),
            'events' => array(
              'visible'=>self::checkAccess('Events.*'),
              'icon' =>'isw-calendar',
              'label'=>'<span class="text">'.Tk::g('Events').'事项</span>',
              'url'=>array('/events/index'),
              'items'=>array(
                array('icon'=>'th-list','label'=>'<span class="text">'.Tk::g(array('Events','Admin')).'</span>', 'url'=>array('/events/admin')),
                array('icon'=>'plus','label'=>'<span class="text">'.Tk::g('Events').'事项</span>',  'url'=>array('/events/create'),),
                // array('icon'=>'trash','label'=>'<span class="text">'.Tk::g('Recycle').'</span>',  'url'=>array('/events/recycle'),),
              ),
            ), 
           'file' => array(
              'visible'=>self::checkAccess('File.*'),
              'icon' =>'isb-cloud',
              'label'=>'<span class="text">具云盘</span>',
              'url'=>array('/file/index'),
              'items'=>array(
                array('icon'=>'hdd','label'=>'<span class="text">全部文档</span>', 'url'=>array('/file/index')),
                array('icon'=>'picture','label'=>'<span class="text">图片</span>', 'url'=>array('/file/image')),
                array('icon'=>'file','label'=>'<span class="text">文档</span>', 'url'=>array('/file/image')),
                array('icon'=>'film','label'=>'<span class="text">视频</span>', 'url'=>array('/file/video')),
                array('icon'=>'tasks','label'=>'<span class="text">其他</span>', 'url'=>array('/file/other ')),
                array('icon'=>'plus','label'=>'<span class="text">文件上传</span>',  'url'=>array('/file/create'),),
                array('icon'=>'trash','label'=>'<span class="text">'.Tk::g('Recycle').'</span>',  'url'=>array('/file/recycle'),),
              ),
            ), 
            
           'pss' => array(
              'visible'=>self::checkAccess('Pss.*')||self::checkAccess('Product.*'),
              'icon' =>'isw-list',
              'label'=>'<span class="text">库存管理</span>',
              'url'=>array('/pss/index'),
              'items'=>array(
                    array('icon'=>'th','label'=>'<span class="text">产品分类</span>',  'url'=>array('takType/admin?type=product'),),
                 array('icon'=>'th','label'=>'<span class="text">货物名称</span>',  'url'=>array('/product/admin'),),

                array('icon'=>'th','label'=>'<span class="text">入库录入</span>', 'url'=>array('/purchase/admin')),
                array('icon'=>'th','label'=>'<span class="text">出库录入</span>',  'url'=>array('/sell/admin'),),
                    array('icon'=>'th','label'=>'<span class="text">'.Tk::g('Stocks').'</span>',  'url'=>array('/stocks/admin'),),
              ),
            ), 
           'order' => array(
              'visible'=>self::checkAccess('Order.*'),
              'icon' =>'isb-lock',
              'label'=>'<span class="text">订单</span>',
              'url'=>array('/site/order'),
              'items'=>array(
                array('icon'=>'shopping-cart','label'=>'<span class="text">订单管理</span>', 'url'=>array('/site/order')),
                array('icon'=>'th','label'=>'<span class="text">发货管理</span>',  'url'=>array('/site/order'),),
                array('icon'=>'th','label'=>'<span class="text">订单留言</span>',  'url'=>array('/site/order'),),
                array('icon'=>'trash','label'=>'<span class="text">'.Tk::g('Recycle').'</span>',  'url'=>array('/site/order'),),
              ),
            ), 

            'invite' => array(
              'visible'=>self::checkAccess('Invite.*'),
              'icon' =>'isb-tag',
              'label'=>'<span class="text">招标</span>',
              'url'=>array('/invite/index'),
              'items'=>array(
                array('icon'=>'th-list','label'=>'<span class="text">招标管理</span>', 'url'=>array('/invite/index')),
                array('icon'=>'plus','label'=>'<span class="text">招标录入</span>',  'url'=>array('/invite/create'),),
                array('icon'=>'star','label'=>'<span class="text">投标记录</span>',  'url'=>array('/invite/create'),),
                array('icon'=>'trash','label'=>'<span class="text">'.Tk::g('Recycle').'</span>',  'url'=>array('/invite/recycle'),),
              ),
            ),   
           'job' => array(
              'visible'=>self::checkAccess('Job.*'),
              'icon' =>'isb-graph',
              'label'=>'<span class="text">招聘</span>',
              'url'=>array('/job/index'),
              'items'=>array(
                array('icon'=>'th-list','label'=>'<span class="text">招聘管理</span>', 'url'=>array('/job/index')),
                array('icon'=>'plus','label'=>'<span class="text">招聘录入</span>',  'url'=>array('/job/create'),),
                array('icon'=>'bookmark','label'=>'<span class="text">收藏的简历</span>',  'url'=>array('/job/create'),),
                array('icon'=>'fire','label'=>'<span class="text">收到的简历</span>',  'url'=>array('/job/create'),),
                array('icon'=>'trash','label'=>'<span class="text">'.Tk::g('Recycle').'</span>',  'url'=>array('/file/recycle'),),
              ),
            ), 
          'training' => array(
              'visible'=>self::checkAccess('Training.*'),
              'icon' =>'isb-documents',
              'label'=>'<span class="text">培训</span>',
              'url'=>array('/training/index'),
              'items'=>array(
                array('icon'=>'th-list','label'=>'<span class="text">培训管理</span>', 'url'=>array('/training/index')),
                array('icon'=>'list-alt','label'=>'<span class="text">文档</span>',  'url'=>array('/training/doc'),),
                array('icon'=>'facetime-video','label'=>'<span class="text">视频</span>',  'url'=>array('/job/video'),),
                array('icon'=>'music','label'=>'<span class="text">音频</span>',  'url'=>array('/training/music'),),
                array('icon'=>'trash','label'=>'<span class="text">'.Tk::g('Recycle').'</span>',  'url'=>array('/training/recycle'),),
              ),
            ),           
          );  
        unset($items['file']);
        unset($items['job']);
        unset($items['invite']);
        unset($items['training']);
        unset($items['events']);
        if (self::checkSuperuser()) {
         $items[] = array(
                      'icon' =>'isw-settings',
                      'label'=>'<span class="text">管理中心</span>',
                      'items'=>array(
                        // array('icon'=>'wrench','label'=>'<span class="text">网站设置</span>', 'url'=>array('/settin/index')),
                        array('icon'=>'list-alt','label'=>'<span class="text">网站日志</span>',  'url'=>array('/adminLog/admin'),),
                        // array('icon'=>'fire','label'=>'<span class="text">网站备份</span>',  'url'=>array('/site/back'),),
                      ),
                    );
     }
         $items[] = array(
                       'icon' =>'isw-zoom',
                      'label'=>'<span class="text">帮助中心</span>', 
                      'url'=>array('/site/help'), 
                    );
         $items[] = array(
                       'icon' =>'isw-chat',
                      'label'=>'<span class="text">系统其他功能</span>', 
                      'url'=>Yii::app()->getBaseUrl().'/upload/functionality.jpg', 
                      'linkOptions'=>array('target'=>'_blank')
                    );
         $items[] = array(
                       'icon' =>'isw-target',
                      'label'=>'<span class="text">客户案例</span>', 
                      'url'=>'http://www.9juren.net/', 
                      'linkOptions'=>array('target'=>'_blank')
                    );

        $controlName = Yii::app()->getController()->id;  
        $controlName = strtolower($controlName);

        // Tak::KD(Yii::app()->getController(),1);
        // Tak::KD(Yii::app(),1);
        // Tak::KD($controlName);
        $tname = '';
        foreach ($arr as $key=>$value)
        {
            $key = strtolower($key);
            $value = strtolower($value);
            if ($controlName==$key||strpos($value,",$controlName,")!==false)
            {
                $tname = $key;
                break;
                
            }
        }
        if ($tname==''&&Yii::app()->getController()->breadcrumbs[0]=='授权') {
            $tname = 'manage';
        }
        if ($items[$tname])
        {
            $items[$tname]['active'] = true; 
        }
        return $items;          
    }

    public static function isRecycle(){
        $result = Yii::app()->getController()->getAction()->id == 'recycle';
        return $result;
    }

    public static function getAdminPageCol($arr=false
        ,$gid='list-grid',$width='60px'){
    
     $items = array(
             'class'=>'bootstrap.widgets.TbButtonColumn'
              ,'header' => CHtml::dropDownList('pageSize'
                    ,Yii::app()->user->getState('pageSize')
                    ,TakType::items('pageSize')
                    ,array(
                        'onchange'=>"$.fn.yiiGridView.update('".$gid."',{data:{setPageSize: $(this).val()}})", 
                        'style'=>'width: '.$width.' !important',
                    )   
              )             
        );
     if (is_array($arr)) {
         // self::KD($arr);
         $items = array_merge_recursive($items, $arr);
     }
     // '.Tk::g('Recycle').'
     // self::KD($control->id);
     if(self::isRecycle()){
        $newItems = array('template'=>'{restore} | {del}'
              ,'buttons'=>array(
                    'restore' => array
                    (
                        'label'=>'',
                         'url'=>'Yii::app()->controller->createUrl("restore", array("id"=>$data->primaryKey))',
                         'options'=>array('title'=>'还原','class'=>'icon-repeat'),
                    ),
                    'del' => array
                    (
                        'label'=>'',
                         'url'=>'Yii::app()->controller->createUrl("del", array("id"=>$data->primaryKey))',
                         'options'=>array('title'=>'彻底删除','class'=>'icon-remove'),
                    ),

              ),
            );
          // 'imageUrl'=>$this->{$id.'ButtonImageUrl'},
        $items = array_merge_recursive($items, $newItems);
     }

              


     return $items;         
    }

    public static function getTakTypes(){
        $arr = array();
        $arr['product'] = array(
            'name' => 'Product',
            'file' => 'product',   
            'type' => 'product',   

        );

        return $arr;
    }
    public static function getMovingsType($type){

       $types = array(1=>'Purchase',2=>'Sell');
       if ($types[$type]) {
          $type = $types[$type];
       }else{
        $type = current($types);
       }
       return $type;
    }
    
    public static function msg($msg,$title=''){
        Yii::app()->clientScript->registerScript('bodyend', "notify_s('$title','$msg')");        
    }

    public static function copyright(){
        $arr = array('<div class="hide">');
        $arr[] = Yii::app()->params['copyright'];
        $arr[].= '<script type="text/javascript">
            var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
            document.write(unescape("%3Cscript src=\'" + _bdhmProtocol + "hm.baidu.com/h.js%3Fd98411661088365a052727ec01efb9d8\' type=\'text/javascript\'%3E%3C/script%3E"));
        </script></div>';
        echo join($arr);
    }
}  
