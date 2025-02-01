const form = document.querySelector(".login form"),
continueBtn = form.querySelector(".button input"),
errorText = form.querySelector(".error-text");

form.onsubmit = (e) => {
    e.preventDefault();
};

continueBtn.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/login.php", true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response.trim();
                if(data === "admin"){
                    location.href = "admin/index.html"; // Redirect admin users
                } else if (data === "user"){
                    location.href = "users.php"; // Redirect regular users
                } else {
                    errorText.style.display = "block";
                    errorText.textContent = data;
                }
            }
        }
    };
    let formData = new FormData(form);
    xhr.send(formData);
};
