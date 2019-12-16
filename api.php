<?php

use MyApp\Socket;

error_reporting(E_ALL);
set_time_limit(0);
ob_implicit_flush();
try {
  $address='127.0.0.1';
  $port = '8080';
  $broadcast_string = 'Test the thunder';

  $sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
socket_set_option($sock, SOL_SOCKET, SO_BROADCAST, 1);
socket_sendto($sock, $broadcast_string, strlen($broadcast_string), 0, $address, $port);
die('Exit');

  $socket = socket_create(AF_INET,SOCK_DGRAM,SOL_UDP);
socket_connect($socket,$address,1);
socket_getpeername($socket,$name,$port);
echo "{$name}:{$port}\n"; // 127.0.0.1:1
var_dump(socket_send($socket,'foo',3,0)); // int(3)
var_dump(socket_last_error($socket));

  if (isset($port) and
      ($socket=socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) and
      (socket_connect($socket, $address, $port)))
    {
      $socketClass = new Socket();
      $socketClass->onMessage($socket, 'Test the thunder');

      $text="Connection successful on IP $address, port $port";
      socket_close($socket);
    }
  else
    $text="Unable to connect<pre>".socket_strerror(socket_last_error())."</pre>";

  echo "<html><head></head><body>".
       $text.
       "</body></html>";

  // $sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);

  // $msg = "Ping !";
  // $len = strlen($msg);

  // socket_sendto($sock, $msg, $len, 0, '127.0.0.1', 8080);
  // socket_close($sock);
} catch (Exception $e) {
  echo "ERROR\n\n";
  die($e);
}

// $socket = new Socket();
// $socket->onMessage('Test the message');
