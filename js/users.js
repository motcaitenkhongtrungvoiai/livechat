const searchBar = document.querySelector("form .search input"),
  userList = document.querySelector(".users-list");

//hàm tìm kiếm thôi 
searchBar.onkeyup = () => {
  let hind = searchBar.value.trim();
  fetch("php/search.php?searchTerm=" + hind, { method: "POST" })
  .then((response) => response.text())
  .then((data)=>{
   userList.innerHTML=data;
  })
  .catch((error) => {
   console.error("something go wrong with hind",error);
  })
};
