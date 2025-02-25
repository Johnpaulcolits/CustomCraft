const form = document.querySelector(".login form"),
      continueBtn = form.querySelector(".button input"),
      errorText = form.querySelector(".error-text");

form.onsubmit = (e) => {
    e.preventDefault();
}

continueBtn.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/admin.login.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response.trim(); // Trim response to avoid whitespace issues
                if (data === "admin") {
                    location.href = "./admin/index.php";  // Redirect to admin page
                } else {
                    errorText.style.display = "block";
                    errorText.textContent = data; // Show error for non-admin users or failed login
                }
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}
