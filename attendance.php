<?php require "partials/header.php"; ?>
<link rel="stylesheet" href="css/attendance.css">
<div class="header-class">
    <div class="classTitle">Take Attendance</div>
    <div class="button">
        <button id="addButtonAttendance"><i class='bx bx-save' style="font-size: 25px;margin-top:5px;"></i></button>
    </div>
</div>
<!-- section and class form start -->
<form class="survey-form" id="searchForm" enctype="multipart/form-data" style="display: flex;flex-wrap:wrap;width:80%;padding:0 0 0 5%;float:left;">
<div class="form-group" style="width: 30%;">
      <label>
        Class
        <select id="dropdown" class="updateClassName" name="class">
        </select>
      </label>
    </div>
    <div class="form-group" style="width: 30%;">
      <label>
        Section
        <select id="dropdown" class="updateSecName" name="section">
        </select>
      </label>
    </div>
    <div class="form-group" style="width: 30%;">
    <label>
      Date
    </label>
    <input type="date" name="date" id="saveAttendanceDate" style="padding: 8px;width: 97%;border-radius: 5px;border: none;background-color: #f4f4f4;"class="attendanceDate" required >
    </div>
    <div class="button update" style="width: 100%;text-align:right;">
            <button id="searchAttendanceButton">Search</button>
    </div>
</form>

<!-- section and class form end -->
<div>
<table class="responstable" id="classTable">
</table>
</div>
<script src="./js/axios.js"></script>
<script src="./js/attendance.js"></script>
<?php require "partials/footer.php"; ?>