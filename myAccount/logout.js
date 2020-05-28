let logoutbtn = document.querySelector("#logoutBtn");
logoutbtn.addEventListener("click", function (event) {
  localStorage.removeItem("name");
  localStorage.removeItem("email");
  localStorage.removeItem("phone");
  localStorage.removeItem("street");
  localStorage.removeItem("zip");
  localStorage.removeItem("city");
})


