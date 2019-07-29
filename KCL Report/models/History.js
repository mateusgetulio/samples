const mongoose = require("mongoose");
const Schema = mongoose.Schema;

const HistorySchema = new Schema({
  date: { type: String, required: true },
  user: { type: String, required: true },
  totalCalories: { type: Number, required: true },
  foods: [
    {
      name: { type: String },
      cal: { type: Number },
      selected: { type: Number }
    }
  ]
});

module.exports = History = mongoose.model("histories", HistorySchema);
