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
  let teacherName = document.querySelector(".addClassName");
  if (teacherName.children.length < 2) {
    axios.post("action.php", "action=listClasses").then(({ data, status }) => {
      data.forEach((x) => {
        let option = document.createElement("option");
        option.setAttribute("value", x.id);
        option.appendChild(document.createTextNode(x.name));
        teacherName.appendChild(option);
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
  //fetch sections for form options
  let secName = document.querySelector(".updateSecName");
  let el = event.currentTarget.parentNode.parentNode.parentNode;
  if (secName.children.length < 2) {
    axios.post("action.php", "action=listSections").then(({ data, status }) => {
      data.forEach((x) => {
        let option = document.createElement("option");
        option.appendChild(document.createTextNode(x.section));
        option.setAttribute("value", x.section_id);
        secName.appendChild(option);
      });
    });
  } else {
    for (let i = 0; i < secName.children.length; i++) {
      let x = secName.children[i];

      if (!(x.innerHTML === el.children[2].innerHTML)) {
        x.removeAttribute("selected");
      } else if (x.innerHTML === el.children[2].innerHTML) {
        x.setAttribute("selected", "selected");
      }
    }
  }
  //fetch teachers for form options
  let teacherName = document.querySelector(".updateTeaName");
  if (teacherName.children.length < 2) {
    axios.post("action.php", "action=listTeachers").then(({ data, status }) => {
      data.forEach((x) => {
        let option = document.createElement("option");
        option.appendChild(document.createTextNode(x.teacher));
        option.setAttribute("value", x.teacher_id);
        teacherName.appendChild(option);
      });
    });
  } else {
    for (let i = 0; i < teacherName.children.length; i++) {
      const x = teacherName.children[i];

      if (!(x.innerHTML === el.children[3].innerHTML)) {
        x.removeAttribute("selected");
      } else if (x.innerHTML === el.children[3].innerHTML) {
        x.setAttribute("selected", "selected");
      }
    }
  }
  let classId = parseInt(el.children[0].innerText);
  let className = el.children[1].innerText;

  let formClassName = document.getElementById("updateClassName");
  formClassName.dataset.classId = classId;
  formClassName.value = className;

  // console.log(typeof classId);
  // console.log(el.children[0].innerHTML);
  // for (let i = 0; i < 4; i++) {
  //   let tdel = el.children[i].innerHTML;
  //   console.log(tdel);
  // }
  var updateCloseBtn = document.getElementsByClassName("updateClose")[0];
  updateModal.style.display = "flex";
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
  let updateFormData = new FormData();
  let name = document.getElementById("updateClassName").value;
  let secName = document.querySelector(".updateSecName").value;
  let addTeaName = document.querySelector(".updateTeaName").value;
  let classId = document.getElementById("updateClassName").dataset.classId;
  updateFormData.append("class_id", classId);
  updateFormData.append("name", name);
  updateFormData.append("section_id", secName);
  updateFormData.append("teacher_id", addTeaName);
  updateFormData.append("action", "updateClasses");
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
