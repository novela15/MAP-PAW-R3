const INPUT_BOXES = document.querySelectorAll(".input-container input");
const PASSWORD_BOXES = document.querySelectorAll('.input-container input[type="password"]');

const BUTTON = document.querySelector(".login-email, .signup-email");

// This function is made specifically for an assignment to display the input values in the same page
// This won't be used when the page is converted to MVC soon. Sanity checks will be in the server side.
BUTTON.addEventListener("click", function() {
    let empty_values = "";
    let filled_values = "";

    for (const INPUT of INPUT_BOXES) {
        if (INPUT.type !== "text" && INPUT.type !== "password" && INPUT.type !== "email") { continue }

        const TRIMMED = INPUT.value.trim();

        if (TRIMMED === "") {
            empty_values = `${empty_values}- ${INPUT.name}\n`;
        } else {
            filled_values = `${filled_values}- ${INPUT.name}: ${INPUT.value}\n`;
        }
    }

    if (empty_values !== "") {
        alert(`Empty fields detected:\n${empty_values}`);
        return;
    }

	for (const INPUT of PASSWORD_BOXES) {
        const TRIMMED = INPUT.value.trim();

	    if (TRIMMED === "" || TRIMMED !== PASSWORD_BOXES[0].value.trim()) {
            alert("Password and confirm password fields are empty or don't match.");
            return;
        }
	}

    alert(`Form submission success:\n${filled_values}`);
})
