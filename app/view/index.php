
<script>
    websocket = new WebSocket("ws://localhost:9000/daemon.php");
    websocket.onopen = function(evt) { /* do stuff */ }; //on open event
    websocket.onclose = function(evt) { /* do stuff */ }; //on close event
    websocket.onmessage = function(evt) { /* do stuff */ }; //on message event
    websocket.onerror = function(evt) { /* do stuff */ }; //on error event
    websocket.send(message); //send method
    websocket.close(); //cl
</script>
<div>
    <!--test inject from controller controller/Main.php-->
    <p><?php echo $dataOne;?></p>
  
</div>

<div>

</div>