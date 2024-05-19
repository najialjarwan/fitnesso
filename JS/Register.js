(function() {
    emailjs.init("p2l6m-hfvW8aiMcai");
})();

document.getElementById('welcomeForm').addEventListener('submit', function(event) {
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
        return; // Stop further execution
    } else {
        emailError.style.display = 'none';
        createDynamicElement(fullName, email); // Only call createDynamicElement if email is valid
    }

    const templateParams = {
        full_name: fullName,
        email: email,
    };

    emailjs.send('service_h97o1gb', 'template_wnp4etj', templateParams)
    .then(function(response) {
        console.log("Email sent successfully");

        const message = document.getElementById('message');
        message.textContent = `A welcome email has been sent to ${email}.`;
        message.style.color = 'green';
        message.style.display = 'block';

        const inputs = document.querySelectorAll('#welcomeForm input');
        inputs.forEach(function(input) {
            input.value = '';
            input.disabled = true;
        });

        document.querySelector('#welcomeForm button[type="submit"]').disabled = true;
    }, function(error) {
        console.log("Failed to send email:", error);

        const message = document.getElementById('message');
        message.textContent = `Failed to send email. Error: ${JSON.stringify(error)}`;
        message.style.color = 'red';
        message.style.display = 'block';
    });
});


function createDynamicElement(fullName, email) {
    // JavaScript code to add radio input and form dynamically after form submission
    var successMessage = document.getElementById('successMessage');
    successMessage.innerHTML = `A welcome email has been sent to ${email}.<br>Please fill in the below information.`;
    successMessage.style.display = 'block';

    var goalRadioDiv = document.createElement("div");
    goalRadioDiv.className = "goalRadioDiv"; // Add class for styling
    goalRadioDiv.innerHTML = "<label>Choose your goal:</label><br>" +
    "<input type='radio' id='loseWeight' name='goal' value='loseWeight' required>" +
    "<label for='loseWeight'>Lose Weight</label><br>" +
    "<input type='radio' id='gainWeight' name='goal' value='gainWeight' required>" +
    "<label for='gainWeight'>Gain Weight</label><br><br>";
    
    // Create form for additional information
    var additionalInfoForm = document.createElement("form");
    additionalInfoForm.id = "additionalInfoForm";
    additionalInfoForm.className = "additionalInfoForm"; // Add class for styling
    additionalInfoForm.innerHTML = "<label for='dynamicFullName'>Full Name:</label>" +
    "<input type='text' id='dynamicFullName' name='dynamicFullName' value='" + fullName + "' required><br><br>" + // Populate with initial full name
    "<label for='gender'>Gender:</label>" +
        "<select id='gender' name='gender' required>" +
        "<option value='male'>Male</option>" +
        "<option value='female'>Female</option>" +
        "</select><br><br>" +
        "<label for='age'>Age:</label>" +
        "<input type='number' id='age' name='age' required><br><br>" +
        "<label for='height'>Height (cm):</label>" +
        "<input type='number' id='height' name='height' required><br><br>" +
        "<label for='weight'>Weight (kg):</label>" +
        "<input type='number' id='weight' name='weight' required><br><br>" +
        "<label for='workoutType'>Type of Workout:</label>" +
        "<select id='workoutType' name='workoutType' required>" +
        "<option value='gym workout'>Gym Workout</option>" +
        "<option value='running'>Running</option>" +
        "<option value='jumping rope'>Jumping Rope</option>" +
        "<option value='calisthenics'>Calisthenics</option>" +
        "<option value='cycling'>Cycling</option>" +
        "</select><br><br>" +
        "<label for='workoutIntensity'>Workout Intensity:</label>" +
        "<select id='workoutIntensity' name='workoutIntensity' required>" +
        "<option value='1'>1 day/week</option>" +
        "<option value='2'>2 days/week</option>" +
        "<option value='3'>3 days/week</option>" +
        "<option value='4'>4 days/week</option>" +
        "<option value='5'>5 days/week</option>" +
        "<option value='6'>6 days/week</option>" +
        "<option value='7'>7 days/week</option>" +
        "</select><br><br>" +
        "<button id='calculateButton' type='submit'>Calculate Daily Calorie Intake</button>"; // Changed button text


    // Append radio input and form to a container div
    var dynamicElementsContainer = document.createElement("div");
    dynamicElementsContainer.id = "dynamicElementsContainer"; // Adding an ID for easy access
    dynamicElementsContainer.className = "dynamicElementsContainer"; // Add class for styling
    dynamicElementsContainer.appendChild(goalRadioDiv);
    dynamicElementsContainer.appendChild(additionalInfoForm);

    console.log("Dynamic element created");

    // Insert the container div after the existing form container
    var formContainer = document.getElementById("formContainer");
    formContainer.insertAdjacentElement("afterend", dynamicElementsContainer);

    console.log("Dynamic element appended to DOM");

    // Event listener to calculate and display form information
    additionalInfoForm.addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent form submission

        // Get additional information
        var fullName = document.getElementById("dynamicFullName").value;
        var gender = document.getElementById("gender").value;
        var age = parseInt(document.getElementById("age").value);
        var height = parseInt(document.getElementById("height").value);
        var weight = parseInt(document.getElementById("weight").value);
        var workoutType = document.getElementById("workoutType").value;
        var workoutIntensity = parseInt(document.getElementById("workoutIntensity").value); // Parsing as integer

        // Calculate daily calorie intake (simple example formula)
        var dailyCalorieIntake = 10 * weight + 6.25 * height - 5 * age + (gender === 'male' ? 5 : -161);
        dailyCalorieIntake *= (1.2 + (0.175 * workoutIntensity)); // Adjust based on workout intensity

        // Create table with headers for input values
        var table = "<h2>Form Information</h2>" +
            "<table border='1' class='infoTable'>" +
            "<tr><th>Information</th><th>Value</th></tr>" +
            "<tr><td>Full Name</td><td id='fullNameValue'>" + fullName + "</td></tr>" +
            "<tr><td>Gender</td><td id='genderValue'>" + gender + "</td></tr>" +
            "<tr><td>Age</td><td id='ageValue'>" + age + "</td></tr>" +
            "<tr><td>Height (cm)</td><td id='heightValue'>" + height + "</td></tr>" +
            "<tr><td>Weight (kg)</td><td id='weightValue'>" + weight + "</td></tr>" +
            "<tr><td>Type of Workout</td><td id='workoutTypeValue'>" + workoutType + "</td></tr>" +
            "<tr><td>Workout Intensity (days/week)</td><td id='workoutIntensityValue'>" + workoutIntensity + "</td></tr>" +
            "<tr><td>Daily Intake (calories/day)</td><td id='dailyIntakeValue'>" + Math.round(dailyCalorieIntake) + "</td></tr>" +
            "</table>";

        // Display table with headers
        var resultContainer = document.createElement("div");
        resultContainer.className = "resultContainer"; // Add class for styling
        resultContainer.innerHTML = table;
        dynamicElementsContainer.appendChild(resultContainer);

        // Disable form fields
        var inputs = additionalInfoForm.elements;
        for (var i = 0; i < inputs.length; i++) {
            inputs[i].disabled = true;
        }

        // Change button text
        document.getElementById("calculateButton").textContent = "Calculated"; // Changed button text

        // Change button functionality to recalculate
        document.getElementById("calculateButton").onclick = function() {
            // Enable form fields
            for (var i = 0; i < inputs.length; i++) {
                inputs[i].disabled = false;
            }
        };
    });
}

