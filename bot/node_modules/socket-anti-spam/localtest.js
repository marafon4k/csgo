// This is the test file for socket-anti-spam. Goto 127.0.0.1 and run this to see it live!

// Everyone has this line already when using socket-anti-spam
var io = require('socket.io').listen(8080, {
  log: false,
})

// This is just for the index.html
var static = require('node-static')
var http = require('http')
var file = new static.Server('./public')

// Actually needed for antispam
var antiSpam = require('./antispam')
antiSpam.init({
  banTime: 1,            // Ban time in minutes
  kickThreshold: 7,       // User gets kicked after this many spam score
  kickTimesBeforeBan: 3,  // User gets banned after this many kicks
  banning: true,          // Uses temp IP banning after kickTimesBeforeBan
  heartBeatStale: 40,     // Removes a heartbeat after this many seconds
  heartBeatCheck: 4,      // Checks a heartbeat per this many seconds
  io: io,                  // Bind the socketio variable
})

// Lets create server for index.html
http.createServer(function(req, res) {
  file.serve(req, res)
}).listen(80)

 // Everyone has this line already when using socket-anti-spam
io.sockets.on('connection', function(socket) {
  console.log(antiSpam.getBans())
  socket.join("kappa")
  io.sockets.in("kappa").emit('roomer_msg', {kappa:"kappa"})
  io.sockets.in("kappa").emit('roomer_msg', {kappa:"kappa"})
  io.sockets.in("kappa").emit('roomer_msg', {kappa:"kappa"})
  io.sockets.in("kappa").emit('roomer_msg', {kappa:"kappa"})
  io.sockets.in("kappa").emit('roomer_msg', {kappa:"kappa"})
  io.sockets.in("kappa").emit('roomer_msg', {kappa:"kappa"})
  io.sockets.in("kappa").emit('roomer_msg', {kappa:"kappa"})
  io.sockets.in("kappa").emit('roomer_msg', {kappa:"kappa"})
  io.sockets.in("kappa").emit('roomer_msg', {kappa:"kappa"})
   // Extra socket function for testing purposes so we can spam something :3
  socket.on("spamming", function() {
      socket.emit("spamscore",null)
  })
})
