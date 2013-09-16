
$(document).ready(function(){

    /* LEFT SIDE DATEPICKER */
    $("#menuDatepicker").datepicker();
    /* UI elements datepicker */        
    $("#Datepicker").datepicker();    
    
    /* CALENDAR */
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();

    var calendar = $('.fc').fullCalendar({
            header: {		
                left: 'prev,next today',
                left:  'prev,today,next',//nextYear,prevYear
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
                ,right: 'month,basicWeek,basicDay,agendaWeek,agendaDay'

            },
buttonText:{
    prevYear: '去年',
    nextYear: '明年',
    today:    '今天',
    month:    '月',
    week:     '周',
    day:      '日'
},
// 15.默认显示的视图，注意引号
defaultView:'month',
// 22.指定默认的时间格式
timeFormat:'HH(:MM)',
// 标题格式化
titleFormat:{
    month: 'MMMM yyyy',                             // September 2009
    week: "MMM d[ yyyy]{ '&#8212;'[ MMM] d yyyy}", // Sep 7 - 13 2009
    day: 'dddd, yyyy-MMM-d '                  // Tuesday, Sep 8, 2009
},      
monthNames:['一月','二月', '三月', '四月', '五月', '六月', '七月','八月', '九月', '十月', '十一月', '十二月'],     
 // 月名字的简写
monthNamesShort:['一月','二月', '三月', '四月', '五月', '六月', '七月','八月', '九月', '十月', '十一月', '十二月'],     

dayNames:['星期日', '星期一', '星期二', '星期三','星期四', '星期五', '星期六'],
// 星期名字的缩写
dayNamesShort:['日', '一', '二', '三', '四', '五', '六'],
// 31.日程默认为全天日程
allDayDefault:true,
// 43.是否可以拖拽和改变大小
editable:true,
// 44.禁止拖拽和改变大小
disableDragging:false,
disableResizing:false,
// 45.如果拖拽不成功，多久回复原状,单位是毫秒
dragRevertDuration:500,  
// 46.拖拽不透明度
dragOpacity:{
agenda:.5, //对于agenda试图
'':1.0   //其他视图
},
editable: true,
            selectable: true,
            selectHelper: true,
            select: function(start, end, allDay) {
                    var title = prompt('行程的名字:');
                    if (title) {
                            calendar.fullCalendar('renderEvent',
                                    {
                                            title: title,
                                            start: start,
                                            end: end,
                                            allDay: allDay
                                    },
                                    true // make the event "stick"
                            );
                    }
                    calendar.fullCalendar('unselect');
            },
// 当点击某一个事件时触发此操作            
eventClick: function(calEvent, jsEvent, view) {
        var str = '';
        str+=('Event: ' + calEvent.title);
        str+=('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
        str+=('View: ' + view.name);
        console.log(str);
        console.log(calEvent);
        // change the border color just for fun
        $(this).css('border-color', 'red');
        $('#calendar').fullCalendar('updateEvent', event);

    }      

// 当开始读取的时候是true,当读取完成是false
,events: createUrl('events/list')   
,eventDrop: function(event,dayDelta,minuteDelta,allDay,revertFunc) {
        log(
            event.title + " was moved " +
            dayDelta + " days and " +
            minuteDelta + " minutes."
        );
        log(this);

        if (allDay) {
            console.log("Event is now all-day");
        }else{
            console.log("Event has a time-of-day");
        }

        if (!confirm("Are you sure about this change?")) {
            revertFunc();
        }

    }
    });

        
    // CHECKBOXES AND RADIO
         $(".row-form,.row-fluid,.dialog,.loginBox,.block,.block-fluid").find("input:checkbox, input:radio, input:file").not(".skip, input.ibtn").uniform();
        
 
        
        
    // CUSTOM SCROLLING
    
        $(".scroll").mCustomScrollbar();
    
    // ACCORDION 
    
        $(".accordion").accordion();
    
    // PROGRESSBAR
        
    // DIALOG
    
    $("#b_popup_1").dialog({autoOpen: false});
        
        $("#popup_1").click(function(){$("#b_popup_1").dialog('open')});
        
    $("#b_popup_2").dialog({autoOpen: false, show: "blind", hide: "explode"});

        $("#popup_2").click(function(){$("#b_popup_2").dialog('open')});

    $("#b_popup_3").dialog({autoOpen: false, modal: true});
        
        $("#popup_3").click(function(){$("#b_popup_3").dialog('open')});
        
    $("#b_popup_4").dialog({autoOpen: false, 
                            modal: true,
                            width: 400,
                            buttons: {                            
                                "Ok": function() {
                                    $( this ).dialog( "close" );
                                },
                                Cancel: function() {
                                    $( this ).dialog( "close" );
                                }
    }});
    
        $("#popup_4").click(function(){$("#b_popup_4").dialog('open')});
    
    // SLIDER
    
        $("#slider_1").slider({
            value: 60,
            orientation: "horizontal",
            range: "min",
            animate: true,
            slide: function( event, ui ) {
                $( "#slider_1_amount" ).html( "$" + ui.value );
            }
        });
        
        $("#slider_2").slider({
            values: [ 17, 67 ],
            orientation: "horizontal",
            range: true,
            animate: true,
            slide: function( event, ui ) {
                $( "#slider_2_amount" ).html( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
            }            
        });    
            
        $("#slider_3").slider({
            orientation: "vertical",
            range: "min",
            min: 0,
            max: 100,
            value: 10,
            slide: function( event, ui ) {
                $( "#slider_3_amount" ).html( '$'+ui.value );
            }            
        }); 

        $("#slider_4").slider({
            orientation: "vertical",
            range: true,
            values: [ 17, 67 ]
        }); 

        $("#slider_5").slider({
            orientation: "vertical",            
            range: "max",
            min: 1,
            max: 10,
            value: 2
        }); 
 
    // new selector case insensivity        
        $.expr[':'].containsi = function(a, i, m) {
            return jQuery(a).text().toUpperCase().indexOf(m[3].toUpperCase()) >= 0;
        };        
   //        
        
    // TABS
    
        $( ".tabs" ).tabs();
         
         // Bootstrap tooltip
         $(".tip").tooltip({placement: 'top', trigger: 'hover'});
         $(".tipb").tooltip({placement: 'bottom', trigger: 'hover'});
         $(".tipl").tooltip({placement: 'left', trigger: 'hover'});
         $(".tipr").tooltip({placement: 'right', trigger: 'hover'});


        // SORTABLE       
            $("#sort_1").sortable({placeholder: "placeholder"});
            $("#sort_1").disableSelection();    

            $( ".selector" ).sortable({ connectWith: "#shopping-cart" });
            
        // SELECTABLE
            $("#selectable_1").selectable();
            
            
        // WYSIWIG HTML EDITOR
            if($("#wysiwyg").length > 0){
                editor = $("#wysiwyg").cleditor({width:"100%", height:"100%"})[0].focus();                
            }                                          
            if($("#mail_wysiwyg").length > 0)
                m_editor = $("#mail_wysiwyg").cleditor({width:"100%", height:"100%",controls:"bold italic underline strikethrough | font size style | color highlight removeformat | bullets numbering | outdent alignleft center alignright justify"})[0].focus();
            
            $('#sendmail').on('shown', function () {
                m_editor.refresh();
                $(this).find('.uploader').show();
            });            
            
        // WYSIWIG HTML EDITOR    
                
         /* Multiselect */
         if($("#multiselect").length > 0){
            $("#multiselect").multiSelect();
         }
         if($("#fmultiselect").length > 0){
            $("#fmultiselect").multiSelect({
                selectableHeader: "<div class='multipleselect-header'>Selectable item</div>",
                selectedHeader: "<div class='multipleselect-header'>Selected items</div>"
            });
            $('#multiselect-selectAll').click(function(){
                $('#fmultiselect').multiSelect('select_all');
                return false;
            });
            $('#multiselect-deselectAll').click(function(){
                $('#fmultiselect').multiSelect('deselect_all');
                return false;
            });
            $('#multiselect-selectIndia').click(function(){
                $('#fmultiselect').multiSelect('select', 'in');
                return false;
            });         
         }
         if($(".tags").length > 0)
            $(".tags").tagsInput({'width':'100%',
                                'height':'auto'});         
      
        
        
    $('.ibtn').iButton({
         duration: 200                           // the speed of the animation
       , easing: "swing"                         // the easing animation to use
       , labelOn: "启用"                           // the text to show when toggled on
       , labelOff: "锁定"                         // the text to show when toggled off
       , resizeHandle: "auto"                    // determines if handle should be resized
       , resizeContainer: "auto"                 // determines if container should be resized
       , enableDrag: true                        // determines if we allow dragging
       , enableFx: true                          // determines if we show animation
       , allowRadioUncheck: false                // determine if a radio button should be able to
                                                 // be unchecked
       , clickOffset: 120                        // if millseconds between a mousedown & mouseup event this
                                                 // value, then considered a mouse click

       // define the class statements
       , className:         ""                   // an additional class name to attach to the main container
       , classContainer:    "ibutton-container"
       , classDisabled:     "ibutton-disabled"
       , classFocus:        "ibutton-focus"
       , classLabelOn:      "ibutton-label-on"
       , classLabelOff:     "ibutton-label-off"
       , classHandle:       "ibutton-handle"
       , classHandleMiddle: "ibutton-handle-middle"
       , classHandleRight:  "ibutton-handle-right"
       , classHandleActive: "ibutton-active-handle"
       , classPaddingLeft:  "ibutton-padding-left"
       , classPaddingRight: "ibutton-padding-right"

       // event handlers
       , init: null                              // callback that occurs when a iButton is initialized
       , change: null                            // callback that occurs when the button state is changed
       , click: null                             // callback that occurs when the button is clicked
       , disable: null                           // callback that occurs when the button is disabled/enabled
       , destroy: null            
    });
    
    // Scroll up plugin
     $.scrollUp({scrollText: '^'});
    // eof scroll up plugin    
});


$('.wrapper').resize(function(){

    if($("#wysiwyg").length > 0) editor.refresh();
    if($("#mail_wysiwyg").length > 0) m_editor.refresh();

    
});

function notify(title, text){
    $.pnotify({title: title, text: text, opacity: .8, addclass: 'palert'});
}
function notify_s(title,text){
    $.pnotify({title: title, text: text, opacity: .8, type: 'success'});            
}
function notify_i(title,text){
    $.pnotify({title: title, text: text, opacity: .8, type: 'info'});            
}
function notify_e(title,text){
    $.pnotify({title: title, text: text, opacity: .8, type: 'error'});            
}