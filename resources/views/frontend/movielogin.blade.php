<!DOCTYPE html>
<html>
<head>
  <title>Login Form</title>
   <link rel="stylesheet" type="text/css" href="css/movielogin.css">
 

</head>
<body>
  <div class="login-form">
    <div class="logo">
      <a href="index.html"><img src="images/a.jpg"alt=""></a>
    </div>
    <div class="title-text">
      <h3>Sign in to Your Account</h3>
      
<p> Or, sign in with your email</p>
     
    </div>
     <!-- end Google Button -->
    <form>
   <div class="container">   
    <label for="email"> Your Email</label><p></p>
    <input type="email" placeholder="Enter your email" required>
    <label for="password"> Your password</label><p></p>
    <input type="password" placeholder="Enter your password" required>
  </div>
    <div class="button">  <a href="index.html"><button class="bn632-hover bn18" onclick="redirectToAnotherPage()">Sign in</button></a></div>
      <div class="new-account">
        <a href="contact.html">Forgot your password?</a>
        <p>Don't have an account? <a href="moviesignup.html">Sign up</a></p>


       
      </div>
       
    </form>
  </div>
  <div class="image">
    <img src="images/m.jpg" alt="">
    

  </div>
  <script type="text/javascript">
    function redirectToAnotherPage() {
        // Add code to redirect user to another page after login
        window.location.href = "index.html"; // Replace with the URL you want to redirect to
    }
  </script>
</body>
</html>