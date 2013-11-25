jQuery(function($){

var tselect = function(){
    var select = $(".sele1ct-product")
    , wappmovings = $('#product-movings')
    , page_limit = 20
    , notids = ','
    , str = '<tr id=":itemid"><td class="info"><span>:name</span></td> <td><input type="number" class="stor-txt" name="Product[number][:itemid]" required="required" value="1"/></td> <td><input name="Product[note][:itemid]" type="text" class="stor-txt"/></td> <td><a href="#"><span class="icon-remove"></span></a></td> </tr>'
    , removeIds = function(id){
        notids = notids.replace(','+id+',',',');
    }
    , addIds = function(id){
          notids += id+',';
    }
    , getIds = function(){
        return notids.replace(/\,\,+/g,',');
    }
    , addTr = function(id,name){
        var t = str.replace(/:itemid+/g,id).replace(':name',name);
        wappmovings.append(t);
    }
    ,  movieFormatSelection = function(obj) {
        return obj.name;
    } 
    , movieFormatResult = function(data) {
        var markup = "<table class='movie-result'><tr>"
        , material = data.material==null?'':data.material
        , spec = data.spec==null?'':data.spec
        ;
        markup += "<td class='movie-info'><div class='movie-title'>" + data.name + "</div>";
         markup += "<div class='movie-title'>材料："+material+" </div>";
         markup += "<div class='movie-title'>规格："+spec+" </div>";
        markup += "</td></tr></table>"
        return markup;
    }
    ;
     wappmovings.find('tr').each(function(){
        var id = $(this).attr('id');
            addIds(id);   
    });
    wappmovings.on('click', '.icon-remove', function (event) {
        event.preventDefault();
       if (confirm('是否确认移除?')) {
         var p = $(this).parents('tr');
            removeIds(p.attr('id'));
            p.remove();
       };
    })
    select.css('width','100%');

     select.select2({
            placeholder: "搜索产品",
            allowClear: true,//显示取消按钮
            minimumInputLength: 0,
            loadMorePadding: 300,
            quietMillis:100,
            openOnEnter:true,
            selectOnBlur:true,
            ajax: { 
                url: createUrl("product/select"),
                dataType: 'jsonp',
                data: function (term, page) {
                    return {
                        q: term, 
                        page_limit: page_limit,
                        page: page,
                        'not':getIds()
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
                var id = $(element).val();
                if (id!=="") {
                    $.ajax(
                        createUrl("product/selectById",['id='+id])
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
            formatResult:movieFormatResult,
            formatSelection: movieFormatSelection,
            dropdownCssClass: "bigdrop",
        });

    select.on('change',function(e){
        if (e.val!=''&&e.added) {
            addIds(e.val);
            addTr(e.val,e.added.name);  
            // log("change "+JSON.stringify({val:e.val, added:e.added, removed:e.removed}));
        };
        
    });        
      
} 

$('#list-grid,body').on('takLoad',function(){
    tselect();
});
tselect();

    $('[data-preview]').on('click',function(){
        window.open ($(this).attr('data-preview'), 'preview', 'height=350, width=450, top=0, left=0, toolbar=no, menubar=no, scrollbars=no, resizable=no,location=n o, status=no') //这句要写成一行
    })

});