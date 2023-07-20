document.addEventListener("DOMContentLoaded", function () {
    function registerEventListeners() {
        const regionDragImage = document.querySelector('.app__contentMid-fieldImage');
        const buttonRemoveImage = document.querySelector('.app__contentMid-disableImage');
        const inputChooseFileInput = document.querySelector('.app__contentMid-chooseImage');
        inputChooseFileInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            showFile(file);
        });
        buttonRemoveImage.addEventListener('click', ()=>{
            regionDragImage.classList.add('.app__contentMid-fieldImage');
        })
        function showFile(file) {
            const fileType = file.type;
            const validExtensions = ['image/jpeg', 'image/jpg', 'image/png'];
            if (validExtensions.includes(fileType)) {
                const fileReader = new FileReader();
                fileReader.onload = () => {
                    const fileUrl = fileReader.result;
                    const imgTag = `<img src="${fileUrl}" style=" width: 100%; height: 100%;">`;
                    regionDragImage.innerHTML = imgTag;
                };
                fileReader.readAsDataURL(file);
            } else {
                alert('Đây không phải là ảnh');
            }
        }
    }
    registerEventListeners();
});


