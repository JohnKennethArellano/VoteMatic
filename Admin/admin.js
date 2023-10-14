var menu = document.getElementById('menu');
var minimize = document.getElementById('minimize');
var container = document.getElementById('container');


minimize.addEventListener('click',(e)=>{

    menu.classList.toggle("minimize");
    container.classList.toggle("minimize");
});

var sName = document.getElementById('sName');
var fName = document.getElementById('fName');
var mName = document.getElementById('mName');
const  regex =/^[\w'\-,.][^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]]{2,}$/;
var voterID = document.getElementById('voterID');
var department = document.getElementById('dep');


function validateVoter(){
    var sNameValue = sName.value.trim(); 
    var fNameValue = fName.value.trim(); 
    var mNameValue = mName.value.trim(); 
    var voterIDValue = voterID.value.trim(); 
    var departmentValue = department.value;
    
    if(sNameValue === ""){
        setErrorfor(sName, 'Surname Cannot be Empty');
        return false;
    }
    else if(!regex.test(sNameValue)){
        setErrorfor(sName, 'Invalid Name Format');
        return false;
    } 
    else{
       setSuccessfor(sName);      
    }
    if(fNameValue === ""){
        setErrorfor(fName, 'First Name Cannot be Empty');
        return false;
    }
    else if(!regex.test(fNameValue)){
        setErrorfor(fName, 'Invalid Name Format');
        return false;
    }  
    else{
       setSuccessfor(fName);      
    }
    if(mNameValue === ""){
        setSuccessfor(mName);
       
    }
    else{
       setSuccessfor(mName);      
    }
    if(voterIDValue === ""){
        Swal.fire({
            icon: "warning",
            title: "Voter ID Missing!",
            showConfirmButton: false,
            timer:1000                     
                    });
        return false;
    } 
    if(departmentValue == "default"){  
        Swal.fire({
            icon: "warning",
            title: "Select Department!",
            showConfirmButton: false,
            timer:1000                     
                    });
        return false;
    }


}



var vtfName = document.getElementById('vtfName');
var vtsName = document.getElementById('vtsName');
var vtdepartment = document.getElementById('dept');


function validateChange(){

    var vtsNameValue = vtsName.value.trim(); 
    var vtfNameValue = vtfName.value.trim(); 
    var vtdepartmentValue = vtdepartment.value;

    if(vtsNameValue === ""){
        setErrorfor(vtsName, 'Surname Cannot be Empty');
        return false;
    }
    else if(!regex.test(vtsNameValue)){
        setErrorfor(vtsName, 'Invalid Name Format');
        return false;
    } 
    else{
       setSuccessfor(vtsName);      
    }
    if(vtfNameValue === ""){
        setErrorfor(vtfName, 'First Name Cannot be Empty');
        return false;
    }
    else if(!regex.test(vtfNameValue)){
        setErrorfor(vtfName, 'Invalid Name Format');
        return false;
    } 
    else{
       setSuccessfor(vtfName);      
    }
    if(vtdepartmentValue == "default"){  
        Swal.fire({
            icon: "warning",
            title: "Select Department!",
            showConfirmButton: false,
            timer:1000                     
                    });
        return false;
    }
}

var csName = document.getElementById('csName');
var cfName = document.getElementById('cfName');
var cplatform = document.getElementById('cplatform');
var posAvailable = document.getElementById('posAvailable');
var parAvailable = document.getElementById('parAvailable');


function validateCandidate(){
    
    var csNameValue = csName.value.trim(); 
    var cfNameValue = cfName.value.trim(); 
    var cplatformValue = cplatform.value.trim(); 
    var posAvailableValue = posAvailable.value; 
    var parAvailableValue = parAvailable.value; 


    if(csNameValue === ""){
        setErrorfor(csName, 'Surname Cannot be Empty');
        return false;
    }
    else if(!regex.test(csNameValue)){
        setErrorfor(csName, 'Invalid Name Format');
        return false;
    } 
    else{
       setSuccessfor(csName);      
    }
    if(cfNameValue === ""){
        setErrorfor(cfName, 'First Name Cannot be Empty');
        return false;
    }
    else if(!regex.test(cfNameValue)){
        setErrorfor(cfName, 'Invalid Name Format');
        return false;
    } 
    else{
       setSuccessfor(cfName);      
    }
    if(cplatformValue === ""){
        Swal.fire({
            icon: "warning",
            title: "Platform Required",
            showConfirmButton: false,
            timer:1000                     
                    });
        return false;
    }
    if(posAvailableValue == "default"){  
        Swal.fire({
            icon: "warning",
            title: "Select Position!",
            showConfirmButton: false,
            timer:1000                     
                    });
        return false;
    }
    if(parAvailableValue == "default"){  
        Swal.fire({
            icon: "warning",
            title: "Select Partylist!",
            showConfirmButton: false,
            timer:1000                     
                    });
        return false;
    }


}
var csNameEdit = document.getElementById('csNameEdit');
var cfNameEdit = document.getElementById('cfNameEdit');
var cplatformEdit = document.getElementById('cplatformEdit');
var posAvailableEdit = document.getElementById('posAvailableEdit');
var parAvailableEdit = document.getElementById('parAvailableEdit');

function validateChangeCandidate(){
    var csNameValueEdit = csNameEdit.value.trim(); 
    var cfNameValueEdit = cfNameEdit.value.trim(); 
    var cplatformValueEdit = cplatformEdit.value.trim(); 
    var posAvailableValueEdit = posAvailableEdit.value; 
    var parAvailableValueEdit = parAvailableEdit.value;
    
    if(csNameValueEdit === ""){
        setErrorfor(csNameEdit, 'Surname Cannot be Empty');
        return false;
    }
    else if(!regex.test(csNameValueEdit)){
        setErrorfor(csNameEdit, 'Invalid Name Format');
        return false;
    } 
    else{
       setSuccessfor(csNameEdit);      
    }
    if(cfNameValueEdit === ""){
        setErrorfor(cfNameEdit, 'First Name Cannot be Empty');
        return false;
    }
    else if(!regex.test(cfNameValueEdit)){
        setErrorfor(cfNameEdit, 'Invalid Name Format');
        return false;
    } 
    else{
       setSuccessfor(cfNameEdit);      
    }
    if(cplatformValueEdit === ""){
        Swal.fire({
            icon: "warning",
            title: "Platform Required",
            showConfirmButton: false,
            timer:1000                     
                    });
        return false;
    }
    if(posAvailableValueEdit == "default"){  
        Swal.fire({
            icon: "warning",
            title: "Select Position!",
            showConfirmButton: false,
            timer:1000                     
                    });
        return false;
    }
    if(parAvailableValueEdit == "default"){  
        Swal.fire({
            icon: "warning",
            title: "Select Partylist!",
            showConfirmButton: false,
            timer:1000                     
                    });
        return false;
    }


}






function setSuccessfor(input){
    var formControl = input.parentElement;        

    formControl.className = 'name-form-control success';

}
function setErrorfor(input, message){
    var formControl = input.parentElement;
    var errorMessage = formControl.querySelector(".errorMessage");

    errorMessage.innerText = message;

    formControl.className = 'name-form-control error';
    
}

var depName = document.getElementById('depName');
function validateDepartment(){

    var depNameValue = depName.value.trim(); 

    if(depNameValue === ""){
        setErrorfor(depName, 'Department Name Cannot be Empty');
        return false;
    }
    else if(!regex.test(depNameValue)){
        setErrorfor(depName, 'Invalid Name Format');
        return false;
    } 
    else{
       setSuccessfor(depName);      
    }

}

var depNameEdit = document.getElementById('depNameEdit');
function validateDepartmentChange(){

    var depNameEditValue = depNameEdit.value.trim(); 

    if(depNameEditValue === ""){
        setErrorfor(depNameEdit, 'Department Name Cannot be Empty');
        return false;
    }
    else if(!regex.test(depNameEditValue)){
        setErrorfor(depNameEdit, 'Invalid Name Format');
        return false;
    } 
    else{
       setSuccessfor(depNameEdit);      
    }

}

var partName = document.getElementById('partName');
function validatePartylist(){

    var partNameValue = partName.value.trim(); 

    if(partNameValue === ""){
        setErrorfor(partName, 'Partylist Name Cannot be Empty');
        return false;
    }
    else if(!regex.test(partNameValue)){
        setErrorfor(partName, 'Invalid Name Format');
        return false;
    } 
    else{
       setSuccessfor(partName);      
    }

}

var partNameEdit = document.getElementById('partNameEdit');
function validatePartylistChange(){

    var partNameEditValue = partNameEdit.value.trim(); 

    if(partNameEditValue === ""){
        setErrorfor(partNameEdit, 'Partylist Name Cannot be Empty');
        return false;
    }
    else if(!regex.test(partNameEditValue)){
        setErrorfor(partNameEdit, 'Invalid Name Format');
        return false;
    } 
    else{
       setSuccessfor(partNameEdit);      
    }

}
var posName = document.getElementById('posName');
var maxVote = document.getElementById('maxVote');
var winCount = document.getElementById('winCount');
var priority = document.getElementById('priority');
function validatePosition(){

    var posNameValue = posName.value.trim(); 
    var maxVoteValue = maxVote.value;
    var winCountValue = winCount.value;
    var priorityValue = priority.value;
;
    if(posNameValue === ""){
        setErrorfor(posName, 'Position Name Cannot be Empty');
        return false;
    }
    else if(!regex.test(posNameValue)){
        setErrorfor(posName, 'Invalid Name Format');
        return false;
    } 
    else{
       setSuccessfor(posName);      
    }
    if(maxVoteValue === ""){
        setErrorfor(maxVote, 'Max Vote Cannot be Empty');
        return false;
    }
    else if(isNaN(maxVoteValue)){
        setErrorfor(maxVote, 'Number Only');
        return false;
    } 
    else{
       setSuccessfor(maxVote);      
    }
    if(winCountValue === ""){
        setErrorfor(winCount, 'Winner Count Empty');
        return false;
    }
    else if(isNaN(winCountValue)){
        setErrorfor(winCount, 'Number Only');
        return false;
    } 
    else{
       setSuccessfor(winCount);      
    }
    if(priorityValue === ""){
        setErrorfor(priority, 'Priority Cannot be Empty');
        return false;
    }
    else if(isNaN(priorityValue)){
        setErrorfor(priority, 'Number Only');
        return false;
    } 
    else{
       setSuccessfor(priority);      
    }


}
var posNameEdit = document.getElementById('posNameEdit');
var maxVoteEdit = document.getElementById('maxVoteEdit');
var winCountEdit = document.getElementById('winCountEdit');
var priorityEdit = document.getElementById('priorityEdit');
function validatePositionChange(){

    var posNameValue = posNameEdit.value.trim(); 
    var maxVoteValue = maxVoteEdit.value;
    var winCountValue = winCountEdit.value;
    var priorityValue = priorityEdit.value;
;
    if(posNameValue === ""){
        setErrorfor(posNameEdit, 'Position Name Cannot be Empty');
        return false;
    }
    else if(!regex.test(posNameValue)){
        setErrorfor(posNameEdit, 'Invalid Name Format');
        return false;
    } 
    else{
       setSuccessfor(posNameEdit);      
    }
    if(maxVoteValue === ""){
        setErrorfor(maxVoteEdit, 'Max Vote Cannot be Empty');
        return false;
    }
    else if(isNaN(maxVoteValue)){
        setErrorfor(maxVoteEdit, 'Number Only');
        return false;
    } 
    else{
       setSuccessfor(maxVoteEdit);      
    }
    if(winCountValue === ""){
        setErrorfor(winCountEdit, 'Winner Count Empty');
        return false;
    }
    else if(isNaN(winCountValue)){
        setErrorfor(winCountEdit, 'Number Only');
        return false;
    } 
    else{
       setSuccessfor(winCountEdit);      
    }
    if(priorityValue === ""){
        setErrorfor(priorityEdit, 'Priority Cannot be Empty');
        return false;
    }
    else if(isNaN(priorityValue)){
        setErrorfor(priorityEdit, 'Number Only');
        return false;
    } 
    else{
       setSuccessfor(priorityEdit);      
    }


}
function PreviewImage() {
    
    var pic = new FileReader();
    pic.readAsDataURL(document.getElementById("updPic").files[0]);
    pic.onload = function (oFREvent) {
        document.getElementById("uploadPreview").src = oFREvent.target.result;
    };
   
};

function previewPicture() {
    
    var pic = new FileReader();
    pic.readAsDataURL(document.getElementById("updPicture").files[0]);
    pic.onload = function (oFREvent) {
        document.getElementById("previewPic").src = oFREvent.target.result;
    };
   
};

var sNameAdmin = document.getElementById('sNameAdmin');
var fNameAdmin = document.getElementById('fNameAdmin');
var emailAdmin = document.getElementById('emailAdmin');
var usernameAdmin = document.getElementById('usernameAdmin');
var curpassAdmin = document.getElementById('curpassAdmin');
var newpassAdmin = document.getElementById('newpassAdmin');
var confpassAdmin = document.getElementById('confpassAdmin');
function validateInfo(){

    var sName = sNameAdmin.value.trim(); 
    var fName = fNameAdmin.value.trim(); 
    var email = emailAdmin.value.trim(); 
    var username = usernameAdmin.value.trim(); 
    var curPass = curpassAdmin.value.trim(); 
    var pass = newpassAdmin.value.trim(); 
    var conf = confpassAdmin.value.trim(); 

    if(sName == ''){
        Swal.fire({
            icon: "warning",
            iconColor: "#FF2E2E",
            text: "Surname Missing",
            showConfirmButton: false,
            timer: 1000,
          })
        return false;
    }
    else if(!regex.test(sName)){
        Swal.fire({
            icon: "warning",
            iconColor: "#FF2E2E",
            text: "Invalid Surname",
            showConfirmButton: false,
            timer: 1000,
          })
        return false;
    } 
    if(fName == ''){
        Swal.fire({
            icon: "warning",
            iconColor: "#FF2E2E",
            text: "First Name Missing",
            showConfirmButton: false,
            timer: 1000,
          })
        return false;
    }
    else if(!regex.test(fName)){
        Swal.fire({
            icon: "warning",
            iconColor: "#FF2E2E",
            text: "Invalid First Name",
            showConfirmButton: false,
            timer: 1000,
          })
        return false;
    } 
    if(email == ''){
        Swal.fire({
            icon: "warning",
            iconColor: "#FF2E2E",
            text: "Email Missing",
            showConfirmButton: false,
            timer: 1000,
          })
        return false;
    }
    else if (!isEmail(email)) {
        Swal.fire({
            icon: "warning",
            iconColor: "#FF2E2E",
            text: "Invalid Email",
            showConfirmButton: false,
            timer: 1000,
          })		
        return false;
       
	} 
    if(username == ''){
        Swal.fire({
            icon: "warning",
            iconColor: "#FF2E2E",
            text: "Username Missing",
            showConfirmButton: false,
            timer: 1000,
          })
        return false;
    }
    else if(username.length < 6){
        Swal.fire({
            icon: "warning",
            iconColor: "#FF2E2E",
            text: "Username should be at least 6 characters",
            showConfirmButton: false,
            timer: 1000,
          })
        return false;
    }
    if(curPass == ''){
        Swal.fire({
            icon: "warning",
            iconColor: "#FF2E2E",
            text: "Enter Your Current Password",
            showConfirmButton: false,
            timer: 1000,
          })
        return false;
    }
    if(pass == ''){
        Swal.fire({
            icon: "warning",
            iconColor: "#FF2E2E",
            text: "Password Missing",
            showConfirmButton: false,
            timer: 1000,
          })
        return false;
    }
    else if(pass.length < 6){
        Swal.fire({
            icon: "warning",
            iconColor: "#FF2E2E",
            text: "Password should be at least 6 characters",
            showConfirmButton: false,
            timer: 1000,
          })
        return false;
    } 
    if(conf == ''){
        Swal.fire({
            icon: "warning",
            iconColor: "#FF2E2E",
            text: "Please Confirm Your Password ",
            showConfirmButton: false,
            timer: 1000,
          })
        return false;
    }
    else if(pass !== conf) {
        Swal.fire({
            icon: "warning",
            iconColor: "#FF2E2E",
            text: "Passwords Do Not Match",
            showConfirmButton: false,
            timer: 1000,
          })
        return false;
        
    }
    
}

function isEmail(email) {
	return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}
