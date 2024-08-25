const form = document.querySelector(".typing-area"),
  incoming_id = form.querySelector(".incoming_id").value,
  inputField = form.querySelector(".input-field"),
  sendBtn = form.querySelector("button"),
  chatBox = document.querySelector(".chat-box");

form.onsubmit = (e) => {
  e.preventDefault();
};

inputField.onkeyup = () => {
  if (inputField.value != "") {
    sendBtn.classList.add("active");
  } else {
    sendBtn.classList.remove("active");
  }
};

sendBtn.onclick = () => {
  let xhttp = new XMLHttpRequest();
  xhttp.open("POST", "php/insert_chat.php", true);
  xhttp.onload = () => {
    if (xhttp.readyState === 4 && xhttp.status === 200) {
      inputField.value = "";
      chatBox.innerHTML = xhttp.responseText;
      scrollToBottom();
    }
  };
  let formData = new FormData(form);
  xhttp.send(formData);
};

chatBox.onmouseenter = () => {
  chatBox.classList.add("active");
};

chatBox.onmouseleave = () => {
  chatBox.classList.remove("active");
};

setInterval(() => {
  let xhr = new XMLHttpRequest();
  xhr.onload = () => {
    if (xhr.readyState === 4 && xhr.status === 200) {
      if (!chatBox.classList.contains("active")) {
        chatBox.innerHTML = xhr.responseText;
        scrollToBottom();
      }
    }
  };
  xhr.open("POST", "php/get_chat.php?incoming_id=" + incoming_id, true);
  xhr.send();
}, 200);

function scrollToBottom() {
  chatBox.scrollTop = chatBox.scrollHeight;
}
