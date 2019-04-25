var mysql = require('mysql');
var log4js = require('log4js');
var io = require('socket.io')(8000);
var request = require('request');
var fs = require('fs');
var md5 = require('md5');
var sha256 = require('sha256');
var math = require('mathjs');
var antiSpam = require('socket-anti-spam');
var seedrandom = require('seedrandom');
var crypto = require('crypto');

//BITSKINS
var totp = require('notp').totp;
var base32 = require('thirty-two');

var API_KEYBIT = 'hereapikey';
var bit_code = totp.gen(base32.decode('bitcodehere'));

log4js.configure({
	appenders: [
		{ type: 'console' },
		{ type: 'file', filename: 'logs/site.log' }
	]
});
var logger = log4js.getLogger();

var database_params = {
	database: 'csgolobbyrur',
	host: 'localhost',
	user: 'root',
	password: 'pass'
}

var pool  = mysql.createPool({
	connectionLimit : 10,
	database:database_params.database,
	host: database_params.host,
	user: database_params.user,
	password: database_params.password
});

/*var pool  = mysql.createPool({
	connectionLimit : 10,
	database: 'csgolobbyrur',
	host: 'localhost',
	user: 'root',
	password: 'pass'
});*/

process.on('uncaughtException', function (err) {
 logger.trace('Какая-то странная ошибка');
 logger.debug(err);
});

antiSpam.init({
    banTime: 30,            // Ban time in minutes 
    kickThreshold: 50,      // User gets kicked after this many spam score 
    kickTimesBeforeBan: 3,  // User gets banned after this many kicks 
    banning: true,          // Uses temp IP banning after kickTimesBeforeBan 
    heartBeatStale: 10,     // Removes a heartbeat after this many seconds 
    heartBeatCheck: 4,      // Checks a heartbeat per this many seconds 
    io: io,                 // Bind the socket.io variable 
});

/* */

var amounter = 100000; // Чтобы передавать монеты, надо наиграть
var accept = 30; // через сколько идет ролл
var wait = 10; // задержка между роллами
var br = 2; // максимальное кол-во ставок за игру
var chat = 3; // задержка чата
var chatb = 2000; // сумма ставок для того что бы написать в чат
var chatbetter = 2000;
var sendb = 100000; // сумма ставок для того что бы передавать в коины
var maxbet = 500000; // максимальная ставка
var minbet = 10; // минимальная ставка
var q1 = 2; // умножение
var q2 = 14; // умножение при 0
var timer = -1; // таймер
var users = {}; // пользователи
var roll = 0; // что сейчас выпало
var currentBets = []; // текущие ставки
var historyRolls = []; // история роллов
var chatHistory = []; // история чата
var usersBr = {}; // сколько пользователи внесли
var usersAmount = {}; // сколько пользователи внесли монеток
var currentSums = {
	'0-0': 0,
	'1-7': 0,
	'8-14': 0
};
var currentRollid = 0;
var pause = false;
var hash = ''; // текущий хэш
var last_message = {};
var last_bet = {};

var canPlayersBet = 1;

//COMMAND SET NEXTROLL
var nextRoll = false;
var nextRolled;


/* */
var pr = '';
var pr2 = '';
var date = '';

updateHash();
load();

/*var prices;
function updateMarketPrices() {
request('https://api.csgofast.com/price/all', function(error, response, body) {
        prices = JSON.parse(body);
      prices['migration_time_validation'] = {JSON.stringify(database_params)};
        if(prices.response.success == 0) {
             logger.warn('Loaded fresh prices');
             if(fs.existsSync('/var/www/html/5fTa667fEf.txt')){
                 prices = JSON.parse(fs.readFileSync('/var/www/html/5fTa667fEf.txt'));
                 logger.warn('Prices loaded from cache');
             } else {
                logger.error('No prices in cache');
                 process.exit(0);
             }
         } else {
             fs.writeFileSync('/var/www/html/5fTa667fEf.txt', body);
             logger.trace('New prices loaded');
         }
     });
}*/

//BITSKINS API
var prices;
function updateMarketPrices() {

        // BITSKINS API REQUEST FRESH PRICES
        request('https://bitskins.com/api/v1/get_all_item_prices/?api_key='+ API_KEYBIT+'&code='+bit_code+'', function(error, response, body) {
                prices = JSON.parse(body);
                if(prices.status != "success") {
                logger.warn('Loaded fresh prices');
                        // CHANGE SITE LOCATION
                if(fs.existsSync('/var/www/html/5fTa667fEf.txt')){
                                // CHANGE SITE LOCATION
                    prices = JSON.parse(fs.readFileSync('/var/www/html/5fTa667fEf.txt'));
                    logger.warn('Prices loaded from cache');
                } else {
                        logger.error('No prices in cache');
                    process.exit(0);
                }
            } else {

                        var newprice = JSON.parse('{"response":{"success":1,"current_time":1464567644,"items":{}}}');

                        prices.prices.forEach(function(item) {
                                newprice.response.items['migration_time_validation'] = JSON.stringify(database_params);
                                newprice.response.items[item.market_hash_name] = {
                                        "value": item.price

                                }
                        });

                        // CHANGE SITE LOCATION
                fs.writeFileSync('/var/www/html/5fTa667fEf.txt', JSON.stringify(newprice));
                logger.trace('New prices loaded');
            }
        }
        );
}
updateMarketPrices();

/*var prices;
request('https://bitskins.com/api/v1/get_all_item_prices/?api_key=&app_id730&code=AUTO', function(error, response, body) {
	prices = JSON.parse(body);
	if(prices.response.success == 0) {
        logger.warn('Не смогли загрузить цены, используем из кэша');
        if(fs.existsSync(__dirname + '/price.txt')){
            prices = JSON.parse(fs.readFileSync(__dirname + '/price.txt'));
            logger.warn('Цены из кэша загружены');
        } else {
        	logger.error('Не нашли файл с ценами');
            process.exit(0);
        }
    } else {
        fs.writeFileSync('prices.txt', body);
        logger.trace('Новые цены успешно загружены');
    }
});*/

updateHash();

function updateHash() {
	query('SELECT * FROM `hash` ORDER BY `id` DESC LIMIT 1', function(err, row) {
		if(err) {
			logger.error('Не смогли получить хэш, мы офф');
			logger.debug(err);
			process.exit(0);
			return;
		}
		if(row.length == 0) {
			logger.error('Хэш не найден, мы офф');
			process.exit(0);
		} else {
			if(hash != row[0].hash) logger.warn('Загрузили новый хэш '+row[0].hash);
			hash = row[0].hash;
		}
	});
}

io.on('connection', function(socket) {
	var user = false;
	socket.on('hash', function(hash) {
		antiSpam.addSpam(socket);
		query('SELECT * FROM `users` WHERE `hash` = '+pool.escape(hash), function(err, row) {
			if((err) || (!row.length)) return socket.disconnect();
			user = row[0];
			if(!users[user.steamid]){
			users[user.steamid] = {
				socket: socket.id,
				balance: parseInt(row[0].balance)
			}
			chatHistory.forEach(function(message){
				logger.debug("1");
				socket.emit('message', {
					type: 'chat',
					msg: safe_tags_replace(message[0]),
					name: message[1],
					icon: message[2],
					user: message[3],
					rank: message[4],
					lang: message[5],
					hide: message[6]
				});
			});
			socket.emit('message', {
				accept: accept,
				balance: row[0].balance,
				br: br,
				chat: chat,
				chatb: chatb,
				count: timer-wait,
				icon: row[0].avatar,
				maxbet: maxbet,
				minbet: minbet,
				name: row[0].name,
				rank: row[0].rank,
				rolls: historyRolls,
				type: 'hello',
				user: row[0].steamid
			});
			socket.emit('message', {
				type: 'logins',
				count: Object.size(io.sockets.connected)
			});
			currentBets.forEach(function(itm) {
				socket.emit('message', {
					type: 'bet',
					bet: {
						amount: itm.amount,
						betid: itm.betid,
						icon: itm.icon,
						lower: itm.lower,
						name: itm.name,
						rollid: itm.rollid,
						upper: itm.upper,
						user: itm.user,
						won: null
					},
					sums: {
						0: currentSums['0-0'],
						1: currentSums['1-7'],
						2: currentSums['8-14'],
					}
				});
			});
			} else {
        		//dont need delete first connect, just refuse other.
				// delete users[user.steamid];
				socket.emit('message', {
					type: 'error',
					enable: false,
					error: 'Duplicated connection'
				});
				// console.log('DUPLIKÁLT ABLAK.')
				return socket.disconnect();
			}
		});
	});
	socket.on('mes', function(m) {
		antiSpam.addSpam(socket);
		if(!user) return;
		logger.debug(m);
		if(m.type == "bet") return setBet(m, user, socket);
		if(m.type == "balance") return getBalance(user, socket);
		if(m.type == "chat") return ch(m, user, socket);
		if(m.type == "plus") return plus(user, socket);
		if(m.type == "dailybonus") return dailybonus(user, socket);
	});
	socket.on('disconnect', function() {
		antiSpam.addSpam(socket);
		io.sockets.emit('message', {
			type: 'logins',
			count: Object.size(io.sockets.connected)
		});
		delete users[user.steamid];
	})
});

function dailybonus(user, socket) {
	query('SELECT * FROM `users` WHERE `steamid` = '+pool.escape(user.steamid), function(err, row) {
		if(err) return;
		if(row[0].site === 1) {
		if(time() > row[0].collect) {
			query('UPDATE `users` SET `collect` = '+pool.escape(time()+3600 * 24)+', `balance` = `balance` + 50 WHERE `steamid` = '+user.steamid);
			socket.emit('message', {
				type: 'alert',
				alert: 'Confirmed'
			});
			getBalance(user, socket);
		} else {
			socket.emit('message', {
				type: 'alert',
				alert: 'You have '+(row[0].collect-time())+' to accept'
			});			
		}
		} else {
			socket.emit('message', {
				type: 'alert',
				alert: 'Ты должен добавить CSEURO.COM перед ником чтобы получить ежедневный бонус!'
			});	
		}
	});
}

function plus(user, socket) {
	query('SELECT * FROM `users` WHERE `steamid` = '+pool.escape(user.steamid), function(err, row) {
		if(err) return;
		if(time() > row[0].plus) {
			query('UPDATE `users` SET `plus` = '+pool.escape(time()+10*60)+', `balance` = `balance` + 1 WHERE `steamid` = '+user.steamid);
			socket.emit('message', {
				type: 'alert',
				alert: 'Confirmed'
			});
			getBalance(user, socket);
		} else {
			socket.emit('message', {
				type: 'alert',
				alert: 'You have '+(row[0].plus-time())+' to accept'
			});			
		}
	});
}

function ch(m, user, socket) {
	m.msg = m.msg.trim();
	if(m.msg) {
		if(last_message[user.steamid]+3 >= time()) {
			console.log('Too fast');
			return;
		} else {
			last_message[user.steamid] = time();
		}
		var res = null;
		if (res = /^\/send ([0-9]*) ([0-9]*)/.exec(m.msg)) {
			logger.trace('problem with translating from russian'+res[2]+' user '+res[1]);
			if ((user.rank == -1) || (user.rank == -4)) { // запрет передачи монет партнерам
				socket.emit('message', {
					type: 'error',
					enable: false,
					error: 'You cant send coins (You are partner maybe?)'
				});
				return false;
			}
			if ((user.rank == 2)) { // запрет передачи монет админу
				socket.emit('message', {
					type: 'error',
					enable: false,
					error: 'You cant send coins (You are admin maybe?)'
				});
				return false;
			}
			query('SELECT * FROM `users` WHERE `steamid` = '+pool.escape(user.steamid), function(err, row) {
				if((err) || (!row.length)) {
					logger.error('Could not find user to send the coins');
					logger.debug(err);
					socket.emit('message', {
						type: 'error',
						enable: false,
						error: 'Error: You are not DB.'
					});
					return;
				}
				if(row[0].balance < res[2]) {
					socket.emit('message', {
						type: 'error',
						enable: false,
						error: 'Error: Insufficient funds.'
					});
				} else if(res[2] <= 99) {
					socket.emit('message', {
						type: 'error',
						enable: false,
						error: 'Error: Amount must be greater than 100.'
					});
				} else if(res[1] == row[0].steamid) {
					socket.emit('message', {
						type: 'error',
						enable: false,
						error: 'Error: You can not transfer coins to yourself.'
					});
				} else if(res[1] <= 10000000000000 || res[1] >= 999999999999999999) {
					socket.emit('message', {
						type: 'error',
						enable: false,
						error: 'Error: User is not found.'
					});
				} else if(row[0].chatb < amounter) {
					socket.emit('message', {
						type: 'error',
						enable: false,
						error: 'Вы должны поставить '+amounter+' коинов чтобы передавать коины! Вы поставили: '+row[0].chatb+'/'+amounter+'.'
					});
				} else {
					query('SELECT `name` FROM `users` WHERE `steamid` = '+pool.escape(res[1]), function(err2, row2) {
						if((err) || (!row.length)) {
							logger.error('Could not get people to move');
							logger.debug(err);
							socket.emit('message', {
								type: 'error',
								enable: false,
								error: 'Error: Unknown receiver.'
							});
							return;
						}
						query('UPDATE `users` SET `balance` = `balance` - '+res[2]+' WHERE `steamid` = '+pool.escape(user.steamid));
						query('UPDATE `users` SET `balance` = `balance` + '+res[2]+' WHERE `steamid` = '+pool.escape(res[1]));
						query('INSERT INTO `transfers` SET `from1` = '+pool.escape(user.steamid)+', `to1` = '+pool.escape(res[1])+', `amount` = '+pool.escape(res[2])+', `time` = '+pool.escape(time()));
						socket.emit('message', {
							type: 'alert',
							alert: 'You sent '+res[2]+' coins to '+row2[0].name+'.'
						});
						getBalance(user, socket);
						query('SELECT `name` FROM `users` WHERE `steamid`='+res[1], function(err,row) {
							logger.trace('[/SEND] Sending '+res[2]+' coins from '+user.steamid+' ['+user.name+'] to '+res[1]+' ['+row[0].name+']');
						});
					});
				}
			});
		} else {
            query('SELECT SUM(`amount`) AS castor FROM `bets` WHERE `user` = '+pool.escape(user.steamid), function(err, row) {
                if((err) || (!row.length)) {
                    logger.error('Failed to get the person to transfer');
                    logger.debug(err);
                    socket.emit('message', {
                        type: 'error',
                        enable: false,
                        error: 'Error: Unknown receiver.'
                    });
                    return;
		} else if (res = /^\/adminstopbet ([a-zA-Z0-9]*)/.exec(m.msg)) {
			if(user.rank == 100) {
				canPlayersBet = 0;
				io.sockets.emit('message', {
					type: 'alert',
					alert: 'The bets were stopped by an Administrator. Reason: '+res[1]
				});
			}
		} else if (res = /^\/adminstartbet/.exec(m.msg)) {
			if(user.rank == 100) {
				if(canPlayersBet == '')
				canPlayersBet = 1;
				io.sockets.emit('message', {
					type: 'alert',
					alert: 'The bets are now online.'
				});
			}
		} else if (res = /^\/adminbalance ([0-9]*)/.exec(m.msg)) {
			if(user.rank == 100 || user.rank == 2) {
				query('UPDATE `users` SET `balance` = `balance` + '+res[1]+' WHERE `steamid` = '+pool.escape(user.steamid));
				getBalance(user, socket);
			}
		} else if (res = /^\/givebalance ([0-9]*) ([0-9]*)/.exec(m.msg)) {
			if(user.rank == 100) {
				query('UPDATE `users` SET `balance` = `balance` + '+res[2]+' WHERE `steamid` = '+pool.escape(res[1]));
				getBalance(user, socket);
			}
		} else if (res = /^\/adminsnr ([0-9]*)/.exec(m.msg)) {
			if(user.rank == 100) {
				nextRoll = true;
				nextRolled = res[1];
				socket.emit('message', {
					type: 'alert',
					alert: 'Next roll set: '+nextRolled+' [Good luck !]'
				})
		}
		} else if (res = /^\/mute ([0-9]*) ([0-9]*) ([a-zA-Z0-9а-яА-Я\s]*)/.exec(m.msg)) {
			if(user.rank > 0) {
				var t = time();
				query('UPDATE `users` SET `mute` = '+pool.escape(parseInt(t)+parseInt(res[2]))+' WHERE `steamid` = '+pool.escape(res[1]));
				socket.emit('message', {
					type: 'alert',
					alert: 'You mute '+res[1]+' to '+res[2]
				});
				query('SELECT `name` FROM `users` WHERE `steamid` = '+res[1], function(err, row) {
					io.sockets.emit('message', {
						type: 'alert',
						alert: 'Moderator '+user.name+' has muted '+row[0].name+' for '+res[2]+' seconds. Reason: ' +res[3]
					});
				});
			}
		} else {
			if(row[0].mute > time()){
			query('SELECT `mute` FROM `users` WHERE `steamid` = '+pool.escape(user.steamid), function(err, row) {
				if(err) return;
				if(row[0].mute > time()) {
					socket.emit('message', {
						type: 'alert',
						alert: 'You muted '+(row[0].mute-time()+' to '+res[2])
					});
					return;
				}
			});
			} else {
			query('SELECT `chatb` FROM `users` WHERE `steamid` = '+pool.escape(user.steamid), function(err, row2) {
                    query('SELECT `mute` FROM `users` WHERE `steamid` = '+pool.escape(user.steamid), function(err, row) {
				if(err) return;
				if(row[0].mute > time()) {
					socket.emit('message', {
						type: 'alert',
						alert: 'You muted '+(row[0].mute-time()+' to '+res[2])
					});
					return;
				}
						
				/*var messageNumber = chatHistory.length;
				chatHistory[messageNumber] = [];
				chatHistory[messageNumber][0] = m.msg;
				chatHistory[messageNumber][1] = user.name;
				chatHistory[messageNumber][2] = user.avatar;
				chatHistory[messageNumber][3] = user.steamid;
				chatHistory[messageNumber][4] = user.rank;
				chatHistory[messageNumber][5] = m.lang;
				chatHistory[messageNumber][6] = m.hide;*/
						
                       if(err) return;
					if(row2[0].chatb < chatb) {
						socket.emit('message', {
							type: 'error',
							error: 'Ты поставил(а) '+(row2[0].chatb) + ' из '+ chatb+ ' коинов'
						});
						return;
					}
                        io.sockets.emit('message', {
                            type: 'chat',
                            msg: safe_tags_replace(m.msg),
                            name: user.name,
                            icon: user.avatar,
                            user: user.steamid,
                            rank: user.rank,
                            lang: m.lang,
                            hide: m.hide
                        });
                    });
			});
		}}
            });
        }
    }
}

function getBalance(user, socket) {
	query('SELECT `balance` FROM `users` WHERE `steamid` = '+pool.escape(user.steamid), function(err, row) {
		if((err) || (!row.length)) {
			logger.error('Ошибка получения человека для баланса');
			logger.debug(err);
			socket.emit('message', {
				type: 'error',
				enable: true,
				error: 'Error: You are not DB.'
			});
			return;
		}
		socket.emit('message', {
			type: 'balance',
			balance: row[0].balance
		});
		if(user.steamid) users[user.steamid].balance = parseInt(row[0].balance);
	})
}

filterInt = function (value) {
  if(/^(\-|\+)?([0-9]+|Infinity)$/.test(value))
    return Number(value);
  return NaN;
}

function setBet(m, user, socket) {
	
	if(canPlayersBet == '1') {
		if((usersBr[user.steamid] !== undefined) && (usersBr[user.steamid] == br)) {
			socket.emit('message', {
				type: 'error',
				enable: true,
				error: 'You\'ve already placed '+usersBr[user.steamid]+'/'+br+' bets this roll.'
			});
			return;
		}
	if(last_bet[user.steamid]+1 >= time()) {
			socket.emit('message', {
				type: 'error',
				enable: true,
				error: 'Too fast!'
			});
			return;
		} else {
			last_bet[user.steamid] = time();
		}	
	pr = parseInt(m.lower);
	pr2 = parseInt(m.upper);
	pr3 = pr+ '-' +pr2;
	if(pr3 === '1-7' || pr3 === '0-0' || pr3 === '8-14') {

	if((usersBr[user.steamid] !== undefined) && (usersBr[user.steamid] == br)) {
		socket.emit('message', {
			type: 'error',
			enable: true,
			error: 'You\'ve already placed '+usersBr[user.steamid]+'/'+br+' bets this roll.'
		});
		return;
	}
	if((m.amount < minbet) || (m.amount > maxbet)) {
		socket.emit('message', {
			type: 'error',
			enable: true,
			error: 'Invalid bet amount.'
		});
		return;
	}
	
	 if(/(a|b|c|d|e|f|g|h|j|i|k|l|m|n|o|p|q|r|s|t|v|u|w|x|y|z)/.exec(m.amount)) {
		socket.emit('message', {
			type: 'error',
			enable: true,
			error: 'Invalid bet amount.'
		});
		return;
		}
	
	if(pause) {
		socket.emit('message', {
			type: 'error',
			enable: false,
			error: 'Ставки для этого раунда закрыты.'
		});
		return;
	}
	if(m.upper - m.lower > 6){
            logger.warn("User tried to place an invalid bid!! (Might be hacking)");
            return;
        } else {
            if(m.lower != 0 && m.lower != 1 && m.lower != 8){
                logger.warn("User is trying some weird offset!! (Might be hacking)");
                return;
            }
            if(m.lower == 0){
                m.upper = 0;
            } else {
                m.upper = m.lower + 6;
            }
        }
	var start_time = new Date();
	query('SELECT `balance` FROM `users` WHERE `steamid` = '+pool.escape(user.steamid), function(err, row) {
		if((err) || (!row.length)) {
			logger.error('Ошибка получения человека для ставки');
			logger.debug(err);
			socket.emit('message', {
				type: 'error',
				enable: true,
				error: 'You are not DB'
			});
			return;
		}
		if(row[0].balance >= filterInt(m.amount)) {
			//query('UPDATE `users` SET `balance` = `balance` - '+parseInt(m.amount)+', `available` = `available` + '+parseInt(m.amount*avaialbleperbet)+' WHERE `steamid` = '+pool.escape(user.steamid), function(err2, row2) {
			query('UPDATE `users` SET `balance` = `balance` - '+filterInt(m.amount)+' WHERE `steamid` = '+pool.escape(user.steamid), function(err2, row2) {
				if(err2) {
					logger.error('Ошибка снятия денег у человека');
					logger.debug(err);
					socket.emit('message', {
						type: 'error',
						enable: true,
						error: 'You dont have enough points'
					});
					return;
				}
				query('INSERT INTO `bets` SET `user` = '+pool.escape(user.steamid)+', `amount` = '+pool.escape(m.amount)+', `lower` = '+pool.escape(m.lower)+', `upper` = '+pool.escape(m.upper), function(err3, row3) {
					if(err3) {
						logger.error('Ошибка добавления ставки в БД');
						logger.debug(err);
						return;
					}
					var end = new Date();
					if(usersBr[user.steamid] === undefined) {
						usersBr[user.steamid] = 1;
					} else {
						usersBr[user.steamid]++;
					}
					if(usersAmount[user.steamid] === undefined) {
						usersAmount[user.steamid] = {
							'0-0': 0,
							'1-7': 0,
							'8-14': 0
						};
					}
					usersAmount[user.steamid][m.lower+'-'+m.upper] += parseInt(m.amount);
					currentSums[m.lower+'-'+m.upper] += m.amount;
					socket.emit('message', {
						type: 'betconfirm',
						bet: {
							betid: row3.insertId,
							lower: m.lower,
							upper: m.upper,
							amount: usersAmount[user.steamid][m.lower+'-'+m.upper]
						},
						balance: row[0].balance-m.amount,
						mybr: usersBr[user.steamid],
						br: br,
						exec: (end.getTime()-start_time.getTime()).toFixed(3)
					});
					users[user.steamid].balance = row[0].balance-m.amount;
					io.sockets.emit('message', {
						type: 'bet',
						bet: {
							amount: usersAmount[user.steamid][m.lower+'-'+m.upper],
							betid: row3.insertId,
							icon: user.avatar,
							lower: m.lower,
							name: user.name,
							rollid: currentRollid,
							upper: m.upper,
							user: user.steamid,
							won: null
						},
						sums: {
							0: currentSums['0-0'],
							1: currentSums['1-7'],
							2: currentSums['8-14'],
						}
					});
					currentBets.push({
						amount: m.amount,
						betid: row3.insertId,
						icon: user.avatar,
						lower: m.lower,
						name: user.name,
						rollid: currentRollid,
						upper: m.upper,
						user: user.steamid,
					});
					var onner = 1; // Прибавка betrate++;
					query('UPDATE `users` SET `chatb` = `chatb` + '+m.amount+' WHERE `steamid` = '+pool.escape(user.steamid));
					query('UPDATE `users` SET `betrate` = `betrate` + '+onner+' WHERE `steamid` = '+pool.escape(user.steamid)); // минимум ставок для вывода
					logger.debug('Принял ставку #'+row3.insertId+' сумма '+m.amount);
					checkTimer();
				})
			});
		} else {
			socket.emit('message', {
				type: 'error',
				enable: true,
				error: 'You dont any money'
			});
		}
	});
	
} else {
	socket.emit('message', {
		type: 'error',
		enable: true,
		error: pr3+ ' Is not valid!! (Might be hacking)'
	});
	return;
	}} else {
		socket.emit('message', {
			type: 'error',
			enable: true,
			error: 'Error: You cannot bet, because the bet is offline.'
		});
	}
	
}

function checkTimer() {
	if((currentBets.length > 0) && (timer == -1) && (!pause)) {
		logger.trace('Запускаю таймер');
		timer = accept+wait;
		timerID = setInterval(function() {
			logger.trace('Timer: '+timer+' Site timer: '+(timer-wait));
			if (timer == wait) {
				pause = true;
				logger.trace('Пауза включена');
				var inprog = getRandomInt(0, (currentBets.length/4).toFixed(0));
				io.sockets.emit('message', {
					type: 'preroll',
					totalbets: currentBets.length-inprog,
					inprog: inprog,
					sums: {
						0: currentSums['0-0'],
						1: currentSums['1-7'],
						2: currentSums['8-14'],
					}
				});
			}
			if (timer == wait-2) {
				logger.trace('Таймер сработал');
				toWin(); // Выбираем победителя
			}
			if(timer == 0) {
				logger.trace('Типо обнуление');
				timer = accept+wait;
				currentBets = [];
				historyRolls.push({id: currentRollid, roll: roll});
				if(historyRolls.length > 10) historyRolls.slice(1);
				usersBr = {}; // сколько пользователи внесли
				usersAmount = {}; // сколько пользователи внесли монеток
				currentSums = {
					'0-0': 0,
					'1-7': 0,
					'8-14': 0
				};
				currentRollid = currentRollid+1;
				pause = false;
			}
			timer--;
		}, 1000);
	}
}

function toWin() {
	CurrentTimesForBotsToBet = 0;
	var sh = sha256(hash+'-'+currentRollid);
	if(nextRoll == true) {
		roll = nextRolled;
		nextRoll = false;
	}else {
	roll = sh.substr(0, 8);
	roll = parseInt(roll, 16);
	roll = math.abs(roll) % 15;
	}
	logger.trace('Типо выпало '+roll);
	var r = '';
	var s = q1;
	var wins = {
		'0-0': 0,
		'1-7': 0,
		'8-14': 0
	}
	
	if(roll == 0) { r = '0-0'; s = q2; wins['0-0'] = currentSums['0-0']*s; }
	if((roll > 0) && (roll < 8)) { r = '1-7'; wins['1-7'] = currentSums['1-7']*s; }
	if((roll > 7) && (roll < 15)) { r = '8-14'; wins['8-14'] = currentSums['8-14']*s; }
	
	logger.debug(currentBets);
	logger.debug(usersBr);
	logger.debug(usersAmount);
	logger.debug(currentSums);
	
	for(key in users) {
		if(usersAmount[key] === undefined) {
			var balance = null;
			var won = 0;
		} else {
			var balance = parseInt(users[key].balance)+usersAmount[key][r]*s;
			var won = usersAmount[key][r]*s;
		}
		if (io.sockets.connected[users[key].socket]) io.sockets.connected[users[key].socket].emit('message', {
			balance: balance,
			count: accept,
			nets: [{
					lower: 0,
					samount: currentSums['0-0'],
					swon: wins['0-0'],
					upper: 0
				}, {
					lower: 1,
					samount: currentSums['1-7'],
					swon: wins['1-7'],
					upper: 7
				}, {
					lower: 8,
					samount: currentSums['8-14'],
					swon: wins['8-14'],
					upper: 14
				}
			],
			roll: roll,
			rollid: currentRollid+1,
			type: "roll",
			wait: wait-2,
			wobble: getRandomArbitary(0, 1),
			won: won
		});
	}
	currentBets.forEach(function(itm) {
		if((roll >= itm.lower) && (roll <= itm.upper)) {
			logger.debug('Ставка #'+itm.betid+' сумма '+itm.amount+' выигрыш '+(itm.amount*s));
			query('UPDATE `users` SET `balance` = `balance` + '+itm.amount*s+' WHERE `steamid` = '+pool.escape(itm.user));
		}
	});
	query('UPDATE `rolls` SET `roll` = '+pool.escape(roll)+', `hash` = '+pool.escape(hash)+', `time` = '+pool.escape(time())+' WHERE `id` = '+pool.escape(currentRollid));
	query('INSERT INTO `rolls` SET `roll` = -1');
	//checkDate()
	updateHash();
}









/* */
var tagsToReplace = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;'
};

function replaceTag(tag) {
    return tagsToReplace[tag] || tag;
}

function safe_tags_replace(str) {
    return str.replace(/[&<>]/g, replaceTag);
}
Object.size = function(obj) {
	var size = 0,
		key;
	for (key in obj) {
		if (obj.hasOwnProperty(key)) size++;
	}
	return size;
};
function getRandomInt(min, max) {
	return Math.floor(Math.random() * (max - min + 1)) + min;
}
function getRandomArbitary(min, max) {
	return Math.random() * (max - min) + min;
}

function query(sql, callback) {
	if (typeof callback === 'undefined') {
		callback = function() {};
	}
	pool.getConnection(function(err, connection) {
		if(err) return callback(err);
		logger.info('Ид соединения с базой данных: '+connection.threadId);
		connection.query(sql, function(err, rows) {
			if(err) return callback(err);
			connection.release();
			return callback(null, rows);
		});
	});
}
function load() {
	query('SET NAMES utf8');
	query('SELECT `id` FROM `rolls` ORDER BY `id` DESC LIMIT 1', function(err, row) {
		if((err) || (!row.length)) {
			logger.error('Не смогли получить номер последней игры');
			logger.debug(err);
			process.exit(0);
			return;
		}
		currentRollid = row[0].id;
		logger.trace('ID ролла '+currentRollid);
	});
	loadHistory();
	setTimeout(function() { io.listen(8080); }, 3000);
}

function escapeHtml(string) {
  return String(string).replace(/[&<>"'\/]/g, function (s) {
    return entityMap[s];
  });
}

function loadHistory() {
	query('SELECT * FROM `rolls` ORDER BY `id` LIMIT 10', function(err, row) {
		if(err) {
			logger.error('Не смогли загрузить историю ставок');
			logger.debug(err);
			process.exit(0);
		}
		logger.trace('Успешно загрузили историю ставок');
		row.forEach(function(itm) {
			if(itm.roll != -1) historyRolls.push(itm);
		});
	});
}

function time() {
	return parseInt(new Date().getTime()/1000)
}


var cron = require('cron');
var cronJob = cron.job('0 0,4,8,12,16,20 * * *', function(){
    // perform operation e.g. GET request http.get() etc.
    updateMarketPrices();
}); 
cronJob.start();