// let btn = document.querySelector("#btn");
// let sidebar = document.querySelector(".sidebar");
// btn.onclick = function () {
//   sidebar.classList.toggle("active");
// };
// snack bar
function snackBarFunc(
  popmessage = "success",
  txtcolor = "#fff",
  bgcolor = "#333"
) {
  let x = document.getElementById("snackbar");
  x.style.backgroundColor = bgcolor;
  x.style.color = txtcolor;
  x.innerHTML = popmessage;
  x.className = "show";

  setTimeout(function () {
    x.className = x.className.replace("show", "");
  }, 3000);
}
//drop down menu profile func
dropDownFullFunc();
function dropDownFullFunc() {
  document.addEventListener("click", docEventListener);
  function docEventListener(event) {
    if (
      event.target === document.getElementById("headUserName") ||
      event.target === document.getElementById("headUserName").children[0] ||
      event.target === document.getElementById("headUserName").children[1] ||
      event.target === document.getElementById("dropDownMenu") ||
      event.target.parentNode === document.getElementById("dropDownMenu")
    ) {
      document.getElementById("dropDownMenu").style.display = "block";
    } else {
      document.getElementById("dropDownMenu").style.display = "none";
    }
  }
}
