const searchBar =document.querySelector("form .search input"),
userList=document.querySelector(".users-list");



searchBar.onkeyup = () => {
    let hind= searchBar.value;
    let xhttp = new XMLHttpRequest;
     xhttp.onreadystatechange =() => {
        if(xhttp.readyState === 4 && xhttp.status === 200){
         let data=xhttp.responseText;
          userList.innerHTML = data;
        }
     }
     xhttp.open("POST","php/search.php?searchTerm=" + hind,true);
     xhttp.send();
}

