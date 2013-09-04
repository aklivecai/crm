<?php
$this->pageTitle=Yii::app()->name . ' - 帮助中心';
$this->breadcrumbs=array(
  '帮助中心 ',
);
?>      
<script type='text/javascript' src='<?php echo yii::app()->theme->baseUrl;?>/js/plugins/highlight/jquery.highlight-4.js'></script>

    <script type='text/javascript' src='<?php echo yii::app()->theme->baseUrl;?>/js/faq.js'></script>
                <div class="page-header">
                    <h1>帮助中心 <small>和常见问题</small></h1>
                </div>                

                <div class="row-fluid">
                    <div class="span8">     
                        <div class="headInfo">
                            <div class="input-append">
                                <input type="text" name="text" placeholder="关键词.." id="widgetInputMessage" class="faqSearchKeyword"/><button class="btn btn-success" id="faqSearch" type="button">搜索</button>
                            </div>                                           
                            <div class="arrow_down"></div>
                        </div>
                        <div class="block-fluid">
                            <div class="toolbar clearfix">
                                <div class="left">
                                    <div id="faqSearchResult" class="note"></div>
                                </div>
                                <div class="right">
                                    <div class="btn-group">
                                        <button class="btn btn-small" id="faqOpenAll" title="打开所有"><span class="icon-chevron-down icon-white"></span></button>
                                        <button class="btn btn-small" id="faqCloseAll" title="折叠所有"><span class="icon-chevron-up icon-white"></span></button>
                                        <button class="btn btn-small" id="faqRemoveHighlights" title="关闭高亮"><span class="icon-remove icon-white"></span></button>
                                    </div>
                                </div>
                            </div>                                                        
                            <div class="faq">
                                <div class="item" id="faq-1">
                                    <div class="title">怎么添加客户?</div>
                                    <div class="text"><p>进入后台=》客户=》客户录入</p></div>
                                </div>

                                <div class="item" id="faq-2">
                                    <div class="title">CRM需要下载安装吗?</div>
                                    <div class="text"><p>租用我们的软件服务器平台。客户的软件客户端无需安装，只需使用以IE8或以上版本浏览器便可直接访问使用，推荐使用Chrome.</p></div>
                                </div>

                                <div class="item" id="faq-3">
                                    <div class="title">什么是具云盘?</div>
                                    <div class="text"><p>是个一个在线的基于云端的文件管理</p></div>
                                </div>

                                <div class="item" id="faq-4">
                                    <div class="title">CRM系统的亮点?</div>
                                    <div class="text"><p>线上处理，回家，外出，找客户很轻松.</p></div>
                                </div>

                                <div class="item" id="faq-5">
                                    <div class="title">怎么收费?</div>
                                    <div class="text"><p>XXXXXXX</p></div>
                                </div>

                                <div class="item" id="faq-6">
                                    <div class="title">使用"CRM"的产品应用服务，如何保障我们公司的资料保密性?</div>
                                    <div class="text"><p>
                                    系统经过两层数据加密链接方式对数据库进行动态访问，因此确保了数据内容的安全性，客户可以安心应用
                                    </p><p>我们签订保密协议。。</p></div>
                                </div>

                                <div class="item" id="faq-7">
                                    <div class="title">我购买了CRM管理软件后，产品有免费升级吗?</div>
                                    <div class="text"><p>我们提供的优质服务承诺，客户自购买软件起一年内均可享受CRM管理软件免费升级服务，详细细则请咨询全程软件售后服务部4000-168-488</p></div>
                                </div>

                                <div class="item" id="faq-8">
                                    <div class="title">出现错误?</div>
                                    <div class="text"><p>XXXXX.</p></div>
                                </div>

                                <div class="item" id="faq-9">
                                    <div class="title">CRM适用于什么类型的公司?</div>
                                    <div class="text"><p>CRM系统可应用于各类销售型、服务型企业，是一套侧重于管理型的CRM系统，使企业员工能根据授权范围来跟踪客户，服务客户。</p></div>
                                </div>

                                <div class="item" id="faq-10">
                                    <div class="title">企业实施CRM的核心是什么?</div>
                                    <div class="text"><p>CRM是以客户为核心系统，因此，在进行规划的时候应从客户的价值和客户的满意度出发。CRM不仅仅是追求业务处理效率的提升，不是一个单纯的面向员工和内部的流程，而是面向客户的流程，其强调的是客户体验，也就是说规划CRM流程时应该围绕着客户体验来进行设计，而不仅仅将规划的着眼点放在企业内部。 </p></div>
                                </div>                            
                            </div>
                        </div>
                    </div>
                    <div class="span4"> 
                        
                        <div class="block-fluid without-head">
                            <div class="toolbar nopadding-toolbar clear clearfix">
                                <h4>常见问题</h4>
                            </div>                            
                            
                            <ul class="list nol" id="faqListController">
                                <li><a href="#faq-3">什么是具云盘?</a></li>
                                <li><a href="#faq-6">客户信息安全?</a></li>
                                <li><a href="#faq-9">CRM适用于什么类型的公司?</a></li>
                            </ul>
                            
                        </div>
                        
                        <div class="block-fluid nm without-head">
                            <div class="toolbar nopadding-toolbar clear clearfix">
                                <h4>问题反馈</h4>
                            </div>                            
                            
                                <div class="row-form clearfix">
                                    <div class="span3">名字</div>
                                    <div class="span9">                                      
                                        <input type="text" placeholder="名字">
                                    </div>
                                </div>
                                <div class="row-form clearfix">
                                    <div class="span3">Email</div>
                                    <div class="span9">                                    
                                        <input type="text" placeholder="Email">
                                    </div>
                                </div>                                
                                <div class="row-form clearfix">
                                    <div class="span12">
                                        <textarea name="text"></textarea> 
                                   </div>
                                </div>                                                                          
                            
                            <div class="footer tar">
                                <button class="btn">提交</button>
                            </div>                            
                        </div>
                    </div>                    
                </div>     
