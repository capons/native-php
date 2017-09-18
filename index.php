<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

require_once("app/Autoloader.php");
require_once("app/config/constant.php");
require_once("app/config/route.php");

//$content = new \app\system\action\url\UrlLoad();
//$content->boot();




/*
$addr = gethostbyname("socket");


$client = stream_socket_client("tcp://$addr:8282", $errno, $errorMessage);

if ($client === false) {
    throw new UnexpectedValueException("Failed to connect: $errorMessage");
}
*/

//fwrite($client, "GET / HTTP/1.0\r\nHost: socket\r\nAccept: */*\r\n\r\n");
/*
echo stream_get_contents($client);
fclose($client);
die();
*/


/*

error_reporting(~E_NOTICE);
//set_time_limit (0);

$address = "127.0.0.1";
$port = 8585;
$max_clients = 10;

if(!($sock = socket_create(AF_INET, SOCK_STREAM, 0)))
{
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);

    die("Couldn't create socket: [$errorcode] $errormsg \n");
}

echo "Socket created \n";

if ( ! socket_set_option($sock, SOL_SOCKET, SO_REUSEADDR, 1))
{
    echo socket_strerror(socket_last_error($sock));
    exit;
}

// Bind the source address
if( !socket_bind($sock, $address) )
{
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);

    die("Could not bind socket : [$errorcode] $errormsg \n");
}

echo "Socket bind OK \n";

if(!socket_listen ($sock , 10))
{
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);

    die("Could not listen on socket : [$errorcode] $errormsg \n");
}

echo "Socket listen OK \n";





echo "Waiting for incoming connections... \n";

//array of client sockets
$client_socks = array();

//array of sockets to read
$read = array();

//start loop to listen for incoming connections and process existing connections
while (true)
{
    //prepare array of readable client sockets
    $read = array();

    //first socket is the master socket
    $read[0] = $sock;



    //now add the existing client sockets
    for ($i = 0; $i < $max_clients; $i++)
    {
        if($client_socks[$i] != null)
        {
            $read[$i+1] = $client_socks[$i];
        }
    }


    $write = null;
    $except = null;
    //now call select - blocking call
    /*
    if(socket_select($read , $write , $except , 0) === false)
    {
        $errorcode = socket_last_error();
        $errormsg = socket_strerror($errorcode);

        die("Could not listen on socket : [$errorcode] $errormsg \n");
    }
    */

/*


    //if ready contains the master socket, then a new connection has come in
    if (in_array($sock, $read))
    {
        for ($i = 0; $i < $max_clients; $i++)
        {
            if ($client_socks[$i] == null)
            {

                if(($newc = @socket_accept($sock)) !== false) {
                    $con=1;
                }

              

                 $client_socks[$i] = socket_accept($sock);
             
                //display information about the client who is connected
                if(socket_getpeername($client_socks[$i], $address, $port))
                {
                    echo "Client $address : $port is now connected to us. \n";
                }

                //Send Welcome message to client
                $message = "Welcome to php socket server version 1.0 \n";
                $message .= "Enter a message and press enter, and i shall reply back \n";
                socket_write($client_socks[$i] , $message);
                break;
            }
        }
    }



    //check each client if they send any data
    for ($i = 0; $i < $max_clients; $i++)
    {
        if (in_array($client_socks[$i] , $read))
        {
            $input = socket_read($client_socks[$i] , 1024);

            if ($input == null)
            {
                //zero length string meaning disconnected, remove and close the socket
                unset($client_socks[$i]);
                socket_close($client_socks[$i]);
            }

            $n = trim($input);

            $output = "OK ... $input";

            echo "Sending output to client \n";

            //send response to client
            socket_write($client_socks[$i] , $output);
        }
    }

}
*/

/*
// set some variables
$host = "127.0.0.1";
$port = 8282;
// don't timeout!
set_time_limit(0);
// create socket
$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
// bind socket to port
$result = socket_connect($socket, $host, $port) or die("Could not bind to socket\n");
// start listening for connections
$result = socket_listen($socket, 3) or die("Could not set up socket listener\n");

// accept incoming connections
// spawn another socket to handle communication
$spawn = socket_accept($socket) or die("Could not accept incoming connection\n");
// read client input
$input = socket_read($spawn, 1024) or die("Could not read input\n");
// clean up input string
$input = trim($input);
echo "Client Message : ".$input;
// reverse client input and send back
$output = strrev($input) . "\n";
socket_write($spawn, $output, strlen ($output)) or die("Could not write output\n");
// close sockets
socket_close($spawn);
socket_close($socket);
*/


if(!($sock = socket_create(AF_INET, SOCK_STREAM, 0)))
{
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);

    die("Couldn't create socket: [$errorcode] $errormsg \n");
}

echo "Socket created \n";

//Connect socket to remote server
if(!socket_connect($sock , '127.0.0.1' , 8282))
{
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);

    die("Could not connect: [$errorcode] $errormsg \n");
}

echo "Connection established \n";

$message = "GET / HTTP/1.1\r\n\r\n";

//Send the message to the server
if( ! socket_send ( $sock , $message , strlen($message) , 0))
{
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);

    die("Could not send data: [$errorcode] $errormsg \n");
}

echo "Message send successfully \n";

//////////////////////





//Now receive reply from server
if(socket_recv ( $sock , $buf , 2045 , MSG_WAITALL ) === FALSE)
{
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);

    die("Could not receive data: [$errorcode] $errormsg \n");
}

//print the received message
echo $buf;

socket_close($sock);







