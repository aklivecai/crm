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
    public static function checkSuperuser(){
        return Yii::app()->user->checkAccess(Rights::module()->superuserName);
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
            array('label'=>Tk::g('Action'), 'icon'=>'fire', 'url'=>'', 'active'=>true),
            array('label'=>Tk::g('View'), 'icon'=>'eye-open'),
            array('label'=>Tk::g('Admin'), 'icon'=>'th','url'=>array('admin')),
            array('label'=>Tk::g('Create'), 'icon'=>'pencil','url'=>array('create')),
            array('label'=>Tk::g('Update'), 'icon'=>'edit','url'=>array('update', 'id'=>$itemid)),
            array('label'=>Tk::g('Delete'), 'icon'=>'trash','url'=>array('delete', 'id'=>$itemid),'linkOptions'=>array('class'=>'delete')),
        );
        return $items;    
    }
    public static function getListMenu(){
       $listMenu = array(  
            array(
              'icon' =>'isw-plus',
              'url' => array('create'),
              'label'=>Tk::g('Create'),
            )    
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
            ,array(
              'icon' =>'isw-refresh',
              'url' => Yii::app()->request->url,
              'label'=>Tk::g('Refresh'),
              'linkOptions'=>array('class'=>'refresh'),
            )    
        );        
       return $listMenu;    
    }   

    public static function searchData($key=false){
       $nowDate = date("Y").'-'.date("m").'-'.date("d");
       $now = time();
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

    public static function getMainMenu(){
        $items = array(  
            array(
              'icon' =>'isw-grid',
              'url' => array('/site/index'),
              'label'=>'<span class="text">主页</span>',
            ),
            array(
              'icon' =>'isw-users',
              'label'=>'<span class="text">员工</span>',
              'url'=>array('/manage/admin'),
               'visible'=>Yii::app()->user->checkAccess('Manage.Admin'),
              'items'=>array(
                array('icon'=>'th','label'=>'<span class="text">员工管理</span>',  'url'=>array('/manage/admin'),),
                array('icon'=>'plus','label'=>'<span class="text">员工录入</span>',  'url'=>array('/manage/create'),),
                array('icon'=>'trash','label'=>'<span class="text">回收站</span>',  'url'=>array('/manage/trashs'),),
              ),
            ), 
            array(
              'icon' =>'isw-users',
              'label'=>'<span class="text">客户</span>',
              'url'=>array('/clientele/admin'),
              'visible'=>Yii::app()->user->checkAccess('Market')||Yii::app()->user->checkAccess('Clientele.Admin'),
              'items'=>array(
                array('icon'=>'th','label'=>'<span class="text">客户管理</span>',  'url'=>array('/clientele/admin'),),
                array('icon'=>'plus','label'=>'<span class="text">客户录入</span>',  'url'=>array('/clientele/create'),),
                array('icon'=>'th','label'=>'<span class="text">联系人管理</span>',  'url'=>array('/contactpPrson/admin'),),
                array('icon'=>'plus','label'=>'<span class="text">联系人录入</span>',  'url'=>array('/contactpPrson/create'),),
                array('icon'=>'th','label'=>'<span class="text">联系记录</span>',  'url'=>array('/contact/admin'),),
                array('icon'=>'trash','label'=>'<span class="text">回收站</span>',  'url'=>array('/clientele/trashs'),),
              ),
            ), 
            array(
              'icon' =>'isw-archive',
              'label'=>'<span class="text">通讯录</span>',
              'visible'=>Yii::app()->user->checkAccess('AddressBook.Admin'),
              'items'=>array(
                array('icon'=>'th-list','label'=>'<span class="text">通讯录管理</span>', 'url'=>array('/addressBook/admin')),
                array('icon'=>'plus','label'=>'<span class="text">通讯录录入</span>',  'url'=>array('/addressBook/create'),),
                array('icon'=>'th-list','label'=>'<span class="text">部门管理</span>', 'url'=>array('/AddressGroups/admin')),
                array('icon'=>'plus','label'=>'<span class="text">部门录入</span>',  'url'=>array('/AddressGroups/create'),),
              ),
            ),
            array(
              'visible'=>Yii::app()->user->checkAccess('Events.Admin'),
              'icon' =>'isw-calendar',
              'label'=>'<span class="text">行程</span>',
              'url'=>array('/events/index'),
              'visible'=>Yii::app()->user->checkAccess('Events.Admin'),
              'items'=>array(
                array('icon'=>'th-list','label'=>'<span class="text">行程管理</span>', 'url'=>array('/events/index')),
                array('icon'=>'plus','label'=>'<span class="text">行程录入</span>',  'url'=>array('/events/create'),),
                array('icon'=>'trash','label'=>'<span class="text">回收站</span>',  'url'=>array('/events/trashs'),),
              ),
            ), 
            array(
              'visible'=>Yii::app()->user->checkAccess('File.Admin'),
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
                array('icon'=>'trash','label'=>'<span class="text">回收站</span>',  'url'=>array('/file/trashs'),),
              ),
            ), 
            array(
              'visible'=>Yii::app()->user->checkAccess('Order.Admin'),
              'icon' =>'isb-list',
              'label'=>'<span class="text">订单</span>',
              'url'=>array('/order/index'),
              'items'=>array(
                array('icon'=>'shopping-cart','label'=>'<span class="text">订单管理</span>', 'url'=>array('/order/index')),
                array('icon'=>'th','label'=>'<span class="text">发货管理</span>',  'url'=>array('/order/create'),),
                array('icon'=>'th','label'=>'<span class="text">订单留言</span>',  'url'=>array('/order/create'),),
                array('icon'=>'trash','label'=>'<span class="text">回收站</span>',  'url'=>array('/order/trashs'),),
              ),
            ), 

            array(
              'visible'=>Yii::app()->user->checkAccess('Invite.Admin'),
              'icon' =>'isb-tag',
              'label'=>'<span class="text">招标</span>',
              'url'=>array('/invite/index'),
              'visible'=>Yii::app()->user->checkAccess('Invite.Admin'),
              'items'=>array(
                array('icon'=>'th-list','label'=>'<span class="text">招标管理</span>', 'url'=>array('/invite/index')),
                array('icon'=>'plus','label'=>'<span class="text">招标录入</span>',  'url'=>array('/invite/create'),),
                array('icon'=>'star','label'=>'<span class="text">投标记录</span>',  'url'=>array('/invite/create'),),
                array('icon'=>'trash','label'=>'<span class="text">回收站</span>',  'url'=>array('/invite/trashs'),),
              ),
            ),   
            array(
              'visible'=>Yii::app()->user->checkAccess('Job.Admin'),
              'icon' =>'isb-graph',
              'label'=>'<span class="text">招聘</span>',
              'url'=>array('/job/index'),
              'items'=>array(
                array('icon'=>'th-list','label'=>'<span class="text">招聘管理</span>', 'url'=>array('/job/index')),
                array('icon'=>'plus','label'=>'<span class="text">招聘录入</span>',  'url'=>array('/job/create'),),
                array('icon'=>'bookmark','label'=>'<span class="text">收藏的简历</span>',  'url'=>array('/job/create'),),
                array('icon'=>'fire','label'=>'<span class="text">收到的简历</span>',  'url'=>array('/job/create'),),
                array('icon'=>'trash','label'=>'<span class="text">回收站</span>',  'url'=>array('/file/trashs'),),
              ),
            ), 
            array(
              'visible'=>Yii::app()->user->checkAccess('Job.Admin'),
              'icon' =>'isb-documents',
              'label'=>'<span class="text">培训</span>',
              'url'=>array('/training/index'),
              'items'=>array(
                array('icon'=>'th-list','label'=>'<span class="text">培训管理</span>', 'url'=>array('/training/index')),
                array('icon'=>'list-alt','label'=>'<span class="text">文档</span>',  'url'=>array('/training/doc'),),
                array('icon'=>'facetime-video','label'=>'<span class="text">视频</span>',  'url'=>array('/job/video'),),
                array('icon'=>'music','label'=>'<span class="text">音频</span>',  'url'=>array('/training/music'),),
                array('icon'=>'trash','label'=>'<span class="text">回收站</span>',  'url'=>array('/training/trashs'),),
              ),
            ),           
          );  
        if (self::checkSuperuser()) {
         $items[] = array(
                      'icon' =>'isw-settings',
                      'label'=>'<span class="text">管理中心</span>',
                      'items'=>array(
                        array('icon'=>'wrench','label'=>'<span class="text">网站设置</span>', 'url'=>array('/events/index')),
                        array('icon'=>'list-alt','label'=>'<span class="text">网站日志</span>',  'url'=>array('/adminLog/index'),),
                        array('icon'=>'fire','label'=>'<span class="text">网站备份</span>',  'url'=>array('/site/back'),),
                        array('icon'=>'trash','label'=>'<span class="text">回收站</span>',  'url'=>array('/events/trashs'),),
                      ),
                    );
         $items[] = array(
                       'icon' =>'isw-user',
                      'label'=>'<span class="text">权限管理</span>', 
                      'url'=>array('/rights/assignment/view'), 
                    );
        } 
         $items[] = array(
                       'icon' =>'isw-zoom',
                      'label'=>'<span class="text">帮助中心</span>', 
                      'url'=>array('/site/help'), 
                    );
        return $items;          
    }

    public static function getAdminPageCol($arr=false,$gid='list-grid',$width='60px'){
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

     return $items;         
    }
}  
