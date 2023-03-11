<?php require "partials/header.php"; ?>
<link rel="stylesheet" href="css/subjects.css">
<div class="header-class">
    <div class="classTitle">Subjects</div>
    <div class="button">
        <button id="addButton" ><i class='bx bx-plus-medical'></i></button>
    </div>
</div>

<div>
<table class="responstable" id="classTable">
      <tr>
        <th>ID</th>
        <th><span>Subject</span></th>
        <th><span>Subject Code</span></th>
        <th>Subject Type</th>
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
    <h1>Add Subject</h1>

<form class="survey-form" id="addForm" method="POST">
  <div class="form-group">
    <label
      >Name
      <input
        id="addClassName"
        name="subject"
        type="text"
        placeholder="Enter Subject Name..."
        required
        /></label>
      </div>
      <div class="form-group">
        <label>Type
        <div style="display: flex;">
            <label class="radio-inline" style="margin: 0 10px;">
                <input type="radio" name="type" id="updateMale" value="Theory" required>Theory
            </label>
            <label class="radio-inline" style="margin: 0 10px;">
                <input type="radio" name="type" id="updateFemale" value="Practical" required>Practical
            </label>
        </div>
        </label>
    </div>
    <div class="form-group">
    <label
      >Code
      <input
        id="addClassName"
        name="code"
        type="text"
        placeholder="Enter Subject Code..."
        required
        /></label>
      </div>
  <div class="form-group">
    <button id="addClassSubmit" type="submit">Add Subject</button>
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
    <h1>Update Subject</h1>

<form class="survey-form" id="updateForm">
  <div class="form-group">
    <label
      >Name
      <input
        id="updateClassName"
        name="subject"
        type="text"
        placeholder="Enter subject Name..."
        required
    /></label>
  </div>
  <div class="form-group">
        <label>Type
        <div style="display: flex;">
            <label class="radio-inline" style="margin: 0 10px;">
                <input type="radio" name="type" id="updateTheory" value="Theory" required>Theory
            </label>
            <label class="radio-inline" style="margin: 0 10px;">
                <input type="radio" name="type" id="updatePractical" value="Practical" required>Practical
            </label>
        </div>
        </label>
    </div>
  <div class="form-group">
    <label
      >Code
      <input
        id="updateSubjectCode"
        name="code"
        type="text"
        placeholder="Enter subject Name..."
        required
    /></label>
  </div>
  <input type="hidden" id="updateTeacherId" name="id">
  <div class="form-group">
    <button id="updateClassSubmit" >Update Subject</button>
  </div>
</form>
    <!-- form end -->
  </div>

</div>
<!-- update modal end -->
<script src="./js/axios.js"></script>
<script src="./js/subjects.js"></script>
<?php require "partials/footer.php"; ?>