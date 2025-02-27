// const form = document.querySelector(".signup form"),
//       continueBtn = form.querySelector(".button input"),
//       errorText = form.querySelector(".error-text");

// form.onsubmit = (e) => {
//     e.preventDefault();
// }

// continueBtn.onclick = () => {
//     let xhr = new XMLHttpRequest();
//     xhr.open("POST", "php/signup.php", true);
//     xhr.onload = () => {
//         if (xhr.readyState === XMLHttpRequest.DONE) {
//             if (xhr.status === 200) {
//                 let data = xhr.response;
//                 if (data.trim() === "success") { // Redirect without displaying message
//                     location.href = "../login.php";
//                 } else {
//                     errorText.style.display = "block";
//                     errorText.textContent = data;
//                 }
//             }
//         }
//     }
//     let formData = new FormData(form);
//     xhr.send(formData);
// }

const form = document.querySelector(".signup form"),
      continueBtn = form.querySelector(".button input"),
      errorText = form.querySelector(".error-text");

const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 1500,
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
    xhr.open("POST", "php/signup.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                if (data.trim() === "success") {
                    Toast.fire({
                        icon: "success",
                        title: "Signed up successfully"
                    });
                    setTimeout(() => {
                        location.href = "../confirm.php";
                    }, 1500); // Redirect after the toast
                } else {
                    errorText.style.display = "block";
                    errorText.textContent = data;
                }
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
} 
