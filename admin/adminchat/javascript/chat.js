const form = document.querySelector(".typing-area"),
      incoming_id = form.querySelector(".incoming_id").value,
      inputField = form.querySelector(".input-field"),
      sendBtn = form.querySelector("button"),
      chatBox = document.querySelector(".chat-box"),
      fileInput = document.getElementById("file-input");

form.onsubmit = (e)=>{
    e.preventDefault();
    let formData = new FormData(form);
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/insert-chat.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              inputField.value = "";
              fileInput.value = "";
              sendBtn.classList.remove("active");
              scrollToBottom();
          }
      }
    }
    xhr.send(formData);
}

inputField.onkeyup = ()=>{
    if(inputField.value != "" || fileInput.files.length > 0){
        sendBtn.classList.add("active");
    }else{
        sendBtn.classList.remove("active");
    }
}

fileInput.onchange = ()=>{
    if(inputField.value != "" || fileInput.files.length > 0){
        sendBtn.classList.add("active");
    }else{
        sendBtn.classList.remove("active");
    }
}

chatBox.onmouseenter = ()=>{
    chatBox.classList.add("active");
}
chatBox.onmouseleave = ()=>{
    chatBox.classList.remove("active");
}

setInterval(() =>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/get-chat.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
            let data = xhr.response;
            chatBox.innerHTML = data;
            if(!chatBox.classList.contains("active")){
                scrollToBottom();
              }
          }
      }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("incoming_id="+incoming_id);
}, 500);

function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
}