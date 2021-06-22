const socketController = (socket) => {
    console.log('cliente conectado');

    socket.on('send-msg', (payload, callback) => {
        const id = 123;
        callback(id)
        socket.broadcast.emit('send-msg', payload)
    });

}

module.exports = {
    socketController
}