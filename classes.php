<?php require "partials/header.php"; ?>
<link rel="stylesheet" href="css/table.css">
<div class="header-class">
    <div class="classTitle">Classes Section</div>
    <div class="button">
        <button id="addButton" ><i class='bx bx-plus-medical'></i></button>
    </div>
</div>

<div>
<table class="responstable" id="classTable">
      <tr>
        <th>ID</th>
        <th data-th="Driver details"><span>Name</span></th>
        <th>Section</th>
        <th>class Teacher</th>
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
    <h1>Add Class</h1>

<form class="survey-form" id="addForm" method="POST">
  <div class="form-group">
    <label
      >Class Name
      <input
        id="addClassName"
        type="text"
        placeholder="Enter Your Name..."
        required
    /></label>
  </div>
  <div class="form-group">
    <label>
      Sections
      <select id="dropdown" class="addSecName">
      </select>
    </label>
  </div>
  <div class="form-group">
    <label>
      Assign Class Teacher
      <select id="dropdown" class="addTeaName">
      </select>
    </label>
  </div>
  <div class="form-group">
    <button id="addClassSubmit" type="submit">Add Class</button>
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
<script src="./js/classes.js"></script>
<?php require "partials/footer.php"; ?>