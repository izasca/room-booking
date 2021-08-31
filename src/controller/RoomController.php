<?php

namespace izasca\RoomBooking\Controller;

use izasca\RoomBooking\Model\Room;

class RoomController {

  protected $dbh;

  /**
   * __construct
   */
  public function __construct() {
  }

  /**
   * setDBHandler
   */
  public function setDBHandler ($dbHandler) {
    $this->dbh = $dbHandler;
  }

  /**
   * createRoom
   * 
   * @return room_id
   */
  public function createRoom($room_atr) {
    $room = new Room();
    $room->fill($room_atr);
    $room_id = -1;

    $insert_sql = 'INSERT INTO rooms (name, number, occupant) values (:name, :number, :occupant)';
    try {
      $insert = $this->dbh->prepare($insert_sql);
      $insert->bindParam(':name', $room->name);
      $insert->bindParam(':number', $room->number);
      $insert->bindParam(':occupant', $room->occupant);
      $insert->execute();
      $room_id = $this->dbh->lastInsertId();

    } catch(\PDOException $e) {
      echo '{"error": {"text": '.$e->getMessage().'}';
    }

    return ($room_id);        
  }

  /**
   * updateOccupant
   * 
   * @return boolean
   */
  public function updateOccupant($room_atr) {
    $update_sql = 'UPDATE rooms SET occupant = :occupant WHERE id = :room_id';
    try {
      $update = $this->dbh->prepare($update_sql);
      $update->bindParam(':occupant', $room_atr['occupant']);
      $update->bindParam(':room_id', $room_atr['id']);
      $update->execute();

    } catch(\PDOException $e) {
      return false;
    }

    return true;
  }

  /**
   * deleteRoom
   */
  public function deleteRoom($room_id) {
    $delete_sql = 'DELETE FROM rooms WHERE id = :room_id';
    try {
      $delete = $this->dbh->prepare($delete_sql);
      $delete->bindParam(':room_id', $room_id);
      $delete->execute();

    } catch(\PDOException $e) {
      return false;
    }

    return true;
  }

  /**
   * loadAll
   */
  public function loadAll() {
    $select_sql = 'SELECT * from rooms order by number';
    try {
      $select = $this->dbh->query($select_sql);
      $select->execute();
      $rooms = $select->fetchAll(\PDO::FETCH_OBJ);
    } catch(\PDOException $e) {
        echo '{"error": {"text": '.$e->getMessage().'}';
    }

    return $rooms;
  }

  /**
   * loadByID
   * 
   * @return izasca\RoomBooking\Model\Room
   */
  public function loadByID($room_id) {
    $room = new Room();
    $select_sql = 'SELECT * from rooms where id = :room_id order by number, id';
    try {
      $select = $this->dbh->prepare($select_sql);
      $select->bindParam(':room_id', $room_id);
      $select->execute();
      $room->fill($select->fetch(\PDO::FETCH_ASSOC));
    } catch(\PDOException $e) {
      return null;
    }

    return $room;
 }

}