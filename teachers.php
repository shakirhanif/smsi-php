<?php require "partials/header.php"; ?>
<link rel="stylesheet" href="css/teachers.css">
<div class="header-class">
    <div class="classTitle">Teachers</div>
    <div class="button">
        <button id="addButton" ><i class='bx bx-plus-medical'></i></button>
    </div>
</div>

<div>
<table class="responstable" id="classTable">
      <tr>
        <th>ID</th>
        <th><span>Name</span></th>
        <th><span>Assigned subjects</span></th>
        <th>Class</th>
        <th>Section</th>
        <th></th>
        <th></th>
      </tr>
</table>
</div>
<!-- add modal start -->
<div id="addModal" class="add-modal">
  <div class="add-modal-content">
    <span class="addClose"><i class='bx bx-x-circle'></i></span>
    <!-- form start -->
    <h1>Add Teacher</h1>

<form class="survey-form" id="addForm" method="POST">
  <div class="form-group">
    <label
      >Name
      <input
        id="addClassName"
        name="name"
        type="text"
        placeholder="Enter Teacher Name..."
        required
        /></label>
      </div>
      <div class="form-group">
        <label>
          Assign Subject
          <select id="dropdown" class="addSubName" name="subject">
          </select>
        </label>
      </div>
      <div class="form-group">
        <label>
          Assign Class
          <select id="dropdown" class="addClassName" name="class">
          </select>
        </label>
      </div>
  <div class="form-group">
    <label>
      Assign Section
      <select id="dropdown" class="addSecName" name="section">
      </select>
    </label>
  </div>
  <div class="form-group">
    <button id="addClassSubmit" type="submit">Add Teacher</button>
  </div>
</form>
    <!-- form end -->
  </div>

</div>
<!-- add modal end -->
<!-- update modal start -->
<div id="updateModal" class="update-modal">
  <div class="update-modal-content">
    <span class="updateClose"><i class='bx bx-x-circle'></i></span>
    <!-- form start -->
    <h1>Update Class</h1>

<form class="survey-form" id="updateForm">
  <div class="form-group">
    <label
      >Class Name
      <input
        id="updateClassName"
        type="text"
        placeholder="Enter Your Name..."
        required
    /></label>
  </div>
  <div class="form-group">
    <label>
      Sections
      <select id="dropdown" class="updateSecName">
      </select>
    </label>
  </div>
  <div class="form-group">
    <label>
      Assign Class Teacher
      <select id="dropdown" class="updateTeaName">
      </select>
    </label>
  </div>
  <div class="form-group">
    <button id="updateClassSubmit" >Update Class</button>
  </div>
</form>
    <!-- form end -->
  </div>

</div>
<!-- update modal end -->
<script src="./js/axios.js"></script>
<script src="./js/teachers.js"></script>
<?php require "partials/footer.php"; ?>