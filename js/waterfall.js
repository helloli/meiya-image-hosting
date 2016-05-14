var waterfall = function (parent, box) {
    var oParent = document.getElementById(parent);
    var oBoxs = getByClass(oParent, box);
    var oBoxW = oBoxs[0].offsetWidth;
    var cols = Math.floor(document.documentElement.clientWidth / oBoxW);
    var colH = new Array();

    for (var i = 0; i < oBoxs.length; i ++) {
        if (i < cols) {
            // 将图片的高度值添加到数组中
            colH.push(oBoxs[i].offsetHeight);
        } else {
            // 求最小值和最小值的索引
            var minH = Math.min.apply(null, colH);
            var index = getMinhIndex(colH, minH);

            // 计算及定义图片出现的位置
            oBoxs[i].style.position = 'absolute';
            oBoxs[i].style.top = minH + 'px';
            oBoxs[i].style.left = oBoxs[index].offsetLeft + 'px';
            // 改变数组值
            colH[index] = minH + oBoxs[index].offsetHeight;
        }
    }
    function getByClass(parent, clsName) {
        var boxArr = new Array(),
        oElements = parent.getElementsByTagName('*');
        for (var i = 0; i < oElements.length; i ++) {
            if (oElements[i].className == clsName) {
                boxArr.push(oElements[i]);
            }
        }
        return boxArr;
    }

    // 求值在数组中的索引,arr接收的是数组，val接收的是判断的值
    function getMinhIndex(arr, val) {
        for (var i in arr) {
            if (arr[i] == val) {
                return i;
            }
        }
    }
}