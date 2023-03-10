const classTable = document.getElementById("classTable");
fetchFunc();
function fetchFunc() {
  classTable.innerHTML = `
  <tr>
    <th>ID</th>
    <th><span>Name</span></th>
    <th></th>
    <th></th>
  </tr>`;
  axios.post("action.php", "action=listSections").then(({ data, status }) => {
    if (status === 200) {
      data.forEach((x, i) => {
        classTable.innerHTML += `<tr class=${i % 2 === 0 ? "trEven" : "trOdd"}>
        <td>${x.section_id}</td>
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
  window.onclick = function (event) {
    if (event.target == addModal) {
      addModal.style.display = "none";
    }
  };
};
closeBtn.onclick = function () {
  addModal.style.display = "none";
};
//update button
var updateModal = document.getElementById("updateModal");
function openModal(event) {
  let el = event.currentTarget.parentNode.parentNode.parentNode;
  let sectionId = parseInt(el.children[0].innerText);
  let className = el.children[1].innerText;
  document.getElementById("updateSectionId").value = sectionId;
  let formClassName = document.getElementById("updateClassName");
  formClassName.value = className;
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
  let addFormData = new FormData();
  let name = document.getElementById("addClassName").value;
  addFormData.append("name", name);
  addFormData.append("action", "addSections");
  axios.post("action.php", addFormData).then(({ data, status }) => {
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
  let id = document.getElementById("updateSectionId").value;
  updateFormData.append("name", name);
  updateFormData.append("id", id);
  updateFormData.append("action", "updateSections");
  axios.post("action.php", updateFormData).then(({ data, status }) => {
    fetchFunc();
    let updateModalForm = document.getElementById("updateModal");
    updateSubmitBtn.style.cursor = "pointer";
    updateModalForm.style.display = "none";
  });
}

//DELETE CLASS
function deleteClass(e) {
  let deleteTr = e.currentTarget.parentNode.parentNode.parentNode;
  let sectionId = deleteTr.children[0].innerText;
  let formData = new FormData();
  formData.append("action", "deleteSections");
  formData.append("id", sectionId);
  axios.post("action.php", formData).then(({ status }) => {
    if (status === 200) {
      fetchFunc();
    }
  });
}
