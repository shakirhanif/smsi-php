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
  //fetch student for form options
  let stuFormData = new FormData();
  stuFormData.append("action", "listStudentsForm");
  className.addEventListener("change", classFunc);
  function classFunc(e) {
    if (e.target.value !== "select") {
      if (stuFormData.get("classId") === null) {
        stuFormData.append("classId", e.target.value);
      } else {
        stuFormData.set("classId", e.target.value);
      }
      studentPopulate(stuFormData);
    }
  }
  secName.addEventListener("change", secFunc);
  function secFunc(e) {
    if (e.target.value !== "select") {
      if (stuFormData.get("secId") === null) {
        stuFormData.append("secId", e.target.value);
      } else {
        stuFormData.set("secId", e.target.value);
      }
      // console.log(stuFormData);
      studentPopulate(stuFormData);
    }
  }
  studentPopulate(stuFormData);
  let studentName = document.querySelector(".updateStudentName");
  function studentPopulate(stuFormData) {
    axios.post("action.php", stuFormData).then(({ data, status }) => {
      studentName.innerHTML = "<option value='select'>Select</option>";
      data.forEach((x) => {
        let option = document.createElement("option");
        option.appendChild(document.createTextNode(x.name));
        option.setAttribute("value", x.id);
        studentName.appendChild(option);
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
  let dateArray = addFormData.get("date").replaceAll("-", "/");
  addFormData.set("date", dateArray);
  // console.log(addFormData);
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
    <th>Name</th>
    <th><span>Reg No</span></th>
    <th><span>Roll No</span></th>
    <th>Attendance Status</th>
  </tr>`;
  data.forEach((x, i) => {
    classTable.innerHTML += `<tr class=${i % 2 === 0 ? "trEven" : "trOdd"}>
        <td>${x.name}</td>
        <td>${x.regno}</td>
        <td>${x.rollno}</td>
        <td>
            <label for="present" class="attendance active ispresent">Present</label>
        </td>
      </tr>`;
  });
}
function lableHandler(e) {
  let attendanceDiv = e.currentTarget.parentNode;
  let lableElem = attendanceDiv.getElementsByClassName("attendance");
  for (let i = 0; i < lableElem.length; i++) {
    let x = lableElem[i];
    if (x === e.currentTarget) {
      x.classList.add("active");
    } else {
      x.classList.remove("active");
    }
  }
}
//Save Form
document
  .getElementById("addButtonAttendance")
  .addEventListener("click", saveHandler);
function saveHandler(e) {
  let date = document
    .getElementById("saveAttendanceDate")
    .value.replaceAll("-", "/");
  let className = document.querySelector(".updateClassName").value;
  let secName = document.querySelector(".updateSecName").value;
  let lables = document.getElementsByClassName("attendance active");
  let list = [];
  let attendance = {};
  let formData = new FormData();
  for (let i = 0; i < lables.length; i++) {
    let x = lables[i];
    let studentId = x.dataset.studentId;
    let attenadanceStatus =
      x.innerText === "Present"
        ? 1
        : x.innerText === "Absent"
        ? 2
        : x.innerText === "Sick-Leave"
        ? 3
        : x.innerText === "Half-Day"
        ? 4
        : null;
    attendance = {
      student_id: studentId,
      class_id: className,
      section_id: secName,
      attendance_status: attenadanceStatus,
      attendance_date: date,
    };
    // formData.append("attList", attendance);
    list.push(attendance);
  }
  let newList = JSON.stringify(list);
  formData.append("attList", newList);
  // console.log(formData);
  formData.append("action", "addAttendance");
  axios.post("action.php", formData).then(({ data, status }) => {
    if (status === 200) {
      snackBarFunc(data);
    }
  });

  // console.log(secName.value);
  // console.log(date.value.replaceAll("-", "/"));
  // console.log(lables[0].dataset.studentId);
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

/////test////
// document
//   .getElementById("attendanceSubmit")
//   .addEventListener("submit", attendanceSubmit);
// function attendanceSubmit(e) {
//   e.preventDefault();
//   let myForm = new FormData(e.target);
//   console.log(myForm);
// }
////checked active///
// let lableElem = document.getElementsByClassName("attendance");
// console.log(lableElem);
// for (let i = 0; i < lableElem.length; i++) {
//   lableElem[i].addEventListener("click", attendanceClickHandler);
//   function attendanceClickHandler(e) {
//     for (let i = 0; i < lableElem.length; i++) {
//       const x = lableElem[i];
//       if (x === e.target) {
//         x.classList.add("active");
//       } else {
//         x.classList.remove("active");
//       }
//     }
//   }
// }
// lableElem.forEach((x) => {
//   x.addEventListener("click", attendanceClickHandler);
// function attendanceClickHandler(e) {
//   lableElem.forEach((x) => {
//     if (x === e.target) {
//       x.classList.add("active");
//     } else {
//       x.classList.remove("active");
//     }
//   });
// }
// });
