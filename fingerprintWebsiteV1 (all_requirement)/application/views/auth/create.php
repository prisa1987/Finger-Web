<!DOCTYPE html>
<head>
<meta charset="utf-8">
</head>
<body>
<div id="container">
 <!--      <?php echo $header;?> -->
      <div id="body" class="body">
<?php echo form_open("auth/create_user");?>
<div id="register">
<h2>Register</h2>
      <fieldset>
            <p>
                  <p><label for="first_name">First Name:*</label>
                  <?php echo '<input  type="text" name="first_name" id="first_name" value="'.$first_name.'">';?>
                  </p>
            </p>
            <p>
                  <p><label for="last_name">Last Name:*</label>
                  <input  type="text" name="last_name" id="last_name">
                  </p>
            </p>
            <p>
                  <p><label for="company">Company:</label>
                  <input  type="text" name="company" id="company">
                  </p>
            </p>
            <p>
                  <p><label for="email">Email:*</label>
                  <input  type="email" name="email" id="email">
                  </p>
            </p>
            <p>
                  <p><label for="phone">Phone:</label>
                  <input  type="text" name="phone" id="phone">
                  </p>
            </p>
            <p>
                  <p><label for="password">Password:*</label>
                  <br>
                  <label style="font-size:15px;">ต้องไม่ต่ำกว่า 9 ตัวอักษร ประกอบไปด้วย ตัวพิมพ์ใหญ่, ตัวพิมพ์เล็ก, ตัวเลข และอักษรพิเศษ</label>
                  <input type="password" name="password" id="password" onBlur="if(this.value=='')this.value='password'" onFocus="if(this.value=='password')this.value=''">
                  </p>
            </p>
            <p>
                  <p><label for="password_confirm">Password confirmation:*</label>
                  <input type="password" name="password_confirm" id="password_confirm" onBlur="if(this.value=='')this.value='password'" onFocus="if(this.value=='password')this.value=''">
                  </p>
            </p>
            <p>
            <input type="submit" id="submitbtn" value="Submit">
            </p>
      </fieldset>
</div>
<?php echo form_close();?>
</div>
</div>
</body>
</html>
