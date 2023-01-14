import ws from 'ws';
import {v4 as uuid} from 'uuid';

const {Server} = ws;
const clients = {};

const wss = new Server({
    port: 8000
});

wss.on("connection", (ws) => {
    const id = uuid();
    clients[id] = ws;

    console.log(`New client ${id}`);

    ws.on('message', (rawMessage) => {

    });

    ws.on('close', () => {
       delete clients[id];
       console.log(`Client is closed ${id}`);
    });
})

export default wss;
