const form = document.querySelector(".typing-area"),
  incoming_id = form.querySelector(".incoming_id").value,
  inputField = form.querySelector(".input-field"),
  sendBtn = form.querySelector("button"),
  chatBox = document.querySelector(".chat-box");

form.onsubmit = (e) => {
  e.preventDefault();
};
//làm nổi khung chat khi người dùng nhấn vào khung chat
inputField.onkeyup = () => {
  if (inputField.value != "") {
    sendBtn.classList.add("active");
  } else {
    sendBtn.classList.remove("active");
  }
};

//dùng fetch api để insert tin nhắn vào database
sendBtn.onclick = () => {
  let formData = new FormData(form);
  fetch("php/insert_chat.php", { method: "POST", body: formData }) 
    .then((response) => {
      inputField.value = "";
      scrollToBottom();
    })
    .catch((error) => {
      console.error("not good! you can't insert chat into database!!!", error);
    });
};


// di chuật vào khung chat để không cho tin nhắn mới suất hiện 
chatBox.onmouseenter = () => {
  chatBox.classList.add("active");
};

chatBox.onmouseleave = () => {
  chatBox.classList.remove("active");
};

// lấy tin nhắn theo thời gian thực từ data base -- sau 200milisecond thì lấy một lần 
setInterval(() => {
  fetch("php/get_chat.php?incoming_id=" + incoming_id, { method: "POST" })
    .then((response) => {
      if (response.ok) {
        return response.text();
      }
      throw new Error("Network response was not ok.");
    })
    .then((data) => {
      if (!chatBox.classList.contains("active")) {
        chatBox.innerHTML = data;
        scrollToBottom();
      }
    })
    .catch((error) => {
      console.error(
        "There has been a problem with your fetch operation:",
        error
      );
    });
}, 200);


// tự động hiển thị tin nhắn mới nhất
function scrollToBottom() {
  chatBox.scrollTop = chatBox.scrollHeight;
}
