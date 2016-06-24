/**
 * Created by poovarasanv on 23/6/16.
 */
var express = require("express");
var app = express();
var port = 3700;
var io = require('socket.io').listen(app.listen(port));

io.sockets.on('connection', function (socket) {
    socket.emit('message', {message: 'welcome to the chat'});
    socket.on('send', function (data) {
        io.sockets.emit('message', data);
    });

    socket.on('disconnect', function (socket) {
        console.log('User Disconnected...');
    })
});


console.log("Listening on port " + port);