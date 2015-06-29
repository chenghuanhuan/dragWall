/*
 *下面拖动代码来源于http://www.newxing.com/Tech/WebDevelop/JavaScript/472.html
 *在此感谢原作者，转载请声明来源
 *@author @ken @1039110278
 */
Number.prototype.NaN0=function(){return isNaN(this)?0:this;}
var iMouseDown  = false;
var dragObject  = null;
var curTarget   = null;
var pageMaxNotes=50;

function makeDraggable(item){
    if(!item) return;
    item.onmousedown = function(ev){
        dragObject  = this;
        mouseOffset = getMouseOffset(this, ev);
        return false;
    }
}

function getMouseOffset(target, ev){
    ev = ev || window.event;

    var docPos    = getPosition(target);
    var mousePos  = mouseCoords(ev);
    return {x:mousePos.x - docPos.x, y:mousePos.y - docPos.y};
}

function getPosition(e){
    var left = 0;
    var top  = 0;
    while (e.offsetParent){
        left += e.offsetLeft + (e.currentStyle?(parseInt(e.currentStyle.borderLeftWidth)).NaN0():0);
        top  += e.offsetTop  + (e.currentStyle?(parseInt(e.currentStyle.borderTopWidth)).NaN0():0);
        e     = e.offsetParent;
    }

    left += e.offsetLeft + (e.currentStyle?(parseInt(e.currentStyle.borderLeftWidth)).NaN0():0);
    top  += e.offsetTop  + (e.currentStyle?(parseInt(e.currentStyle.borderTopWidth)).NaN0():0);

    return {x:left, y:top};

}

function mouseCoords(ev){
    if(ev.pageX || ev.pageY){
        return {x:ev.pageX, y:ev.pageY};
    }
    return {
        x:ev.clientX + document.body.scrollLeft - document.body.clientLeft,
        y:ev.clientY + document.body.scrollTop  - document.body.clientTop
    };
}

function mouseDown(ev){
    ev         = ev || window.event;
    var target = ev.target || ev.srcElement;

    if(target.onmousedown || target.getAttribute('DragObj')){
        return false;
    }
}

function mouseUp(ev){

    dragObject = null;

    iMouseDown = false;
}

function mouseMove(ev){
    ev         = ev || window.event;

    /*
    We are setting target to whatever item the mouse is currently on

    Firefox uses event.target here, MSIE uses event.srcElement
    */
    var target   = ev.target || ev.srcElement;
    var mousePos = mouseCoords(ev);
    

    if(dragObject){
        dragObject.style.position = 'absolute';
        dragObject.style.top      = mousePos.y - mouseOffset.y;
        dragObject.style.left     = mousePos.x - mouseOffset.x;
        if(dragObject.style.zIndex!=pageMaxNotes)
        {
            pageMaxNotes++;
            dragObject.style.zIndex=pageMaxNotes;
        }
    }

    // track the current mouse state so we can compare against it next time
    lMouseState = iMouseDown;

    // this prevents items on the page from being highlighted while dragging
    if(curTarget || dragObject) return false;
}

document.onmousemove = mouseMove;
document.onmousedown = mouseDown;
document.onmouseup   = mouseUp;

/**
 * @author Mr.Think
 * @author blog http://mrthink.net/
 * @2011.01.27
 * 可自由转载及使用,但请注明版权归属
 */
function fadeIn(elem, speed, opacity){
        //底层共用
    var iBase = {
        Id: function(name){
            return document.getElementById(name);
        },
		//设置元素透明度,透明度值按IE规则计,即0~100
        SetOpacity: function(ev, v){
            ev.filters ? ev.style.filter = 'alpha(opacity=' + v + ')' : ev.style.opacity = v / 100;
        }
    }
    
       speed = speed || 20;
        opacity = opacity || 100;
      //显示元素,并将元素值为0透明度(不可见)
        elem.style.display = 'block';
        iBase.SetOpacity(elem, 0);
       //初始化透明度变化值为0
       var val = 0;
      //循环将透明值以5递增,即淡入效果
      (function(){
          iBase.SetOpacity(elem, val);
            val += 5;
           if (val <= opacity) {
               setTimeout(arguments.callee, speed)
            }
        })();
   }

/*
 *生成随机数
 */
function GetRandomNum(Min,Max)
{   
    var Range = Max - Min;   
    var Rand = Math.random();   
    return(Min + Math.round(Rand * Range));   
} 

//留言条出现的最低位置
var maxHeight = 960-350;

//留言条出现的最右位置

var maxWidth = 960-235;
// 创建留言条的个数
var note_count=0;
// 初始化
$(function(){
    /** 关于留言板的初始化 */
    //取得所有的note类留言条
    var notes=document.getElementsByName("note");
    
    //此时note所在层最小为49，最高层为49+note数量
    pageMaxNotes=49+notes.length;
    
    //得到此时文档宽度
    var bodyWidthMain = document.body.offsetWidth;
    
    //因为留言条的拖动是相对于整个body，而定位是相对于这个main
    //左右宽度body与main的差值
    var baseOffsetLeft = (bodyWidthMain-960)/2;
    
    //上下高度body与main的差值
    var baseOffsetTop = 0;
    

        
    for(var i=0;i<notes.length;i++)
    {
        makeDraggable(notes[i]);
        
        //随机出现位置
        notes[i].style.top = baseOffsetTop + GetRandomNum(0 , maxHeight);
        notes[i].style.left =baseOffsetLeft + GetRandomNum(0 ,maxWidth);
        
        //位置确定后淡入
        fadeIn(notes[i]);
    }

    /** 关于弹窗的初始化*/
    var $el = $('.dialog');
    $el.hDialog({
        width:400,
        height:400,
        beforeShow: function(){
        // 默认值设置
        $("input[name='expression']:eq(0)").prop("checked","checked");
        $("input[name='skin']:eq(0)").prop("checked","checked");
        }
    });
    // 初始化悬浮窗
    xuanfu();

    //提交并验证表单
    $('.submitBtn').click(function() {
        // 内容
        var $content = $.trim($('.content').val());
        // 表情
        var $expression = $("input[name='expression']:checked").val(); 
        // 皮肤
        var $skin = $("input[name='skin']:checked").val(); 
        // 姓名
        var $name = $.trim($('.name').val());
        if($content == ''){
            $.tooltip('想要说的话还没填呢...'); $content.focus();
            return;
        }
        if($content.length>140){
            $.tooltip('只能说200字以内的话哦...'); $content.focus();
            return;
        }
        if($name.length>20){
            $.tooltip('尼玛，你名字怎么这么长...'); $content.focus();
            return;
        }

        

            var data = {content:$content,expression:$expression,skin:$skin,name:$name};
            $.ajax({ url: "php/save.php", 
                    type:"POST",
                    data:data,
                    dataType:"json" ,
                    success: function(data){
                       if(data.success){
                          $.tooltip('留言成功!',2000,true);
                          note_count++;
                          var div = "";
                          div +='<div name="note" class="note" id="note'+note_count+'">';
                          div +=  '<div class="nhead" style="background-image: url(./images/a'+$skin+'_1.gif);">';
                          div +=  data.time;
                          div +=  '</div>';
                          div +=  '<div class="nbody" style="background-image: url(./images/a'+$skin+'_2.gif);">';
                          div +=  $content;
                          div +=  '</div>';
                          div +=  '<div class="nfoot" style="background-image: url(./images/a'+$skin+'_3.gif);">';
                          div +=      '<div class="moodpic">';
                          div +=          '<img src="images/'+$expression+'.gif"/>';
                          div +=      '</div>';
                          div +=      '<div class="username">';
                          div +=      $name;
                          div +=      '</div>';
                          div +=  '</div>';
                          div +='</div> '; 
                        $("#main").append(div);
                        var note = document.getElementById("note"+note_count);
                        makeDraggable(note);
        
                        //随机出现位置
                        note.style.top = baseOffsetTop+maxHeight/2;
                        note.style.left =baseOffsetLeft+ maxWidth/2;
                        
                        //位置确定后淡入
                        fadeIn(note);
                        $el.hDialog('close',{box:'#HBox'}); 
                        reset();
                       }
                

                }
            });
            
        
    });
});

// 重置表单
function reset(){
    $('.content').val('');
    var $name = $('.name').val('');
    $("input[name='expression']:eq(0)").prop("checked","checked");
    $("input[name='skin']:eq(0)").prop("checked","checked");
}
/**
 * 悬浮窗
 */
function xuanfu(){
    var $bottomTools = $('.bottom_tools');
    var $qrTools = $('.qr_tool');
    var qrImg = $('.qr_img');
    
    $(window).scroll(function () {

        var scrollHeight = $(document).height();

        var scrollTop = $(window).scrollTop();
        console.log(scrollTop+"     "+scrollHeight);
        var $windowHeight = $(window).height();
        console.log("$windowHeight"+$windowHeight);
        scrollTop > 50 ? $("#scrollUp").fadeIn(200).css("display","block") : $("#scrollUp").fadeOut(200);           
        $bottomTools.css("bottom", 40);
        console.log($bottomTools.css("bottom"));
    });
    
    $('#scrollUp').click(function (e) {
        e.preventDefault();
        $('html,body').animate({ scrollTop:0});
    });
    
    $qrTools.hover(function () {
        qrImg.fadeIn();
    }, function(){
         qrImg.fadeOut();
    });
}

