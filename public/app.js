const express = require('express');
const app = express();
const http = require('http');
const server = http.createServer(app);
const { Server } = require("socket.io");
const io = new Server(server);


/* connectiom to db */
const db = require('./connection.js');
console.log("# db :" + db);


io.on('connection', (socket) => {
  const username = socket.handshake.query.username;

  console.log('Connected Successfully', socket.id);
  socket.on('disconnect', () => {
    console.log('Discconect', socket.id);
  });





   socket.on('message', (data) => {

    console.log('data', data);
    const clearMessage = db.checkBlackList(data.message);
    console.log("# message after checked :"+ clearMessage);
    const messages = db.insertMessage(1, 2, clearMessage);
    console.log("# message :" + messages);
    const message = {
      message: clearMessage,
      senderUsername: username,
      sentAt: Date.now()
    }
    // messages.push(message)
    io.emit('message', message)

  })
});

app.get('/', (req, res) => {
  res.send("Server is running");
  const result = db.getAllMessage();
  console.log("#resutl ::" + result);
  const messages = db.getMessageById(1, 2);
  console.log("#result message ::" + messages);
})

server.listen(4545, () => {
  console.log('listening on *:4545');
});