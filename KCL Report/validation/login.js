const Validator = require('validator');
const isEmpty = require('./is-empty');

module.exports = function validateLoginInput(data) {
  let errors = {};

  // Sets the email as an empty string if it's null
  data.email = !isEmpty(data.email) ? data.email : '';
  // Sets the pass as an empty string if it's null
  data.password = !isEmpty(data.password) ? data.password : '';

  // Checks the email format
  if (!Validator.isEmail(data.email)) {
    errors.email = 'Email is invalid';
  }

  // Checks if the email was informed
  if (Validator.isEmpty(data.email)) {
    errors.email = 'Email field is required';
  }

  // Check if the password was informed
  if (Validator.isEmpty(data.password)) {
    errors.password = 'Password field is required';
  }

  // Return the validation status
  return {
    errors,
    isValid: isEmpty(errors)
  };
};
