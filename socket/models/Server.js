const express = require('express');
const cors = require('cors');
const { socketController } = require('../controllers/controller');

class Server {

    constructor() {
        this.app = express();
        this.port = 8081;
        this.server = require('http').createServer(this.app);
        this.io = require("socket.io")(this.server, {
            cors: {
                origin: '*',
            }
        });
        this.paths = {};

        // Middlewares
        this.middlewares();

        // Rutas de mi aplicación
        this.routes();

        //sockets
        this.sockets();
    }

    middlewares() {
        this.app.use(express.static('public'));
        this.app.use(cors());
        this.app.use(express.json());

    }

    routes() {

    }

    sockets() {
        this.io.on('connection', socketController);
    }

    listen() {
        this.server.listen(this.port, () => {
            console.log('Servidor corriendo en puerto', this.port);
        });
    }

}




module.exports = Server;