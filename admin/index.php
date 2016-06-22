<?php
    session_start();
    if(isset($_SESSION["name"])){
        $is_login = true;
    } else {
        $is_login = false;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>上传图片</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/layout.css">
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</head>
<body>


<?php
    if (!$is_login) {
?>
<!-- 模态框（Modal） -->
<div class="modal" style="background-color: #ccc" id="myModal" tabindex="-1" role="dialog" 
   aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <!-- <button type="button" class="close" 
               data-dismiss="modal" aria-hidden="true">
                  &times;
            </button> -->
            <h4 class="modal-title" id="myModalLabel">
               请登录
            </h4>
         </div>
         <div class="modal-body">
           <div class="form-group">
              <input type="text" class="form-control" id="name" 
                 placeholder="用户名">
           </div>
           <div class="form-group">
              <input type="password" class="form-control" id="password" 
                 placeholder="密码">
           </div>
         </div>
         <div class="modal-footer">
            <span id="msg" style="float:left;color:red;">*用户名或密码错误</span>
            <!-- <button type="button" class="btn btn-default" 
               data-dismiss="modal">关闭
            </button> -->
            <button id="submit" type="button" class="btn btn-primary">
               登录
            </button>
         </div>
      </div><!-- /.modal-content -->
</div><!-- /.modal -->
<script>
    $('#msg').hide();
    $('#name').focus();
    $('#myModal').modal({
        show: true,
        backdrop: 'static',
        keyboard: false
    });
    $('button').click(function () {

        $.ajax({
            type: 'POST',
            url: 'login.php',
            data: {name: $('#name').val(), pw: $('#password').val()},
            dataType: 'json',
            success: function (json) {
                if (json.msg) {
                    $('#msg').show();
                    $('#name').focus();
                } else {
                    // console.log(json);
                    // $('#msg').html('登录成功！');
                    window.location.reload();
                }
            }
        });
    });
</script>
<?php
    } else {
?>

<div class="jumbotron">
    <div class="container">
        <h1>美丫图床图片上传<button id="logout" class="btn btn-primary">登出</button></h1>
        <!-- <p>美丫图床为大家带来各种炫酷的表情哦</p> -->
        <p>
            <!-- <button class="btn btn-info" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false">登录</button> -->
            
            <input type="file" multiple="true" id="uploads">
        </p>
    </div>
</div>
<div class="wrap">
    <div id="main"></div>
</div>
<!-- 
<div class="inputDiv">
    <input type="file" multiple="true" id="uploads">
</div> -->
<script src="../js/up.itorr.js"></script>
<script>

    $('#logout').click(function () {
        $.ajax({
            type: 'GET',
            url: 'logout.php',
            success: function (json) {
                // console.log(json);
                window.location.reload();
            }
        });
    });

    // 监测上传框数据变化，有则执行上传图片处理
    $('#uploads').change(function () {

        // 如果上传框里没有数据则返回
        if (!this.files || !this.files[0]) {
            return alert('选取文件出错！');
        }

        // 上传了多少张图片就在main里添加多少个空的div
        for (var i = 0, len = this.files.length; i < len; i ++) {
            var node = '<div class="picbox" id="box'
            + i + '"><div class="pic progress">0%</div></div>';
            $('#main').prepend(node);
        }

        // 对所有图片进行依次上传
        for (var i = 0, len = this.files.length; i < len; i ++) {
            var picfile = this.files[i];

            // 监测上传的文件是不是图片
            if (picfile.type.indexOf('image') != 0) {
                return alert('这不是一个图像呀！');
            }

            // 将图片上传到微博服务器，并返回图片唯一的pid
            upPic(picfile, function (pid) {
                var postData = JSON.stringify({'pid': pid});

                // 将返回的pid存储到数据库
                $.ajax({
                    type: 'POST',
                    url: 'save.php',
                    data: postData,
                    dataType: 'json',
                    success: function (json) {
                        $('.progress').last().html('<img src="http://ww2.sinaimg.cn/large/'
                            + pid
                            + '" /></div</div>')
                        .removeClass('progress')
                        .parent()
                        .attr('id', json.data[0].id);
                    }
                });
            }, function () {
                alert('上传文件出错了！');
            }, function (progress) {
                $('.progress').last().html(parseInt(progress * 100) + '%');
            })
        }
    });
</script>
<?php
    }
?>



</body>
</html>