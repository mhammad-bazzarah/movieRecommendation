<!DOCTYPE html>
<html>
<head>
  <title>Sign Up Form</title>
  <link rel="stylesheet" type="text/css" href="css/moviesignup.css">
 

</head>
<body>
  <div class="signup-form">
    <div class="logo">
      <a href="index.html"><img src="images/a.jpg" alt=""></a>
    </div>
    <div class="title-text">
      <h3>Create an Account</h3>
    </div>
    
  
<div class="a8 a9 a1x a23">
<span class="
  aj
  sm:ah
  aB[60px] a7 at[1px] a3f
"></span>
<p class="
  a7
  a37
  a1S
  a1M
  aH
  a1R
">
Or, register with your email
</p>
<span class="
  aj
  sm:ah
  aB[60px] a7 at[1px] a3f
"></span>
</div>
    <!--  end Google sign up-->
    
    <form>
      <div class="container">
        <div class="row">
          <div class="field">
            <label for="email"> Your Email</label>
            <input type="email" placeholder="Email" required>
          </div>
          <div class="field">
            <label for="text"> Your Name</label>
            <input type="text" placeholder="Name" required>
          </div>
        </div>
        <div class="row">
          <div class="field">
            <label for="text"> Your Address</label>
            <input type="text" placeholder="Address" required>
          </div>
          <div class="field">
            <label for="Password"> Your Password</label>
            <input type="password" placeholder="Password" required>
          </div>
        </div>
        <div class="row">
          <div class="field">
            <label for="Phone"> Your Phone</label>
            <input type="tel" placeholder="Phone" required>
          </div>
          </div>
      </div>
      
  
     <div class="button"> <a href="index.html"><button class="bn632-hover bn18" onclick="redirectToAnotherPage()">Sign Up</button></a></div>
    </form>
    <div class="login-link">
      <p>Already have an account? <a href="movielogin.html">Log in</a></p>
    </div>
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