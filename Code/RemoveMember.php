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
$dbname = "cis411";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$mysql = "SELECT * 
    FROM customers";

$result = $conn->query($mysql);

$viewer = new viewer;

echo "<br><br><div class='container'>
<form action=\"Home.php\" method=\"post\">
  <label for=\"record_id\"></label>
  <label for=\"customer_id\"></ID>
  <label for=\"salutation\"></label>
  <label for=\"customer_first_name\"></label>
  <label for=\"customer_middle_initial\"></label>
  <label for=\"customer_last_name\"></label>
  <label for=\"gender\"></label>
  <label for=\"email_address\"></label>
  <label for=\"login_name\"></label>
  <label for=\"login_password\"></label>
  <label for=\"phone_number\"></label>
  <label for=\"address\"></label>
  <label for=\"town_city\"></label>
  <label for=\"county\"></label>
  <label for=\"country\"></label>
  <button type=\"submit\" name=\"Action\" value=\"Submit\" class=\"button\">Filter</button>
  <button type=\"submit\" class=\"button\" formaction=\"AddMember.php\">Add Member</button>
  <button type=\"submit\" class=\"button\" formaction=\"RemoveMember.php\">Remove Member</button>
  <button type=\"submit\" class=\"button\" formaction=\"EditMember.php\">Edit Information</button>

<table><tr>
<th></th>
<th>ID<br>
<input type=\"integer\" id=\"customer_id\" name=\"customer_id\"<br></th>
<th>Salutation<br>
<input type=\"text\" id=\"salutation\" name=\"salutation\"<br></th>
<th>First Name<br>
<input type=\"text\" id=\"customer_first_name\" name=\"customer_first_name\"><br></th>
<th>Middle Initial<br>
<input type=\"text\" id=\"customer_middle_initial\" name=\"customer_middle_initial\"<br></th>
<th>Last Name<br>
<input type=\"text\" id=\"customer_last_name\" name=\"customer_last_name\"><br></th>
<th>Gender
<input type=\"text\" id=\"gender\" name=\"gender\"<br></th>
<th>Email Address<br>
<input type=\"email_address\" name=\"email_address\"/>
<th>Username<br>
<input type=\"text\" id=\"login_name\" name=\"login_name\"<br></th>
<th>Password<br>
<input type=\"text\" id=\"login_password\" name=\"login_password\"<br></th>
<th>Phone
<input type=\"text\" id=\"phone_number\" name=\"phone_number\"<br></th>
<th>Address
<input type=\"text\" id=\"address\" name=\"address\"<br></th>
<th>City
<input type=\"text\" id=\"town_city\" name=\"town_city\"<br></th>
<th>County
<input type=\"text\" id=\"county\" name=\"county\"<br></th>
<th>Country
<input type=\"text\" id=\"country\" name=\"country\"<br></th>

</form>";

$viewer->removeMember($dbname, $conn);

echo '<br>';
$viewer->home($conn);

?>