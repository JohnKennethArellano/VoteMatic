var button = document.getElementById('login-btn');
var show = document.getElementById('login-register');
var container = document.getElementById('container');
var register = document.getElementById('register');
var login = document.getElementById('login');
var close2 = document.getElementById('close');
var close1 = document.getElementById('close1');
var voteNow = document.getElementById('voteNow');



voteNow.addEventListener('click',(e)=>{

    show.classList.toggle("active");
});
close2.addEventListener('click',(e)=>{

    show.classList.toggle("active");
});
close1.addEventListener('click',(e)=>{

    show.classList.toggle("active");
});
button.addEventListener('click',(e)=>{

    show.classList.toggle("active");
});

register.addEventListener('click',(e)=>{

    container.classList.toggle("active");
});
login.addEventListener('click',(e)=>{

    container.classList.toggle("active");

});

var sName = document.getElementById('sName');
var fName = document.getElementById('fName');
var mName = document.getElementById('mName');
var username = document.getElementById('username');
var email = document.getElementById('email');
var password = document.getElementById('password');
var confirmPass = document.getElementById('confirmPass');
const  regex =/^[\w'\-,.][^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]]{2,}$/;

var togglePassword = document.getElementById('loginID');
var pass = document.getElementById("pass");

togglePassword.addEventListener('click', (e)=>{


    if (pass.type === "password") {
      pass.type = "text";
    } else {
      pass.type = "password";
    }
});

var usernameLogIN = document.getElementById('usernameLogIN');

function ValidateLogIn(){

    var uliValue = usernameLogIN.value.trim(); 
    var pliValue = pass.value.trim();

    if(uliValue === ''){
        setErrorforInput(usernameLogIN, 'ID Cannot be empty');
        return false;      
    }
    else{
       setSuccessforInput(usernameLogIN);
  
    }
    if(pliValue === ''){
        setErrorforInput(pass, 'Password Cannot be empty');
        return false;
 
    }
    else{
       setSuccessforInput(pass);

    }

}


function setErrorforInput(input, message){
    const formControl = input.parentElement;
    const errorMessage = formControl.querySelector(".errorMessage");

    errorMessage.innerText = message;

    formControl.className = 'form-control error';
    
}
function setSuccessforInput(input){
    const formControl = input.parentElement;        

    formControl.className = 'form-control success';

}






function Validate(){

    var sNameValue = sName.value.trim(); 
    var fNameValue = fName.value.trim();
    var usernameValue = username.value.trim(); 
    var emailValue = email.value.trim(); 
    var passValue = password.value.trim(); 
    var confpassValue = confirmPass.value.trim(); 

    if(sNameValue === ''){
        setErrorforName(sName, 'Name Cannot be empty');
        return false;

       
    }
    else if(!regex.test(sNameValue)){
        setErrorforName(sName, 'Invalid Format');
        return false;
    } 
    else{
       setSuccessforName(sName);

       
    }
    if(fNameValue === ''){
        setErrorforName(fName, 'Name Cannot be empty');
        return false;

       
    }
    else if(!regex.test(fNameValue)){
        setErrorforName(fName, 'Invalid Format');
        return false;
    } 
    else{
       setSuccessforName(fName);

       
    }
    if(usernameValue ===''){
        setErrorfor(username, 'Username Cannot be Empty');
        return false;
       
    }
    else if(usernameValue.length < 6){
        setErrorfor(username, 'Username should Atleast 6 Characters');
        return false;
    } 
    else{
       setSuccessfor(username);

        
    }     
    if(emailValue ===''){
        setErrorfor(email, 'Email Cannot be Empty');
        return false;
       
    }
    else if (!isEmail(emailValue)) {
		setErrorfor(email, 'Not a valid email');
        return false;
       
	} 
    else{
       setSuccessfor(email);

       
    }      
    if(passValue ===''){
        setErrorfor(password, 'Password Cannot be Empty');
        return false;
    }
    if(passValue.length < 6){
        setErrorfor(password, 'Password should Atleast 6 Characters');
        return false;
    } 
    else{
       setSuccessfor(password);

       
    }

    if(confpassValue ===''){
        setErrorfor(confirmPass, 'Confirm your Password');
        return false;
       
    }
    else if(passValue !== confpassValue) {
		setErrorfor(confirmPass, 'Passwords does not match');
        return false;
        
    }
    else{
       setSuccessfor(confirmPass);
       
    }

}

function setErrorfor(input, message){
    var formControl = input.parentElement;
    var errorMessage = formControl.querySelector(".errorMessage");

    errorMessage.innerText = message;

    formControl.className = 'regis-form-control error';
    
}
function setSuccessfor(input){
    var formControl = input.parentElement;        

    formControl.className = 'regis-form-control success';

}
function setErrorforName(input, message){
    var formControl = input.parentElement;
    var errorMessage = formControl.querySelector(".errorMessage");

    errorMessage.innerText = message;

    formControl.className = 'name-form-control error';
    
}
function setSuccessforName(input){
    var formControl = input.parentElement;        

    formControl.className = 'name-form-control success';

}
function isEmail(email) {
	return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}

var ball = document.getElementById('ball');
var id = document.getElementById('id');
var section = document.getElementById('header');
var options = document.getElementById('options');
var section1 = document.getElementById('section1');
var flogo = document.getElementById('f-logo');
var body  = document.getElementById('body');
var featureTitle  = document.getElementById('featureTitle');
var fbutton  = document.getElementById('feedback-Button');
var aboutUsCompany  = document.getElementById('aboutUs-Company');
var info  = document.getElementById('info-container');
var fcontainer  = document.getElementById('footer-container');
var front = document.getElementById('front');
var back = document.getElementById('back');



ball.addEventListener('click',(e)=>{

    body.classList.toggle("dark");
    section.classList.toggle("dark");
    options.classList.toggle("dark");
    id.classList.toggle("dark");
    section1.classList.toggle('dark');
    flogo.classList.toggle("dark");
    voteNow.classList.toggle("dark");
    fbutton.classList.toggle("dark");   
    featureTitle.classList.toggle("dark");   
    aboutUsCompany.classList.toggle("dark");
    info.classList.toggle("dark");
    fcontainer.classList.toggle("dark");
    front.classList.toggle("dark");
    back.classList.toggle("dark");
});
