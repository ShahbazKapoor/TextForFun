const form = document.querySelector(".login form"),
    signupBtn = form.querySelector(".button input"),
    errorText = document.querySelector(".error-txt");

form.onsubmit = (e) => {
    e.preventDefault(); // preventing from from submitting
}

signupBtn.onclick = () => {
    let xhr = new XMLHttpRequest(); // creating XML object
    xhr.open("POST", "php/login.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                if (data == "success") {
                    location.href = "users.php";
                } else {
                    errorText.textContent = data;
                    errorText.style.display = "block";
                }
            }
        }
    }
    // Sending form data through ajax to php
    let formData = new FormData(form); // creating new formData Object
    xhr.send(formData); // sending from data to php
}