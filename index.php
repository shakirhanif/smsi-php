<?php include "./partials/header.php"; ?>
<link rel="stylesheet" href="css/dashboard.css">
<div class="dashBoardMain">
    <div class="card-container attendanceReport">
        <div class="card">
            <a href="attendance_report.php">
        <div class="card--display">
            <div style="height: 160px; display:flex;align-items: center;justify-content: center;font-size: 18px;"><span id="stuPresentCount" style="font-size: 50px;color:brown"></span> <span id="stuTotalCount" style="font-size: 25px;margin-right: 20px;"></span> Students Present Today</div>
        <i class='bx bx-line-chart' ></i>
            <h2>Attendance Report</h2>
        </div>
        <div class="card--hover">
            <h2>Attendance Report</h2>
            <div style="width: 400px;margin-left: auto;margin-right: auto;">
                <canvas id="attendanceChart"></canvas>
            </div>
            <p>
                Attendance of School for last 15 days
            </p>
            <p class="link">Click to go to Attendence Report</p>
        </div></a
        >
        <div class="card--border"></div>
    </div>
    </div>
    <div class="card-container">
        <div class="card">
            <a href="hottub">
        <div class="card--display">
        <i class='bx bx-male'>Take Attendance</i>
            <h2></h2>
        </div>
        <div class="card--hover">
            <h2>Teachers</h2>
            <p>
                for more details about teachers click
            </p>
            <p class="link">Click to see Teachers</p>
        </div></a
        >
        <div class="card--border"></div>
    </div>
    </div>
    <div class="card-container">
        <div class="card">
            <a href="hottub">
        <div class="card--display">
        <i class='bx bx-male'>Teachers</i>
            <h2>Teachers</h2>
        </div>
        <div class="card--hover">
            <h2>Teachers</h2>
            <p>
                for more details about teachers click
            </p>
            <p class="link">Click to see Teachers</p>
        </div></a
        >
        <div class="card--border"></div>
    </div>
    </div>
    <div class="card-container">
        <div class="card">
            <a href="hottub">
        <div class="card--display">
        <i class='bx bx-male'>Teachers</i>
            <h2>Teachers</h2>
        </div>
        <div class="card--hover">
            <h2>Teachers</h2>
            <p>
                for more details about teachers click
            </p>
            <p class="link">Click to see Teachers</p>
        </div></a
        >
        <div class="card--border"></div>
    </div>
    </div>
</div>
<script src="./js/axios.js"></script>
<script src="js/charts.js"></script>
<script src="js/dashboard.js"></script>
<?php include "./partials/footer.php"; ?>