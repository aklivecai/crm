<?php $this->pageTitle=Yii::app()->name; ?>

                <div class="row-">

                    <div class="span4">

                        <div class="wBlock red clearfix">
                            <div class="dSpace">
                                <h3>Invoices statistics</h3>
                                <span class="mChartBar" sparkType="bar" sparkBarColor="white"><!--130,190,260,230,290,400,340,360,390--></span>
                                <span class="number">60%</span>
                            </div>
                            <div class="rSpace">
                                <span><b>今日</b> 10 </span>
                                <span><b>本月</b> 200 </span>
                                <span><b>今年</b> 1000 </span>
                            </div>
                        </div>

                    </div>

                    <div class="span4">

                        <div class="wBlock green clearfix">
                            <div class="dSpace">
                                <h3>客户总量</h3>
                                <span class="mChartBar" sparkType="bar" sparkBarColor="white"><!--5,10,15,20,23,21,25,20,15,10,25,20,10--></span>
                                <span class="number">2,513</span>
                            </div>
                            <div class="rSpace">
                                <span><b>今日</b> 10 </span>
                                <span><b>本月</b> 200 </span>
                                <span><b>今年</b> 1000 </span>
                            </div>
                        </div>

                    </div>

                    <div class="span4">

                        <div class="wBlock blue clearfix">
                            <div class="dSpace">
                                <h3>联系人</h3>
                                <span class="mChartBar" sparkType="bar" sparkBarColor="white"><!--240,234,150,290,310,240,210,400,320,198,250,222,111,240,221,340,250,190--></span>
                                <span class="number">6,302</span>
                            </div>
                            <div class="rSpace">
                                <span><b>今日</b> 10 </span>
                                <span><b>本月</b> 200 </span>
                                <span><b>今年</b> 1000 </span>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="dr"><span></span></div>

                <div class="row-">

                    <div class="span4">
                        <div class="head clearfix">
                            <span class="glyphicon glyphicon-ok-sign"></span>
                            <h1>客户</h1>
                            <ul class="buttons">
                                <li>
                                    <a href="#" class="isw-settings"></a>
<?php 
    $this->widget('application.components.MyMenu',array(
      'htmlOptions'=>array('class'=>'dd-list'),
      'items'=> array(
                array(
                  'icon' =>'isw-list',
                  'url' => array('clientele/admin','id'=>$itemid),
                  'label'=>'全部',
                )
                ,array(
                  'icon' =>'isw-ok',
                  'url' => array('clientele/admin','id'=>$itemid),
                  'label'=>'代理商',
                )
                ,array(
                  'icon' =>'isw-minus',
                  'url' => $this->createUrl('clientele/admin').'?Clientele[industry]=5',
                  'label'=>'VIP客户',
                )
        ) ,
    ));
?>                                      
                        </div>
                        <div class="block-fluid accordion">

                            <h3>意向客户</h3>
                            <div>
                                <table cellpadding="0" cellspacing="0" width="100%" class="sOrders">
                                    <thead>
                                        <tr>
                                            <th width="60">日期</th><th>名字</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><span class="date">Nov 6</span><span class="time">12:35</span></td>
                                            <td><a href="#">Aqvatarius</a></td>
                                        </tr>
                                        <tr>
                                            <td><span class="date">Nov 8</span><span class="time">18:42</span></td>
                                            <td><a href="#">Olga</a></td>
                                        </tr>
                                        <tr>
                                            <td><span class="date">Nov 15</span><span class="time">8:21</span></td>
                                            <td><a href="#">Alex</a></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2" align="right"><button class="btn btn-small">更多...</button></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <h3>普通客户</h3>
                            <div>
                                <table cellpadding="0" cellspacing="0" width="100%" class="sOrders">
                                    <thead>
                                        <tr>
                                            <th width="60">日期</th><th>名字</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><span class="date">Nov 6</span><span class="time">12:35</span></td>
                                            <td><a href="#">Aqvatarius</a></td>
                                        </tr>
                                        <tr>
                                            <td><span class="date">Nov 8</span><span class="time">18:42</span></td>
                                            <td><a href="#">Olga</a></td>
                                        </tr>
                                        <tr>
                                            <td><span class="date">Nov 15</span><span class="time">8:21</span></td>
                                            <td><a href="#">Alex</a></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2" align="right"><button class="btn btn-small">更多...</button></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                           
                            <h3>VIP客户</h3>
                            <div>
                                <table cellpadding="0" cellspacing="0" width="100%" class="sOrders">
                                    <thead>
                                        <tr>
                                            <th width="60">日期</th><th>名字</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><span class="date">Nov 6</span><span class="time">12:35</span></td>
                                            <td><a href="#">Aqvatarius</a></td>
                                        </tr>
                                        <tr>
                                            <td><span class="date">Nov 8</span><span class="time">18:42</span></td>
                                            <td><a href="#">Olga</a></td>
                                        </tr>
                                        <tr>
                                            <td><span class="date">Nov 15</span><span class="time">8:21</span></td>
                                            <td><a href="#">Alex</a></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2" align="right"><button class="btn btn-small">更多...</button></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                        </div>
                    </div>

                    <div class="span4">
                        <div class="head clearfix">
                            <div class="isw-edit"></div>
                            <h1>通知公告</h1>
                            <ul class="buttons">
                                <li>
                                    <a href="#" class="isw-text_document"></a>
                                </li>
                                <li>
                                    <a href="#" class="isw-settings"></a>
                                    <ul class="dd-list">
                                        <li><a href="#"><span class="isw-list"></span> 显示更多</a></li>
                                        <li><a href="#"><span class="isw-refresh"></span> 刷新</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="block news scrollBox">

                            <div class="scroll" style="height: 270px;">

                                <div class="item">
                                    <a href="#">放假通知</a>
                                    <p>2013年国企放假通知！！！！！！</span>
                                    <div class="controls">
                                        <a href="#" class="icon-pencil tip" title="Edit"></a>
                                        <a href="#" class="icon-trash tip" title="Remove"></a>
                                    </div>
                                </div>

                                <div class="item">
                                    <a href="#">放假通知</a>
                                    <p>2013年国企放假通知！！！！！！</span>
                                    <div class="controls">
                                        <a href="#" class="icon-pencil tip" title="Edit"></a>
                                        <a href="#" class="icon-trash tip" title="Remove"></a>
                                    </div>
                                </div>

                                <div class="item">
                                    <a href="#">放假通知</a>
                                    <p>2013年国企放假通知！！！！！！</span>
                                    <div class="controls">
                                        <a href="#" class="icon-pencil tip" title="Edit"></a>
                                        <a href="#" class="icon-trash tip" title="Remove"></a>
                                    </div>
                                </div>

                                <div class="item">
                                    <a href="#">放假通知</a>
                                    <p>2013年国企放假通知！！！！！！</span>
                                    <div class="controls">
                                        <a href="#" class="icon-pencil tip" title="Edit"></a>
                                        <a href="#" class="icon-trash tip" title="Remove"></a>
                                    </div>
                                </div>

                                <div class="item">
                                    <a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a>
                                    <p>2013年国企放假通知！！！！！！</span>
                                    <div class="controls">
                                        <a href="#" class="icon-pencil tip" title="Edit"></a>
                                        <a href="#" class="icon-trash tip" title="Remove"></a>
                                    </div>
                                </div>

                                <div class="item">
                                    <a href="#">放假通知</a>
                                    <p>2013年国企放假通知！！！！！！</span>
                                    <div class="controls">
                                        <a href="#" class="icon-pencil tip" title="Edit"></a>
                                        <a href="#" class="icon-trash tip" title="Remove"></a>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="span4">
                        <div class="head clearfix">
                            <div class="isw-cloud"></div>
                            <h1>最近联系</h1>
                            <ul class="buttons">
                                <li>
                                    <a href="#" class="isw-users"></a>
                                </li>
                                <li>
                                    <a href="#" class="isw-settings"></a>
                                    <ul class="dd-list">
                                        <li><a href="#"><span class="isw-list"></span> 全部</a></li>
                                        <li><a href="#"><span class="isw-mail"></span> 发送邮件</a></li>
                                        <li><a href="#"><span class="isw-refresh"></span> 刷新</a></li>
                                    </ul>
                                </li>
                                <li class="toggle"><a href="#"></a></li>
                            </ul>
                        </div>
                        <div class="block users scrollBox">

                            <div class="scroll" style="height: 270px;">

                                <div class="item clearfix">
                                    <div class="image"><a href="#"><img src="#/aqvatarius_s.jpg" width="32"/></a></div>
                                    <div class="info">
                                        <a href="#" class="name">Aqvatarius</a>
                                        <div class="controls">
                                            <a href="#" class="icon-ok"></a>
                                            <a href="#" class="icon-remove"></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="item clearfix">
                                    <div class="image"><a href="#"><img src="#/olga_s.jpg" width="32"/></a></div>
                                    <div class="info">
                                        <a href="#" class="name">Olga</a>
                                        <div class="controls">
                                            <a href="#" class="icon-ok"></a>
                                            <a href="#" class="icon-remove"></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="item clearfix">
                                    <div class="image"><a href="#"><img src="#/alexey_s.jpg" width="32"/></a></div>
                                    <div class="info">
                                        <a href="#" class="name">Alexey</a>
                                        <div class="controls">
                                            <a href="#" class="icon-ok"></a>
                                            <a href="#" class="icon-remove"></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="item clearfix">
                                    <div class="image"><a href="#"><img src="#/dmitry_s.jpg" width="32"/></a></div>
                                    <div class="info">
                                        <a href="#" class="name">Dmitry</a>
                                        <span>approved</span>
                                    </div>
                                </div>

                                <div class="item clearfix">
                                    <div class="image"><a href="#"><img src="#/helen_s.jpg" width="32"/></a></div>
                                    <div class="info">
                                        <a href="#" class="name">Helen</a>
                                        <span>approved</span>
                                    </div>
                                </div>

                                <div class="item clearfix">
                                    <div class="image"><a href="#"><img src="#/alexander_s.jpg" width="32"/></a></div>
                                    <div class="info">
                                        <a href="#" class="name">Alexander</a>
                                        <span>approved</span>
                                    </div>
                                </div>

                                <div class="item clearfix">
                                    <div class="image"><a href="#"><img src="#/aqvatarius_s.jpg" width="32"/></a></div>
                                    <div class="info">
                                        <a href="#" class="name">Aqvatarius</a>
                                        <span>approved</span>
                                    </div>
                                </div>

                                <div class="item clearfix">
                                    <div class="image"><a href="#"><img src="#/olga_s.jpg" width="32"/></a></div>
                                    <div class="info">
                                        <a href="#" class="name">Olga</a>
                                        <span>approved</span>
                                    </div>
                                </div>

                                <div class="item clearfix">
                                    <div class="image"><a href="#"><img src="#/alexey_s.jpg" width="32"/></a></div>
                                    <div class="info">
                                        <a href="#" class="name">Alexey</a>
                                        <span>approved</span>
                                    </div>
                                </div>

                                <div class="item clearfix">
                                    <div class="image"><a href="#"><img src="#/dmitry_s.jpg" width="32"/></a></div>
                                    <div class="info">
                                        <a href="#" class="name">Dmitry</a>
                                        <span>approved</span>
                                    </div>
                                </div>

                                <div class="item clearfix">
                                    <div class="image"><a href="#"><img src="#/helen_s.jpg" width="32"/></a></div>
                                    <div class="info">
                                        <a href="#" class="name">Helen</a>
                                        <span>approved</span>
                                    </div>
                                </div>

                                <div class="item clearfix">
                                    <div class="image"><a href="#"><img src="#/alexander_s.jpg" width="32"/></a></div>
                                    <div class="info">
                                        <a href="#" class="name">Alexander</a>
                                        <span>approved</span>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>


                </div>

                <div class="dr"><span></span></div>

<div class="row-">


<div class="head clearfix">
    <div class="isw-calendar"></div>
    <h1>日历</h1>
</div>
<div class="block-fluid">
    <div id="calendar" class="fc"></div>
</div>        
</div>



                <div class="dr"><span></span></div>