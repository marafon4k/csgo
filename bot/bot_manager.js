var forever = require('forever-monitor');
var mysql = require('mysql');

var pool  = mysql.createPool({
	connectionLimit : 10,
	database: 'csgolobbyrur',
	host: 'localhost',
	user: 'root',
	password: 'pass'
});

query('SELECT * FROM `bots`', function(err, row) {
	if((err) || (!row.length)) {
		console.log('Ошибка запроса к БД, либо нет ботов');
		console.log(err);
		return process.exit(0);
	}
	console.log('Получили список ботов');
	row.forEach(function(itm) {
		console.log('Сделал заявку на запуск бота '+itm.id);
		var bot = new (forever.Monitor)('bot.js', {
			args: [itm.id]
		});
		bot.on('start', function(process, data) {
			console.log('Бот с ид '+itm.id+' запустился');
		});
		bot.on('exit:code', function(code) {
   			console.log('Бот остановился с кодом '+code);
		});
		bot.on('stdout', function(data) {
			console.log(data);
		});
		bot.start();
	});
});

function query(sql, callback) {
	if (typeof callback === 'undefined') {
		callback = function() {};
	}
	pool.getConnection(function(err, connection) {
		if(err) return callback(err);
		console.info('Ид соединения с базой данных: '+connection.threadId);
		connection.query(sql, function(err, rows) {
			if(err) return callback(err);
			connection.release();
			return callback(null, rows);
		});
	});
}