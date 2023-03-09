<?php
  require "class/School.php";
  $school=new School();
  if ($school->isLoggedIn()) {
    header("location: index.php");
  }else{
    $school->adminLogin();
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Login</title>
    <link rel="stylesheet" href="./css/login.css" />
    <link
      href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css"
      rel="stylesheet"
    />
  </head>
  <body>
    <div class="container">
      <form action="login.php" method="POST">
        <div class="form-content">
          <div class="login-form">
            <div class="title">Admin Login <span  style="font-size: large;">(SMS)</span></div>
            <div class="input-groups">
              <div class="input-box">
              <i class='bx bxs-envelope' ></i>
                <input
                  type="email"
                  class="input"
                  id="email"
                  name="email"
                  placeholder="Enter your email"
                  required
                />
              </div>
            </div>

            <div class="input-groups">
              <div class="input-box">
              <i class='bx bxs-lock-alt'></i>
                <input
                  type="password"
                  id="password"
                  class="input"
                  name="password"
                  placeholder="Enter your password"
                  required
                />
              </div>
            </div>

            <div class="input-groups">
              <div class="button input-box">
                <button type="submit" name="submit">Submit</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </body>
</html>
