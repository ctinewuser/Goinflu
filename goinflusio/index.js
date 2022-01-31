var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http, {
  cors: {
    origin: "https://goinflu.herokuapp.com/",
    methods: ["GET", "POST"],
    allowedHeaders: ["my-custom-header"],
    credentials: true
  }
});
var request = require('request');
var clients =[];
app.get('/',function(req,res){
    res.send("Welcome to my socket");
});

app.get('/sender', function(req, res) {
   res.sendfile('sender.html');
});
 
 io.on('connection', function(socket) {
   console.log('user Online'+socket.id);
    //--- Online user-----//
  socket.on('disconnect', function (data) {});   

    socket.on('SenderMessageById', function(data) {
       request("https://ctinfotech.com/CTCC/goinflu/api/send_message?sender_id="+data.sender_id+"&sender_image="+data.sender_image+"&sender_name="+data.sender_name+"&receiver_id="+data.receiver_id+"&receiver_name="+data.receiver_name+"&receiver_image="+data.receiver_image+"&datetime="+data.datetime+"&messages="+data.messages+"&image="+data.image, function (error, response, body) {
        console.log('error:', error); // Print the error if one occurred
        console.log('statusCode:', response.statusCode); // Print the response status code if a response was received
        console.log('body:', body); // Print the HTML for the Google homepage.
      });
       console.log("SenderMessageById",data);
      io.emit('ReceiverMessageById'+data.receiver_id,data);

   });  

    socket.on('chat message', function(msg){
    io.emit('chat message', msg);
  });

});

http.listen(process.env.PORT || 5000, function(){
  console.log('listening on', http.address().port);
});