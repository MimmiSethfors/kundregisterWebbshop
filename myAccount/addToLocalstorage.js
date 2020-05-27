
//lägg in i localstorage
let myName;
let myEmail;
let myPhone;
let myStreet;
let myZip;
let myCity;

myName = document.querySelector(".myName")
myEmail = document.querySelector(".myEmail")
myPhone = document.querySelector(".myPhone")
myStreet = document.querySelector(".myStreet")
myZip = document.querySelector(".myZip")
myCity = document.querySelector(".myCity")

localStorage.setItem("name", myName.textContent)
localStorage.setItem("email", myEmail.textContent)
localStorage.setItem("phone", myPhone.textContent)
localStorage.setItem("street", myStreet.textContent)
localStorage.setItem("zip", myZip.textContent)
localStorage.setItem("city", myCity.textContent)






