<?php
include("db.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="dashboard.css"> -->
    <style>
        body{
    background: linear-gradient(90deg, rgba(0,0,0) 0%, rgba(121,9,9,1) 1%, rgba(255,132,0,1) 100%);
    overflow-x: hidden;
    display: flex; 
    flex-wrap: wrap;
    gap: 30px;      
    padding: 20px;
    padding-left: 135px;
}
#dynamic{
    background: linear-gradient(90deg, rgba(2,0,36,1) 20%, rgb(255, 60, 0) 300%, orange 100%);
    border: 2px hidden rgb(1, 1, 58);
    display: flex;
    width: fit-content;
    border-radius: 8px;
    padding-bottom: 2px;
    display: flex; /* Enables flexbox layout */
    flex-wrap: wrap; /* Allows items to wrap onto the next line */
    gap: 10px;      /* Adds spacing between the divs */
    padding: 20px;
}
input{
    padding: 10px;
    border-radius: 15px;
    background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgb(255, 60, 0) 0%, orange 100%) ;
    border: 1px groove chocolate;
    font-weight: 600;
    margin-top: 10px;
}
iframe{
    border-radius: 8px;
}
    </style>
</head>
<body>
</body>
</html>

<?php

$sql = "SELECT * from yd;";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)){
    $iframe = $row["iframe"];
    $link = $row['link'];
    $timer = $row['timer'];
    $url = "$link&t=$timer";
    echo "
    <div id='dynamic'>
        <table>
            <tr>
                <td>
                    $iframe
                </td>
            </tr>
            <tr>
                <td align='center'>
                    <a href='$url' target='_blank' align='center'><input type='button'
                            value='Go to Video'></a>
                </td>
            </tr>
        </table>
    </div>
    ";
}

?>