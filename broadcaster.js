var server = require('http').Server();

var io = require('socket.io')(server,{
    allowEIO3: true,
    cors: {
        origin: "http://www.dacs.com",
        methods: ["GET", "POST"],
        allowedHeaders: ["x-schubwerk-token"],
        credentials: false
    }
});

var Redis = require('ioredis');
var redis = new Redis();

redis.subscribe('dacsonline_database_maps.1',(err,count)=>{
    console.log(count);
});

redis.on('message', function(channel,message){
    console.log(channel);
    let parsedMessage = JSON.parse(message);
    console.log(parsedMessage)
    io.emit(channel+':'+parsedMessage.event,parsedMessage.data);
})

server.listen(3000)
