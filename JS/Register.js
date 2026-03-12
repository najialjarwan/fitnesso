(function () {
    emailjs.init("p2l6m-hfvW8aiMcai");
})();

function sendWelcomeEmail(fullName, email) {
    const templateParams = {
        full_name: fullName,
        email: email,
    };

    emailjs.send('service_h97o1gb', 'template_wnp4etj', templateParams)
        .then(function (response) {
            console.log('Email sent:', response);
        }, function (error) {
            console.error('Failed to send email:', error);
        });
}

document.getElementById('welcomeForm').addEventListener('submit', function (event) {
    event.preventDefault();

    console.log("Form submission event listener triggered");

    const fullName = document.getElementById('fullName').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;

    const passwordError = document.getElementById('passwordError');
    if (password !== confirmPassword) {
        console.log("Passwords do not match");
        passwordError.style.display = 'block';
        return;
    } else {
        passwordError.style.display = 'none';
    }

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const emailError = document.getElementById('emailError');
    if (!emailPattern.test(email)) {
        console.log("Email format is incorrect");
        emailError.style.display = 'block';
        return;
    } else {
        emailError.style.display = 'none';
    }

    const formData = new FormData();
    formData.append('fullName', fullName);
    formData.append('email', email);
    formData.append('password', password);

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'connection.php', true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log("Registration successful!");
                createDynamicElement(fullName, email);
                sendWelcomeEmail(fullName, email);
            } else {
                console.error("Error:", xhr.responseText);
            }
        }
    };
    xhr.send(formData);
});

function createDynamicElement(fullName, email) {
    var successMessage = document.getElementById('successMessage');
    successMessage.innerHTML = `Registration Successful! an email has been sent to ${email}<br>Please fill in the below information.`;
    successMessage.style.display = 'block';
}

