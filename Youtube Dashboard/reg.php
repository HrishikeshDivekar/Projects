<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function limitNumber(input, maxLength) {
  let value = input.value;

  // For number inputs, convert to string first
  value = String(value);

  if (value.length > maxLength) {
    input.value = value.slice(0, maxLength);
  }

  // Optional character count
  const charCountSpan = document.getElementById("charCount");
  if (charCountSpan) {
    charCountSpan.textContent = input.value.length + "/" + maxLength;
  }
}
    </script>
</head>

<body>
    <div align="center">
        <form action="reg.php" method="post">
            <table>
                <tr>
                    <td align="center">
                        <namer id="link"><b>🔗</b>Link</namer><br>
                        <textarea name="link_ip" rows="8" cols="50"></textarea>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <namer id="iframe"><b>🎞️</b>iFrame Metadata</namer><br>
                        <textarea  name="iframe_ip" rows="8" cols="50"></textarea>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <namer id="timestamp"><b>⌛</b>Timestamp</namer><br>
                        <input type="number" name="timer_ip" id="timer" size="10"
                            title="Skip : in TIMESTAMP. Ex- 12:00:00 = 120000" oninput="limitNumber(this, 6)">
                    </td>
                </tr>
                <tr>
                    <td align="center"><br><input type="submit" value="Save" id="save" ></td>
                </tr>
            </table>
        </form>
</div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
</body>

</html>

<?php


include("db.php");
include("functions.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
$link_ip =  $_POST['link_ip']; //Takes data from textbox of name="link"
$iframe_ip =  $_POST['iframe_ip']; //Takes data from textbox of name="iframe"
$timer_ip =  $_POST['timer_ip']; //Takes data from textbox of name="timer"

if($link_ip==null || $iframe_ip==null || $timer_ip==null){
    // echo "<script>alert('Fill complete information');</script>";
}
else{
$link = filterLink($link_ip); //Filters the link and removes dynamic link address
$iframe = filterIframe($iframe_ip); //Filters the iframe info to get YouTube link only
$iframe = filterLink($iframe); //Filters the iframe retrieved link and removes dynamic link address
$iframe = '<iframe width="560" height="315" src="'.$iframe.'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>';
//Above iframe=... reassembles the dynamic removed link into the Embed code again
$timer = getSeconds($timer_ip); //Retreives seconds from input timer

//Entering data in database table

$sql = "SELECT * FROM yd WHERE link='$link'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
// 1. Checking whether data exist otherwise UPDATE the values
if($row!=""){
    echo "<script>alert('Data is already present, timer is UPDATED');</script>";
    // echo "$link<br>$iframe";
    $sql = "UPDATE yd SET timer=$timer WHERE link='$link'";
    mysqli_query($conn,$sql);
}

// 2. If data doesn't exist then new data is added
else{
    echo "<script>alert('Data does not exists, added to DB');</script>";
    $sql = "INSERT into yd VALUES('$link','$iframe',$timer);";
    mysqli_query($conn,$sql);
}
}
}
?>