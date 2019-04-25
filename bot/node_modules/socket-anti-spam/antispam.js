'use strict'

var moment = require('moment')
var events = require('events')
var eventEmitter = new events.EventEmitter()

var not = function(val) {
  return (val == null || val === false || val == undefined)
}

var defaultOptions = {
  banTime: 60,
  kickThreshold: 10,
  kickTimesBeforeBan: 3,
  banning: true,
  heartBeatStale: 40,
  heartBeatCheck: 4,
}
var options = defaultOptions
var users = {}
var heartbeats = {}

exports.init = function(sets) {
  if (not(sets.banTime))
    sets.banTime = defaultOptions.banTime
  if (not(sets.kickThreshold))
    sets.kickThreshold = defaultOptions.kickThreshold
  if (not(sets.kickTimesBeforeBan))
    sets.kickTimesBeforeBan = defaultOptions.kickTimesBeforeBan
  if (not(sets.banning))
    sets.banning = defaultOptions.banning
  if (not(sets.heartBeatStale))
    sets.heartBeatStale = defaultOptions.heartBeatStale
  if (not(sets.heartBeatCheck))
    sets.heartBeatCheck = defaultOptions.heartBeatCheck
  if (sets.io) {
    sets.io.on('connection', function(socket) {
      var emit = socket.emit
      socket.emit = function() {
        if (!socket.banned) {
          exports.addSpam(socket)
          emit.apply(socket, arguments)
        }
      }
      authenticate(socket)

      socket.on('disconnect', function() {
        clearHeart(socket)
      })

      socket.on('error', function(err) {
        console.error(err)
      })
    })
  }

  options = sets
}

exports.addSpam = function(socket) {
  if (not(socket))
    throw new Error('socket variable is not defined')
  authenticate(socket, function(data) {
    if (data.banned)
      return

    var lastInteraction = moment.duration(moment().diff(data.lastInteraction)).asSeconds()
    data.lastInteraction = moment()

    if (lastInteraction < 1)
      data.score++
    if (lastInteraction >= 1) {
      var newScore = data.score - Math.round(lastInteraction)
      data.score = newScore
      if (newScore <= 0)
        data.score = 0
    }

    var lastLowerKick = moment.duration(moment().diff(data.lastLowerKick)).asSeconds()
    if (lastLowerKick >= 1800 && data.kickCount >= 1) {
      data.lastLowerKick = moment()
      data.kickCount--
    }

    eventEmitter.emit('spamscore', socket, data)
    if (data.score >= options.kickThreshold) {
      eventEmitter.emit('kick', socket, data)
      data.score = 0
      data.kickCount = data.kickCount + 1
      if (data.kickCount >= options.kickTimesBeforeBan && options.banning) {
        eventEmitter.emit('ban', socket, data)
        clearHeart(socket)
        data.kickCount = 0
        data.banned = true
        data.lastLowerKick = moment()
        data.bannedUntil = moment().add(options.banTime, 'minutes')
      }

      socket.disconnect()
    }
  })
}

function clearHeart(socket) {
  if (!heartbeats[socket.id])
    return
  clearInterval(heartbeats[socket.id].interval)
}

function addHeart(socket) {
  if (heartbeats[socket.id])
    return
  clearHeart(socket)
  heartbeats[socket.id] = {
    interval: setInterval(checkHeart, options.heartBeatCheck * 1000, socket),
  }
}

function checkHeart(socket) {
  if (!heartbeats[socket.id])
    return (clearHeart(socket))
  var startedSince = Math.round(heartbeats[socket.id].interval._idleStart / 1000)
  if (startedSince >= options.heartBeatStale)
    clearHeart(socket)
  authenticate(socket)
}

function authenticate(socket, cb) {
  if (not(socket.ip))
    socket.ip = socket.client.request.headers['x-forwarded-for'] || socket.client.conn.remoteAddress

  eventEmitter.emit('authenticate', socket)
  if (typeof(users[socket.ip]) == 'undefined') {
    users[socket.ip] = {
      score:           0,
      banned:          false,
      kickCount:       0,
      bannedUntil:     0,
      lastInteraction: moment(),
      lastLowerKick:   moment(),
    }
  }

  var data = users[socket.ip]
  if (data.banned) {
    data.banned = false
    if (heartbeats[socket.id])
      clearHeart(socket)
    if (data.bannedUntil.diff(moment(), 'seconds') >= 1) {
      data.banned = true
      socket.banned = true
      socket.disconnect()
    }
  }

  addHeart(socket)
  if (cb)
    cb(data)
}

exports.ban = function(data, min) {
  if (not(data))
    throw new Error('No options defined')
  if (not(min))
    min = options.banTime
  var ip = false
  if (typeof(users[data]) !='undefined')
    ip = data
  if (typeof(users[data.ip]) != 'undefined')
    ip = data.ip
  if (ip)
    return ban(true, ip)
  return false
}

exports.unBan = function(data) {
  if (not(data))
    throw new Error('No options defined')
  var ip = false
  if (typeof(users[data])!='undefined')
    ip = data
  if (typeof(users[data.ip])!='undefined')
    ip = data.ip
  if (ip) return ban(false, ip)
  return false
}

function ban(ban, data, min) {
  users[data].kickCount = 0
  users[data].score = 0
  if (ban) {
    users[data].banned = true
    users[data].lastLowerKick = moment()
    users[data].bannedUntil = moment().add(min, 'minutes')
  } else {
    users[data].banned = false
    users[data].lastLowerKick = moment()
    users[data].bannedUntil = 0
  }

  return true
}

exports.getBans = function() {
  var banned = []
  var user
  for (user in users) {
    if (users[user].banned)
      banned.push({
        ip:    user,
        until: users[user].bannedUntil,
      })
  }

  return banned
}


exports.event = eventEmitter
exports.antiSpam = exports
