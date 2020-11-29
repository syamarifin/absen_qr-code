<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>SIUJAR - ITB asia malang</title>
    <link rel="icon" href="<?php echo base_url('assets/images/lg1_logo.png')?>" type="image/png">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/styleLogin.css')?>">
   <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  </head>
  <body>
    <div class="bg-img">
      <div class="content">
        <header>Login Form</header>
        <form method="post" action="<?php echo base_url('auth/aksi_login'); ?>">
          <div class="field">
            <span class="fa fa-user"></span>
            <input type="text" required placeholder="Email" id="username" name="username">
          </div>
          <div class="field space">
            <span class="fa fa-lock"></span>
            <input type="password" class="pass-key" required placeholder="Password" id="password" name="password">
            <span class="show">SHOW</span>
          </div>
          <div class="pass">
            <br/>
            <a href="#"></a>
          </div>
          <div class="field">
            <input type="submit" value="LOGIN">
          </div>
        </form>
      </div>
    </div>

    <script>
      const pass_field = document.querySelector('.pass-key');
      const showBtn = document.querySelector('.show');
      showBtn.addEventListener('click', function(){
       if(pass_field.type === "password"){
         pass_field.type = "text";
         showBtn.textContent = "HIDE";
         showBtn.style.color = "#3498db";
       }else{
         pass_field.type = "password";
         showBtn.textContent = "SHOW";
         showBtn.style.color = "#222";
       }
      });
    </script>


  </body>
</html>
