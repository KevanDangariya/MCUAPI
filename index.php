<!DOCTYPE html>
<html>
    <head>
        <title>MCU</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" />
        <link rel="stylesheet" href="./style.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js"></script>
    </head>
    <body class="container">
        <form method="post" action="" style="margin: 20px;">
            <div class="col-lg-12">
                <label for="" class="col-lg-1">Super Hero: </label>
                <input type="text" name="name" id="name" placeholder="Enter Superhero name.." class="col-lg-8" style="padding-left: 10px;">
            </div>
            <input type="submit" class="btn btn-primary">
        </form>
        
        <div id="json_data">
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name'])) {
                
                $name = htmlspecialchars(str_replace(' ', '_', $_POST['name']));
                // access-token :: put here git hub login acces token 
                $json = file_get_contents('https://superheroapi.com/api/{access-token}/search/'.$name);
                $jsonData = json_decode( $json, TRUE );
                
                // Check if the extra section and json_data exist
                if (!empty($jsonData['results'])) {
                    for ($i=0; $i < sizeof($jsonData['results']); $i++) { 
                        echo '<a href="detail.php?name='.$jsonData['results'][$i]['name'].'&id='.$jsonData['results'][$i]['id'].'" style="margin: 10px;"><img src="'.$jsonData['results'][$i]['image']['url'].'" alt="Italian Trulli" class="img"></a>';
                    }
                } else {
                    echo 'no data found';
                }
            }
        ?>
    </div>
</body>
</html>
