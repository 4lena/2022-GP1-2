<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Toxicity Inspector - Login</title>
  <meta content="" name="description">

  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/logo.png" rel="icon">
  <link href="assets/img/logo.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet"> 
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
 
  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/form.css" rel="stylesheet">


</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span>Toxicity Inspector</span>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto" href="index.php">Home</a></li>
          <li><a class="nav-link scrollto" href="index.php#about">About Us</a></li>
          <li><a class="nav-link scrollto" href="index.php#vision">Our Vision</a></li> 
          <li><a class="nav-link scrollto" href="index.php#contact">Contact Us</a></li>
          <li><a class="nav-link scrollto active" href="login.php">Login</a></li>  
          <li><a class="getstarted scrollto" href="signup.php">Sign Up</a></li> 
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>

    </div>
  </header><!-- End Header -->

  <!-- ======= Breadcrumbs ======= -->
  <section class="breadcrumbs">
    <div class="container">

      <ol>
        <li><a href="index.php">Home</a></li>
        <li>Login</li>
      </ol>
      <h2>Login</h2>

    </div>
  </section><!-- End Breadcrumbs -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center">

    <div class="wrapper">
      <div class="title-text">
         <div class="title admin">
            Welcome Back
         </div>
         <div class="title user">
          Welcome Back
         </div>
      </div>
      <div class="form-container">
         <div class="slide-controls">
            <input type="radio" name="slide" id="admin" checked>
            <input type="radio" name="slide" id="user">
            <label for="admin" class="slide admin">Admin</label>
            <label for="user" class="slide user">User</label>
            <div class="slider-tab"></div>
         </div>
         <div class="form-inner">
            <form action="#" class="admin">
               <div class="field">
                  <input type="text" placeholder="Username" required>
               </div>
               <div class="field">
                  <input type="password" placeholder="Password" required>
               </div>
               <div class="pass-link">
                  <a href="#">Forgot password?</a>
               </div>
               <div class="field btn">
                  <div class="btn-layer"></div>
                  <input type="submit" value="Login">
               </div>
               <div class="user-link">
                  Not a member? <a href="signup.php">Sign up now</a>
               </div>
            </form>
            <form action="#" class="user">
               <div class="field">
                  <input type="text" placeholder="Username" required>
               </div>
               <div class="field">
                  <input type="password" placeholder="Password" required>
               </div>
               <div class="pass-link">
                <a href="#">Forgot password?</a>
               </div>
               <div class="field btn">
                  <div class="btn-layer"></div>
                  <input type="submit" value="Login">
               </div>
               <div class="user-link">
                Not a member? <a href="signup.php">Sign up now</a>
             </div>
            </form>
         </div>
      </div>
   </div>
   <script>
      const adminText = document.querySelector(".title-text .admin");
      const adminForm = document.querySelector("form.admin");
      const adminBtn = document.querySelector("label.admin");
      const userBtn = document.querySelector("label.user");
     /*  const userLink = document.querySelector("form .user-link a"); */
      userBtn.onclick = (()=>{
        adminForm.style.marginLeft = "-50%";
        adminText.style.marginLeft = "-50%";
      });
      adminBtn.onclick = (()=>{
        adminForm.style.marginLeft = "0%";
        adminText.style.marginLeft = "0%";
      });
      userLink.onclick = (()=>{
        userBtn.click();
        return false;
      });
      </script>
  </section><!-- End Hero -->

  

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-5 col-md-12 footer-info">
            <a href="index.php" class="logo d-flex align-items-center">
              <img src="assets/img/logo.png" alt="">
              <span>Toxicity Inspector</span>
            </a>
            <p>Toxicity Inspector is a website that enable the users to inspect the 
            overall score of comments as well as enable the users to provide their feedback on the obtained results.</p>
            <div class="social-links mt-3">
              <a href="https://twitter.com/" target="_blank" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="https://facebook.com/" target="_blank" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="https://instagram.com/" target="_blank" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="https://linkedin.com/" target="_blank" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>

          <div class="col-lg-2 col-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="index.php">Home</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="index.php#about">About us</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="index.php#vision">Our Vision</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="index.php#contact">Contact Us</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="login.php">Login</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="signup.php">Sign Up</a></li>
            </ul>
          </div>

     

          <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
            <h4>Contact Us</h4>
            <p>
              King Saud University, <br>
              Riyadh
              <br><br>
              <strong>Phone:</strong> +966 555555555<br>
              <strong>Email:</strong> <a  href = "mailto: toxicityinspector@gmail.com">toxicityinspector@gmail.com</a><br>
            </p>
          </div>

          

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Toxicity Inspector</span></strong>. All Rights Reserved
      </div>
      <div class="credits">

      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>