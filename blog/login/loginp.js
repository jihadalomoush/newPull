let sBut = document.getElementById("signbutton");
let lBut = document.getElementById("logbutton");
let animate = function () {
    let logBox = document.querySelector(".log-box");
    logBox.classList.toggle("log-left");
    let signBox = document.querySelector(".signup-box");
    signBox.classList.toggle("sign-right");
}
sBut.onclick = animate;
lBut.onclick = animate;