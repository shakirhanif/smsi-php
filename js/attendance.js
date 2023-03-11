searchOptionsPopulate();
document
  .getElementById("searchForm")
  .addEventListener("submit", searchFormSubmit);

function searchOptionsPopulate() {
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
}
//search form submit
function searchFormSubmit(e) {
  e.preventDefault();
  let addSubmitBtn = document.getElementById("searchAttendanceButton");
  addSubmitBtn.style.cursor = "not-allowed";
  let addFormData = new FormData(e.target);
  //   console.log(addFormData);
  addFormData.append("action", "searchAttendance");
  axios.post("action.php", addFormData).then(({ data, status }) => {
    fetchFunc(data);
    addSubmitBtn.style.cursor = "pointer";
  });
}

function fetchFunc(data) {
  const classTable = document.getElementById("classTable");
  classTable.innerHTML = `
  <tr>
    <th>ID</th>
    <th><span>Reg No</span></th>
    <th><span>Roll No</span></th>
    <th>Name</th>
    <th>Mark Present</th>
    <th>Mark Absent</th>
  </tr>`;
  data.forEach((x, i) => {
    classTable.innerHTML += `<tr class=${i % 2 === 0 ? "trEven" : "trOdd"}>
    <td>${x.attendance_id}</td>
        <td>${x.regno}</td>
        <td>${x.rollno}</td>
        <td>${x.name}</td>
        <td>
            <div class="button update">
                <button onclick="openModal(event)"><i class='bx bxs-edit-alt'></i></button>
            </div>
        </td>
        <td>
            <div class="button delete">
                <button onclick="deleteTeachers(event)"><i class='bx bxs-trash'></i></button>
            </div>
        </td>
      </tr>`;
  });
}
// //addform submit
// document.getElementById("addForm").addEventListener("submit", addFormSubmit);
// function addFormSubmit(e) {
//   e.preventDefault();
//   let addSubmitBtn = document.getElementById("addClassSubmit");
//   addSubmitBtn.style.cursor = "not-allowed";
//   let addFormData = new FormData(e.target);
//   //   console.log(addFormData);
//   addFormData.append("action", "addSubjects");
//   axios.post("action.php", addFormData).then(({ data, status }) => {
//     fetchFunc();
//     let addModalForm = document.getElementById("addModal");
//     addSubmitBtn.style.cursor = "pointer";
//     addModalForm.style.display = "none";
//   });
// }
// //update form submit
// document
//   .getElementById("updateForm")
//   .addEventListener("submit", updateFormSubmit);
// function updateFormSubmit(e) {
//   e.preventDefault();
//   let updateSubmitBtn = document.getElementById("updateClassSubmit");
//   updateSubmitBtn.style.cursor = "not-allowed";
//   let updateFormData = new FormData(e.target);
//   updateFormData.append("action", "updateSubjects");
//   axios.post("action.php", updateFormData).then(({ data, status }) => {
//     fetchFunc();
//     let updateModalForm = document.getElementById("updateModal");
//     updateSubmitBtn.style.cursor = "pointer";
//     updateModalForm.style.display = "none";
//   });
// }

//DELETE Subject
function deleteTeachers(e) {
  let deleteTr = e.currentTarget.parentNode.parentNode.parentNode;
  let subjectId = deleteTr.children[0].innerText;
  let formData = new FormData();
  formData.append("action", "deleteSubjects");
  formData.append("id", subjectId);
  axios.post("action.php", formData).then(({ status }) => {
    if (status === 200) {
      fetchFunc();
    }
  });
}
