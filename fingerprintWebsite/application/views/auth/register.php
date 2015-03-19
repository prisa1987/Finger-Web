<!DOCTYPE html>
<head>
      <meta charset="utf-8">
      <?php echo css_asset('bootstrap.min.css');?>
      <?php echo css_asset('mycss.css');?>
</head>
<body>
      <div id="container">
      <div class=" panel-default" id="head" name="head">
            <div class="panel-body" id="banner" name="banner">
              <img src="">
            </div>
      </div>
      <br>
      <div class="panel panel-default" id="body" name="body">
            <div class="panel-heading "id="title" class="title">
                  <h3 class="panel-title">สมัครสมาชิก</h3>
            </div>
            <?php echo form_open("auth/create_user");?>
                  <div class="panel-body" id="content" name="content">
                        <div class="form-inline col-md-6 col-md-offset-4 " id="register" name="register">
                              <div>
                                    <label class="col-xs-4" for="first_name">ชื่อจริง:*</label>
                                    <?php echo '<input class="form-control" type="text" name="first_name" id="first_name" value="'.$first_name.'">';?>
                              </div>
                              <div>
                                    <label class="col-xs-4" for="last_name">นามสกุล:*</label>
                                    <?php echo '<input class="form-control" type="text" name="last_name" id="last_name" value="'.$last_name.'">';?>
                              </div>
                              <div>
                                    <label class="col-xs-4" for="company">บริษัท:</label>
                                    <?php echo '<input class="form-control" type="text" name="company" id="company" value="'.$company.'">';?>
                              </div>
                              <div>
                                    <label class="col-xs-4" for="email">อีเมลล์:*</label>
                                    <?php echo '<input class="form-control" type="email" name="email" id="email" value="'.$email.'">';?>
                              </div>
                              <div>
                                    <label class="col-xs-4" for="phone">เบอร์โทรศัพท์:</label>
                                    <?php echo '<input class="form-control" type="text" name="phone" id="phone" value="'.$phone.'">';?>
                              </div>
                              <div>
                                    <label class="col-xs-4" for="password">รหัสผ่าน:*</label>
                                    <!-- onBlur="if(this.value=='')this.value='password'" onFocus="if(this.value=='password')this.value=''" -->
                                    <input class="form-control" type="password" name="password" id="password"  >
                                    <br>
                                    <!-- <label style="font-size:15px;">ต้องไม่ต่ำกว่า 9 ตัวอักษร ประกอบไปด้วย ตัวพิมพ์ใหญ่, ตัวพิมพ์เล็ก, ตัวเลข และอักษรพิเศษ</label> -->
                              </div>
                              <div>
                                    <label class="col-xs-4" for="password_confirm">ยืนยันรหัสผ่าน:*</label>
                                    <input class="form-control" type="password" name="password_confirm" id="password_confirm" >
                              </div>
                              <br>
                              <div>
                                    <input class="btn btn-default btn-lg"  type="submit" id="submitbtn" value="สมัครสมาชิก">
                              </div>
                        </div>
                  </div>
            <?php echo form_close();?>
            </div>
      </div>
</body>
</html>
