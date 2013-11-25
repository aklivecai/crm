jQuery(function($){
var initSelects = function(){
    var clientele = $(".select-clientele").attr({'data-select':'Clientele','placeholder':'搜索客户'})
    , prson = $(".select-prsonid").attr({'data-select':'ContactpPrson','placeholder':'搜索联系人','data-selectby':'input.select-clientele:clienteleid'})
    , manage = $(".select-manageid").attr({'data-select':'Manage'})
    , page_limit = 10
    , defaultID = 'itemid'
    , formatMange = function(data){
        var result = "<table class='movie-result'><tr>";
        result += "<td class='movie-info'><div class='movie-title'>" + data.user_nicename + "</div></td>";
        result += "<td> ("+data.user_name+")</td>"
        result += "</tr></table>";       
        return result;
    }
    , getSwitch = function(type){
        var result = false
          , format = arguments.length>=2?arguments[1]:false
         , arr = {
            'Clientele':{'s1':'clientele_name'},
            'ContactpPrson':{'s1':'nicename'},
            'Manage':{'func':formatMange,'id':'manageid'}
        };
        if (typeof arr[type]!='undefined'){
            if(format){
                if(typeof arr[type][format]!='undefined')
                {
                    result = arr[type][format];
                }else if(format=='id'){
                    result = defaultID;
                }
            }else{
                result = arr[type];
            }
        }
        return result;
    }
    , mFormatSelection = function(data,type) {
        var result = ''
         , arr =  getSwitch(type)
        ;
        if (arr){
            if(typeof arr['s1']!='undefined'){
                result = data[arr['s1']];  
            }else if(typeof arr['func']!='undefined'){
                result = arr['func'](data);
            }
        }
        return result;
    } 
    , mFormatResult = function(data,type) {
        var result = ''
         , arr =  getSwitch(type)
        ;
        if (arr){
            if(typeof arr['s1']!='undefined'){
                result = data[arr['s1']];  
                _temp = "<table class='movie-result'><tr>";
                _temp += "<td class='movie-info'><div class='movie-title'>" + result + "</div>";
                _temp += "</td></tr></table>";
                result = _temp;
            }else if(typeof arr['func']!='undefined'){
                result = arr['func'](data);
            }
        }
        return result;
     }
     , mFormatID = function(data,type){
        var result = ''
         , name =  getSwitch(type,'id')
        ;
        if (typeof data[name]!='undefined'){
            result = data[name];
        }      
        return result;
     }
     , loadSelects = function(elem){
        if(elem instanceof Array){
            for (var i = elem.length - 1; i >= 0; i--) {
                loadSelects(elem[i]);
            };
            return true;
        }        
        var t = $(elem);
        if (t.length==0) {return false;};

            var sType = t.attr('data-select')
            , ajaxUrl = sType+"/select"
            , result = {
                placeholder: "搜索",
                allowClear: true,//显示取消按钮
                minimumInputLength: 0,
                loadMorePadding: 300,
                quietMillis:100,
                openOnEnter:true,
                selectOnBlur:true,
                dropdownCssClass: "bigdrop",
                createSearchChoice: function (term) {},
                escapeMarkup: function (m) { return m; } ,
                formatResult:function(data){return mFormatResult(data,sType)},
                formatSelection: function(data){ return mFormatSelection(data,sType)},
                id:function(data){ return mFormatID(data,sType); },
                ajax: { 
                    url: createUrl(ajaxUrl),
                    dataType: 'jsonp',
                    data: function (term, page) {
                        var result = {q: term, page_limit: page_limit}
                            , _temp = t.attr('data-selectby')
                        ;
                        result[sType+'_page'] = page;
                        if (_temp){
                            _temp = _temp.split(':');
                            result[_temp[1]] = $(_temp[0]).val();
                        };
                        return result;
                    },
                    results: function (data, page) { 
                        var more = (page * page_limit) < data.totalItemCount; 
                        return {results: data['data'],more:more};
                    }
                },
                initSelection: function(element, callback) {
                    var id= t.val();
                    if (id!=="") {
                        $.ajax(createUrl(ajaxUrl,['id='+id])
                            , {dataType: "jsonp"}
                            ).done(function(data) {
                            if (data!=''&&typeof data=='object') {
                                callback(data.data[0]);
                            };
                       });
                    }
                }
            };
            t.select2(result).trigger('select-load');
      }
    ;
    // clientele.css('width','100%');
    // prson.css('width','101%'); 
    prson.on('select-load',function(){
        clientele.on("change", function(e) { 
            prson.select2('val','');
        })        
    });
    loadSelects([clientele,prson,manage]);  
        
} 
    $('#list-grid,body').on('takLoad',function(){ /*tselect();*/});
    initSelects();
});