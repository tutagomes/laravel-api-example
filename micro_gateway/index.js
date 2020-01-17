var http = require('http');
const express = require('express')
const httpProxy = require('express-http-proxy')
const app = express()
var cookieParser = require('cookie-parser');
var logger = require('morgan');
const helmet = require('helmet');
 
const auth = httpProxy('http://localhost:3001');
const productsServiceProxy = httpProxy('http://localhost:3002');

const port = 3000;

// Proxy request
app.get('/auth', (req, res, next) => {
  userServiceProxy(req, res, next);
})
 
app.get('/produtos', (req, res, next) => {
  productsServiceProxy(req, res, next);
})

app.get
app.use(logger('dev'));
app.use(helmet());
app.use(express.json());
app.use(express.urlencoded({ extended: false }));
app.use(cookieParser());
 
var server = http.createServer(app);
server.listen(port);
console.log('Escutando na porta: ' + port);
