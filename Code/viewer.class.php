<?php

class viewer{

  //This function displays table header information as well as form info
  function header() {
    echo "<br><br><div class='container'>
    <form action=\"Home.php\" method=\"post\">
      <label for=\"record_id\"></label>
      <label for=\"member_id\"></ID>
      <label for=\"last_name\"></label>
      <label for=\"first_name\"></label>
      <label for=\"full_name\"></label>
      <label for=\"email\"></label>
      <label for=\"phone_number\"></label>
      <label for=\"receipt\"></label>
      <label for=\"amount\"></label>
      <label for=\"renewalDate\"></label>
      <label for=\"level\"></label>
      <label for=\"reason\"></label>

      <button type=\"submit\" name=\"Action\" value=\"Submit\" class=\"button\">Filter</button>
      <button type=\"submit\" class=\"button\" formaction=\"AddMember.php\">Add Member</button>
      <button type=\"submit\" class=\"button\" formaction=\"RemoveMember.php\">Remove Member</button>
      <button type=\"submit\" class=\"button\" formaction=\"EditMember.php\">Edit Information</button>

    <table><tr>
    <th></th>
    <th>ID<br>
    <input type=\"integer\" id=\"member_id\" name=\"member_id\"<br></th>
    <th>Last Name<br>
    <input type=\"text\" id=\"last_name\" name=\"last_name\"<br></th>
    <th>First Name<br>
    <input type=\"text\" id=\"first_name\" name=\"first_name\"><br></th>
    <th>Full Name<br>
    <input type=\"text\" id=\"full_name\" name=\"full_name\"<br></th>
    <th>Email<br>
    <input type=\"text\" id=\"email\" name=\"email\"><br></th>
    <th>Phone<br>
    <input type=\"text\" id=\"phone_number\" name=\"phone_number\"<br></th>
    <th>Receipt<br>
    <input type=\"text\" id=\"receipt\" name=\"receipt\"/>
    <th>Amount<br>
    <input type=\"text\" id=\"amount\" name=\"amount\"<br></th>
    <th>renewalDate<br>
    <input type=\"text\" id=\"renewalDate\" name=\"renewalDate\"<br></th>
    <th>Level<br>
    <input type=\"text\" id=\"level\" name=\"level\"<br></th>
    <th>Reason<br>
    <input type=\"text\" id=\"reason\" name=\"reason\"<br></th>

    </form>";
  }

  //This function collects queried data via POST method, then renders them into the table created in Home.php.
  //The function filters based on requested parameters.
  function home($conn) {

    //First part of SQL query
      $mysql = "SELECT * 
          FROM ledgers 
          WHERE ";

          //Add to query for each piece of data
          foreach($_POST as $key=>$value){
              if ($value != '' && $value != 'Submit' && $key != 'record_id') {
                  $mysql .= $key.= "= '$value' AND ";
              }
          }

      //Finish sql statement, limit records to 100.
      $mysql .= "2=2 LIMIT 100";
      
      //Debug
      echo $mysql."<br><br><br><br><br>";
      
      //Run query
      $result = $conn->query($mysql);

      //Display data in HTML table rows
      if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
              echo "<tr>
              <td>
              <input type=\"radio\" id=\"record_id\" name=\"record_id\" value=\"" . $row["member_id"]."\">
              <br>
              </td>";
          echo "<td>" . $row["member_id"]. "</td>";
          echo "<td>" . $row["last_name"]. "</td>";
          echo "<td>" . $row["first_name"]. "</td>";
          echo "<td>" . $row["full_name"]. "</td>";
          echo "<td>" . $row["email"]. "</td>";
          echo "<td>" . $row["phone_number"]. "</td>";
          echo "<td>" . $row["receipt"]. "</td>";
          echo "<td>" . $row["amount"]. "</td>";
          echo "<td>" . $row["renewalDate"]. "</td>";
          echo "<td>" . $row["level"]. "</td>";
          echo "<td>" . $row["reason"]. "</td>";
          echo "</tr>";"
          }
      } else {
          echo '0 results'";
        }
      }
    }

    //addMember needs every field filled in to function properly.
    //If it has every required field, it creates a new record with the data passed via POST.
    function addMember($name, $conn) {
      // Check if all required fields are present
      $required_fields = array('member_id', 'last_name', 'first_name', 'full_name', 'email', 'phone_number', 'receipt', 'amount', 'renewalDate', 'level', 'reason');
      foreach($required_fields as $field){
          if(!isset($_POST[$field]) || $_POST[$field] == ''){
              echo "Error: $field is required.";
              return;
          }
      }
  
      // All required fields are present, insert new record
      $mysql = "INSERT INTO ledgers 
          (member_id,
          last_name,
          first_name,
          full_name,
          email,
          phone_number,
          receipt,
          amount,
          renewalDate,
          level,
          reason) VALUES ('";
  
      foreach($_POST as $key=>$value){
          if ($value != '' && $value != 'Submit' && $key != 'record_id') {
              $mysql .= $value . "', '";
          }
      }
  
      $mysql = rtrim($mysql, "', '");
      $mysql .= "')";
  
      if ($conn->query($mysql) === TRUE) {
          echo "New record created successfully";
      } else {
          echo "Error: " . $mysql . "<br>" . $conn->error;
      }
  }
  

    function removeMember($name, $conn) {
      $mysql = "DELETE FROM ledgers WHERE member_id=";

        foreach($_POST as $key=>$value){
          //Add record id to DELETE query
          if ($key == 'record_id') {
              $mysql .= $value;
          }
        }
     
      //Debug
      echo $mysql."<br><br><br><br><br>";
      
      //Run query
      $result = $conn->query($mysql);
    }

    function editMember($name, $conn) {
      $mysql = "UPDATE ledgers SET ";

      foreach($_POST as $key=>$value){
        if ($value != '' && $value != 'Submit' && $key != 'record_id') {
            $mysql .= $key." = '".$value."', ";
        }
      }

      //Delete trailing characters
      $mysql = rtrim($mysql, ", ");

      //Where condition
      $mysql .= "WHERE member_id=";
        foreach($_POST as $key=>$value){
          //Loop through POSTed values to find customer id
          if ($key == 'record_id') {
              $mysql .= $value;
          }
        }
      //Debug
      echo '<br><br>'.$mysql;

      //Run query
      $result = $conn->query($mysql);
    }
}
?>
