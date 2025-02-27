// const form = document.querySelector(".login form"),
//       continueBtn = form.querySelector(".button input"),
//       errorText = form.querySelector(".error-text");

// form.onsubmit = (e) => {
//     e.preventDefault();
// }

// continueBtn.onclick = () => {
//     let xhr = new XMLHttpRequest();
//     xhr.open("POST", "php/login.php", true);
//     xhr.onload = () => {
//         if (xhr.readyState === XMLHttpRequest.DONE) {
//             if (xhr.status === 200) {
//                 let data = xhr.response.trim(); // Trim response to avoid whitespace issues
//                 if (data === "user") {
//                     location.href = "../../users/index.php";  // Redirect to normal user page
//                 } else {
//                     errorText.style.display = "block";
//                     errorText.textContent = data; // Show error for non-user logins
//                 }
//             }
//         }
//     }
//     let formData = new FormData(form);
//     xhr.send(formData);
// }

const form = document.querySelector(".login form"),
      continueBtn = form.querySelector(".button input"),
      errorText = form.querySelector(".error-text");

const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 1000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
    }
});

form.onsubmit = (e) => {
    e.preventDefault();
}

continueBtn.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/login.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response.trim(); // Trim response to avoid whitespace issues
                if (data === "user") {
                    Toast.fire({
                        icon: "success",
                        title: "Signed in successfully"
                    });
                    setTimeout(() => {
                        location.href = "../../users/index.php"; // Redirect to normal user page
                    }, 1000); // Redirect after the toast
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
