var express = require('express');
var morgan = require('morgan');
var path = require('path');

var app = express();
app.use(morgan('combined'));

app.get('/ui/', function (req, res) {
  res.sendFile(path.join(__dirname, 'ui', 'ggpp1.html'));
});
app.get('/article1', function (req, res) {
  res.sendFile(path.join(__dirname, 'article1.html'));
});
app.get('/butter.html', function (req, res) {
  res.sendFile(path.join(__dirname, 'butter.html'));
});

app.get('/aboutme.html', function (req, res) {
  res.sendFile(path.join(__dirname, 'aboutme.html'));
});

app.get('/jam.html', function (req, res) {
  res.sendFile(path.join(__dirname, 'jam.html'));
});
app.get('/ui/style.css', function (req, res) {
  res.sendFile(path.join(__dirname, 'ui', 'style.css'));
});

app.get('/ui/madi.png', function (req, res) {
  res.sendFile(path.join(__dirname, 'ui', 'madi.png'));
});


var port = 8080; // Use 8080 for local development because you might already have apache running on 80
app.listen(8080, function () {
  console.log(`IMAD course app listening on port ${port}!`);
});
