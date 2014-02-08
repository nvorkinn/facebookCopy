function connectToNotifServer(){

var conn = new WebSocket('ws://localhost:8080');

conn.onopen = function(e) {
    alert("Connection established!");
	conn.send(JSON.stringify({user_id: sessionStorage.getItem("user_id")}));
};

conn.onmessage = function(e) {
	alert(e.data);
};

conn.onclose = function(e) {
    alert("Connection closed!");
};
return conn;

}
