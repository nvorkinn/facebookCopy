function connectToNotifServer(){

var conn = new WebSocket('ws://localhost:8080');

conn.onopen = function(e) {
    console.log("Connection established!");
	conn.send(JSON.stringify({user_hash: sessionStorage.getItem("user_hash"),message:"INIT_MESSAGE"}));
};

conn.onclose = function(e) {
    console.log("Connection closed!");
};

return conn;

}

function registerNotification(conn,to,msg){
	console.log("to: "+to+" msg:"+msg); 
	conn.send(JSON.stringify({user_hash: sessionStorage.getItem("user_hash"),target_hash:to,message:msg}));
}
