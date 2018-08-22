<!DOCTYPE html>
<Html>
<head>
<link rel="stylesheet" type="text/css" href="../css/log.css">
<link href="https://fonts.googleapis.com/css?family=Indie+Flower|Josefin+Sans|Roboto+Condensed|Shadows+Into+Light|Ubuntu" rel="stylesheet">
<script>
function check() {
var email = document.getElementById("email").value;  
if (email != "") {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                 var msg = this.responseText;
                 document.getElementById("exist").innerHTML = msg;
}};
        xmlhttp.open("GET", "check.php?email=" + email, true);
        xmlhttp.send();
} }
</script>

<?php 
  require_once 'login.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);
  if (isset($_POST['email'])   &&
      isset($_POST['password']))
  {
    $email   = get_post($conn, 'email');
    $password    = get_post($conn, 'password');
    $query    = "INSERT INTO users VALUES" .
      "('$email', '$password')";
    $result   = $conn->query($query);

  	if (!$result) echo "INSERT failed: $query<br>" .
      $conn->error . "<br><br>";
  }

  echo <<<_END
  <form action="log.php" method="post" class="form" >
<pre>
<div>

<input type="email" name="email" id="email" placeholder="email" required="required" onkeyup="check()">
<p style="color:red;"><span id="exist"></span></p>
<input type="password" name="password" placeholder="password" required="required">
<input type="submit" value="submit">
</div>
</pre></form>
_END;

  $query  = "SELECT * FROM users";
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