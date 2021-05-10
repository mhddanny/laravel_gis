<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>From Login</title>
    <link rel="stylesheet" href="{{ asset('test/css/style.css')}}">

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  </head>
  <body>
    <div class="bg-img">
      <div class="content">
        <header>
          Login From
        </header>
          <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="field">
              <span class="fa fa-user"></span>
              <input type="text" name="username" required placeholder="username" value="">
            </div>

            <div class="field space">
              <span class="fa fa-lock"></span>
              <input type="password" class="password" required name="password" placeholder="password" value="">
              <span class="show">SHOW</span>
            </div>
            <div class="pass">
              <a href="#">Forgot Password?</a>
            </div>
            <div class="field ">
              <input type="submit" value="Login">
            </div>
            <div class="login">Or Login with</div>
              <div class="link">
                <div class="facebook">
                  <i class="fab fa-facebook-f"><span>Facebook</span></i>
                </div>
                <div class="instagram">
                  <i class="fab fa-instagram"><span>Instagram</span></i>
                </div>
              </div>
              <div class="singup">Don't have account?
                <a href="#">Singup Now</a>
              </div>
          </form>
        </div>
      </div>
      <script>
        const pass_field = document.querySelector('.password');
        const show_btn = document.querySelector('.show');
        show_btn.addEventListener('click', function(){
          if (pass_field.type === "password") {
            pass_field.type = "text";
            show_btn.style.color = "#3498db";
            show_btn.textConten = "HIDE";
          }
          else {
            pass_field.type = "password";
            show_btn.style.color = "#222";
            show_btn.textConten = "SHOW";
          }
        });
      </script>
  </body>
</html>
