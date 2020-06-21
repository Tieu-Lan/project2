function check() {
    let form1 = ["name", "email", "password", "again","emailError","passwordError","difference"];
    let userName = document.getElementsByName("userName")[0].value;
    let email = document.getElementsByName("email")[0].value;
    let password = document.getElementsByName("password")[0].value;
    let again = document.getElementsByName("again")[0].value;
    let form2 = [userName, email, password, again];
    let pass = true;
    for (let i = 0;i < 7;i++){
        document.getElementById(form1[i]).style.display = "none";
    }
    for (let i = 0; i < 4; i++) {
        if (form2[i] === "") {
            pass = false;
            document.getElementById(form1[i]).style.display = "block";
        }
    }
    let mai = /^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/;
    if (!mai.test(email) && email !== ""){
        console.log("asd")
        pass = false;
        document.getElementById("emailError").style.display = "block";
    }
    let l1 = password.length;
    let l2 = again.length;
    if (l1 < 6 && l1 > 0){
        pass = false;
        document.getElementById("passwordError").style.display = "block";
    }
    if (l1 !== l2){
        document.getElementById("difference").style.display = "block";
    } else if (l1 !== 0 && l2 !== 0){
        for (let i = 0;i < l1;i++){
            if(password[i] !== again[i]){
                pass = false;
                document.getElementById("difference").style.display = "block";
            }
        }
    }
    if(pass){
        register.method = "POST";
        register.action = "register.php";
        register.submit();
    }
}