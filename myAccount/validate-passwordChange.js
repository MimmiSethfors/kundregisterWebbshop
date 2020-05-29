let submitNewUser = document.querySelector(".form-container__submit-button");
let strengthMeter = document.getElementById('strength-meter');
let passwordInput = document.getElementById('passwordInput');
let reasons = document.getElementById('passwordValidationText');


function enableSumbitIfFormIsValid() {
  if (isPasswordValid && isQuestionValid && isAnswerValid) {
    submitBtn.disabled = false;
  }
}

let isPasswordValid = false;
let isQuestionValid = false;
let isAnswerValid = false;

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


function validateControllQuestion() {
  let question = document.querySelector('#controllQuestion').value;
  let infoText = document.querySelector('.QuestionValidationText');

  if (question.length === 0) {
    infoText.innerHTML = "OBS! Obligatoriskt fält";
  } else if (question.length < 10) {
    infoText.innerHTML = "OBS! Din fråga är för kort"
  } else if (isValidControllQ(question)) {
    infoText.innerHTML = "OBS! Ogiltig format på frågan, får bara innehålla a-ö, siffror och frågetecken.";
  } else {
    infoText.innerHTML = "";
    isQuestionValid = true;
    enableSumbitIfFormIsValid();
    return;
  }

}

function isValidControllQ(question) {
  let regEx = /\`|\~|\!|\@|\#|\$|\%|\^|\&|\*|\(|\)|\+|\=|\[|\{|\]|\}|\||\\|\'|\<|\,|\.|\>|\/|\""|\;|\:/
  return regEx.test(String(question));
}


function validateControllAnswer() {
  let answer = document.querySelector('#controllAnswer').value;
  let infoText = document.querySelector('.AnswerValidationText');

  if (answer.length === 0) {
    infoText.innerHTML = "OBS! Obligatoriskt fält";
  } else if (answer.length < 5) {
    infoText.innerHTML = "OBS! Ditt svar är för kort, måste vara minst fem bokstäver."
  } else if (isValidControllA(answer)) {
    infoText.innerHTML = "OBS! Ogiltig format på frågan, får bara innehålla a-ö och siffror.";
  } else {
    infoText.innerHTML = "";
    isAnswerValid = true;
    enableSumbitIfFormIsValid();
    return;
  }

}

function isValidControllA(answer) {
  let regEx = /\`|\~|\!|\@|\#|\$|\%|\^|\&|\*|\(|\)|\+|\=|\[|\{|\]|\}|\||\\|\'|\<|\,|\.|\>|\/|\""|\;|\:/
  return regEx.test(String(answer));
}

