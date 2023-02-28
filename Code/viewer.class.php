<?php

class viewer{

  //This function collects queried data via POST method, then renders them into the table created in Home.php.
  //The function filters based on requested parameters.
  function home($conn) {

    //First part of SQL query
      $mysql = "SELECT * 
          FROM customers 
          WHERE ";

          //Add to query for each piece of data
          foreach($_POST as $key=>$value){
              if ($value != '' && $value != 'Submit') {
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
              echo "<tr>";
          echo "<td>" . $row["customer_id"]. "</td>";
          echo "<td>" . $row["salutation"]. "</td>";
          echo "<td>" . $row["customer_first_name"]. "</td>";
          echo "<td>" . $row["customer_middle_initial"]. "</td>";
          echo "<td>" . $row["customer_last_name"]. "</td>";
          echo "<td>" . $row["gender"]. "</td>";
          echo "<td>" . $row["email_address"]. "</td>";
          echo "<td>" . $row["login_name"]. "</td>";
          echo "<td>" . $row["login_password"]. "</td>";
          echo "<td>" . $row["phone_number"]. "</td>";
          echo "<td>" . $row["address"]. "</td>";
          echo "<td>" . $row["town_city"]. "</td>";
          echo "<td>" . $row["county"]. "</td>";
          echo "<td>" . $row["country"]. "</td>";
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
      $mysql = "INSERT INTO customers 
      (customer_id, 
      salutation, 
      customer_first_name, 
      customer_middle_initial,
      customer_last_name,
      gender,
      email_address,
      login_name,
      login_password,
      phone_number,
      address,
      town_city,
      county,
      country) VALUES ('";

      foreach($_POST as $key=>$value){
        if ($value != '' && $value != 'Submit') {
            $mysql .= $value."', '";
        }
      }

      //Delete trailing characters and close parentheses
      $mysql = rtrim($mysql, ", '");
      $mysql .= '\')';

      //Debug
      echo '<br><br>'.$mysql;

      //Run query
      $result = $conn->query($mysql);
    }
}
?>