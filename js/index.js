const req=document.getElementById("log");
const div1=document.getElementById("logsignup");
req.addEventListener("click",(ev)=>{
    div1.innerHTML="";
    let div2=document.createElement("button");
    div2.textContent="😎User1";
    div1.append(div2);
})