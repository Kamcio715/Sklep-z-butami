const logo = document.getElementById("searchlogo");
const search = document.getElementById("search");
const filtricon=document.getElementById("filtricon")
const filtrbtn = document.getElementById("filtrbtn");

logo.addEventListener("click", (e) => {
    e.preventDefault();
    search.classList.toggle("active");
});

document.addEventListener("click", (e) => {
    if (!logo.contains(e.target) && !search.contains(e.target) && !filtrbtn.contains(e.target) && !filtricon.contains(e.target)) {
        search.classList.remove("active");
    }
});

const panel = document.getElementById("filtrpanel");

filtrbtn.addEventListener("click", () => {
    panel.classList.add("active");
});
filtricon.addEventListener("click", () => {
    panel.classList.add("active");
});


document.addEventListener("click", (e) => {
    if (!filtrbtn.contains(e.target) && !panel.contains(e.target) && !logo.contains(e.target) && !filtricon.contains(e.target) && closebtn.clicked==true) {
        panel.classList.remove("active");
    }
});

const closebtn = document.getElementById("closebtn");


const usericon = document.querySelector(".usericon");
const usermenu = document.getElementById("usermenu");

usericon.addEventListener("click", () => {
    usermenu.classList.toggle("active");
});

document.addEventListener("click", (e) => {
    if (!usericon.contains(e.target) && !usermenu.contains(e.target)) {
        usermenu.classList.remove("active");
    }
});

