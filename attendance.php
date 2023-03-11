<?php require "partials/header.php"; ?>
<link rel="stylesheet" href="css/attendance.css">
<div class="header-class">
    <div class="classTitle">Attendance</div>
    <div class="button">
        <button id="addButton"><i class='bx bx-save' style="font-size: 25px;margin-top:5px;"></i></button>
    </div>
</div>
<!-- section and class form start -->
<form class="survey-form" id="searchForm" enctype="multipart/form-data" style="display: flex;flex-wrap:wrap;width:80%;padding:0 0 0 5%;float:left;">
<div class="form-group" style="width: 50%;">
      <label>
        Class
        <select id="dropdown" class="updateClassName" name="class">
        </select>
      </label>
    </div>
    <div class="form-group" style="width: 50%;">
      <label>
        Section
        <select id="dropdown" class="updateSecName" name="section">
        </select>
      </label>
    </div>
    <div class="button update" style="width: 100%;text-align:right;">
            <button id="searchAttendanceButton">Search</button>
    </div>
</form>

<!-- section and class form end -->
<div>
<table class="responstable" id="classTable">
      <tr>
        <th>ID</th>
        <th><span>Reg No</span></th>
        <th><span>Roll No</span></th>
        <th>Name</th>
        <th>Attendance</th>
        <th></th>
        <th></th>
      </tr>
</table>
</div>
<script src="./js/axios.js"></script>
<script src="./js/attendance.js"></script>
<?php require "partials/footer.php"; ?>