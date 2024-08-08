const signupform=document.getElementById("signupform");
const errorlist=document.querySelectorAll('.inputerror');
const Name=document.getElementById('username');
const nameError=document.getElementById('nameerror');
const Email=document.getElementById('email');
const emailError=document.getElementById('emailerror');
const passWord=document.getElementById('pass');
const passerror=document.getElementById('passerror');
const inputlist=document.querySelectorAll('input');

errorlist.forEach(errors=>{
    errors.style.display='none';
});

signupform.addEventListener('submit',function(e){
    e.preventDefault();

    errorlist.forEach(errors=>{
        errors.style.display='none';
    });


    passWord.classList.remove('inputchange');
    Name.classList.remove('inputchange');
    Email.classList.remove('inputchange');
    
    if(passWord.value.length<8){
        passerror.style.display='block';
        passWord.classList.add('inputchange');
    }
    var formData = new FormData(document.getElementById('signupform'));
    fetch('../htmlphp/signup.php',{
        method:'POST',
        body:formData
    })
    .then(response=>{
        return response.json();
    })
    .then(data=>{
        if(!data.username&&!data.email){
           window.location.href="index.php";
        }
        else{
        if(data.username){
           nameError.style.display='block';
           Name.classList.add('inputchange');
        }
        if(data.email){
            emailError.style.display='block';
            Email.classList.add('inputchange');
        }
    }
    })
});

// inputlist.forEach(inp=>{
//     inp.addEventListener('input',()=>{
//         // e.preventDefault();
//         inp.style.border='1px solid gray';
//     })
// })