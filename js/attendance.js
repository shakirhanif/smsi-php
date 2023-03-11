const classTable = document.getElementById("classTable");
fetchFunc();
function fetchFunc() {
  classTable.innerHTML = `
  <tr>
    <th>ID</th>
    <th><span>Reg No</span></th>
    <th><span>Roll No</span></th>
    <th>Name</th>
    <th>Mark Present</th>
    <th>Mark Absent</th>
  </tr>`;
  axios.post("action.php", "action=listSubjects").then(({ data, status }) => {
    if (status === 200) {
      data.forEach((x, i) => {
        classTable.innerHTML += `<tr class=${i % 2 === 0 ? "trEven" : "trOdd"}>
        <td>${x.subject_id}</td>
        <td>${x.subject}</td>
        <td>${x.type}</td>
        <td>${x.code}</td>
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
  });
}

// add modal
var addModal = document.getElementById("addModal");
var Addbtn = document.getElementById("addButton");
var closeBtn = document.getElementsByClassName("addClose")[0];
Addbtn.onclick = function () {
  addModal.style.display = "flex";
  window.onclick = function (event) {
    if (event.target == addModal) {
      addModal.style.display = "none";
    }
  };
};
closeBtn.onclick = function () {
  addModal.style.display = "none";
};
//update Modal
var updateModal = document.getElementById("updateModal");
function openModal(event) {
  let el = event.currentTarget.parentNode.parentNode.parentNode;
  let subjectId = el.children[0].innerText;
  let subjectName = el.children[1].innerText;
  let subjectType = el.children[2].innerText;
  let subjectCode = el.children[3].innerText;
  document.getElementById("updateTeacherId").value = subjectId;
  let formClassName = document.getElementById("updateClassName");
  if (subjectType === "Theory") {
    document.getElementById("updateTheory").checked = true;
  } else {
    document.getElementById("updatePractical").checked = true;
  }
  document.getElementById("updateSubjectCode").value = subjectCode;
  formClassName.value = subjectName;
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
  let addSubmitBtn = document.getElementById("addClassSubmit");
  addSubmitBtn.style.cursor = "not-allowed";
  let addFormData = new FormData(e.target);
  //   console.log(addFormData);
  addFormData.append("action", "addSubjects");
  axios.post("action.php", addFormData).then(({ data, status }) => {
    fetchFunc();
    let addModalForm = document.getElementById("addModal");
    addSubmitBtn.style.cursor = "pointer";
    addModalForm.style.display = "none";
  });
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
  updateFormData.append("action", "updateSubjects");
  axios.post("action.php", updateFormData).then(({ data, status }) => {
    fetchFunc();
    let updateModalForm = document.getElementById("updateModal");
    updateSubmitBtn.style.cursor = "pointer";
    updateModalForm.style.display = "none";
  });
}

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
