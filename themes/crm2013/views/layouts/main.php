<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<!--[if gt IE 8]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <![endif]-->
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<link rel="icon" type="image/ico" href="favicon.ico"/>
<link href="<?php echo yii::app()->theme->baseUrl;?>/css/stylesheets.css" rel="stylesheet" type="text/css" />
<!--[if lt IE 8]>
        <link href="<?php echo yii::app()->theme->baseUrl;?>/css/ie7.css" rel="stylesheet" type="text/css" />
<![endif]-->
<link rel='stylesheet' type='text/css' href='<?php echo yii::app()->theme->baseUrl;?>/css/fullcalendar.print.css' media='print' />

<script src='<?php echo yii::app()->theme->baseUrl;?>/js/plugins/jquery/jquery-ui-1.10.1.custom.min.js'></script>
<script src='<?php echo yii::app()->theme->baseUrl;?>/js/plugins/jquery/jquery-migrate-1.2.1.min.js'></script>
<script src='<?php echo yii::app()->theme->baseUrl;?>/js/plugins/jquery/jquery.mousewheel.min.js'></script>
<script src='<?php echo yii::app()->theme->baseUrl;?>/js/plugins/cookie/jquery.cookies.2.2.0.min.js'></script>


<script src='<?php echo yii::app()->theme->baseUrl;?>/js/plugins/fullcalendar/fullcalendar.min.js'></script>
<script src='<?php echo yii::app()->theme->baseUrl;?>/js/plugins/select2/select2.min.js'></script>
<script src='<?php echo yii::app()->theme->baseUrl;?>/js/plugins/uniform/uniform.js'></script>


<!-- 滚动条 -->

<script src='<?php echo yii::app()->theme->baseUrl;?>/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js'></script>

<!-- 弹窗 ，图片 -->
<script src='<?php echo yii::app()->theme->baseUrl;?>/js/plugins/fancybox/jquery.fancybox.pack.js'></script>
<!-- 消息提示 -->
<script src='<?php echo yii::app()->theme->baseUrl;?>/js/plugins/pnotify/jquery.pnotify.min.js'></script>
<!-- 美化按钮 -->
<script src='<?php echo yii::app()->theme->baseUrl;?>/js/plugins/ibutton/jquery.ibutton.min.js'></script>

<script src='<?php echo yii::app()->theme->baseUrl;?>/js/plugins/scrollup/jquery.scrollUp.min.js'></script>

<script src='<?php echo yii::app()->theme->baseUrl;?>/js/cookies.js'></script>
<script src='<?php echo yii::app()->theme->baseUrl;?>/js/actions.js'></script>
<script src='<?php echo yii::app()->theme->baseUrl;?>/js/plugins.js'></script>
<script src='<?php echo yii::app()->theme->baseUrl;?>/js/settings.js'></script>

   <?php Yii::app()->bootstrap->register(); ?>  
<style type="text/css" media="screen">
.logo span{
  color: #FFF;
  font: bold 20px/25px '黑体';
}  
.header{background-color: #DDC;}
.breadLine{background-color: #ECECEC;}
.breadcrumb {
  padding:0 15px;
  background:none;
}
.row-form input[type="text"],
.row-form input[type="password"], 
.row-form textarea{height: 35px;}

.form-horizontal .control-group{margin-bottom:8px;}

.block-fluid .grid-view{
  padding-top:0;
} 

.admin ul.control{
  width:120px;
  float: right;
}
.admin .image{
  width:80px;
}
.img-polaroid{
  padding:0;
}

ul.yiiPager .first, ul.yiiPager .last {
display: inline;
}
</style>
</head>

<body>
<div class="wrapper">
  <div class="header"> <a class="logo" href="" title="<?php echo CHtml::encode(Yii::app()->name); ?>">
  <span>
  <?php echo CHtml::encode(Yii::app()->name); ?>
  </span></a>
    <ul class="header_menu">
      <li class="list_icon"><a href="#">&nbsp;</a></li>
      <li class="settings_icon"> <a href="#" class="link_themeSettings">&nbsp;</a>
        <div id="themeSettings" class="popup">
          <div class="head clearfix">
            <div class="arrow"></div>
            <span class="isw-settings"></span> <span class="name">主题设置</span> </div>
          <div class="body settings">
            <div class="row-fluid">
              <div class="span3"><strong>颜色:</strong></div>
              <div class="span9"> <a class="styleExample active" title="Default style" data-style="">&nbsp;</a> <a class="styleExample silver " title="Silver style" data-style="silver">&nbsp;</a> <a class="styleExample dark " title="Dark style" data-style="dark">&nbsp;</a> <a class="styleExample marble " title="Marble style" data-style="marble">&nbsp;</a> <a class="styleExample red " title="Red style" data-style="red">&nbsp;</a> <a class="styleExample green " title="Green style" data-style="green">&nbsp;</a> <a class="styleExample lime " title="Lime style" data-style="lime">&nbsp;</a> <a class="styleExample purple " title="Purple style" data-style="purple">&nbsp;</a> </div>
            </div>
            <div class="row-fluid">
              <div class="span3"><strong>背景:</strong></div>
              <div class="span9"> <a class="bgExample active" title="Default" data-style="">&nbsp;</a> <a class="bgExample bgCube " title="Cubes" data-style="cube">&nbsp;</a> <a class="bgExample bghLine " title="Horizontal line" data-style="hline">&nbsp;</a> <a class="bgExample bgvLine " title="Vertical line" data-style="vline">&nbsp;</a> <a class="bgExample bgDots " title="Dots" data-style="dots">&nbsp;</a> <a class="bgExample bgCrosshatch " title="Crosshatch" data-style="crosshatch">&nbsp;</a> <a class="bgExample bgbCrosshatch " title="Big crosshatch" data-style="bcrosshatch">&nbsp;</a> <a class="bgExample bgGrid " title="Grid" data-style="grid">&nbsp;</a> </div>
            </div>
            <div class="row-fluid">
              <div class="span3"><strong>固定布局:</strong></div>
              <div class="span9">
                <input type="checkbox" name="settings_fixed" value="1"/>
              </div>
            </div>
            <div class="row-fluid">
              <div class="span3"><strong>隐藏 菜单:</strong></div>
              <div class="span9">
                <input type="checkbox" name="settings_menu" value="1"/>
              </div>
            </div>
          </div>
          <div class="footer">
            <button class="btn link_themeSettings" type="button">关闭</button>
          </div>
        </div>
      </li>
    </ul>
  </div>
  <div class="menu">
    <div class="breadLine">
      <div class="arrow"></div>
      <div class="adminControl active"> 欢迎，<?php echo Yii::app()->user->name;?> </div>
    </div>
    <div class="admin">
      <div class="image">
<?php $this->widget('application.components.GoogleQRCode', array(
    'size' => 82,
    'content' => Yii::app()->request->hostInfo.Yii::app()->request->getUrl(),
    'htmlOptions' => array('class' => 'img-polaroid')
));
?>
      </div>
      <ul class="control">
        <li><span class="icon-comment"></span> <a href="messages.html">消息</a> <a href="messages.html" class="caption red">12</a></li>
        <li><span class="icon-cog"></span> <a href="forms.html">设置</a></li>
        <li><span class="icon-share-alt"></span> <a href="<?php echo $this->createUrl('/site/logout',array('id'=>100))?>" class="logout">退出</a></li>
      </ul>
      <div class="info"> <span>上一次登录：<?php echo Yii::app()->user->last_login_time;?></span> </div>
    </div>
    <?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'list',
    'items'=>array(
        array('label'=>'LIST HEADER'),
        array('label'=>'Home', 'icon'=>'home', 'url'=>'#', 'active'=>true),
        array('label'=>'Library', 'icon'=>'book', 'url'=>'#'),
        array('label'=>'Application', 'icon'=>'pencil', 'url'=>'#'),
        array('label'=>'ANOTHER LIST HEADER'),
        array('label'=>'Profile', 'icon'=>'user', 'url'=>'#'),
        array('label'=>'Settings', 'icon'=>'cog', 'url'=>'#'),
        array('label'=>'Help', 'icon'=>'flag', 'url'=>'#',
          'items' => array(
              array('label'=>'Profile', 'icon'=>'user', 'url'=>'#'),
              
            array('label'=>'LIST HEADER'),
            array('label'=>'Home', 'icon'=>'home', 'url'=>'#', 'active'=>true),
            array('label'=>'Library', 'icon'=>'book', 'url'=>'#'),
            array('label'=>'Application', 'icon'=>'pencil', 'url'=>'#'),
            array('label'=>'ANOTHER LIST HEADER'),
            array('label'=>'Profile', 'icon'=>'user', 'url'=>'#'),
            array('label'=>'Settings', 'icon'=>'cog', 'url'=>'#'),              
            )
        ),
    ),
)); ?>

<?php $this->widget('application.components.MyMenu', array(
    'activateItemsOuter'=>false,
    'linkLabelWrapper' => 'span',
    'activateItems' => true,
    'id' => 'search-type',  // using class =>'search-type' fires an exception! 
 
 
    'htmlOptions' => array('class'=>'search-type'), 
    'items' => array(
       array('label' => 'Home', 'url' => array('/site/index')),
       array('label' => 'Add Your Business', 'url' => array('bdlisting/create')),
    ),
));
?>
<?php
$this->widget('zii.widgets.CMenu', array(
  'items'=>array(
    array(
      'label'=>'创建提醒', 
      'url'=>array('/post/create'), 
      'visible'=>Yii::app()->user->checkAccess('Post.Create')
    ),
    array(
      'label'=>'提醒管理', 
      'url'=>array('/post/admin'), 
      'visible'=>Yii::app()->user->checkAccess('Post.Admin')
    ),
    array(
      'label'=>'录入员工', 
      'url'=>array('/manage/create'), 
      'visible'=>Yii::app()->user->checkAccess('Manage.Create')
    ),
    array(
      'label'=>'员工管理', 
      'url'=>array('/manage/admin'), 
      'visible'=>Yii::app()->user->checkAccess('Manage.Admin')
    ),
    array(
      'label'=>'录入通讯录', 
      'url'=>array('/clientele/create'), 
      'visible'=>Yii::app()->user->checkAccess('Clientele.Create')
    ),
    array(
      'label'=>'通讯录', 
      'url'=>array('/clientele/admin'), 
      'visible'=>Yii::app()->user->checkAccess('Clientele.Admin')
    ),
    array(
      'label'=>'操作日志',
      'url'=>array('/adminLog/'),
      'visible'=>Yii::app()->user->checkAccess('AdminLog.Admin'),
    )
    ,
    array(
      'label'=>Yii::t('blog', '填写评论 (:commentCount)', array(':commentCount'=>Comment::model()->pendingCommentCount)), 
      'url'=>array('/comment/index'), 'visible'=>Yii::app()->user->checkAccess('Comment.Approve')
    ),
    array(
      'label'=>'退出系统', 
      'url'=>array('/site/logout'), 
      'visible'=>!Yii::app()->user->isGuest
    ),
  ),
));
?>
  <div id="mainmenu">
    <?php 
    $arr = array(

/*        array('label'=>'主页', 'url'=>array('/post/index')),
        array('label'=>'关于我们', 'url'=>array('/site/page', 'view'=>'about')),
        array('label'=>'留言联系', 'url'=>array('/site/contact')),*/

        array('label'=>'员工管理', 'url'=>array('/manage/')),
        array('label'=>'操作日志', 'url'=>array('/adminLog/')),
        array('label'=>'权限配置', 'url'=>array('/rights'), 'visible'=>Yii::app()->user->checkAccess(Rights::module()->superuserName)),
    );
    if (Yii::app()->user->isGuest) {
      array_push($arr
        ,array('label'=>'登录1', 'url'=>array('/site/login&itemid=8ea92f73rwL650UE0THAhVCQZWCVIFBgdMQhw')));
      array_push($arr
        ,array('label'=>'登录2', 'url'=>array('/site/login&itemid=d6171dda1ujebKBE0bSgAGCQcFBAZSVgRKRR0')));
      array_push($arr
        ,array('label'=>'登录3', 'url'=>array('/site/login&itemid=27123dd0fMZe3oCklARgQDVVUHUwkICABIRRg')));
    }else{
      array_push($arr
        ,array('label'=>'退出 ('.Yii::app()->user->name.'_'.Yii::app()->user->fromid.')', 'url'=>array('/site/logout')));       
    }
    $this->widget('zii.widgets.CMenu',array('items' => $arr)); ?>
  </div><!-- mainmenu -->
    <ul class="navigation">
      <li class="active"> <a href="index.html"><span class="isw-grid"></span><span class="text">主页</span> </a> </li>
      <li class="openable"> <a href="#"> <span class="isw-list"></span><span class="text">权限</span> </a>
        <ul>
          <li> <a href="#"> <span class="icon-th"></span><span class="text">UI Elements</span> </a> </li>
          <li> <a href="#"> <span class="icon-th-large"></span><span class="text">Widgets</span> </a> </li>
          <li> <a href="#"> <span class="icon-chevron-right"></span><span class="text">Buttons</span> </a> </li>
          <li> <a href="#"> <span class="icon-fire"></span><span class="text">Icons</span> </a> </li>
          <li> <a href="#"> <span class="icon-align-justify"></span><span class="text">Grid system</span> </a> </li>
        </ul>
      </li>
   
    </ul>
    <div class="dr"><span></span></div>
    <div class="widget-fluid">
      <div id="menuDatepicker"></div>
    </div>
    <div class="dr"><span></span></div>
    <div class="widget">
      <div class="input-append">
        <input id="appendedInputButton" style="width: 118px;" type="text">
        <button class="btn" type="button">搜索</button>
      </div>
    </div>
    <div class="dr"><span></span></div>
 
  </div>
  <div class="content">
    <div class="breadLine">
      <?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
					'links'=>$this->breadcrumbs,
				)); ?>
      <!-- breadcrumbs -->
      
      <ul class="buttons">
        <li> <a href="#" class="link_bcPopupList"><span class="icon-user"></span><span class="text">客户列表</span></a>
          <div id="bcPopupList" class="popup">
            <div class="head clearfix">
              <div class="arrow"></div>
              <span class="isw-users"></span> <span class="name">客户列表</span> </div>
            <div class="body-fluid users">
              <div class="item clearfix">
                <div class="image"><a href="#"><img src="#about" width="32"/></a></div>
                <div class="info"> <a href="#" class="name">张三</a> <span>online</span> </div>
              </div>
              <div class="item clearfix">
                <div class="image"><a href="#"><img src="#about" width="32"/></a></div>
                <div class="info"> <a href="#" class="name">Alexander</a> </div>
              </div>
            </div>
            <div class="footer">
              <button class="btn" type="button">快速录入</button>
              <button class="btn btn-danger link_bcPopupList" type="button">关闭</button>
            </div>
          </div>
        </li>
        <li> <a href="#" class="link_bcPopupSearch"><span class="icon-search"></span><span class="text">Search</span></a>
          <div id="bcPopupSearch" class="popup">
            <div class="head clearfix">
              <div class="arrow"></div>
              <span class="isw-zoom"></span> <span class="name">Search</span> </div>
            <div class="body search">
              <input type="text" placeholder="Some text for search..." name="search"/>
            </div>
            <div class="footer">
              <button class="btn" type="button">添加</button>
              <button class="btn btn-danger link_bcPopupSearch" type="button">关闭</button>
            </div>
          </div>
        </li>
      </ul>
    </div>
    <div class="workplace"> <?php echo $content; ?> </div>
  </div>
</div>
</body>
</html>