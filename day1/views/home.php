<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   
    
<form action="" method="post" >
<select name="cityid" > 
  


    <?php

// var_dump($cities_name);

foreach ( $eg_cities as $city ) 
{
    
    // echo($name);

   echo "<option value='{$city["id"]}'>{$city["name"]}</option>";}

?>
 </select>
<input type="submit">

   
    </form>
</body>
</html>

