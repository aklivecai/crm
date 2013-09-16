/** 
 dateFormat('yyyy-MM-dd hh:mm:ss');
dateFormat(new Date(), 'yyyy-MM-dd hh:mm:ss');
 */

var log = function(msg){
    console.log(msg);
}

//用于动态生成网址
//$route,$params=array(),$ampersand='&'
function createUrl(route)
{
    if(!CrmPath){
        return false;
    }
    var ampersand = typeof arguments[2]!='undefined'?arguments[2]:'&'
    , params = typeof arguments[1]!='undefined'?arguments[1]:[]
    ;
    if(!route || route == "undefined")
    {
        return CrmPath;
    }

    var url = CrmPath + (CrmPath.indexOf('?')>0?'':'?');
    url += route;
    if (params.length>0) {
        url += ampersand+params.join(ampersand);
    };
    return url;
}
function dateFormat(date, format) {
    if(format === undefined){
        format = date;
        date = new Date();
    }
    var map = {
        "M": date.getMonth() + 1, //月份 
        "d": date.getDate(), //日 
        "h": date.getHours(), //小时 
        "m": date.getMinutes(), //分 
        "s": date.getSeconds(), //秒 
        "q": Math.floor((date.getMonth() + 3) / 3), //季度 
        "S": date.getMilliseconds() //毫秒 
    };
    format = format.replace(/([yMdhmsqS])+/g, function(all, t){
        var v = map[t];
        if(v !== undefined){
            if(all.length > 1){
                v = '0' + v;
                v = v.substr(v.length-2);
            }
            return v;
        }
        else if(t === 'y'){
            return (date.getFullYear() + '').substr(4 - all.length);
        }
        return all;
    });
    return format;
}        
jQuery(function($){

        // 颜色插件
        var localization = $.spectrum.localization["cn"] = {
            cancelText: "取消",
            chooseText: "选择",
            preferredFormat:'name' //格式
        };
        $.extend($.fn.spectrum.defaults, localization);
        $(".color").spectrum({
            showPaletteOnly: true,
            showPalette:true,
            palette: [
                ['black', 'white', 'blanchedalmond',
                '#FF8000', '#488026'],
                ['red', 'yellow', 'green', 'blue', 'violet']
            ]
        });          


        $.datepicker.regional['zh-CN'] = {
                closeText: '关闭',
                prevText: '<上月',
                nextText: '下月>',
                currentText: '今天',
                monthNames: ['一月','二月','三月','四月','五月','六月',
                '七月','八月','九月','十月','十一月','十二月'],
                monthNamesShort: ['一','二','三','四','五','六',
                '七','八','九','十','十一','十二'],
                dayNames: ['星期日','星期一','星期二','星期三','星期四','星期五','星期六'],
                dayNamesShort: ['周日','周一','周二','周三','周四','周五','周六'],
                dayNamesMin: ['日','一','二','三','四','五','六'],
                weekHeader: '周',
                dateFormat: 'yy-mm-dd',
                firstDay: 1,
                isRTL: false,
                showMonthAfterYear: true,
                yearSuffix: '年'};
        $.datepicker.setDefaults($.datepicker.regional['zh-CN']);

var tselect = function(){
    var clientele = $(".sele1ct-clientele,#list-grid input[name*='[clienteleid]']")
    , prson = $(".sele1ct-prsonid,#list-grid input[name='Contact[prsonid]']")
    , page_limit = 20
    , page_limit = 20
    ,  movieFormatSelection = function(obj) {
        return obj.clientele_name;
    } 
    , movieFormatResult = function(data) {
        var markup = "<table class='movie-result'><tr>";
        markup += "<td class='movie-info'><div class='movie-title'>" + data.clientele_name + "</div>";
        markup += "</td></tr></table>"
        return markup;
    }
    ;
    clientele.css('width','100%');
    prson.css('width','100%');
 
     clientele.select2({
            placeholder: "搜索客户",
            allowClear: true,//显示取消按钮
            minimumInputLength: 0,
            loadMorePadding: 300,
            quietMillis:100,
            openOnEnter:true,
            selectOnBlur:true,
            ajax: { 
                url: createUrl("clientele/select"),
                dataType: 'jsonp',
                data: function (term, page) {
                    return {
                        q: term, 
                        page_limit: page_limit,
                        Clientele_page: page,
                    };
                },
                results: function (data, page) { 
                    var more = (page * page_limit) < data.totalItemCount; 
                    return {results: data['data'],more:more};
                }
            },
            id:function(object){
                return object.itemid;
            },
            initSelection: function(element, callback) {
                var id=$(element).val();
                if (id!=="") {
                    $.ajax(
                        createUrl("clientele/selectById",['id='+id])
                        , {
                        data: {
                        },
                        dataType: "jsonp"
                    }).done(function(data) {
                        if (data!=''&&typeof data=='object') {
                            callback(data.data[0]);
                        };
                         
                   });
                }
            },
            createSearchChoice: function (term) {
                // console.log(term);
            },
            formatResult:movieFormatResult,
            formatSelection: movieFormatSelection,
            dropdownCssClass: "bigdrop",
            // formatNoMatches: function () { return "Nessun risultato trovato!";},
            // formatSearching: function () { return "Ricerco.."; },
            escapeMarkup: function (m) { return m; } 
        });    
        
        if (prson.length>0) {
            (function(){

             prson.select2({
                    placeholder: "搜索联系人",
                    allowClear: true,//显示取消按钮
                    minimumInputLength: 0,
                    loadMorePadding: 300,
                    quietMillis:100,
                    openOnEnter:true,
                    selectOnBlur:true,
                    ajax: { 
                        url: createUrl("contactpPrson/select"),
                        dataType: 'jsonp',
                        data: function (term, page) {
                            return {
                                q: term, 
                                page_limit: page_limit,
                                clienteleid : clientele.val(),
                                Clientele_page: page,
                            };
                        },
                        results: function (data, page) { 
                            var more = (page * page_limit) < data.totalItemCount; 
                            return {results: data['data'],more:more};
                        }
                    },
                    id:function(object){
                        return object.itemid;
                    },
                    initSelection: function(element, callback) {
                        var id=$(element).val();
                        if (id!=="") {
                            $.ajax(
                                createUrl("contactpPrson/selectById",['id='+id]), {
                                data: {
                                },
                                dataType: "jsonp"
                            }).done(function(data) {
                                if (data!=''&&typeof data=='object') {
                                    callback(data.data[0]);
                                };
                                 
                           });
                        }
                    },
                    formatResult:function(data){return data.nicename;},
                    formatSelection: function(obj){ return obj.nicename},
                    dropdownCssClass: "bigdrop",
                });    
            clientele.on("change", function(e) { 
                prson.select2('val','');
            }) 
            })()
        };      
} 

$('#list-grid,body').on('takLoad',function(){
    tselect();        
});
tselect();

});

$(document).ready(function(){
    $('li .delete').on('click',function(){
        if(!confirm('你确定要删除这个信息吗?')) return false;
    });

    var listDate = $('.type-date');
  if (listDate.length>0) {
        listDate.each(function(){
            var t = $(this)
              , date = new Date(t.val()*1000)
              , maxDate = t.attr('name').indexOf('start')>0?'#F{$dp.$D(\'Events_end_time\')}':''
              , minDate = t.attr('name').indexOf('end')>0?'#F{$dp.$D(\'Events_start_time\')}':''
             ;
             log(maxDate);
             v = t.val();
             if (v>0) {
                t.val(dateFormat(date, 'yyyy-MM-dd hh:mm:ss'));   
             }else{
                t.val('');
             }             
             
            t.on('focus',function(){
               WdatePicker({
                    startDate:'%y-%M-01 00:00:00',
                    dateFmt:'yyyy-MM-dd HH:mm:ss',
                    alwaysUseStartDate:true
                    ,maxDate:maxDate
                    ,minDate:minDate
            })
            });
        });
  };    


   var  afterDelete = function(){}
   , refreshGridView = function(){
     jQuery('#list-grid').yiiGridView('update');
   }
   ;

    $('.delete-select').on('click',function(event){
        event.preventDefault();
        var arr = $.fn.yiiGridView.getSelection('list-grid');
        if (arr.length==0) {
            alert('请选则需要删除的信息!');
           
        }else if(!confirm('你确定要删除选择的'+arr.length+'信息')){

        }else{        
            jQuery('#list-grid').yiiGridView('update', {
                type: 'POST',
                url: jQuery(this).attr('href'),
                success: function(data) {
                   refreshGridView();
                    afterDelete(th, true, data);
                },
                error: function(XHR) {
                    return afterDelete(th, false, XHR);
                }
            });

        }

        return false;
    });
    $('.refresh').on('click',function(event){
        event.preventDefault();
        refreshGridView();
        return false;
    });
    $('.logout').on('click',function(event){
        if (!confirm('是否确认退出？')) {
            event.preventDefault();
            return false;
        };
    })

    $("div[class^='span']").find(".row-form:first").css('border-top', '0px');
    $("div[class^='span']").find(".row-form:last").css('border-bottom', '0px');            
    
    // collapsing widgets
    
        $(".toggle a").click(function(){
            
            var box = $(this).parents('[class^=head]').parent('div[class^=span]').find('div[class^=block]');
            if(box.length == 1){
                
                if(box.is(':visible')){        
                    
                    if(box.attr('data-cookie'))                    
                        $.cookies.set(box.attr('data-cookie'),'hidden');                                        
                    $(this).parent('li').addClass('active');
                    box.slideUp(100);
                    
                }else{                    
                    if(box.attr('data-cookie'))                    
                        $.cookies.set(box.attr('data-cookie'),'visible');                                        
                    $(this).parent('li').removeClass('active');
                    box.slideDown(200);                    
                }
            }            
            return false;
        });
        
    var cList = 5;    
    
    $(".withList").each(function(){
        if($(this).find('.list li').length > cList){        
            $(this).find('.list li').hide().filter(':lt('+cList+')').show();        
            $(this).append('<div class="footer"><button type="button" class="btn btn-small more">show more...</button></div>');                        
        }        
        if($(this).hasClass('scrollBox'))
                $(this).find('.scroll').mCustomScrollbar("update");
    });
    
    
    $(".more").live('click',function(){        
        if(!$(this).hasClass('disabled')){        
            cList = cList+5;
            var wl = $(this).parents('.withList');
            var list = wl.find('.list li');
            list.filter(':lt('+cList+')').show();
            if(list.length < cList) $(this).addClass('disabled');
            if($(wl).hasClass('scrollBox'))
                $(wl).find('.scroll').mCustomScrollbar("update");

        }
    });    
    // eof setting for list with button <<more>>
    
    
    
    $(".header_menu .list_icon").click(function(){        
        var menu = $("body .wrapper .menu");            
        if(menu.is(":visible")){
            menu.fadeOut(200);
            $("body > .modal-backdrop").remove();
        }else{
            menu.fadeIn(300);
            $("body").append("<div class='modal-backdrop fade in'></div>");
        }        
        return false;
    });
    
    if($(".adminControl").hasClass('active')){
        $('.admin').fadeIn(300);
    }
    
    
    $(".adminControl").click(function(){        
        if($(this).hasClass('active')){            
            $.cookies.set('b_Admin_visibility','hidden');            
            $('.admin').fadeOut(200);            
            $(this).removeClass('active');            
        }else{            
            $.cookies.set('b_Admin_visibility','visible');            
            $('.admin').fadeIn(300);            
            $(this).addClass('active');
        }
        
    });
    
    
    $(".navigation .openable > a").on('click',function(event){
        var par = $(this).parent('.openable');
        var sub = par.find("ul");

        if(sub.is(':visible')){
            par.find('.popup').hide();
            par.removeClass('active');
        }else{
            par.addClass('active');            
        }
        event.preventDefault();
        return false;
    });
    
    $(".jbtn").button();
    
    $(".alert").click(function(){
        $(this).fadeOut(300, function(){            
                $(this).remove();            
        });
    });
    
    $(".buttons li > a").click(function(){        
        var parent   = $(this).parent();        
        if(parent.find(".dd-list").length > 0){        
            var dropdown = parent.find(".dd-list");
            if(dropdown.is(":visible")){
                dropdown.hide();
                parent.removeClass('active');
            }else{
                dropdown.show();
                parent.addClass('active');
            }

            return false;
            
        }
        
    });
    
    
    $(".link_navPopMessages").click(function(){
        if($("#navPopMessages").is(":visible")){
            $("#navPopMessages").fadeOut(200);
        }else{
            $("#navPopMessages").fadeIn(300);
        }
        return false;
    });
    
    $(".link_bcPopupList").click(function(){
        if($("#bcPopupList").is(":visible")){
            $("#bcPopupList").fadeOut(200);
        }else{
            $("#bcPopupList").fadeIn(300);
        }
        return false;
    });    
    
    $(".link_bcPopupSearch").click(function(){
        if($("#bcPopupSearch").is(":visible")){
            $("#bcPopupSearch").fadeOut(200);
        }else{
            $("#bcPopupSearch").fadeIn(300);
        }
        return false;
    });        
        
    $(".fancybox").fancybox();

});

$(window).load(function(){
    headInfo();    
});
$(window).resize(function(){
    headInfo();    
    if($("body").width() > 980){        
        $("body .wrapper .menu").show();            
        $("body > .modal-backdrop").remove();
    }else{
        $("body .wrapper .menu").hide();
        $("body > .modal-backdrop").remove();
    }    
    
});


$('.wrapper').resize(function(){    
    if($("body > .content").css('margin-left') == '220px'){
        if($("body > .menu").is(':hidden'))
            $("body > .menu").show();
    }    
    headInfo();
});

function headInfo(){
    var block = $(".headInfo .input-append");
    var input = block.find("input[type=text]");
    var button = block.find("button");    
    input.width(block.width()-button.width()-44);
}



