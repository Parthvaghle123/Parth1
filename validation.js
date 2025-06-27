document.addEventListener("DOMContentLoaded", function () {
    document.querySelector("form").addEventListener("submit", function (event) {
      let isValid = true;
  
      // Get input values
      let username = document.getElementById("username").value.trim();
      let email = document.getElementById("email").value.trim();
      let password = document.getElementById("password").value.trim();
      let confirmPassword = document.getElementById("confirmPassword").value.trim();
      let address = document.getElementById("address").value.trim();
      let checkBox = document.getElementById("myCheck");
  
      // Clear previous error messages
      document.querySelectorAll(".error").forEach(e => e.remove());
  
      // Validation checks
      if (username === "") {
        showError("UserName is required", "username");
        isValid = false;
      }
  
      if (!validateEmail(email)) {
        showError("Invalid email format", "email");
        isValid = false;
      }
  
      if (!validatePassword(password)) {
        showError("Password must be at least 6 characters, include an uppercase letter, a lowercase letter, and a number", "password");
        isValid = false;
      }
  
      if (password !== confirmPassword) {
        showError("Passwords do not match", "confirmPassword");
        isValid = false;
      }
  
      if (address === "") {
        showError("Address is required", "address");
        isValid = false;
      }
  
      if (!checkBox.checked) {
        showError("You must agree to the terms", "myCheck", true);
        isValid = false;
      }
  
      if (!isValid) {
        event.preventDefault();
      }
    });
  
    function showError(message, elementId, isCheckbox = false) {
      let inputField = document.getElementById(elementId);
      let errorDiv = document.createElement("div");
      errorDiv.textContent = message;
      errorDiv.classList.add("error");
      errorDiv.style.color = "red";
      errorDiv.style.fontSize = "14px";
      errorDiv.style.marginTop = "5px";
  
      if (isCheckbox) {
        inputField.parentNode.appendChild(errorDiv);
      } else {
        inputField.insertAdjacentElement("afterend", errorDiv);
      }
    }
  
    function validateEmail(email) {
      let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return emailPattern.test(email);
    }
  
    function validatePassword(password) {
      let passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/;
      return passwordPattern.test(password);
    }
  });
  