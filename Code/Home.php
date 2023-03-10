<?php

spl_autoload_register(function ($class){ include  $class . '.class.php'; });

echo "<!DOCTYPE html>
<html>
<style>
  table, th, td {
    border: 1px solid white;
    border-collapse: collapse;
    font-family:\"Arial\";
    padding: 15px;
  }

  th {
    background-color: #474747;
    color: white;
  }

  tr {
    border-bottom: 1px solid #ddd;
  }

  tr:nth-child(even) {
    background-color: #cfcfcf;
  }

  tr:hover {background-color: #D6EEEE;}

  ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
    font-size: 100px;
    color: white;
    font-family: arial;
  }

  title {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
  }

  .button {
    background-color: #bfbfbf;
    border: none;
    color: black;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    font-family: Arial;
    margin: 0 auto;
    width: 200px;
    margin: 4px 2px;
    border-radius: 2px;
  }

  .button:hover {
    background-color: #d4d5d6;
    cursor: pointer;
  }

  .container {
    display: inline;
    width: 500px;
    margin: 0 auto;
  }

</style>";

echo "<ul><title>Membership Database</title></ul>";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "members";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$mysql = "SELECT * 
    FROM ledgers";

$result = $conn->query($mysql);

$viewer = new viewer;

$viewer->header();

$viewer->home($conn);

?>