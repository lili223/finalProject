<!DOCTYPE html>
<Html>
<head>
<script language="javascript" type="text/javascript" src="../js/select.js">
</script>
<link rel="stylesheet" type="text/css" href="../css/tenant.css">
</head>
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
      "('$id', '$contect_info', '$home_type', '$type', '$num_of_rooms', '$price', '$lease_length','$pet' )";
    $result   = $conn->query($query);

  	if (!$result) echo "INSERT failed: $query<br>" .
      $conn->error . "<br><br>";
  }

  $query  = "SELECT * FROM rent";
  $result = $conn->query($query);
  if (!$result) die ("Database access failed: " . $conn->error);

  $rows = $result->num_rows;
echo <<<_END

<form action="tenant.php" method="post">
<div ></div>
<table id="store">
<thead>
<tr> 
  <th>id</th>     
  <th>contect information</th>     
  <th>home type<select name="home_type" id="home_type" onchange="onSearch(this)" value="" >
                 <option value=""></option>
                 <option value="house">house</option>
                 <option value="apartment">apartment</option>
                 </select></th>     
  <th>type<select name="type" id="type" onchange="ontype(this)" value="" >
<option value=""></option>
            <option value="Entire">Entire home</option>
            <option value="Private room">Private room</option>
            </select></th>    
  <th>number of rooms<select name="num_of_rooms" id="num_of_rooms" onchange="onnum(this)" value="" >
<option value=""></option>
                                 <option value="1">1</option>
                                 <option value="2">2</option>
                                 <option value="3">3</option>
                                 <option value="4">4</option>
                                 <option value="5">5</option>
                                 </select></th>
  <th>$/month</th>  
  <th>lease length<select name="lease_length" id="lease_length" onchange="onlen(this)" value="" >
<option value=""></option>
                     <option value="4 months">4 months</option>
                     <option value="8 months">8 months</option>
                     <option value="1 year">1 year</option>
                     </select></th>
  <th>pet friendly<select name="pet" id="pet" onchange="onpet(this)" value="" >
<option value=""></option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                     </select></th>
</tr>
</thead>
_END;
  for ($j = 0 ; $j < $rows ; ++$j)
  {
    $result->data_seek($j);
    $row = $result->fetch_array(MYSQLI_NUM);

    echo <<<_END


<tbody>
<tr> 
<td> $row[0] </td>
<td> $row[1] </td>
<td> $row[2] </td>
<td> $row[3] </td>
<td> $row[4] </td>
<td> $row[5] </td>
<td> $row[6] </td>
<td> $row[7] </td>
</tr>   

_END;
  }
echo <<<_END
 </table> 
</form>
_END;
  $result->close();
  $conn->close();
  
  function get_post($conn, $var)
  {
    return $conn->real_escape_string($_POST[$var]);
  }

?>

<?php
$title = $_POST['title']; 

echo $html;
exit;
?>
</html>
