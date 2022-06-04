var app = require('express')();
var server = require('http').Server(app);
var io = require('socket.io')(server);
var redis = require('redis');

server.listen(8890, function () {

});

// Register socket.io connection.
io.on('connection', function (socket) {

    // Create redis client to subscribe redis channel.
    var redisClient = redis.createClient();

    // Subscribe to redis channel.
    redisClient.subscribe('order-received');
    redisClient.subscribe('suborder-id');
    redisClient.subscribe('order-deleted');
    redisClient.subscribe('order-item-delete');

    // emit message that subscribed.
    redisClient.on('message', function (channel, message) {
        socket.emit(channel, message);
    });

});
