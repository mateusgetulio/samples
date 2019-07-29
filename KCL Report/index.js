const express = require("express");
const bodyParser = require("body-parser");
const mongoose = require("mongoose");
const db = require("./config/keys.js").mongoURI;
const allowCors = require("./config/cors");

const passport = require("passport");
const path = require("path");

const history = require("./routes/api/history");
const user = require("./routes/api/user");

const port = process.env.PORT || 5000;

const app = express();

app.use(allowCors);
app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());

app.use(passport.initialize());
require("./config/passport")(passport);

app.get("/", (req, res) => res.send("ok"));
app.use("/api/user", user);
app.use("/api/history", history);

app.listen(port, () => console.log(`Server running on ${port} port`));

mongoose
  .connect(db, { useNewUrlParser: true })
  .then(() => console.log("Mongo db connected!"))
  .catch(err => console.log(err));
