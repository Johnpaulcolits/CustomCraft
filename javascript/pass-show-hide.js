const passwordFields = document.querySelectorAll(".form input[type='password']");
const toggleIcons = document.querySelectorAll(".form .field i");

toggleIcons.forEach((icon, index) => {
  icon.onclick = () => {
    if (passwordFields[index].type === "password") {
      passwordFields[index].type = "text";
      icon.classList.add("active");
    } else {
      passwordFields[index].type = "password";
      icon.classList.remove("active");
    }
  };
});
