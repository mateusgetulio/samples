const express = require("express");
const router = express.Router();
const passport = require("passport");
const History = require("../../models/History");

History.meth;

/***
  Method: GET  
  Restricted: Yes 
  Returns: The history for that specific user authenticated with the token            
***/
router.get(
  "/",
  // Athenticates the token sent
  passport.authenticate("jwt", { session: false }),
  (req, res) => {
    // Finds the history based on the authenticated user
    History.find({ user: req.user.email })
      // Sort based on the date
      .sort({ date: -1 })
      // Returns the data found
      .then(history => res.json(history))
      // Error treatment
      .catch(err =>
        res.status(404).json({ errorMessage: "An error ocurred: " + err })
      );
  }
);


/*** 
  Method: GET
  Restricted: Yes
  Endpoint: year
  Parameter: year - The year that needs to be retrieved
  Returns: The user history for a specific year
***/
router.get(
  "/year/:year",
  // Athenticate the token sent
  passport.authenticate("jwt", { session: false }),
  (req, res) => {
    // Find the history based on the authenticated user
    History.find({
      user: req.user.email,
      date: new RegExp(req.params.year, "i")
    })
      // Sort based on the date
      .sort({ date: -1 })
      // Returns the data found
      .then(history => res.json(history))
      // Error treatment
      .catch(err =>
        res.status(404).json({ errorMessage: "An error ocurred: " + err })
      );
  }
);


/*** 
  Method: GET
  Restricted: Yes
  Endpoint: month
  Parameter: month - The month that needs to be retrieved
  Returns: The user history for a specific month
***/
router.get(
  "/month/:month",
  passport.authenticate("jwt", { session: false }),
  (req, res) => {
    // Find the history based on the authenticated user
    History.find({
      user: req.user.email,
      date: new RegExp(req.params.month, "i")
    })
      // Sort based on the date
      .sort({ date: -1 })
      // Returns the data found
      .then(history => res.json(history))
      // Error treatment
      .catch(err =>
        res.status(404).json({ errorMessage: "An error ocurred: " + err })
      );
  }
);


/*** 
  Method: GET
  Restricted: Yes
  Endpoint: years  
  Returns: The user history for a specific period of years
***/
router.get(
  "/years/",
  passport.authenticate("jwt", { session: false }),
  (req, res) => {
    // Find the history based on the authenticated user
    History.find({ user: req.user.email })
      // Sort based on the date
      .sort({ date: -1 })
      // Returns the data found
      .then(history => {
        let years = [];        
        history.forEach(el => {
          // Get the last 4 digits of the value as the year  
          let year = el.date.match(/[0-9]{4}/)[0];

          // Add the year to the list if it's not there yet
          if (years.indexOf(year) < 0) {
            years.push(year);
          }
        });
        // Parse to JSON
        res.json(years);
      })
      // Error treatment
      .catch(err =>
        res.status(404).json({ errorMessage: "An error ocurred: " + err })
      );
  }
);


/*** 
  Method: GET
  Restricted: Yes
  Endpoint: months  
  Returns: The user history for a specific period of months
***/
router.get(
  "/months/",
  passport.authenticate("jwt", { session: false }),
  (req, res) => {
    // Find the history based on the authenticated user
    History.find({ user: req.user.email })
      // Sort based on the date
      .sort({ date: -1 })
      // Returns the data found
      .then(history => {
        let months = [];

        history.forEach(el => {
          // Fetch the month
          let month = el.date.match(/([0-9]+)-([0-9]+)/)[0];

          // Add the month to the list if it's not there yet
          if (months.indexOf(month) < 0) {
            months.push(month);
          }
        });
        // Parse to JSON
        res.json(months);
      })
      // Error treatment
      .catch(err =>
        res.status(404).json({ errorMessage: "An error ocurred: " + err })
      );
  }
);


/*** 
  Method: GET
  Restricted: Yes  
  Parameter: date - The date that needs to be retrieved
  Returns: The user history for a specific date
***/
router.get("/:date", (req, res) => {
  // Find the history based on the authenticated user
  History.find({ date: req.params.date })
    // Returns the data found
    .then(history => res.json(history))
    // Error treatment
    .catch(err =>
      res.status(404).json({ errorMessage: "An error ocurred: " + err })
    );
});


/*** 
  Method: POST
  Restricted: Yes  
  Parameter: date - The date that needs to be updated
  Returns: The updated history
***/
router.post(
  "/:date",
  passport.authenticate("jwt", { session: false }),
  (req, res) => {
    // Find the history based on the authenticated user
    History.findOne({ date: req.params.date })
      // Returns the updated data
      .then(history => {
        history.totalCalories = req.body.totalCalories;

        let parsedFoods = [];

        // Fix quota incompatibilities
        parsedFoods = eval(req.body.foods.replace(/\"/g, "'"));

        // Prepares the data that needs to be updated
        parsedFoods.forEach(el => {
          history.foods.push({
            name: el.name,
            cal: el.cal,
            selected: el.selected
          });
        });

        // Save the data to the DB
        history.save()
        // Returns the updated data
        .then(history => res.json(history));
      })
      // Error treatment
      .catch(err =>
        res.status(404).json({ errorMessage: "No history found" + err })
      );
  }
);


/*** 
  Method: GET
  Restricted: Yes    
  Returns: The history that was saved
***/
router.post(
  "/",
  passport.authenticate("jwt", { session: false }),
  (req, res) => {
    let newHistory = new History({
      date: req.body.date,
      totalCalories: req.body.totalCalories,
      user: req.user.email
    });

    let parsedFoods = [];

    typeof req.body.foods == "string"
      // Fix quota incompatibilities
      ? (parsedFoods = eval(req.body.foods.replace(/\"/g, "'")))
      : (parsedFoods = req.body.foods);

    // Prepares the data that needs to be updated
    parsedFoods.forEach(el => {
      newHistory.foods.push({
        name: el.name,
        cal: el.cal,
        selected: el.selected
      });
    });

    // Save the data to the DB
    newHistory.save().
    // Returns the saved data
    then(history => res.json(history));
  }
);

module.exports = router;
