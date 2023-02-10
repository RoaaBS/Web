// let menu =document.querySelector('#menu-btn');
let navbarright =document.querySelector('.navbar .navbar-right');

$(document).ready(function(){
    $("#page-loader").fadeOut(3000);
})

$("#menu-btn").onclick=()=>{
    $("#menu-btn").classList.toggle('fas-times');
    navbarright.classList.toggle('active');
}
//window.onscroll =() =>{
 //   console.log($("#menu-btn"))
  //  $("#menu-btn").classList.remove('fas-times');
  //  navbarright.classList.remove('active');
//}
