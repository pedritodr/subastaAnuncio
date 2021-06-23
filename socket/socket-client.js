const socket = io('http://localhost:8081');
console.log(sessionUser);
socket.on('connect', () => {
    console.log('online');
})

socket.on('disconnect', () => {
    console.log('offline');
})


const payload = {

}
socket.emit('send-puja', { payload });