// Imports
const express = require("express");
const bodyParser = require("body-parser");
const mongoose = require("mongoose");
const db = require("./config/keys.js").mongoURI;
const allowCors = require("./config/cors");
const passport = require("passport");
const path = require("path");
const history = require("./routes/api/history");
const user = require("./routes/api/user");

// Running on port 5000
const port = process.env.PORT || 5000;
// Initialize express
const app = express();

// Allow corts
app.use(allowCors);
// Apply body parser
app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());

// Initialize the passport
app.use(passport.initialize());
require("./config/passport")(passport);

// Register the routers based on its component
app.use("/api/user", user);
app.use("/api/history", history);

// Send a message to the terminal stating the server is connected
app.listen(port, () => console.log(`Server running on ${port} port`));

// Connect to the DB
mongoose
  .connect(db, { useNewUrlParser: true })
  .then(() => console.log("Mongo db connected!"))
  .catch(err => console.log(err));
