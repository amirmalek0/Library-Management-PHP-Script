function openForm() {
    document.getElementById("ls-modal").style.display = "block";
}
function closeForm(){
    document.getElementById("ls-modal").style.display = "none";
}
function goToSignUp(){
    document.getElementById("login-inputs").style.display="none";
    document.getElementById("signup-inputs").style.display="block"
    document.getElementById("ls-modal").style.paddingTop = "15px";
}
function goToLogin(){
    document.getElementById("signup-inputs").style.display="none";
    document.getElementById("login-inputs").style.display="block";
}
function closeAddTicket(){
    document.getElementById("closeAddTicket").style.display = "none";
}

function closeReplyOk(){
    document.getElementById("closeReplyOk").style.display = "none";

}
function closeEditProfile(){
    document.getElementById("closeEditProfile").style.display = "none";

}
function newPassword(){
    document.getElementById("new-password").style.display = "block";
    document.getElementById("new-password").disabled = false;

    document.getElementById("new-password-label").style.display="block";
    document.getElementById("cancel-change-password").style.display="block";
    document.getElementById("change-password").style.display="none";
}
function CancelNewPassword(){
    document.getElementById("new-password").style.display = "none";
    document.getElementById("new-password").disabled =true;
    document.getElementById("new-password-label").style.display="none";
    document.getElementById("cancel-change-password").style.display="none";
    document.getElementById("change-password").style.display="block";



}
function ShowPassLogin() {
    let input_type = document.getElementById("login-password").type
    if (input_type === "password") {
        document.getElementById("login-password").type = "text";
        document.getElementById("show-password").innerHTML = " مخفی &#128065; ";

    } else if (input_type === "text") {
        document.getElementById("login-password").type = "password"
        document.getElementById("show-password").innerHTML = " نمایش &#128065; ";

    }
}
function ShowPassSignup() {
    let input_type = document.getElementById("signup-password").type
    if (input_type === "password") {
        document.getElementById("signup-password").type = "text";
        document.getElementById("show-password-signup").innerHTML = " مخفی &#128065; ";

    } else if (input_type === "text") {
        document.getElementById("signup-password").type = "password"
        document.getElementById("show-password-signup").innerHTML = " نمایش &#128065; ";

    }
}
let pass = document.getElementById("signup-password");
pass.addEventListener("keyup", CheckPass)
function CheckPass() {
    let bar = document.getElementById("bar");
    let password = document.getElementById("signup-password").value
    let hint = document.getElementById("hint")
    let submitButton = document.getElementById('signup-button')
    if (password.length < 8) {
        hint.innerHTML = "پسورد باید حداقل 8 کاراکتر باشد 😶"
        bar.value = 25;
        bar.style.accentColor = "#ff3e36"
        submitButton.disabled = true;

    } else if (password.length > 8) {
        hint.innerHTML = ""
        let strength = 0
        if (password.match(/[a-z]/)) {
            strength += 1
        }
        if (password.match(/[A-Z]/)) {
            strength += 1
        }
        if (password.match(/[0-9]/)) {
            strength += 1
        }
        if (password.match(/[$@#&!]/)) {
            strength += 1
        }

        switch (strength) {
            case 0:
                bar.value = 0
                break

            case 1:
                bar.value = 25
                bar.style.accentColor = "#ff3e36"
                hint.innerHTML = "پسورد ضعیف 😡 "
                submitButton.disabled = true
                break

            case 2:
                bar.value = 50
                bar.style.accentColor = "#e0540e"
                hint.innerHTML = "پسورد قابل قبول 🫤"
                submitButton.disabled = false
                break

            case 3:
                bar.value = 75
                bar.style.accentColor = "#93841e"
                hint.innerHTML = "پسورد خوب 🤓"
                submitButton.disabled = false
                break

            case 4:
                bar.value = 100
                bar.style.accentColor = "#0f7f4b"
                hint.innerHTML = "پسورد عالی 🫡"
                submitButton.disabled = false

                break
        }
    }
}