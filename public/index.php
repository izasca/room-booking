<?php
require '../src/App/init.php';

use Slim\Http\Request as Request;
use Slim\Http\Response as Response;
use izasca\RoomBooking\Controller\RoomController;

$app = new \Slim\App();

$rc = new RoomController();
$rc->setDBHandler($db->getDBH());

$app->options('/{routes:.+}', function ($request, $response, $args) {
  return $response;
});

$app->add(function ($req, $res, $next) {
  $response = $next($req, $res);
  return $response
    ->withHeader('Access-Control-Allow-Origin', '*')
    ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
    ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});

// 1. Ability to create a room with an id, name, number, and occupant
// POST .../api/rooms?name=Room 01&number=1&occupant=Pablo
$app->post('/api/rooms', function(Request $request, Response $response) use ($rc) {
  $name = $request->getParam('name');
  $number = $request->getParam('number');
  $occupant = $request->getParam('occupant');
  $room_atr = array('name' => $name, 'number' => $number, 'occupant' => $occupant);

  $new_id = $rc->createRoom($room_atr);
  
  if ($new_id == -1) {
    return $response->withStatus(400)
      ->withHeader('Content-Type', 'text/html')
      ->write('Something went wrong!');  
  } else {
    $room = $rc->loadByID($new_id);
    return $response->withStatus(200)
      ->withJson($room);
  }
});

// 2. Ability to update a room’s occupant field.
// PUT .../api/rooms/24?occupant=Pablo
$app->put('/api/rooms/{id}', function(Request $request, Response $response) use ($rc) {
  $id = $request->getAttribute('id');
  $occupant = $request->getParam('occupant');

  $room_atr = array('id' => $id, 'occupant' => $occupant);

  if ($rc->updateOccupant($room_atr)) {
    return $response->withStatus(200);  
  } else {
    return $response->withStatus(400)
      ->withHeader('Content-Type', 'text/html')
      ->write('Something went wrong!');  
  }
});

// 3. Ability to delete a room
// DELETE .../api/rooms/24
$app->delete('/api/rooms/{id}', function(Request $request, Response $response) use ($rc) {
  $id = $request->getAttribute('id');

  if ($rc->deleteRoom($id)) {
    return $response->withStatus(200);  
  } else {
    return $response->withStatus(400)
      ->withHeader('Content-Type', 'text/html')
      ->write('Something went wrong!');  
  }
});

// 4. Ability to get a list of all rooms
// GET .../api/rooms
$app->get('/api/rooms', function(Request $request, Response $response) use ($rc) {
  $rooms = $rc->loadAll();
  return $response->withJson($rooms, 200, JSON_PRETTY_PRINT);
});

$app->run();

$rc = null;