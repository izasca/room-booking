<?php

namespace izasca\RoomBooking\Controller;

use izasca\RoomBooking\Model\Room;

class RoomController {

  /**
   * __construct
   */
  public function __construct() {
  }

  /**
   * createRoom
   */
  public function createRoom($room_atr) {
    $room = new Room();
    $room->fill($room_atr);

    /*
    $sql = "INSERT INTO customers (first_name,last_name,phone,email,address,city,state) VALUES
    (:first_name,:last_name,:phone,:email,:address,:city,:state)";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name',  $last_name);
        $stmt->bindParam(':phone',      $phone);
        $stmt->bindParam(':email',      $email);
        $stmt->bindParam(':address',    $address);
        $stmt->bindParam(':city',       $city);
        $stmt->bindParam(':state',      $state);

        $stmt->execute();

        echo '{"notice": {"text": "Customer Added"}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
    */
        
  }

  /**
   * updateOccupant
   */
  public function updateOccupant($room_atr) {
    // mockup
    return true;

    // TODO implement
  }

  /**
   * deleteRoom
   */
  public function deleteRoom($room_id) {
    // mockup
    return false;

    // TODO implement
  }

  /**
   * loadAll
   */
  public function loadAll() {
    // mockup
    $rooms = array();

    $room = new Room();
    $room->fill(['id' => 1, 'name' => 'Room 01', 'number' => 1, 'occupant' => 'Javier']);
    array_push($rooms, $room);

    $room = new Room();
    $room->fill(['id' => 2, 'name' => 'Room 02', 'number' => 2, 'occupant' => 'Santi']);
    array_push($rooms, $room);

    // TODO implement

    /*
    $sql = "SELECT * FROM customers";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $customers = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($customers);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
    */

    return $rooms;
  }

  /**
   * loadByID
   */
  public function loadByID($room_id) {
    // mockup
    $r = new Room();
    $r->fill(['id' => 1, 'name' => 'Room 01', 'number' => 1, 'occupant' => 'Nobody']);
    return ($r);

    // TODO implement
    /*
    $sql = '
    select * from rooms r
    where r.id = :room_id
    ';
    $res = $this->dbh->prepare($sql);
    $res->bindParam(':room_id', $room_id);
    $res->execute();

    if ($row = $res->fetch()) {
      $this->list[] = $row;
    }

    return $row;
    */
  }

}