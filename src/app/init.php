<?php

require '../vendor/autoload.php';

use izasca\RoomBooking\App\Database;

// loading .env.local file with env variables
$dotenv = Dotenv\Dotenv::createImmutable(dirname(dirname(__DIR__)), '.env.local');
$dotenv->load();

// connecting to DB
$db_settings = array(
  'db-host' => getenv('DB_HOST'),
  'db-name' => getenv('DB_DATABASE'),
  'db-user' => getenv('DB_USERNAME'),
  'db-pass' => getenv('DB_PASSWORD')
);
$db = new Database($db_settings);
$db->connect();