const form = document.querySelector(".login form"),
  continuteBtn = document.querySelector(".button input"),
  errorText = document.querySelector(".error-text");

form.onsubmit = (e) => {
  e.preventDefault();
};

continuteBtn.onclick = () => {
  let xhttp = new XMLHttpRequest();
  xhttp.open("POST", "php/login_.php", true);
  xhttp.onload = () => {
    if (xhttp.readyState === XMLHttpRequest.DONE && xhttp.status === 200) {
      let data = xhttp.response;
      if (data === "success") {
        location.href = "user.php";
      } else {
        errorText.style.display = "block";
        errorText.textContent = data;
      }
    }
  };
  let formdata = new FormData(form);
  xhttp.send(formdata);
};
