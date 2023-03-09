<?php
require "./class/School.php";
$school=new School();
$school->adminLoginstatus();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SMS</title>
    <!-- icon lib -->
    <link
      href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="./css/style.css" />
  </head>
  <body>
        <!-- partial:index.partial.html -->
        <div class="sidebar active">
      <div class="logo_content">
        <div class="logo">
          <i class="bx bxs-school" style="font-size: 30px"></i>
          <div class="logoname" style="margin-left: 5px">SMS</div>
        </div>
        <i class="bx bx-menu-alt-right" id="btn" style="font-size: 25px"></i>
      </div>
      <ul class="nav_list">
        <li>
          <i class="bx bx-search"></i>
          <input type="text" placeholder="Search..." />
          <span class="tooltip">Search</span>
        </li>
        <li>
          <a href="index.php">
            <i class="bx bx-grid-alt"></i>
            <span class="link_names">Dashboard</span>
          </a>
          <span class="tooltip">Dashboard</span>
        </li>
        <li>
          <a href="students.php">
          <i class='bx bx-user-pin'></i>
            <span class="link_names">Students</span>
          </a>
          <span class="tooltip">Students</span>
        </li>
        <li>
          <a href="classes.php">
          <i class='bx bx-group'></i>
            <span class="link_names">Classes</span>
          </a>
          <span class="tooltip">Classes</span>
        </li>
        <li>
          <a href="#">
          <i class='bx bxs-shapes'></i>
            <span class="link_names">Sections</span>
          </a>
          <span class="tooltip">Sections</span>
        </li>
        <li>
          <a href="#">
          <i class='bx bx-male'></i>
            <span class="link_names">Teachers</span>
          </a>
          <span class="tooltip">Teachers</span>
        </li>
        <li>
          <a href="#">
          <i class='bx bx-book'></i>
            <span class="link_names">Subjects</span>
          </a>
          <span class="tooltip">Subjects</span>
        </li>
        <li>
          <a href="#">
          <i class='bx bx-check-square'></i>
            <span class="link_names">Attendance</span>
          </a>
          <span class="tooltip">Atendance</span>
        </li>
        <li>
          <a href="#">
          <i class='bx bx-line-chart' ></i>
            <span class="link_names">Attendance Report</span>
          </a>
          <span class="tooltip">Attendance Report</span>
        </li>
      </ul>
    </div>
    <div class="navbar-div" >
        <div class="navbar">
          <div class="nav-title">
            School Management<span> System</span>
          </div>
          <div class="head-user">
            <?php echo $_SESSION['first_name']; ?>
          </div>
        </div>
      </div>
    <div class="home_content">
      