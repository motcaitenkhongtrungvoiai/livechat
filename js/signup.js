const form =document.querySelector(".signup form"),
continuteBtn=document.querySelector(".button input"),
errorText =document.querySelector(".error-text");

form.onsubmit = (e)=>{
    e.preventDefault();
}

continuteBtn.onclick=()=>{
    
    let xhr =new XMLHttpRequest();
    xhr.open("POST","php/signup.php",true);
    xhr.onload=()=>{
        if(xhr.readyState=== XMLHttpRequest.DONE && xhr.status===200){
            let data = xhr.response;
            if (data==="success"){
                location.href="user.php";
              
            }
            else{
               errorText.style.display = 'block';      
               errorText.textContent= data+"!!";     
            }
        }
    }
    let formData=new FormData(form);
    xhr.send(formData);
}   
;