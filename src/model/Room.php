<?php

namespace izasca\RoomBooking\Model;

class Room {

  public $id;
  public $name;
  public $number;
  public $occupant;

  /**
   * __construct
   */
  public function __construct() {
  }

  /**
   * fill
   */
  public function fill ( $room_atr ) {
    array_key_exists('id', $room_atr) ? $this->id = $room_atr['id'] : $this->id = -1;
    array_key_exists('name', $room_atr) ? $this->name = $room_atr['name'] : $this->name = 'NoNameRoom';
    array_key_exists('number', $room_atr) ? $this->number = $room_atr['number'] : $this->number = 1;
    array_key_exists('occupant', $room_atr) ? $this->occupant = $room_atr['occupant'] : $this->occupant = '';
  }

}