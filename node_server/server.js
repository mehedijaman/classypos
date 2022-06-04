var app = require('express')();
var server = require('http').Server(app);
var io = require('socket.io')(server);
var redis = require('redis');
var clients = [];

server.listen(8890, function () {
    console.log('Server is running!');
});

io.on('connection', function (socket) {
    clients.push(socket.id);

    // console.log('New client connected!', clients);

    var redisClient = redis.createClient();
    redisClient.subscribe('order-received');
    redisClient.subscribe('suborder-id');
    redisClient.subscribe('order-deleted');
    redisClient.subscribe('order-item-delete');
    redisClient.on('message', function (channel, message) {
        console.log('Channel is ' + channel + ' and message is ' + message);

        socket.emit(channel, message);
    });
});
