const Validator = require("validator");
const isEmpty = require("./is-empty");

module.exports = function validateRegisterInput(data) {
  let errors = {};

  // Sets the name as an empty string if it's null
  data.name = !isEmpty(data.name) ? data.name : "";
  // Sets the email as an empty string if it's null
  data.email = !isEmpty(data.email) ? data.email : "";
  // Sets the password as an empty string if it's null
  data.password = !isEmpty(data.password) ? data.password : "";
  // Sets the password confirmation as an empty string if it's null
  data.password2 = !isEmpty(data.password2) ? data.password2 : "";

  // Checks if the name length
  if (!Validator.isLength(data.name, { min: 2, max: 30 })) {
    errors.name = "Name must be between 2 and 30 characters";
  }

  // Checks if the name was informed
  if (Validator.isEmpty(data.name)) {
    errors.name = "Name field is required";
  }

  // Checks if the email was informed
  if (Validator.isEmpty(data.email)) {
    errors.email = "Email field is required";
  }

  // Checks if the email format
  if (!Validator.isEmail(data.email)) {
    errors.email = "Email is invalid";
  }

  // Checks if the password was informed
  if (Validator.isEmpty(data.password)) {
    errors.password = "Password field is required";
  }

  // Checks the password length
  if (!Validator.isLength(data.password, { min: 6, max: 30 })) {
    errors.password = "Password must be at least 6 characters";
  }

  // Checks if the password confirmation was informed
  if (Validator.isEmpty(data.password2)) {
    errors.password2 = "Confirm Password field is required";
  }

  // Checks if the passwords match
  if (!Validator.equals(data.password, data.password2)) {
    errors.password2 = "Passwords must match";
  }

  // Return the validation status
  return {
    errors,
    isValid: isEmpty(errors)
  };
};
