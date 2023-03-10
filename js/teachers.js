const classTable = document.getElementById("classTable");
fetchFunc();
function fetchFunc() {
  classTable.innerHTML = `
  <tr>
    <th>ID</th>
    <th><span>Name</span></th>
    <th><span>Assigned Subject</span></th>
    <th>Class</th>
    <th>Section</th>
    <th></th>
    <th></th>
  </tr>`;
  axios.post("action.php", "action=listTeachers").then(({ data, status }) => {
    if (status === 200) {
      data.forEach((x, i) => {
        classTable.innerHTML += `<tr class=${i % 2 === 0 ? "trEven" : "trOdd"}>
        <td>${x.teacher_id}</td>
        <td>${x.teacher}</td>
        <td>${x.subject}</td>
        <td>${x.className}</td>
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
  //fetch subjects for form options
  let subjectName = document.querySelector(".addSubName");
  if (subjectName.children.length < 2) {
    axios.post("action.php", "action=listSubjects").then(({ data, status }) => {
      data.forEach((x) => {
        let option = document.createElement("option");
        option.setAttribute("value", x.subject_id);
        option.appendChild(document.createTextNode(x.subject));
        subjectName.appendChild(option);
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
  // //fetch sections for form options
  // let secName = document.querySelector(".updateSecName");
  // if (secName.children.length < 2) {
  //   axios.post("action.php", "action=listSections").then(({ data, status }) => {
  //     data.forEach((x) => {
  //       let option = document.createElement("option");
  //       option.appendChild(document.createTextNode(x.section));
  //       option.setAttribute("value", x.section_id);
  //       if (x.section === el.children[4].innerHTML) {
  //         option.setAttribute("selected", "selected");
  //       }
  //       secName.appendChild(option);
  //     });
  //   });
  // } else {
  //   for (let i = 0; i < secName.children.length; i++) {
  //     let x = secName.children[i];

  //     if (!(x.innerHTML === el.children[4].innerHTML)) {
  //       x.removeAttribute("selected");
  //     } else if (x.innerHTML === el.children[4].innerHTML) {
  //       x.setAttribute("selected", "selected");
  //     }
  //   }
  // }
  //fetch subjects for form options
  let subjectName = document.querySelector(".updateSubName");
  if (subjectName.children.length < 2) {
    axios.post("action.php", "action=listSubjects").then(({ data, status }) => {
      data.forEach((x) => {
        let option = document.createElement("option");
        option.appendChild(document.createTextNode(x.subject));
        option.setAttribute("value", x.subject_id);
        if (x.subject === el.children[2].innerHTML) {
          option.setAttribute("selected", "selected");
        }
        subjectName.appendChild(option);
      });
    });
  } else {
    for (let i = 0; i < subjectName.children.length; i++) {
      const x = subjectName.children[i];

      if (!(x.innerHTML === el.children[2].innerHTML)) {
        x.removeAttribute("selected");
      } else if (x.innerHTML === el.children[2].innerHTML) {
        x.setAttribute("selected", "selected");
      }
    }
  }
  // //fetch classes for form options
  // let className = document.querySelector(".updateClassName");
  // if (className.children.length < 2) {
  //   axios.post("action.php", "action=listClasses").then(({ data, status }) => {
  //     data.forEach((x) => {
  //       let option = document.createElement("option");
  //       option.appendChild(document.createTextNode(x.name));
  //       option.setAttribute("value", x.id);
  //       if (x.name === el.children[3].innerHTML) {
  //         option.setAttribute("selected", "selected");
  //       }
  //       className.appendChild(option);
  //     });
  //   });
  // } else {
  //   for (let i = 0; i < className.children.length; i++) {
  //     const x = className.children[i];

  //     if (!(x.innerHTML === el.children[3].innerHTML)) {
  //       x.removeAttribute("selected");
  //     } else if (x.innerHTML === el.children[3].innerHTML) {
  //       x.setAttribute("selected", "selected");
  //     }
  //   }
  // }
  let teacherName = el.children[1].innerText;
  let teacherId = el.children[0].innerText;
  document.getElementById("updateTeacherId").value = teacherId;
  let formClassName = document.getElementById("updateClassName");
  formClassName.value = teacherName;

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
  let addSubmitBtn = document.getElementById("addClassSubmit");
  addSubmitBtn.style.cursor = "not-allowed";
  let addFormData = new FormData(e.target);
  // console.log(addFormData);
  addFormData.append("action", "addTeachers");
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
  updateFormData.append("action", "updateTeachers");
  // console.log(updateFormData);
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
