<?php require "partials/header.php"; ?>
<link rel="stylesheet" href="css/attendance_report.css">
<div class="header-class">
    <div class="classTitle">Attendance Report</div>
</div>
<!-- section and class form start -->
<form class="survey-form" id="searchForm" enctype="multipart/form-data" style="display: flex;flex-wrap:wrap;width:80%;padding:0 0 0 5%;float:left;">
<div class="form-group" style="width: 50%;">
      <label>
        Class
        <select id="dropdown" class="updateClassName" name="class">
          <option value="">Select</option>
        </select>
      </label>
    </div>
    <div class="form-group" style="width: 50%;">
      <label>
        Section
        <select id="dropdown" class="updateSecName" name="section">
        <option value="">Select</option>
        </select>
      </label>
    </div>
    <div class="form-group" style="width: 50%;">
      <label>
        Student Name
        <select id="dropdown" class="updateStudentName" name="student">
        <option value="">Select</option>
        </select>
      </label>
    </div>
    <div class="form-group" style="width: 50%;">
    <label>
      Date
    </label>
    <input type="date" name="date" id="saveAttendanceDate" style="padding: 8px;width: 97%;border-radius: 5px;border: none;background-color: #f4f4f4;"class="attendanceDate">
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
<script src="./js/attendance_report.js"></script>
<?php require "partials/footer.php"; ?>