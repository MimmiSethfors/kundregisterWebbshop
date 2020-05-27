let submitBtn = document.querySelector(".form-container__submit-button");

function enableSumbitIfFormIsValid() {
  if (isChangeValid) {
    submitBtn.disabled = false;
  }
}

let isPasswordValid = false;

function validatePasswordChange() {
  let password = document.querySelector("#password").value;
  let infoText = document.querySelector(".passwordValidationText");
  if (password.length === 0) {
    infoText.innerHTML = "OBS! Obligatoriskt fält"
  } else if (!isChangeValid(password)) {
    infoText.innerHTML = "OBS! Lösenordet är för svagt";
  } else {
    infoText.innerHTML = "";
    isPasswordValid = true;
    enableSumbitIfFormIsValid();
    return;
  }
  submitBtn.disabled = true;
  isPasswordValid = false;
}

function isChangeValid(password) {
  //en siffra, en liten bokstav, en stor bokstav, minst 8 tecken
  let regEx = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
  console.log(regEx.test(String(password)))
  return regEx.test(String(password))
}
