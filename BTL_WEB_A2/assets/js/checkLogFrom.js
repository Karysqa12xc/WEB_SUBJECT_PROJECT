document.addEventListener("DOMContentLoaded", function(){
    const inputElements = document.querySelectorAll('input:not([type = "submit"])');
    const msgErrors = document.querySelectorAll('.form_control-mgsError');
    const form = document.querySelector("form");
    const msgErrorTotal = document.querySelector('.container-msgErrorTotal');
    const eye_close = document.querySelector('.eye-close');
    const eye_open = document.querySelector('.eye-open');
    form.addEventListener('submit', (e) =>{
        inputElements.forEach((inputElement)=>{
            if(inputElement.value == ''){
                msgErrorTotal.innerHTML = "Nhắc nhở: Bạn cần nhập đúng và đầy đủ tất cả các trường!!!";
                e.preventDefault();
            }
           
        });
    });
    inputElements.forEach((inputElement, index) => {
        inputElement.addEventListener('blur', (e) => {
          if (inputElement.value == '') {
            // e.preventDefault();
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
      eye_open.addEventListener('click', ()=>{
        eye_open.style.display = "none";
        eye_close.style.display = "block";
        let inputPass = document.querySelector("#passLog");
        inputPass.setAttribute('type', "password");
      });
      eye_close.addEventListener('click', ()=>{
        eye_close.style.display = "none";
        eye_open.style.display = "block";
        let inputPass = document.querySelector("#passLog");
        inputPass.setAttribute('type', "text");
      });
    
})