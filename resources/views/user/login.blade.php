

<!DOCTYPE html>
<html>

<head>
    <title>Animated Login Form</title>
    <link rel="stylesheet" type="text/css" href="./css/login_style.css" method="POST">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<style>
    .error-block {
        font-size: smaller;
        color: #ff5555;
        transform: translate(-80px, 55px);
        /* transform: translateX(); */
        /* transform: translateY(55px); */
    }

    a:link, a:visited {
  background-color: white;
  color: rgb(147, 147, 147);
  
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  border-radius: 25px;
}

a:hover, a:active {
  background-color: green;
  color: white;
}
</style>

<body>
    <img class="wave" src="assets/wave.png">
    <div class="container">
        <div class="img">
            <img src="assets/bg.svg">
        </div>
        <div class="login-content">
            <form action="{{ route('login.action') }}" method="POST">
                @csrf
                <img src="assets/avatar.svg">
                <h2 class="title">Login</h2>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Username</h5>
                        <input class="input" type="username" name="username" value="{{ old('username') }}" />
                        @if($errors->any())
                        <div class="error-block">{{$errors->all()[0]}} *</div>
                        @endif
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Password</h5>
                        <input class="input" type="password" name="password" />
                        @if($errors->any())
                        <div class="error-block">{{$errors->all()[1]}} *</div>
                        @endif
                    </div>
                </div>
                <a href="/password">Forgot Password?</a>
                <!-- <button type="submit">Login</button> -->
                <!-- <button type="submit" class="btn" value="Login">
                <a href="./" style="text-align: center">Kembali</a> -->
                <input type="submit" class="btn" value="Login">
                <div style="display: flex; 
                 justify-content: space-between;
                  ">
                    
				<a href="./" style="text-align: center">Kembali</a>
                <a href="/register" style=" text-align: center">Register</a>
                </div>
                
            </form>
        </div>
    </div>
    <script type="text/javascript" src="main.js"></script>
</body>

</html>