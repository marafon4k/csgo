'use strict'

var assert = require('assert')
var assert = require('assert-plus')
var clientIo = require('socket.io-client')
var io = require('socket.io').listen(3000, { log: false })
var antiSpam = require('../antispam')

var passed = false
var passedBan = false
var disconnected = false
var times = 0
var clientSocket = clientIo.connect('http://127.0.0.1:3000', {
  forceNew: true,
})

antiSpam.init({
  banTime:            30,     // Ban time in minutes
  kickThreshold:      1,      // User gets kicked after this many spam score
  kickTimesBeforeBan: 1,      // User gets banned after this many kicks
  banning:            true,   // Uses temp IP banning after kickTimesBeforeBan
  heartBeatStale:     40,     // Removes a heartbeat after this many seconds
  heartBeatCheck:     0.1,    // Checks a heartbeat per this many seconds
  io:                 io,     // Bind the socketio variable
})


var authenticateEventWorks = false
antiSpam.event.on('authenticate', function() {
  authenticateEventWorks = true
})

var spamscoreEventWorks = false
antiSpam.event.on('spamscore', function() {
  spamscoreEventWorks = true
})

var kickEventWorks = false
antiSpam.event.on('kick', function() {
  kickEventWorks = true
})

var banEventWorks = false
antiSpam.event.on('ban', function(a,b,c) {
  banEventWorks = true
})

var ip = '::ffff:127.0.0.1'
if (process.version.indexOf('v0.10') > -1)
  ip = '127.0.0.1'

function repeat() {
  if (disconnected) {
    times++
    if (times >= 4) {
      disconnected = true
      return
    }

    clientSocket = clientIo.connect('http://127.0.0.1:3000', {
      forceNew: true,
    })

    clientSocket.on('connect', function() {
      disconnected = false
    })

    clientSocket.on('reconnect', function() {
      disconnected = false
    })

    clientSocket.on('disconnect', function() {
      disconnected = true
    })

    disconnected = false
    return
  }

  clientSocket.emit('spamming', { some: 'data' })
  setTimeout(function() { repeat() }, 250)
}

clientSocket.on('connect', function() {
  disconnected = false
})

clientSocket.on('reconnect', function() {
  disconnected = false
})

clientSocket.on('disconnect', function() {
  disconnected = true
})

var canSpam = false
io.sockets.on('connection', function(socket) {
  socket.on('spamming', function() {
    if (canSpam)
      socket.emit('spamscore', null)
  })
})



describe('Ban system', function() {
  this.timeout(10000)
  it('Wait 2000ms for lastInteract', function(done) {
    setTimeout(function(done) {
      console.log(antiSpam.getBans())
      done()
    }, 2000, done)
  })

  it('Connect to the webserver, spam socket.emits and get disconnect/kicked', function(done) {
    canSpam = true
    var spammerino = setInterval(function() {
      repeat()
      if (!disconnected)
        return
      clearInterval(spammerino)
      done()
    }, 1)
  })

  it('Get Banned', function(done) {
    var spammerino = setInterval(function() {
      repeat()
      if (!disconnected)
        return
      clearInterval(spammerino)
      done()
    }, 1)
  })

  it('Confirm ban', function() {
    assert.equal(antiSpam.getBans()[0].ip, ip)
  })

  it('unBan ip', function() {
    antiSpam.unBan(ip)
    assert.equal(antiSpam.getBans().length, 0)
  })

  it('ban ip', function() {
    antiSpam.ban(ip)
    assert.equal(antiSpam.getBans()[0].ip, ip)
  })

  it('ban ip for 1 ms', function() {
    antiSpam.unBan(ip)
    antiSpam.ban(ip, 0.000000001)
    assert.equal(antiSpam.getBans()[0].ip, ip)
  })
})

describe('Heartbeat', function() {
  this.timeout(10000)
  it('Wait 100ms for heartbeat', function(done) {
    setTimeout(function(done) {
      done()
    }, 100, done)
  })
})

describe('Init function', function() {
  this.timeout(10000)
  it('Call init', function() {
    antiSpam.init({
      banTime: 30,            // Ban time in minutes
      kickThreshold: 2,       // User gets kicked after this many spam score
      kickTimesBeforeBan: 1,  // User gets banned after this many kicks
      banning: true,          // Uses temp IP banning after kickTimesBeforeBan
      heartBeatStale: 40,     // Removes a heartbeat after this many seconds
      heartBeatCheck: 4,      // Checks a heartbeat per this many seconds
      io: io,                  // Bind the socketio variable
    })
  })

  it('Call init with only banTime', function() {
    antiSpam.init({
      banTime: 30,            // Ban time in minutes
    })
  })

  it('Call init with only kickThreshold', function() {
    antiSpam.init({
      kickThreshold: 2,       // User gets kicked after this many spam score
    })
  })

  it('Call init with only kickTimesBeforeBan', function() {
    antiSpam.init({
      kickTimesBeforeBan: 1,   // User gets banned after this many kicks
    })
  })
})

describe('Events', function() {
  it('Authenticate', function() {
    assert.equal(authenticateEventWorks, true)
  })

  it('Ban', function() {
    assert.equal(banEventWorks, true)
  })

  it('Kick', function() {
    assert.equal(kickEventWorks, true)
  })

  it('Spamscore', function() {
    assert.equal(spamscoreEventWorks, true)
  })
})

describe('Error Handling', function() {
  this.timeout(10000)
  it('Call authentication without a socket', function() {
    assert.throws(function() {
      antiSpam.authenticate('test')
    }, Error)
  })

  it('Call ban without options', function() {
    assert.throws(function() {
      antiSpam.ban()
    }, Error)
  })

  it('Call unban without options', function() {
    assert.throws(function() {
      antiSpam.unBan()
    }, Error)
  })

  it('Call addSpam without a socket variable', function() {
    assert.throws(function() {
      antiSpam.addSpam()
    }, Error)
  })

  it('Call ban with a non existing ip', function() {
    assert.equal(antiSpam.ban({
      ip: 'kappa',
    }), false)
  })

  it('Call unban with a non existing ip', function() {
    assert.equal(antiSpam.unBan({
      ip: 'kappa',
    }), false)
  })

})
