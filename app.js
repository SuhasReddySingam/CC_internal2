const express = require("express");
const bodyParser = require("body-parser");

const app = express();
const port = process.env.PORT || 3000;

// store notes in memory
let notes = [];

app.set("view engine", "ejs");
app.use(bodyParser.urlencoded({ extended: true }));

// home page
app.get("/", (req, res) => {
  res.render("index", { notes });
});

// add note
app.post("/add", (req, res) => {
  const note = req.body.note;
  if (note) {
    notes.push(note);
  }
  res.redirect("/");
});

// delete note
app.post("/delete", (req, res) => {
  const index = req.body.index;
  notes.splice(index, 1);
  res.redirect("/");
});

app.listen(port, () => {
  console.log(`Server running on port ${port}`);
});
