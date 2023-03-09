<?php require "partials/header.php"; ?>
<link rel="stylesheet" href="css/students.css">
<div class="header-class">
    <div class="classTitle">Students Section</div>
    <div class="button">
        <button id="addButton" ><i class='bx bx-plus-medical'></i></button>
    </div>
</div>

<div>
<table class="responstable" id="studentsTable">
      <tr>
        <th>ID</th>
        <th data-th="Reg No"><span>Reg No</span></th>
        <th>Roll No</th>
        <th>Name</th>
        <th>Photo</th>
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
    <h1>Add Student</h1>
<form class="survey-form" id="addForm" enctype="multipart/form-data">
    <div class="form-group">
        <label
        >Registration No.
        <input
        id="addStuReg"
        name="regno"
        type="text"
        class="stuInput"
        placeholder="Enter Your Name..."
        required
        /></label>
    </div>
    <div class="form-group">
        <label
        >Roll No.
        <input
        name="rollno"
        id="addStuRoll"
        class="stuInput"
        type="text"
        placeholder="Enter Your Name..."
        required
        /></label>
    </div>
    <div class="form-group">
    <label>
    Academic Year*
      <select id="dropdown" name="acayear" class="addAcaYear">
          <option value="2018">2018</option>
          <option value="2019">2019</option>
          <option value="2020">2020</option>
          <option value="2021">2021</option>
          <option value="2022">2022</option>
      </select>
    </label>
  </div>
  <div class="form-group">
      <label
        >Admission Date
        <input
          id="addAddDate"
          class="stuInput"
          type="text"
          name="addate"
          placeholder="Enter Date..."
          required
      /></label>
    </div>
    <div class="form-group">
      <label>
        Class
        <select id="dropdown" class="addClassName" name="class">
        </select>
      </label>
    </div>
    <div class="form-group">
      <label>
        Section
        <select id="dropdown" class="addSecName" name="section">
        </select>
      </label>
    </div>
    <div class="form-group">
      <label
        >Name
        <input
          id="addStuName"
          name="name"
          class="stuInput"
          type="text"
          placeholder="Enter Your Name..."
          required
      /></label>
    </div>
  <div class="form-group">
    <label
      >Photo
      <input
        name="photo"
        id="addStuPhoto"
        class="stuInput"
        type="file"
    /></label>
  </div>
  <div class="form-group">
        <label>Gender
        <div style="display: flex;">
            <label class="radio-inline" style="margin: 0 10px;">
                <input type="radio" name="gender" id="male" value="male" required>Male
            </label>
            <label class="radio-inline" style="margin: 0 10px;">
                <input type="radio" name="gender" id="female" value="female" required>Female
            </label>
        </div>
        </label>
    </div>
    <div class="form-group">
      <label
        >Email
        <input
            name="email"
          id="addStuEmail"
          class="stuInput"
          type="text"
          placeholder="Enter Your Email..."
      /></label>
    </div>    <div class="form-group">
      <label
        >Mobile
        <input
            name="mobile"
          id="addStuMobile"
          class="stuInput"
          type="text"
          placeholder="Enter Your Name..."
      /></label>
    </div>    <div class="form-group">
      <label
        >Address
        <input
            name="address"
          id="addStuAddress"
          class="stuInput"
          type="text"
          placeholder="Enter Your Name..."
          required
      /></label>
    </div>    <div class="form-group">
      <label
        >Father Name
        <input
          name="fathername"
          id="addStuFatherName"
          class="stuInput"
          type="text"
          placeholder="Enter Your Name..."
          required
      /></label>
    </div>    <div class="form-group">
      <label
        >Mother Name
        <input
            name="mothername"
          id="addStuMotherName"
          class="stuInput"
          type="text"
          placeholder="Enter Your Name..."
          required
      /></label>
    </div>
  <div class="form-group">
    <button id="addClassSubmit" type="submit">Admit Student</button>
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
<script src="./js/students.js"></script>
<?php require "partials/footer.php"; ?>
