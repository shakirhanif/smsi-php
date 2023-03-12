let btn = document.querySelector("#btn");
let sidebar = document.querySelector(".sidebar");
let searchBtn = document.querySelector(".bx-search");

btn.onclick = function () {
  sidebar.classList.toggle("active");
};
searchBtn.onclick = function () {
  sidebar.classList.toggle("active");
};
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
