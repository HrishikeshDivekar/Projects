<?php

include("db.php");
include("functions.php");

$link_ip =  $_POST['link_ip']; //Takes data from textbox of name="link"
$iframe_ip =  $_POST['iframe_ip']; //Takes data from textbox of name="iframe"
$timer_ip =  $_POST['timer_ip']; //Takes data from textbox of name="timer"

if ($link_ip == null || $iframe_ip == null || $timer_ip == null) {
    echo "<script>alert('Fill complete information');</script>";
} 
else{
    $link = filterLink($link_ip); //Filters the link and removes dynamic link address
    $iframe = filterIframe($iframe_ip); //Filters the iframe info to get YouTube link only
    $iframe = filterLink($iframe); //Filters the iframe retrieved link and removes dynamic link address
    $iframe = '<iframe width="560" height="315" src="' . $iframe . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>';
    //Above iframe=... reassembles the dynamic removed link into the Embed code again
    $timer = getSeconds($timer_ip); //Retreives seconds from input timer

    //Entering data in database table

    $sql = "SELECT * FROM yd WHERE link='$link'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    // 1. Checking whether data exist otherwise UPDATE the values
    if ($row != "") {
        print("<script>alert('Data is already present, timer is UPDATED');</script>");
        // echo "$link<br>$iframe";
        $sql = "UPDATE yd SET timer=$timer WHERE link='$link'";
        mysqli_query($conn, $sql);
    }

    // 2. If data doesn't exist then new data is added
    else {
        print("<script>alert('Data does not exists, added to DB');</script>");
        $sql = "INSERT into yd VALUES('$link','$iframe',$timer);";
        mysqli_query($conn, $sql);
    }
}
