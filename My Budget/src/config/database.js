const mongoose = require("mongoose");
mongoose.Promise = global.Promise;
module.exports = mongoose.connect("mongodb://user:pass@mongo.com:57574/db");

mongoose.Error.messages.general.required =
  "The attribute '{PATH}' must be filled.";
mongoose.Error.messages.Number.min = "The '{VALUE}' is smaller than '{MIN}'.";
mongoose.Error.messages.Number.max = "The '{VALUE}' is higher than '{MAX}'.";
mongoose.Error.messages.String.enum = "'{VALUE}' isn't valid for the '{PATH}'.";
