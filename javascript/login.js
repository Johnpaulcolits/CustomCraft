const form = document.querySelector(".login form"),
      continueBtn = form.querySelector(".button input"),
      errorText = form.querySelector(".error-text");

form.onsubmit = (e) => {
    e.preventDefault();
}

continueBtn.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/login.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                if (data === "user") {
                    location.href = "../users.php";  // Redirect to normal user page
                } else {
                    errorText.style.display = "block";
                    errorText.textContent = data; // Show error for non-user logins
                }
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}
