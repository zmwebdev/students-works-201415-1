// form
// http://expressjs.com/4x/api.html#req.params

var express = require('express');
var app = express();


var sqlze = require('sequelize');
var mysql =  require('mysql');
// var db = new sqlze('databasename', 'username', 'password',{
var db = new sqlze('katez', 'root', 'unai',{
dialect: 'mysql',
port: 3306
});
//
db
.authenticate()
.complete(function(err){
if(!!err) {
console.log('Unable to connect to database: ', err);
} else {
console.log('Connection OK!');
}
});



// body-parser for POST
// https://github.com/expressjs/body-parser
var bodyParser = require('body-parser');
// parse application/x-www-form-urlencoded
app.use(bodyParser.urlencoded({ extended: false }));
// parse application/json
app.use(bodyParser.json());

// public files
app.use(express.static(__dirname + '/public'));


// **********************************************

app.get('/', function(req, res) {
    res.redirect('/index.html');
});





app.get('/partaideak', function(req, res) {
db.query('select * from argazkiak').success(function(rows){
// no errors
  console.log(rows);
  res.json(rows);
// res.json(JSON.stringify(rows));
});
});

app.get('/bideoak', function(req, res) {
db.query('select * from bideoak').success(function(rows){
// no errors
  console.log(rows);
  res.json(rows);
// res.json(JSON.stringify(rows));
});
});




var server = app.listen(process.env.PORT || 3000, function(){
    console.log('Listening in port %d', server.address().port);
});


  //connection.end(function(err){
//Cerramos la conexion con nuestro mysql.
//});

