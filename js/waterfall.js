var _al = [];
function waterfall(){
     // 计算及定位数据块显示分散效果
     var _pin = $("#main").find(".pin");
     var _pw = _pin.eq(0).outerWidth();
     var _wh = $(window).height()/2;
     var _ww = $(window).width();
        
    var _co = Math.floor(_ww/_pw);
    var _pi = _pin.length;
    // 初始化数组
    for(var i in _pin){
        if(i<_co){
            _al.push(0);
        }
        _pin.eq(i).css({
            top:_wh,
            left:'50%',
            'margin-top':-(_pin.height()/2)+((Math.floor(Math.random()*10)<5?-1:1)*Math.floor(Math.random()*200)),
            'margin-left':-(_pin.width()/2)+((Math.floor(Math.random()*10)<5?-1:1)*Math.floor(Math.random()*200))
        });
    }
    animateWater(_pin,0,_pw);
}

function checkscrollside(){
  // 检测是否具备了加载数据块的条件
}

function animateWater(_pin,_i,_pw){
        var _t = getMin(_al);
        _pin.eq(_i).animate({
            left:_t*_pw,
            'margin':0,
            top:_al[_t]
        },50,function(){
            _al[_t]+=_pin.eq(_i).outerHeight();
            _i++;
            animateWater(_pin,_i,_pw);
        })
}

function getMin(_al){
    var _minT = Math.min.apply(null,_al);
    for(var i in _al){
        if(_al[i]==_minT){
            return i;
        }
    }
}