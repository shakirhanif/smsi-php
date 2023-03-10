<?php require "partials/header.php"; ?>
<link rel="stylesheet" href="css/sections.css">
<div class="header-class">
    <div class="classTitle">Sections</div>
    <div class="button">
        <button id="addButton" ><i class='bx bx-plus-medical'></i></button>
    </div>
</div>

<div>
<table class="responstable" id="classTable">
      <tr>
        <th>ID</th>
        <th><span>Name</span></th>
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
    <h1>Add Section</h1>

<form class="survey-form" id="addForm" method="POST">
  <div class="form-group">
    <label
      >Section Name
      <input
        id="addClassName"
        type="text"
        placeholder="Enter Your Name..."
        required
    /></label>
  </div>
  <div class="form-group">
    <button id="addClassSubmit" type="submit">Add Section</button>
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
    <h1>Update Section</h1>

<form class="survey-form" id="updateForm">
  <div class="form-group">
    <label
      >Section Name
      <input
        id="updateClassName"
        type="text"
        placeholder="Enter Your Name..."
        required
    /></label>
  </div>
  <input type="hidden" name="id" id="updateSectionId">
  <div class="form-group">
    <button id="updateClassSubmit" >Update Section</button>
  </div>
</form>
    <!-- form end -->
  </div>

</div>
<script src="./js/axios.js"></script>
<script src="./js/sections.js"></script>
<?php require "partials/footer.php"; ?>