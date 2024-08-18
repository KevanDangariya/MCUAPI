<!DOCTYPE html>
<html>
<head>
    <title>MCU</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js"></script>
</head>
<body>

<?php
$name = htmlspecialchars(str_replace(' ', '_', $_GET['name']));
$id = htmlspecialchars($_GET['id']);
// access-token :: put here git hub login acces token 
$json = file_get_contents('https://superheroapi.com/api/{access-token}/search/'.$name);
$dataArray = json_decode( $json, TRUE );

if ($name !== null) {
    // Find the item with the matching ID
    $item = null;
    foreach ($dataArray['results'] as $data) {
        if ($data['id'] == $id) {
            $item = $data;
            break;
        }
    }

    if ($item) {
        // Display the details of the item
        echo '<div class="container-fluid">';
        echo '<div class="col-lg-12 mx-4 fs-1">'.$item['name'].'</div>';
        echo '<div class="d-flex col-lg-12 justify-content-center">';
        echo '<div class="col-lg-4 justify-content-center d-flex">';
        echo '<img src="'.$item['image']['url'].'" alt="'.$item['name'].'" style="width: 90%; height: 90%; border-radius: 20px;">';
        echo '</div>';
        echo '<div class="col-lg-8 px-4">';
        echo '<div class="d-flex col-lg-12">';
        echo '<div class="col-lg-6 box-data">';
        echo '<h2>Powerstats</h2>';
        echo '<div style="display: flex; flex-wrap: wrap;">';
        foreach ($item['powerstats'] as $key => $value) {
            echo '<div class="col-lg-4 d-flex justify-content-center">';
            echo '<div>';
            echo '<div role="progressbar" aria-valuenow="'.$value.'" aria-valuemin="0" aria-valuemax="100" style="--value: '.$value.'"></div>';
            echo '<div class="d-flex justify-content-center">';
            echo '<label for="'.$key.'">'.ucfirst($key).'</label>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
        echo '</div>';
        echo '<div class="col-lg-6 box-data">';
        echo '<h2>Biography</h2>';
        echo '<div>Full Name: '.$item['biography']['full-name'].'</div>';
        echo '<div>Place of Birth: '.$item['biography']['place-of-birth'].'</div>';
        echo '<div>First Appearance: '.$item['biography']['first-appearance'].'</div>';
        echo '<div>Publisher: '.$item['biography']['publisher'].'</div>';
        echo '<div>Alignment: '.$item['biography']['alignment'].'</div>';
        echo '</div>';
        echo '</div>';
        echo '<div class="d-flex col-lg-12">';        
        echo '<div class="col-lg-4 box-data">';
        echo '<h2>Appearance</h2>';
        echo '<div>Gender: '.$item['appearance']['gender'].'</div>';
        echo '<div>Race: '.$item['appearance']['race'].'</div>';
        echo '<div>Height: '.$item['appearance']['height'][0].', '.$item['appearance']['height'][1].'</div>';
        echo '<div>Weight: '.$item['appearance']['weight'][0].', '.$item['appearance']['weight'][1].'</div>';
        echo '<div>Eye Color: '.$item['appearance']['eye-color'].'</div>';
        echo '<div>Hair Color: '.$item['appearance']['hair-color'].'</div>';
        echo '</div>';
        echo '<div class="col-lg-8 box-data">';
        echo '<h2>Work</h2>';
        echo '<div>Occupation: '.$item['work']['occupation'].'</div>';
        echo '<div>Base: '.$item['work']['base'].'</div>';
        echo '</div>';
        echo '</div>';
        echo '<div class="box-data">';
        echo '<h2>Connections</h2>';
        echo '<div>Group Affiliation: '.$item['connections']['group-affiliation'].'</div>';
        echo '<div>Relatives: '.$item['connections']['relatives'].'</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
}
?>
</body>
</html>