autofill()
function autofill() {
  
  console.log(localStorage)
  if (localStorage.getItem("name") != null) {

    let nameInput = document.querySelector("#name")
    let emailInput = document.querySelector("#email")
    let phoneInput = document.querySelector("#phone")


    let streetInput = document.querySelector("#street")
    let zipInput = document.querySelector("#zip")
    let cityInput = document.querySelector("#city")


    let name = localStorage.getItem("name")
    let email = localStorage.getItem("email")
    let phone = localStorage.getItem("phone")
    let street = localStorage.getItem("street")
    let zip = localStorage.getItem("zip")
    let city = localStorage.getItem("city")



    console.log(name);

    nameInput.value = name
    emailInput.value = email
    phoneInput.value = phone
    streetInput.value = street
    zipInput.value = zip
    cityInput.value = city

  }

}