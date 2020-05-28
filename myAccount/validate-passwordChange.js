let submitNewUser = document.querySelector(".form-container__submit-button");
let strengthMeter = document.getElementById('strength-meter');
let passwordInput = document.getElementById('passwordInput');
let reasons = document.getElementById('passwordValidationText');


function enableSumbitIfFormIsValid() {
  if (isPasswordValid) {
    submitBtn.disabled = false;
  }
}

let isPasswordValid = false;

passwordInput.addEventListener('input', updatestrengthMeter)
updatestrengthMeter()

function updatestrengthMeter() {
  let weaknesses = passwordStrength(passwordInput.value)
  //console.log(weaknesses)

  let strength = 100
  reasons.innerHTML = ''
  weaknesses.forEach(weakness => {
    if (weakness == null) return
    strength -= weakness.deduction
    let message = document.createElement('div')
    message.innerText = weakness.message
    reasons.appendChild(message)

  })
  if (strength === 100) {
    isPasswordValid = true;

  }
  strengthMeter.style.setProperty('--strength', strength)
}

function passwordStrength(password) {
  const weaknesses = []
  weaknesses.push(lengthWeakness(password))
  weaknesses.push(numberWeakness(password))
  weaknesses.push(letterWeakness(password))
  return weaknesses
}

function lengthWeakness(password) {
  const length = password.length

  if (length <= 10) {
    return {
      message: "Ditt lösenord måste vara minst 10 karaktärer långt",
      deduction: 40
    }
  }
}

function numberWeakness(password) {
  let regEx = password.match(/[0-9]/g) || []
  if (regEx.length === 0) {
    return {
      message: "Lägg till minst 1 siffra",
      deduction: 30
    }
  }
}
function letterWeakness(password) {
  let regEx = password.match(/[A-Z]/g) || []

  if (regEx.length === 0) {
    return {
      message: "Du behöver minst 1 stor bokstav",
      deduction: 30
    }

  }
}


