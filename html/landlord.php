<!DOCTYPE html>
<Html>
<head>
<link rel="stylesheet" type="text/css" href="../css/landlord.css">
<link href="https://fonts.googleapis.com/css?family=Indie+Flower|Josefin+Sans|Roboto+Condensed|Shadows+Into+Light|Ubuntu" rel="stylesheet">
<?php 
  require_once 'login.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);
if (isset($_POST['id'])   &&
      isset($_POST['contect_info'])    &&
      isset($_POST['home_type']) &&
      isset($_POST['type'])     &&
      isset($_POST['num_of_rooms'])&&
      isset($_POST['price'])&&
      isset($_POST['lease_length'])&&
      isset($_POST['pet']))
  {
    $id   = get_post($conn, 'id');
    $contect_info    = get_post($conn, 'contect_info');
    $home_type = get_post($conn, 'home_type');
    $type= get_post($conn, 'type');
    $num_of_rooms= get_post($conn, 'num_of_rooms');
    $price= get_post($conn, 'price');
    $lease_length= get_post($conn, 'lease_length');
    $pet= get_post($conn, 'pet');
    $query    = "INSERT INTO rent VALUES" .
      "('$id', '$contect_info', '$home_type', '$type', '$num_of_rooms', '$price', '$lease_length','$pet')";
    $result   = $conn->query($query);

  	if (!$result) echo "INSERT failed: $query<br>" .
      $conn->error . "<br><br>";
  }

  echo <<<_END
  <form action="tenant.php" method="post" class="form" >
<pre>
<div>

<input type="text" name="id" placeholder="Id"><input type="text" name="contect_info" placeholder="Contect information">

<label>
Home type</label><select name="home_type">
                 <option value="house">house</option>
                 <option value="apartment">apartment</option>
                 </select>
<label>
Type</label><select name="type">
            <option value="Entire">Entire home</option>
            <option value="Private room">Private room</option>
            </select>
<label>
Number of rooms for rent </label><select name="num_of_rooms">
                                 <option value="1">1</option>
                                 <option value="2">2</option>
                                 <option value="3">3</option>
                                 <option value="4">4</option>
                                 <option value="5">5</option>
                                 </select>
<label>
Price </label><input type="text" name="price">
<label>
Lease length </label><select name="lease_length">
                     <option value="4 months">4 months</option>
                     <option value="8 months">8 months</option>
                     <option value="1 year">1 year</option>
                     </select>
<label>
Pet friendly </label><select name="pet">
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                     </select>


<input type="submit" value="ADD RECORD">

</div>
</pre></form>
_END;

  $query  = "SELECT * FROM rent";
  $result = $conn->query($query);
  if (!$result) die ("Database access failed: " . $conn->error);

  $rows = $result->num_rows;
echo <<<_END


  
_END;
  $result->close();
  $conn->close();
  
  function get_post($conn, $var)
  {
    return $conn->real_escape_string($_POST[$var]);
  }

?>
</html>