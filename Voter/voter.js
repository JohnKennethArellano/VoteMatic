
const password = document.getElementById('password');
const conPassword = document.getElementById('conPassword');

function validate(){
    const passwordValue = password.value.trim();    
    const conPasswordValue = conPassword.value.trim();

     if(passwordValue === ''){
        setErrorfor(password, 'Password Cannot be empty');
        return false;    

    }  
    else if(passwordValue.length < 6){
        setErrorfor(password, 'Password must be 6 or more Characters');
        return false;  
    }
    else{
        setSuccessfor(password);
   
    }
    if(conPasswordValue === ''){
        setErrorfor(conPassword, 'Please Confirm your Password');
        return false;    

    }
    else if(passwordValue !== conPasswordValue) {
		setErrorfor(conPassword, 'Passwords does not match');
        return false;
        
    }
    else{
       setSuccessfor(conPassword);
       
    }
     
}
function setErrorfor(input, message){
    const formControl = input.parentElement;
    const errorMessage = formControl.querySelector(".errorMes");

    errorMessage.innerText = message;

    formControl.className = 'fcontrol error';
    
}
function setSuccessfor(input){
    const formControl = input.parentElement;        

    formControl.className = 'fcontrol success';

}
