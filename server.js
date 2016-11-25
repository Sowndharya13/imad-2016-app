var express = require('express');
var morgan = require('morgan');
var path = require('path');
var Pool = require('pg').Pool;

var config={
    user: 'sowndharya13',
    database: 'sowndharya13',
    host: 'db.imad.hasura-app.io',
    port: '5432',
    password: process.env.DB_PASSWORD
};

var app = express();
app.use(morgan('combined'));

  

app.get('/', function (req, res) {
  res.sendFile(path.join(__dirname, 'ui', 'ggpp1.html'));
});
app.get('/ui/page.min.css', function (req, res) {
  res.sendFile(path.join(__dirname, 'ui', 'page.min.css'));
});
app.get('/ui/style.css', function (req, res) {
  res.sendFile(path.join(__dirname, 'ui', 'style.css'));
});
app.get('/ui/agency.css', function (req, res) {
  res.sendFile(path.join(__dirname, 'ui', 'agency.css'));
});
app.get('/ui/logindubba.css', function (req, res) {
  res.sendFile(path.join(__dirname, 'ui', 'logindubba.css'));
});
app.get('/ui/healthtips.html', function (req, res) {
  res.sendFile(path.join(__dirname, 'ui','healthtips.html'));
});
app.get('/ui/hlttip1.html', function (req, res) {
  res.sendFile(path.join(__dirname, 'ui','hlttip1.html'));
});
app.get('/ui/hlttip2.html', function (req, res) {
  res.sendFile(path.join(__dirname, 'ui','hlttip2.html'));
});

app.get('/diet.html', function (req, res) {
  res.sendFile(path.join(__dirname, 'diet.html'));
});


app.get('/diet.jpg', function (req, res) {
  res.sendFile(path.join(__dirname, 'diet.jpg'));
});

app.get('/9.jpg', function (req, res) {
  res.sendFile(path.join(__dirname, '9.jpg'));
});
app.get('/1.jpg', function (req, res) {
  res.sendFile(path.join(__dirname, '1.jpg'));
});
app.get('/3.jpg', function (req, res) {
  res.sendFile(path.join(__dirname, '3.jpg'));
});
app.get('/7.jpg', function (req, res) {
  res.sendFile(path.join(__dirname, '7.jpg'));
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

var pool= new Pool(config);
app.get('/test-db', function (req,res)){
    pool.query('SELECT * FROM test', function(err,result)){
        if(err){
            res.status(500).send(err.toString());
               }
        else{
            res.send(JSON.stringify(result));
            }
        }
    }


var port = 8080; // Use 8080 for local development because you might already have apache running on 80
app.listen(8080, function () {
  console.log(`IMAD course app listening on port ${port}!`);
});
