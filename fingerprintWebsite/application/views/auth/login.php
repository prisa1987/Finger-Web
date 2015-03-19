<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <?php echo css_asset('bootstrap.min.css');?>
  <?php echo css_asset('mycss.css');?>
  </head>
<body>
<div id="container" name="container">
  <div class=" panel-default" id="head" name="head">
      <div class="panel-body" id="banner" name="banner">
        <img src="">
      </div>
  </div>
  <br>
  <div class="panel panel-default" id="body" name="body">
            <div class="panel-heading " id="title" class="title">
                <h3 class="panel-title">เข้าสู่ระบบ</h3>
            </div>
    <?php echo form_open("auth/login");?>
    <div class="panel-body" id="content" name="content">
      <div class="col-md-4 col-md-offset-4" id="login" name="login">
        <?php echo '<input class="form-control" placeholder="อีเมลล์" type="email" name="identity" id="identity" value="'.$identity.'" >';?>
        <br>
        <?php echo '<input type="password" class="form-control" placeholder="รหัสผ่าน" name="password" id="passwordlogin" value="'.$password.'" >';?>
        <br>
        <input class="btn btn-default btn-lg " type="submit" id="submitbtn" value="เข้าระบบ">
        <!-- <a href="register" style="text-decoration:none;" id="register" name="register">
        <input class="btn btn-default btn-lg " type="button" id="register" value="Register">
        </a> -->
        <?php echo anchor('auth/loadForgotPassword','ลืมรหัสผ่าน?');?>
        <?php echo form_close();?>
      </div>
    </div>
  </div>
  </div>
</body>
</html>