<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../css/log.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="../css/form.css" >
<script> function showHint() {
var email = document.getElementById("email").value;
var pwd = document.getElementById("pwd").value;  
if (pwd != "") {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                 var msg = this.responseText;
                 document.getElementById("txtHint").innerHTML = msg;
}};
        xmlhttp.open("GET", "getinfo.php?email=" + email+"&pwd="+pwd, true);
        xmlhttp.send();
} }
function validate_matching(){
var str = document.getElementById("signal").value;
var res = str.substring(1, 2);
if ( res == "k")
{return true;}
else
{ //event.preventDefault() in onsubmit event very important to turn on "return false;" //for some browsers
event.preventDefault();
return false;
}}

 </script>
<body>
<div>
<form action="home.html" method="POST" onsubmit=" validate_matching();">
<!– creating 2 forms, for singin and signup
<div>
 <label for="email">Email</label>
<input type="email" name="email" id="email">
</div>
<div>
    <label for="pwd">Password</label>
<input type="password" id="pwd" name="pwd" onkeyup="showHint()">
</div>
<p><span id="txtHint"></span></p>
<div>
  <input type="submit" value="login" \> 
</div>
</form>
<div>
<p><a href="create.php">Create a new account </a></p>
</div>
</body>
</html>
