const socket = io('http://localhost:8081');
console.log(socket);
socket.on('connect', () => {
    console.log('online');
})

socket.on('disconnect', () => {
    console.log('offline');
})


const payload = {

}
socket.emit('send-puja', { message, uid: id });