//Hàm check input của email
function checkMail() {
  let regexEmail = /^[^0-9\[\]\{\}\@\.\)\(\*\&\^\#\!\+\=\`\~\;\"\'\>\<\?\:\-\_][A-Za-z][a-zA-z0-9]+@[a-zA-z]+(\.com)$/gm;
  let email = document.querySelector("#emailCheck").value;
  return regexEmail.test(email);
}
//Hàm check input của phone Number
function checkPhoneNumber() {
  let regexPhoneNumber = /(0[1-9]{1})+([0-9]{8})\b/g;;
  let phoneNumber = document.querySelector("#phoneCheck").value;
  return regexPhoneNumber.test(phoneNumber);
}
//Hàm kiểm tra độ mạnh yếu của password
function checkStrengthPass() {
  let password = document.querySelector("#pass");
  let checkLenghtPass = false;
  let checkLowerCase = false;
  let checkUpperCase = false;
  let checkDigitCase = false;
  let checkSpeicalCase = false;
  if (password.value.length >= 8) checkLenghtPass = true;
  if (/[a-z]/.test(password.value)) checkLowerCase = true;
  if (/[A-Z]/.test(password.value)) checkUpperCase = true;
  if (/[0-9]/.test(password.value)) checkDigitCase = true;
  if (/[^a-zA-Z0-9]/.test(password.value)) checkSpeicalCase = true;
  return checkLenghtPass && checkLowerCase && checkUpperCase && checkDigitCase && checkSpeicalCase;
}
//Xác nhận lại mật khẩu nhập lại có giống mật khẩu ở trên không
function checkConfirmPassword() {
  let password = document.querySelector("#pass");
  let cfpassword = document.querySelector("#cfpass");
  let checkPasswordAndCofirmPasswordSame = false;
  if (password.value === cfpassword.value) checkPasswordAndCofirmPasswordSame = true;
  return checkPasswordAndCofirmPasswordSame;
}
//Kiểm tra from đã nhập đúng hết chưa
function checkForm() {
  let isEmailValid = checkMail();
  let isPhoneValid = checkPhoneNumber();
  let isPasswordValid = checkStrengthPass();
  let isConfirmPasswordValid = checkConfirmPassword();
  return isEmailValid && isPhoneValid && isPasswordValid && isConfirmPasswordValid;
}
document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");
  const inputElements = document.querySelectorAll('input:not([type = "submit"])');
  const msgErrors = document.querySelectorAll('.form_control-mgsError');
  const msgErrorTotal = document.querySelector('.container-msgErrorTotal');
  const eye_close = document.querySelector('.eye-close');
  const eye_open = document.querySelector('.eye-open');
  const eye_close_of_cfpass = document.querySelector('.eye-close_2');
  const eye_open_of_cfpass = document.querySelector('.eye-open_2');
  //Báo lỗi khi blur 
  inputElements.forEach((inputElement, index) => {
    inputElement.addEventListener('blur', (e) => {
      if (inputElement.value == '') {
        e.preventDefault();
        msgErrors[index].innerHTML = 'Bạn chưa nhập dữ liệu';
        inputElement.style.borderBottom = "3px solid red";
      }
    });

    //Xóa lỗi khi nhập
    inputElement.addEventListener('input', () => {
      if (inputElement.value != '') {
        msgErrors[index].innerHTML = '';
        inputElement.style.borderBottom = "3px solid blue";
      }
    });
  });
  form.addEventListener('submit', (e) => {
    if (!checkForm()) {
      inputElements.forEach((inputElement, index) => {
        let bothErrorMsgOfPhoneAndEmail = "Trường này bạn nhập chưa đúng định dạng!";
        let errorMsgPassword = "Tối thiếu mật khẩu phải dài hơn 8 ký tự, có chữ thường, chữ hoa số và một ký tự đặc biệt";
        let errorMsgCfPassword = "Mật khẩu nhập lại chưa khớp";
        //Báo lỗi cục bộ khi có bất kỳ một hàng chưa nhập mà bấm submit
        if (inputElement.value == '') msgErrorTotal.innerHTML = "Nhắc nhở: Bạn cần nhập đúng và đầy đủ tất cả các trường!!!";
        else if (inputElement.value != '') msgErrorTotal.innerHTML = "";
        //Check Mail và phoneNumber
        if (inputElement.id === "phoneCheck" && !checkPhoneNumber() || inputElement.id === "emailCheck" && !checkMail()) {
          msgErrors[index].innerHTML = bothErrorMsgOfPhoneAndEmail;
          inputElement.style.borderBottom = "3px solid red";
        }
        //Check mật khẩu mạnh hay yếu
        else if (inputElement.id === "pass" && !checkStrengthPass()) {
          msgErrors[index].innerHTML = errorMsgPassword;
          inputElement.style.borderBottom = "3px solid red";
        }
        //Check mật khẩu nhập lại có giống mật khẩu đã được nhập ở trên không
        else if (inputElement.id === "cfpass" && !checkConfirmPassword()) {
          msgErrors[index].innerHTML = errorMsgCfPassword;
          inputElement.style.borderBottom = "3px solid red";
        }
        else {
          msgErrors[index].innerHTML = "";
          inputElement.style.borderBottom = "3px solid blue";
        }
        e.preventDefault();
      });
    }



  });
  eye_open.addEventListener('click', ()=>{
    eye_open.style.display = "none";
    eye_close.style.display = "block";
    let inputPass = document.querySelector("#pass");
    inputPass.setAttribute('type', "password");
  });
  eye_close.addEventListener('click', ()=>{
    eye_close.style.display = "none";
    eye_open.style.display = "block";
    let inputPass = document.querySelector("#pass");
    inputPass.setAttribute('type', "text");
  });

  eye_open_of_cfpass.addEventListener('click', ()=>{
    eye_open_of_cfpass.style.display = "none";
    eye_close_of_cfpass.style.display = "block";
    let inputPass = document.querySelector("#cfpass");
    inputPass.setAttribute('type', "password");
  });
  eye_close_of_cfpass.addEventListener('click', ()=>{
    eye_close_of_cfpass.style.display = "none";
    eye_open_of_cfpass.style.display = "block";
    let inputPass = document.querySelector("#cfpass");
    inputPass.setAttribute('type', "text");
  });
});