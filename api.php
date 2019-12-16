<?php

require('vendor/autoload.php');

use WebSocket\Client;
try {
  $client = new Client("ws://localhost:8080");
  $client->send("Hello WebSocket.org!");
} catch (Exception $e) {
  echo "ERROR\n\n";
  die($e);
}
