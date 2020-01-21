var http = require('http');
const express = require('express')
const httpProxy = require('express-http-proxy')
const app = express()
var cookieParser = require('cookie-parser');
var logger = require('morgan');
const helmet = require('helmet');
 
const auth = httpProxy('http://localhost:8000');
const productsServiceProxy = httpProxy('http://localhost:8000/api/produtos');
const orderServiceProxy = httpProxy('http://localhost:8002/api/pedidos');

const port = 3000;

// Proxy request
app.all('/api/auth', (req, res, next) => {
  userServiceProxy(req, res, next);
})
 
app.all('/api/produtos', (req, res, next) => {
  productsServiceProxy(req, res, next);
})

app.all('/api/pedidos', (req, res, next) => {
  orderServiceProxy(req, res, next);
})

app.use(logger('dev'));
app.use(helmet());
app.use(express.json());
app.use(express.urlencoded({ extended: false }));
app.use(cookieParser());
 
var server = http.createServer(app);
server.listen(port);
console.log('Escutando na porta: ' + port);
