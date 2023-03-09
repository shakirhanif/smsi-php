const classTable = document.getElementById("studentsTable");
fetchFunc();
function fetchFunc() {
  classTable.innerHTML = `
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
</tr>`;
  axios.post("action.php", "action=listStudents").then(({ data, status }) => {
    if (status === 200) {
      data.forEach((x, i) => {
        classTable.innerHTML += `<tr class=${i % 2 === 0 ? "trEven" : "trOdd"}>
        <td>${x.id}</td>
        <td>${x.admission_no}</td>
        <td>${x.roll_no}</td>
        <td>${x.name}</td>
        <td class="studentImageTd" style="display:flex;justify-content:center;align-items:center;text-align:center;"><img src="upload/${
          x.photo
        }" alt=${x.photo} class="studentImage"></td>
        <td>${x.class}</td>
        <td>${x.section}</td>
        <td>
            <div class="button update">
                <button onclick="openModal(event)"><i class='bx bxs-edit-alt'></i></button>
            </div>
        </td>
        <td>
            <div class="button delete">
                <button onclick="deleteClass(event)"><i class='bx bxs-trash'></i></button>
            </div>
        </td>
      </tr>`;
      });
    }
  });
}

// add modal
var addModal = document.getElementById("addModal");
var Addbtn = document.getElementById("addButton");
var closeBtn = document.getElementsByClassName("addClose")[0];
Addbtn.onclick = function () {
  addModal.style.display = "flex";
  //fetch sections for form options
  let secName = document.querySelector(".addSecName");
  if (secName.children.length < 2) {
    axios.post("action.php", "action=listSections").then(({ data, status }) => {
      data.forEach((x) => {
        let option = document.createElement("option");
        option.appendChild(document.createTextNode(x.section));
        option.setAttribute("value", x.section_id);
        secName.appendChild(option);
      });
    });
  }
  //fetch classes for form options
  let className = document.querySelector(".addClassName");
  if (className.children.length < 2) {
    axios.post("action.php", "action=listClasses").then(({ data, status }) => {
      data.forEach((x) => {
        let option = document.createElement("option");
        option.setAttribute("value", x.id);
        option.appendChild(document.createTextNode(x.name));
        className.appendChild(option);
      });
    });
  }
  window.onclick = function (event) {
    if (event.target == addModal) {
      document.getElementById("addForm").reset();
      addModal.style.display = "none";
    }
  };
};
closeBtn.onclick = function () {
  document.getElementById("addForm").reset();
  addModal.style.display = "none";
};
//update button
var updateModal = document.getElementById("updateModal");
function openModal(event) {
  let el = event.currentTarget.parentNode.parentNode.parentNode;

  let stuId = el.children[0].innerText;
  //fetch sections for form options
  let secName = document.querySelector(".updateSecName");
  if (secName.children.length < 2) {
    axios.post("action.php", "action=listSections").then(({ data, status }) => {
      data.forEach((x) => {
        let option = document.createElement("option");
        option.appendChild(document.createTextNode(x.section));
        option.setAttribute("value", x.section_id);
        secName.appendChild(option);
      });
    });
  }
  //fetch teachers for form options
  let className = document.querySelector(".updateClassName");
  if (className.children.length < 2) {
    axios.post("action.php", "action=listClasses").then(({ data, status }) => {
      data.forEach((x) => {
        let option = document.createElement("option");
        option.setAttribute("value", x.id);
        option.appendChild(document.createTextNode(x.name));
        className.appendChild(option);
      });
    });
  }
  axios
    .post("action.php", "action=getStudentForm&student_id=" + stuId)
    .then(({ data, status }) => {
      document.getElementById("updateStuReg").value = data?.regno;
      document.getElementById("updateStuRoll").value = data?.rollno;
      document.querySelector(".updateAcaYear").value = data?.academic_year;
      document.getElementById("updateAddDate").value = data?.admission_date;
      document.querySelector(".updateClassName").value = data?.class;
      document.querySelector(".updateSecName").value = data?.section;
      document.getElementById("updateStuName").value = data?.name;
      document.getElementById("updateStuEmail").value = data?.email;
      document.getElementById("updateStuMobile").value = data?.mobile;
      document.getElementById("updateStuAddress").value = data?.address;
      document.getElementById("updateStuFatherName").value = data?.father_name;
      document.getElementById("updateStuMotherName").value = data?.mother_name;
      document.getElementById("updateStudentId").value = stuId;
      if (data.gender === "female") {
        document.getElementById("updateFemale").checked = true;
      } else {
        document.getElementById("updateMale").checked = true;
      }
    });

  // // let classId = parseInt(el.children[0].innerText);
  // // let className = el.children[1].innerText;

  // // console.log(typeof classId);
  // // console.log(el.children[0].innerHTML);
  // // for (let i = 0; i < 4; i++) {
  // //   let tdel = el.children[i].innerHTML;
  // //   console.log(tdel);
  // // }
  updateModal.style.display = "flex";
  var updateCloseBtn = document.getElementsByClassName("updateClose")[0];
  updateCloseBtn.onclick = function () {
    updateModal.style.display = "none";
  };
  window.onclick = function (event) {
    if (event.target == updateModal) {
      updateModal.style.display = "none";
    }
  };
}
//addform submit
document.getElementById("addForm").addEventListener("submit", addFormSubmit);
function addFormSubmit(e) {
  e.preventDefault();
  let stuFormData = new FormData(e.target);
  stuFormData.append("action", "addStudents");
  let addSubmitBtn = document.getElementById("addClassSubmit");
  addSubmitBtn.style.cursor = "not-allowed";
  axios.post("action.php", stuFormData).then(({ data, status }) => {
    fetchFunc();
    let addModalForm = document.getElementById("addModal");
    addSubmitBtn.style.cursor = "pointer";
    addModalForm.style.display = "none";
  });
  // console.log(addFormData);
  // console.log(e.target[0].value);
}
//update form submit
document
  .getElementById("updateForm")
  .addEventListener("submit", updateFormSubmit);
function updateFormSubmit(e) {
  e.preventDefault();
  let updateSubmitBtn = document.getElementById("updateClassSubmit");
  updateSubmitBtn.style.cursor = "not-allowed";
  let updateFormData = new FormData(e.target);
  updateFormData.append("action", "updateStudent");
  console.log(updateFormData);
  // let name = document.getElementById("updateClassName").value;
  // let secName = document.querySelector(".updateSecName").value;
  // let addTeaName = document.querySelector(".updateTeaName").value;
  // let classId = document.getElementById("updateClassName").dataset.classId;
  // updateFormData.append("class_id", classId);
  // updateFormData.append("name", name);
  // updateFormData.append("section_id", secName);
  // updateFormData.append("teacher_id", addTeaName);
  // updateFormData.append("action", "updateClasses");
  axios.post("action.php", updateFormData).then(({ data, status }) => {
    fetchFunc();
    let updateModalForm = document.getElementById("updateModal");
    updateSubmitBtn.style.cursor = "pointer";
    updateModalForm.style.display = "none";
  });
  // console.log(addFormData);
  // console.log(e.target[0].value);
}

//DELETE CLASS
function deleteClass(e) {
  let deleteTr = e.currentTarget.parentNode.parentNode.parentNode;
  let classId = deleteTr.children[0].innerText;
  let formData = new FormData();
  formData.append("action", "deleteClasses");
  formData.append("class_id", classId);
  axios.post("action.php", formData).then(({ status }) => {
    if (status === 200) {
      fetchFunc();
    }
  });
}
