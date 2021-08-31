<?php 

namespace izasca\RoomBooking\App;

use PDO;
use PDOException;
use Exception;

class Database {

  private $settings;
	private $db;

	public function __construct($settings) {	
    $this->settings = $settings;
  }

  public function connect() {
    try {
      $this->db = new PDO('mysql:host='.$this->settings['db-host'].';dbname='.$this->settings['db-name'], $this->settings['db-user'], $this->settings['db-pass']);

      $this->db->setAttribute(PDO::ATTR_PERSISTENT, true);
      $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
      $this->db->exec("set names utf8");

    } catch (PDOException $exception) {
      error_log ('PDOException='.$exception);

    } catch (Exception $exception) {
      error_log ('Exception='.$exception);
    }
  }

  public function getDBH() {
    return ($this->db);
  }

}

?>