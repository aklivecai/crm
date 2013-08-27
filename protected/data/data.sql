PRAGMA foreign_keys=OFF;
BEGIN TRANSACTION;
CREATE TABLE [Tak_Admin_Log]
/* 管理日志 */
(
    [itemid] UNSIGNED BIGINT(25) NOT NULL ,/*col 编号 end*/
    [fromid] UNSIGNED INTEGER  NOT NULL ,/*col 平台会员ID end*/
    [user_name] VARCHAR(60)  NOT NULL ,/*col 登录帐号 end*/
    [qstring] VARCHAR(255) DEFAULT '' NOT NULL ,/*col 网址参数 end*/
    [info] VARCHAR(255) DEFAULT '' NOT NULL ,/*col 日志内容 end*/
    [ip] UNSIGNED INTEGER DEFAULT 0 NOT NULL ,/*col 添加IP end*/
    [add_time] UNSIGNED INTEGER(10) DEFAULT 0 NOT NULL ,/*col 添加时间 end*/
    PRIMARY KEY ([itemid])
);
INSERT INTO "Tak_Admin_Log" VALUES(40571606551837093,2,'admin','/github/yii/crm/index.php?r=site/logout','退出操作','127.0.0.1',1377252786);
INSERT INTO "Tak_Admin_Log" VALUES(40571613770080002,2,'admin','/github/yii/crm/index.php?r=site/login','登录操作','127.0.0.1',1377252793);
INSERT INTO "Tak_Admin_Log" VALUES(40571619164324094,2,'admin','/github/yii/crm/index.php?r=site/logout','退出操作','127.0.0.1',1377252799);
INSERT INTO "Tak_Admin_Log" VALUES(40571648355379070,2,'admin','/github/yii/crm/index.php?r=site/login','登录操作','127.0.0.1',1377252828);
INSERT INTO "Tak_Admin_Log" VALUES(40571670466666007,2,'admin','/github/yii/crm/index.php?r=manage/create','添加会员','127.0.0.1',1377252850);
INSERT INTO "Tak_Admin_Log" VALUES(40571833656080056,2,'admin','/github/yii/crm/index.php?r=manage/create','添加会员','127.0.0.1',1377253013);
INSERT INTO "Tak_Admin_Log" VALUES(40573714476196160,1,'admin','/github/yii/crm/index.php?r=site/logout','退出操作','127.0.0.1',1377254894);
INSERT INTO "Tak_Admin_Log" VALUES(40573718498471210,1,'demo','/github/yii/crm/index.php?r=site/login','登录操作','127.0.0.1',1377254898);
INSERT INTO "Tak_Admin_Log" VALUES(40573728746960148,1,'demo','/github/yii/crm/index.php?r=site/logout','退出操作','127.0.0.1',1377254908);
INSERT INTO "Tak_Admin_Log" VALUES(40573734404225100,1,'admin','/github/yii/crm/index.php?r=site/login','登录操作','127.0.0.1',1377254914);
INSERT INTO "Tak_Admin_Log" VALUES(40574134973899030,1,'admin','/github/yii/crm/index.php?r=site/login','登录操作','127.0.0.1',1377255314);
INSERT INTO "Tak_Admin_Log" VALUES(40586716721150136,1,'admin','/github/yii/crm/index.php?r=site/login','登录操作','127.0.0.1',1377267896);
INSERT INTO "Tak_Admin_Log" VALUES(40623679974723068,1,'admin','/github/yii/crm/index.php?r=manage/update&id=40547019084902076','修改会员','127.0.0.1',1377304859);
INSERT INTO "Tak_Admin_Log" VALUES(40623680807176171,1,'admin','/github/yii/crm/index.php?r=manage/update&id=40547019084902076','修改会员','127.0.0.1',1377304860);
INSERT INTO "Tak_Admin_Log" VALUES(40623796576120181,1,'admin','/github/yii/crm/index.php?r=manage/update&id=40547019084902076','修改会员','127.0.0.1',1377304976);
INSERT INTO "Tak_Admin_Log" VALUES(40623864230165191,1,'admin','/github/yii/crm/index.php?r=manage/update&id=40547019084902076','修改会员','127.0.0.1',1377305044);
INSERT INTO "Tak_Admin_Log" VALUES(40623899135490206,1,'admin','/github/yii/crm/index.php?r=manage/update&id=40547019084902076','修改会员','127.0.0.1',1377305079);
INSERT INTO "Tak_Admin_Log" VALUES(40624021878870131,1,'admin','/github/yii/crm/index.php?r=manage/create','添加会员','127.0.0.1',1377305201);
INSERT INTO "Tak_Admin_Log" VALUES(40624166635246121,1,'admin','/github/yii/crm/index.php?r=manage/update&id=40624021867853024','修改会员:40624021867853024','127.0.0.1',1377305346);
INSERT INTO "Tak_Admin_Log" VALUES(40624193300358212,1,'admin','/github/yii/crm/index.php?r=manage/update&id=40624021867853024','修改会员 - 40624021867853024','127.0.0.1',1377305373);
INSERT INTO "Tak_Admin_Log" VALUES(40624214230828196,1,'admin','/github/yii/crm/index.php?r=manage/update&id=40624021867853024','修改会员','127.0.0.1',1377305394);
INSERT INTO "Tak_Admin_Log" VALUES(40624285831421029,1,'admin','/github/yii/crm/index.php?r=site/logout','退出操作','127.0.0.1',1377305465);
INSERT INTO "Tak_Admin_Log" VALUES(40624348827657208,1,'test2013','/github/yii/crm/index.php?r=site/login','登录操作','127.0.0.1',1377305528);
INSERT INTO "Tak_Admin_Log" VALUES(40624360296305155,1,'test2013','/github/yii/crm/index.php?r=site/logout','退出操作','127.0.0.1',1377305540);
INSERT INTO "Tak_Admin_Log" VALUES(40624366157450091,1,'admin','/github/yii/crm/index.php?r=site/login','登录操作','127.0.0.1',1377305546);
INSERT INTO "Tak_Admin_Log" VALUES(40625004092754212,1,'admin','/github/yii/crm/index.php?r=site/logout','退出操作','127.0.0.1',1377306184);
INSERT INTO "Tak_Admin_Log" VALUES(40625015330576177,1,'admin','/github/yii/crm/index.php?r=site/login','登录操作','127.0.0.1',1377306195);
INSERT INTO "Tak_Admin_Log" VALUES(40635182283723158,1,'admin','/github/yii/crm/index.php?r=site/login','登录操作','127.0.0.1',1377316362);
INSERT INTO "Tak_Admin_Log" VALUES(40637631559161059,1,'admin','/github/yii/crm/index.php?r=site/logout','退出操作','127.0.0.1',1377318811);
INSERT INTO "Tak_Admin_Log" VALUES(40637638433252114,1,'admin','/github/yii/crm/index.php?r=site/login','登录操作','127.0.0.1',1377318818);
INSERT INTO "Tak_Admin_Log" VALUES(40645281492796102,1,'admin','/github/yii/crm/index.php?r=manage/update&id=40547019084902076','修改会员','127.0.0.1',1377326461);
CREATE TABLE [Tak_Data]
/* 内容表 */
(
    [itemid] UNSIGNED BIGINT(25) NOT NULL ,/*col 编号 end*/
    [content] TEXT NOT NULL ,/*col 值 end*/
    PRIMARY KEY ([itemid])
);
CREATE TABLE [Tak_Setting]
/* 配置信息 */
(
    [itemid] UNSIGNED BIGINT(25) NOT NULL ,/*col 编号 end*/
    [fromid] UNSIGNED INTEGER  NOT NULL ,/*col 平台会员ID end*/    
    [item_key] VARCHAR(100) DEFAULT '' NOT NULL ,/*col 键 end*/
    [item_value] TEXT NOT NULL ,/*col 值 end*/

    [add_time] UNSIGNED INTEGER(10)   DEFAULT 0 NOT NULL ,/*col 添加时间 end*/
    [add_us] UNSIGNED BIGINT(25) NOT NULL ,/*col 添加人 end*/
    [add_ip] UNSIGNED INTEGER DEFAULT 0 NOT NULL ,/*col 添加IP end*/
    [modified_time] UNSIGNED INTEGER(10) DEFAULT 0 NOT NULL ,/*col 修改时间 end*/
    [modified_us] UNSIGNED BIGINT(25) NOT NULL ,/*col 修改人 end*/
    [modified_ip] UNSIGNED INTEGER DEFAULT 0 NOT NULL  ,/*col 修改IP end*/
    PRIMARY KEY ([itemid])
);
CREATE TABLE [Tak_Clientele]
/* 客户资料 */
(
    [itemid] UNSIGNED BIGINT(25) NOT NULL ,/*col 编号 end*/
    [fromid] UNSIGNED INTEGER  NOT NULL ,/*col 平台会员ID end*/    
    [manageid] UNSIGNED BIGINT(25) NOT NULL ,/*col 会员ID end*/

    [rating] VARCHAR(100)  NULL ,/*col 客户等级 end*/
    [annual_revenue] INTEGER NOT NULL DEFAULT 0 ,/*col 年营业额 end*/
    [industry] VARCHAR(100) NOT NULL ,/*col 客户类型[新客户,意向客户,潜在客户,正式客户,VIP客户] end*/
    [profession] VARCHAR(100) NOT NULL ,/*col 客户行业 end*/
    [origin] VARCHAR(100) NULL ,/*col 来源头[电话营销,主动来电,老客户,朋友介绍,广告杂志,互联网,其它] end*/

    [employees] INTEGER NOT NULL DEFAULT 0 ,/*col 员工数量 end*/


    [accountname] VARCHAR(100) NOT NULL ,/*col 客户名字 end*/
    [email] VARCHAR(100)  NULL ,/*col 邮箱 end*/
    [address] VARCHAR(255)  NULL ,/*col 地址 end*/
    [telephone] VARCHAR(50)  NULL ,/*col 电话 end*/
    [fax] VARCHAR(50) NULL ,/*col 传真 end*/
    [web] VARCHAR(50) NULL ,/*col 网站 end*/
    
    [visibility] UNSIGNED INTEGER(11) DEFAULT 1 NOT NULL ,/*col 显示(0:自己，1公开) end*/

    [add_time] UNSIGNED INTEGER(10)   DEFAULT 0 NOT NULL ,/*col 添加时间 end*/
    [add_us] UNSIGNED BIGINT(25) NOT NULL ,/*col 添加人 end*/
    [add_ip] UNSIGNED INTEGER DEFAULT 0 NOT NULL ,/*col 添加IP end*/
    [modified_time] UNSIGNED INTEGER(10) DEFAULT 0 NOT NULL ,/*col 修改时间 end*/
    [modified_us] UNSIGNED BIGINT(25) NOT NULL ,/*col 修改人 end*/
    [modified_ip] UNSIGNED INTEGER DEFAULT 0 NOT NULL  ,/*col 修改IP end*/

    [note] VARCHAR(255) NULL ,/*col 备注 end*/
    PRIMARY KEY ([itemid])
);
CREATE TABLE [Tak_Address_Book]
/* 通讯录 */
(
    [itemid] UNSIGNED BIGINT(25) NOT NULL ,/*col 编号 end*/
    [groups_id] UNSIGNED BIGINT(25) NOT NULL ,/*col 通讯录组编号 end*/    
    [fromid] UNSIGNED INTEGER  NOT NULL ,/*col 平台会员ID end*/  

    [name] VARCHAR(64)  NOT NULL ,/*col 名字 end*/
    [email] VARCHAR(255) NOT NULL ,/*col Email end*/
    [phone] VARCHAR(255) NOT NULL ,/*col 电话 end*/
    [address] VARCHAR(255) NOT NULL ,/*col 联系地址 end*/
    [department] VARCHAR(100) NOT NULL ,/*col 部门 end*/
    [position] VARCHAR(100) NOT NULL ,/*col 职位 end*/

    [sex] UNSIGNED SMALLINT(1) DEFAULT 0 NOT NULL  ,/*col 性别 end*/
    [longitude] VARCHAR(10) NULL ,/*col 经度 end*/
    [latitude] VARCHAR(10) NULL ,/*col 纬度 end*/
    [location] VARCHAR(20) NULL ,/*col 位置 end*/

    [display] UNSIGNED INTEGER(11) DEFAULT 0 NOT NULL ,/*col 显示情况 end*/

    [add_time] UNSIGNED INTEGER(10)   DEFAULT 0 NOT NULL ,/*col 添加时间 end*/
    [add_us] UNSIGNED BIGINT(25) NOT NULL ,/*col 添加人 end*/
    [add_ip] UNSIGNED INTEGER DEFAULT 0 NOT NULL ,/*col 添加IP end*/
    [modified_time] UNSIGNED INTEGER(10) DEFAULT 0 NOT NULL ,/*col 修改时间 end*/
    [modified_us] UNSIGNED BIGINT(25) NOT NULL ,/*col 修改人 end*/
    [modified_ip] UNSIGNED INTEGER DEFAULT 0 NOT NULL  ,/*col 修改IP end*/

    [note] VARCHAR(255) NULL ,/*col 备注 end*/
    FOREIGN KEY ([groups_id]) REFERENCES [Tak_Address_Groups]([address_groups_id]) ON DELETE CASCADE ON UPDATE CASCADE,
    PRIMARY KEY ([itemid])
);
CREATE TABLE [Tak_Address_Groups]
/* 通讯录组 */
(
    [address_groups_id] UNSIGNED BIGINT(25) NOT NULL ,/*col 编号 end*/
    [fromid] UNSIGNED INTEGER  NOT NULL ,/*col 平台会员ID end*/ 
    [name] VARCHAR(255) NOT NULL ,/*col 组名称 end*/
    [display] UNSIGNED INTEGER(11) DEFAULT 0 NOT NULL ,/*col 显示情况 end*/  

    [add_time] UNSIGNED INTEGER(10)   DEFAULT 0 NOT NULL ,/*col 添加时间 end*/
    [add_us] UNSIGNED BIGINT(25) NOT NULL ,/*col 添加人 end*/
    [add_ip] UNSIGNED INTEGER DEFAULT 0 NOT NULL ,/*col 添加IP end*/
    [modified_time] UNSIGNED INTEGER(10) DEFAULT 0 NOT NULL ,/*col 修改时间 end*/
    [modified_us] UNSIGNED BIGINT(25) NOT NULL ,/*col 修改人 end*/
    [modified_ip] UNSIGNED INTEGER DEFAULT 0 NOT NULL  ,/*col 修改IP end*/

    [note] VARCHAR(255) NULL ,/*col 备注 end*/    
    PRIMARY KEY ([address_groups_id])
);
CREATE TABLE [Tak_Files]
/* 文件列表 */
(
    [itemid] UNSIGNED BIGINT(25) NOT NULL ,/*col 编号 end*/
    [fromid] UNSIGNED INTEGER  NOT NULL ,/*col 平台会员ID end*/
    [manageid] UNSIGNED BIGINT(25) NOT NULL ,/*col 会员编号 end*/
    [file_name] VARCHAR(255) NOT NULL ,/*col 文件名 end*/
    [file_type] UNSIGNED SMALLINT(11) NOT NULL DEFAULT 0 ,/*col 文件类型 end*/
    [parent_file_id] UNSIGNED SMALLINT(11) NOT NULL DEFAULT 0 ,/*col 目录编号 end*/

    [file_path] VARCHAR(500) NULL DEFAULT 0 ,/*col 文件大小,/用户ID/文件夹名字/name.jpg end*/
    [file_size] UNSIGNED BIGINT(64) NOT NULL DEFAULT 0 ,/*col 文件大小 end*/
    [mime_type] VARCHAR(64) NULL,/*col 互联网媒体类型 end*/   

    [status] UNSIGNED INTEGER(11) DEFAULT 1 NOT NULL ,/*col 状态(0:回收站,1:正常) end*/

    [add_time] UNSIGNED INTEGER(10)   DEFAULT 0 NOT NULL ,/*col 添加时间 end*/
    [add_us] UNSIGNED BIGINT(25) NOT NULL ,/*col 添加人 end*/
    [add_ip] UNSIGNED INTEGER DEFAULT 0 NOT NULL ,/*col 添加IP end*/
    [modified_time] UNSIGNED INTEGER(10) DEFAULT 0 NOT NULL ,/*col 修改时间 end*/
    [modified_us] UNSIGNED BIGINT(25) NOT NULL ,/*col 修改人 end*/
    [modified_ip] UNSIGNED INTEGER DEFAULT 0 NOT NULL  ,/*col 修改IP end*/

    [note] VARCHAR(255) NULL ,/*col 备注 end*/    
    PRIMARY KEY ([itemid])
);
CREATE TABLE [Tak_Files_Share]
/* 收藏的文件 */
(
    [itemid] UNSIGNED BIGINT(25) NOT NULL ,/*col 编号 end*/
    [fromid] UNSIGNED  INTEGER  NOT NULL ,/*col 平台会员ID end*/
    [manageid] UNSIGNED INTEGER NOT NULL ,/*col 会员ID end*/
    [file_id] UNSIGNED BIGINT(25) NOT NULL ,/*col 文件编号 end*/
    [clientname] VARCHAR(2555) NOT NULL ,/*col 客户名称 end*/

    [add_time] UNSIGNED INTEGER(10)   DEFAULT 0 NOT NULL ,/*col 添加时间 end*/
    [add_us] UNSIGNED BIGINT(25) NOT NULL ,/*col 添加人 end*/
    [add_ip] UNSIGNED INTEGER DEFAULT 0 NOT NULL ,/*col 添加IP end*/
    [modified_time] UNSIGNED INTEGER(10) DEFAULT 0 NOT NULL ,/*col 修改时间 end*/
    [modified_us] UNSIGNED BIGINT(25) NOT NULL ,/*col 修改人 end*/
    [modified_ip] UNSIGNED INTEGER DEFAULT 0 NOT NULL  ,/*col 修改IP end*/

    [note] VARCHAR(255) NULL ,/*col 备注 end*/
    PRIMARY KEY ([itemid])
);
CREATE TABLE [Tak_AuthItem]

(
   [name] VARCHAR(64) NOT NULL,
   [type] INTEGER NOT NULL,
   [description] TEXT,
   [bizrule] TEXT,
   [data] TEXT,
   primary key ([name])
);
INSERT INTO "Tak_AuthItem" VALUES('Account.Findpwd',0,'找回密码',NULL,'N;');
INSERT INTO "Tak_AuthItem" VALUES('Account.Login',0,'用户登录',NULL,'N;');
INSERT INTO "Tak_AuthItem" VALUES('Account.Logout',0,'用户登出',NULL,'N;');
INSERT INTO "Tak_AuthItem" VALUES('Account.Register',0,'用户注册',NULL,'N;');
INSERT INTO "Tak_AuthItem" VALUES('Account.Resetpwd',0,'重置密码',NULL,'N;');
INSERT INTO "Tak_AuthItem" VALUES('Admin',2,'超级管理员',NULL,'N;');
INSERT INTO "Tak_AuthItem" VALUES('Authenticated',2,'认证用户','return !Yii::app()->user->isGuest;','N;');
INSERT INTO "Tak_AuthItem" VALUES('Editor',2,'文章编辑',NULL,'N;');
INSERT INTO "Tak_AuthItem" VALUES('Guest',2,'游客','return Yii::app()->user->isGuest;','N;');
INSERT INTO "Tak_AuthItem" VALUES('Site.Contact',0,'吐槽',NULL,'N;');
INSERT INTO "Tak_AuthItem" VALUES('Comment.*',1,'Access all comment actions',NULL,'N;');
INSERT INTO "Tak_AuthItem" VALUES('Comment.Approve',0,'这是Approve comments',NULL,'N;');
INSERT INTO "Tak_AuthItem" VALUES('Comment.Delete',0,'Delete comments',NULL,'N;');
INSERT INTO "Tak_AuthItem" VALUES('Comment.Update',0,'Update comments',NULL,'N;');
INSERT INTO "Tak_AuthItem" VALUES('CommentAdministration',1,'Administration of comments',NULL,'N;');
INSERT INTO "Tak_AuthItem" VALUES('Post.*',1,'Access all post actions',NULL,'N;');
INSERT INTO "Tak_AuthItem" VALUES('Post.Admin',0,'Administer posts',NULL,'N;');
INSERT INTO "Tak_AuthItem" VALUES('Post.Create',0,'Create posts',NULL,'N;');
INSERT INTO "Tak_AuthItem" VALUES('Post.Delete',0,'Delete posts',NULL,'N;');
INSERT INTO "Tak_AuthItem" VALUES('Post.Update',0,'Update posts',NULL,'N;');
INSERT INTO "Tak_AuthItem" VALUES('Post.View',0,'View posts',NULL,'N;');
INSERT INTO "Tak_AuthItem" VALUES('PostAdministrator',1,'Administration of posts',NULL,'N;');
INSERT INTO "Tak_AuthItem" VALUES('PostUpdateOwn',0,'Update own posts','return Yii::app()->user->id==$params["userid"];','N;');
INSERT INTO "Tak_AuthItem" VALUES('Manage.*',1,'帐号管理',NULL,'N;');
INSERT INTO "Tak_AuthItem" VALUES('Manage.View',0,NULL,NULL,'N;');
INSERT INTO "Tak_AuthItem" VALUES('Manage.Create',0,NULL,NULL,'N;');
INSERT INTO "Tak_AuthItem" VALUES('Manage.Update',0,NULL,NULL,'N;');
INSERT INTO "Tak_AuthItem" VALUES('Manage.Delete',0,NULL,NULL,'N;');
INSERT INTO "Tak_AuthItem" VALUES('Manage.Index',0,NULL,NULL,'N;');
INSERT INTO "Tak_AuthItem" VALUES('Manage.Admin',0,'信息管理',NULL,'N;');
INSERT INTO "Tak_AuthItem" VALUES('Market',2,'销售部',NULL,'N;');
INSERT INTO "Tak_AuthItem" VALUES('Service',2,'客服部',NULL,'N;');
INSERT INTO "Tak_AuthItem" VALUES('Production',2,'生产部',NULL,'N;');
INSERT INTO "Tak_AuthItem" VALUES('HR',2,'人士部',NULL,'N;');
INSERT INTO "Tak_AuthItem" VALUES('Logistics',2,'后勤部',NULL,'N;');
CREATE TABLE [Tak_AuthItemChild]
/* 授权子项目表 (默认:Tak_AuthItemChild) */
(
   [parent] VARCHAR(64) NOT NULL,
   [child] VARCHAR(64) NOT NULL,
   PRIMARY KEY ([parent],[child]),
   FOREIGN KEY ([parent]) REFERENCES [Tak_AuthItem] ([name]) ON DELETE CASCADE ON UPDATE CASCADE,
   FOREIGN KEY ([child]) REFERENCES [Tak_AuthItem] ([name]) ON DELETE CASCADE ON UPDATE CASCADE
);
INSERT INTO "Tak_AuthItemChild" VALUES('Guest','Account.Findpwd');
INSERT INTO "Tak_AuthItemChild" VALUES('Guest','Account.Login');
INSERT INTO "Tak_AuthItemChild" VALUES('Authenticated','Account.Logout');
INSERT INTO "Tak_AuthItemChild" VALUES('Guest','Account.Register');
INSERT INTO "Tak_AuthItemChild" VALUES('Guest','Account.Resetpwd');
INSERT INTO "Tak_AuthItemChild" VALUES('Editor','Authenticated');
INSERT INTO "Tak_AuthItemChild" VALUES('Authenticated','Site.Contact');
INSERT INTO "Tak_AuthItemChild" VALUES('CommentAdministration','Comment.*');
INSERT INTO "Tak_AuthItemChild" VALUES('Editor','CommentAdministration');
INSERT INTO "Tak_AuthItemChild" VALUES('Authenticated','CommentUpdateOwn');
INSERT INTO "Tak_AuthItemChild" VALUES('Authenticated','Guest');
INSERT INTO "Tak_AuthItemChild" VALUES('PostAdministrator','Post.Admin');
INSERT INTO "Tak_AuthItemChild" VALUES('Authenticated','Post.Create');
INSERT INTO "Tak_AuthItemChild" VALUES('PostAdministrator','Post.Create');
INSERT INTO "Tak_AuthItemChild" VALUES('PostAdministrator','Post.Delete');
INSERT INTO "Tak_AuthItemChild" VALUES('PostAdministrator','Post.Update');
INSERT INTO "Tak_AuthItemChild" VALUES('Guest','Post.View');
INSERT INTO "Tak_AuthItemChild" VALUES('PostAdministrator','Post.*');
INSERT INTO "Tak_AuthItemChild" VALUES('Editor','PostAdministrator');
INSERT INTO "Tak_AuthItemChild" VALUES('Authenticated','PostUpdateOwn');
INSERT INTO "Tak_AuthItemChild" VALUES('Manage.*','Manage.Delete');
CREATE TABLE [Tak_AuthAssignment]
/* 授权分配表 (默认:AuthAssignment) */
(
   [itemname] VARCHAR(64) NOT NULL,
   [userid] UNSIGNED INTEGER NOT NULL,
   [bizrule] TEXT,
   [data] TEXT,
   primary key ([itemname],[userid]),
   FOREIGN KEY ([itemname]) REFERENCES [Tak_AuthItem] ([name]) ON DELETE CASCADE ON UPDATE CASCADE
);
INSERT INTO "Tak_AuthAssignment" VALUES('Admin',40547019084902076,NULL,'N;');
INSERT INTO "Tak_AuthAssignment" VALUES('Editor',7,NULL,'N;');
INSERT INTO "Tak_AuthAssignment" VALUES('Manage.Create',2,NULL,'N;');
INSERT INTO "Tak_AuthAssignment" VALUES('Manage.Admin',2,NULL,'N;');
INSERT INTO "Tak_AuthAssignment" VALUES('Market',40624021867853024,NULL,'N;');
CREATE TABLE [Tak_Rights]
(
    [itemname] VARCHAR(64) NOT NULL,
    [type] UNSIGNED  INTEGER NOT NULL,
    [weight] UNSIGNED  INTEGER NOT NULL,
    [fromid] UNSIGNED  INTEGER  NOT NULL DEFAULT 0,/*col 平台会员ID end*/
    PRIMARY KEY ([itemname]),
    FOREIGN KEY ([itemname]) REFERENCES [Tak_AuthItem] ([name]) ON DELETE CASCADE ON UPDATE CASCADE
);
INSERT INTO "Tak_Rights" VALUES('Account.Findpwd',0,8,0);
INSERT INTO "Tak_Rights" VALUES('Account.Login',0,14,0);
INSERT INTO "Tak_Rights" VALUES('Account.Logout',0,13,0);
INSERT INTO "Tak_Rights" VALUES('Account.Register',0,9,0);
INSERT INTO "Tak_Rights" VALUES('Account.Resetpwd',0,10,0);
INSERT INTO "Tak_Rights" VALUES('Admin',2,5,0);
INSERT INTO "Tak_Rights" VALUES('Authenticated',2,9,0);
INSERT INTO "Tak_Rights" VALUES('Editor',2,8,0);
INSERT INTO "Tak_Rights" VALUES('Guest',2,6,0);
INSERT INTO "Tak_Rights" VALUES('Site.Contact',0,12,0);
INSERT INTO "Tak_Rights" VALUES('Comment.Approve',0,2,0);
INSERT INTO "Tak_Rights" VALUES('Comment.Delete',0,1,0);
INSERT INTO "Tak_Rights" VALUES('Comment.Update',0,0,0);
INSERT INTO "Tak_Rights" VALUES('Post.Admin',0,3,0);
INSERT INTO "Tak_Rights" VALUES('Post.Delete',0,4,0);
INSERT INTO "Tak_Rights" VALUES('Post.Update',0,6,0);
INSERT INTO "Tak_Rights" VALUES('Post.View',0,5,0);
INSERT INTO "Tak_Rights" VALUES('PostUpdateOwn',0,7,0);
INSERT INTO "Tak_Rights" VALUES('Post.Create',0,11,0);
INSERT INTO "Tak_Rights" VALUES('Manage',2,7,0);
INSERT INTO "Tak_Rights" VALUES('Comment.*',1,0,0);
INSERT INTO "Tak_Rights" VALUES('Manage.*',1,1,0);
INSERT INTO "Tak_Rights" VALUES('CommentAdministration',1,2,0);
INSERT INTO "Tak_Rights" VALUES('Post.*',1,3,0);
INSERT INTO "Tak_Rights" VALUES('PostAdministrator',1,4,0);
INSERT INTO "Tak_Rights" VALUES('Market',2,4,0);
INSERT INTO "Tak_Rights" VALUES('Production',2,2,0);
INSERT INTO "Tak_Rights" VALUES('Service',2,3,0);
INSERT INTO "Tak_Rights" VALUES('HR',2,0,0);
INSERT INTO "Tak_Rights" VALUES('Logistics',2,1,0);
CREATE TABLE [Tak_comment] (
  [id] INTEGER  PRIMARY KEY AUTOINCREMENT NOT NULL ,
  [content] text NOT NULL,
  [status] int(11) NOT NULL,
  [create_time] int(11) DEFAULT NULL,
  [author] varchar(128) NOT NULL,
  [email] varchar(128) NOT NULL,
  [url] varchar(128) DEFAULT NULL,
  [post_id] int(11) NOT NULL,

  FOREIGN KEY ([post_id]) REFERENCES [Tak_post] ([id]) ON DELETE CASCADE ON UPDATE CASCADE
);
INSERT INTO "Tak_comment" VALUES(1,'This is a test comment.',2,1230952187,'Tester','tester@example.com','',2);
INSERT INTO "Tak_comment" VALUES(2,'sfdds',2,1377391957,'sdsdf','sfdsf@qq.vom','http://qweqwe.cv',2);
CREATE TABLE [Tak_lookup] (
  [id] INTEGER  PRIMARY KEY AUTOINCREMENT NOT NULL ,
  [name] varchar(128) NOT NULL,
  [code] int(11) NOT NULL,
  [type] varchar(128) NOT NULL,
  [position] int(11) NOT NULL
);
INSERT INTO "Tak_lookup" VALUES(1,'Draft',1,'PostStatus',1);
INSERT INTO "Tak_lookup" VALUES(2,'Published',2,'PostStatus',2);
INSERT INTO "Tak_lookup" VALUES(3,'Archived',3,'PostStatus',3);
INSERT INTO "Tak_lookup" VALUES(4,'Pending Approval',1,'CommentStatus',1);
INSERT INTO "Tak_lookup" VALUES(5,'Approved',2,'CommentStatus',2);
CREATE TABLE [Tak_post] (
  [id] INTEGER  PRIMARY KEY AUTOINCREMENT NOT NULL ,
  [title] varchar(128) NOT NULL,
  [content] text NOT NULL,
  [tags] text,
  [status] int(11) NOT NULL,
  [create_time] int(11) DEFAULT NULL,
  [update_time] int(11) DEFAULT NULL,
  [author_id] int(11) NOT NULL
);
INSERT INTO "Tak_post" VALUES(1,'Welcome!','This blog system is developed using Yii. It is meant to demonstrate how to use Yii to build a complete real-world application. Complete source code may be found in the Yii releases.\r\n\r\nFeel free to try this system by writing new posts and posting comments.','yii, blog',2,1230952187,1377147094,1);
INSERT INTO "Tak_post" VALUES(2,'A Test Post','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','test',2,1230952187,1230952187,1);
INSERT INTO "Tak_post" VALUES(3,'sdfsdf','sdfdsf','sdf',2,1377133495,1377133688,0);
INSERT INTO "Tak_post" VALUES(4,'asdasd','sadas','dasdsa',3,1377133957,1377133957,1);
INSERT INTO "Tak_post" VALUES(7,'jk','jlk','jlkk',2,1377235073,1377235073,2147483647);
CREATE TABLE [Tak_tag] (
 [id] INTEGER  PRIMARY KEY AUTOINCREMENT NOT NULL ,
  [name] varchar(128) NOT NULL,
  [frequency] int(11) DEFAULT 1
);
INSERT INTO "Tak_tag" VALUES(1,'yii',1);
INSERT INTO "Tak_tag" VALUES(2,'blog',1);
INSERT INTO "Tak_tag" VALUES(3,'test',1);
INSERT INTO "Tak_tag" VALUES(4,'sdf',1);
INSERT INTO "Tak_tag" VALUES(5,'dasdsa',1);
INSERT INTO "Tak_tag" VALUES(6,'jlkk',1);
CREATE TABLE [Tak_Manage]
/* 平台管理员表 */
(
    [fromid] UNSIGNED INTEGER NOT NULL ,/*col 平台会员ID end*/
    [manageid] UNSIGNED BIGINT(25) NOT NULL ,/*col 自定义编号 end*/
    [user_name] VARCHAR(60)  NOT NULL ,/*col 登录帐号 end*/
    [user_pass] VARCHAR(64)  NOT NULL ,/*col 登录密码 end*/
    [salt] VARCHAR(10)  NOT NULL ,/*col 登录检验码 end*/
    [user_nicename] VARCHAR(64) NOT NULL ,/*col 用户名称 end*/
    [user_email] VARCHAR(100) NOT NULL ,/*col 邮箱 end*/

    [add_time] UNSIGNED INTEGER(10) DEFAULT 0 NOT NULL ,/*col 添加时间 end*/
    [add_ip] UNSIGNED INTEGER DEFAULT 0 NOT NULL,/*col 添加IP end*/
    [last_login_time] UNSIGNED INTEGER(10) DEFAULT 0 NOT NULL ,/*col 最后登录时间 end*/
    [last_login_ip] UNSIGNED INTEGER DEFAULT 0 NOT NULL ,/*col 最后登录IP end*/
    [login_count] UNSIGNED SMALLINT(11) DEFAULT 0 NOT NULL ,/*col 登录次数 end*/
    [user_status] UNSIGNED INTEGER(11) DEFAULT 0 NOT NULL ,/*col 状态(0:冻结,1:启用) end*/
    [note] VARCHAR(255) DEFAULT '' NOT NULL ,/*col 备注 end*/

    [activkey] VARCHAR(64)  NULL ,
    [active_time] UNSIGNED INTEGER DEFAULT 0 NOT NULL,/*col 活跃时间，即最后退出时间 end*/
    UNIQUE([fromid],[user_name]),
    PRIMARY KEY ([manageid])
);
INSERT INTO "Tak_Manage" VALUES(1,40547019084902076,'admin','c0b266594634df51f07796e7ca31107e','gXmz','admin','admin@qq.com',1377228199,'127.0.0.1',1377318818,'127.0.0.1',14,1,'','',1377318811);
INSERT INTO "Tak_Manage" VALUES(1,40547063589295122,'demo','bdb1b3125fa8ba394d09126906c2975c','qp0F','demo','demo@qq.com',1377228243,'127.0.0.1',0,0,0,0,'','',0);
INSERT INTO "Tak_Manage" VALUES(1,40624021867853024,'test2013','e5c9c6f1ee522a3d1f13c5d5ae9236a2','DT8z','test2013','test2013@qq.com',1377305201,'127.0.0.1',1377305528,'127.0.0.1',1,1,'',NULL,1377305540);
DELETE FROM sqlite_sequence;
INSERT INTO "sqlite_sequence" VALUES('Tak_comment',2);
INSERT INTO "sqlite_sequence" VALUES('Tak_lookup',5);
INSERT INTO "sqlite_sequence" VALUES('Tak_post',7);
INSERT INTO "sqlite_sequence" VALUES('Tak_tag',6);
CREATE INDEX [Tak_Admin_Log_idx] ON [Tak_Admin_Log]([fromid],[user_name]);
CREATE INDEX [Tak_Setting_idx] ON [Tak_Setting]([fromid],[item_key]);
CREATE INDEX [Tak_Clientele_idx] ON [Tak_Clientele]([fromid],[accountname]);
CREATE INDEX [Tak_Address_Book_idx] ON [Tak_Address_Book]([fromid],[name],[phone]);
CREATE INDEX [Tak_Address_Groups_idx] ON [Tak_Address_Groups]([fromid],[name]);
CREATE INDEX [Tak_Files_idx] ON [Tak_Files]([fromid],[manageid]);
CREATE INDEX [Tak_Files_Share_idx] ON [Tak_Files_Share]([manageid],[file_id]);
CREATE INDEX [Tak_Manage_idx] ON [Tak_Manage]([fromid],[user_name],[user_nicename]);
COMMIT;
