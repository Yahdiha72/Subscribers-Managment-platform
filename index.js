
/*logo*/
const text=document.querySelector('.text p'); 
text.innerHTML=text.innerText.split("").map(
  (char, i)=>
 `<span style="transform:rotate(${i*11.1}deg)">${char}</span>`
).join("");
/*header movment*/
window.addEventListener("scroll",function(){
  var header  = document.querySelector("header");
  header.classList.toggle("sticky",window.scrollY > 0);
  });

 

/*toggeL cards open and close */
let card1 = document.querySelector('#card1');
let cardtoggle1 = document.querySelector('.toggle1');
cardtoggle1.onclick = function() {
  card1.classList.toggle('active');
}

let card2 = document.querySelector('#card2');
let cardtoggle2 = document.querySelector('.toggle2');
cardtoggle2.onclick = function() {
  card2.classList.toggle('active');

}


let card3 = document.querySelector('#card3');
let cardtoggle3 = document.querySelector('.toggle3');
cardtoggle3.onclick = function() {
  card3.classList.toggle('active');

};


//steps hide 
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}

