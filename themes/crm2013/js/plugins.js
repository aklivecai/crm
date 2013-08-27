
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

    var calendar = $('#calendar').fullCalendar({
            header: {		
                    left: 'prev,next',
                    center: 'title',
                    right: ''
                    //right: 'month,agendaWeek,agendaDay'
            },
            selectable: true,
            selectHelper: true,
            select: function(start, end, allDay) {
                    var title = prompt('Event Title:');
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
            editable: true,
            events: [
                    {
                            title: 'All Day Event',
                            start: new Date(y, m, 20),
                            end: new Date(y, m, 21)
                    },
                    {
                            title: 'Long Event',
                            start: new Date(y, m, 1),
                            end: new Date(y, m, 10)
                    }
            ]
    });

    // SELECT2       
        $("#s2_1").select2();
        $("#s2_2").select2();
        
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
      
        
        
    $('.ibtn').iButton();
    
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