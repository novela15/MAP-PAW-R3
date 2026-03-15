function signup(){

let username = document.getElementById("username").value;
let email = document.getElementById("email").value;
let password = document.getElementById("password").value;
let confirm = document.getElementById("confirm").value;

if(!email.includes("@")){
    alert("Email harus mengandung @");
    return;
}

if(password !== confirm){
    alert("Password tidak sama, silakan masukkan ulang");
    return;
}

alert(
"Username : " + username +
"\nEmail : " + email +
"\nPassword : " + password
);

}