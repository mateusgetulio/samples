const express = require("express");
const router = express.Router();
const passport = require("passport");

const History = require("../../models/History");

History.meth;

router.get(
  "/",
  passport.authenticate("jwt", { session: false }),
  (req, res) => {
    History.find({ user: req.user.email })
      .sort({ date: -1 })
      .then(history => res.json(history))
      .catch(err =>
        res.status(404).json({ errorMessage: "An error ocurred: " + err })
      );
  }
);

router.get(
  "/year/:year",
  passport.authenticate("jwt", { session: false }),
  (req, res) => {
    History.find({
      user: req.user.email,
      date: new RegExp(req.params.year, "i")
    })
      .sort({ date: -1 })
      .then(history => res.json(history))
      .catch(err =>
        res.status(404).json({ errorMessage: "An error ocurred: " + err })
      );
  }
);

router.get(
  "/month/:month",
  passport.authenticate("jwt", { session: false }),
  (req, res) => {
    History.find({
      user: req.user.email,
      date: new RegExp(req.params.month, "i")
    })
      .sort({ date: -1 })
      .then(history => res.json(history))
      .catch(err =>
        res.status(404).json({ errorMessage: "An error ocurred: " + err })
      );
  }
);

router.get(
  "/years/",
  passport.authenticate("jwt", { session: false }),
  (req, res) => {
    History.find({ user: req.user.email })
      .sort({ date: -1 })
      .then(history => {
        let years = [];

        history.forEach(el => {
          let year = el.date.match(/[0-9]{4}/)[0];

          if (years.indexOf(year) < 0) {
            years.push(year);
          }
        });
        res.json(years);
      })
      .catch(err =>
        res.status(404).json({ errorMessage: "An error ocurred: " + err })
      );
  }
);

router.get(
  "/months/",
  passport.authenticate("jwt", { session: false }),
  (req, res) => {
    History.find({ user: req.user.email })
      .sort({ date: -1 })
      .then(history => {
        let months = [];

        history.forEach(el => {
          let month = el.date.match(/([0-9]+)-([0-9]+)/)[0];

          if (months.indexOf(month) < 0) {
            months.push(month);
          }
        });
        res.json(months);
      })
      .catch(err =>
        res.status(404).json({ errorMessage: "An error ocurred: " + err })
      );
  }
);

router.get("/:date", (req, res) => {
  History.find({ date: req.params.date })
    .then(history => res.json(history))
    .catch(err =>
      res.status(404).json({ errorMessage: "An error ocurred: " + err })
    );
});

router.post(
  "/:date",
  passport.authenticate("jwt", { session: false }),
  (req, res) => {
    History.findOne({ date: req.params.date })
      .then(history => {
        history.totalCalories = req.body.totalCalories;

        let parsedFoods = [];

        parsedFoods = eval(req.body.foods.replace(/\"/g, "'"));

        parsedFoods.forEach(el => {
          history.foods.push({
            name: el.name,
            cal: el.cal,
            selected: el.selected
          });
        });

        history.save().then(history => res.json(history));
      })
      .catch(err =>
        res.status(404).json({ errorMessage: "No history found" + err })
      );
  }
);

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
      ? (parsedFoods = eval(req.body.foods.replace(/\"/g, "'")))
      : (parsedFoods = req.body.foods);

    parsedFoods.forEach(el => {
      newHistory.foods.push({
        name: el.name,
        cal: el.cal,
        selected: el.selected
      });
    });

    newHistory.save().then(history => res.json(history));
  }
);

module.exports = router;
