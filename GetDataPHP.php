<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Obtain data from API with PHP</title>
</head>

<body>
    <?php
    //CURL Library. To obtain information from an API
    $Channel = curl_init();

    //Exact URL from the API which you want the information from
    //IN this case, the API to use is PokeAPI
    $url_API_pokemon = 'https://pokeapi.co/api/v2/pokemon/vulpix';

    //Configuration 
    curl_setopt($Channel, CURLOPT_URL, $url_API_pokemon);
    curl_setopt($Channel, CURLOPT_RETURNTRANSFER,true);

    $response = curl_exec($Channel);

    if (curl_errno($Channel)) {
        $error_msg = curl_error($Channel);
        echo "Error connecting to the API";
    }  
    else{
        curl_close($Channel);

        $pokemon_data = json_decode($response, true);

        echo '<H1>'.$pokemon_data['name']. '</H1>';
        //alt= shows alternative if image is not found
        echo '<img src="'.$pokemon_data['sprites']['front_default'].'" alt="'.$pokemon_data['name'].'"</H1>';
        echo '<img src="'.$pokemon_data['sprites']['back_default'].'" alt="'.$pokemon_data['name'].'"</H1>';
        echo '<ul>';
        echo '<li><strong> Name: </strong>'.$pokemon_data['name'].'</li>';
        echo '<li><strong> Height: </strong>'.$pokemon_data['height'].'</li>';
        echo '<li><strong> Weight: </strong>'.$pokemon_data['weight'].'</li>';
        //using foreach:
        echo '<li><strong> Abilities: </strong></li>';
        echo '<ul>';
        foreach($pokemon_data['abilities'] as $ability){
            echo '<li>'. $ability['ability']['name']. '</li>';
        }
        echo '</ul>';  
        echo '</ul>';
    }   

    //new channel     

    $Channel2 = curl_init();
    
    $url_API_abilities = 'https://pokeapi.co/api/v2/pokemon/pikachu/';

    //Configuration 
    curl_setopt($Channel2, CURLOPT_URL, $url_API_abilities);
    curl_setopt($Channel2, CURLOPT_RETURNTRANSFER,true);

    $response2 = curl_exec($Channel2);

    if (curl_errno($Channel2)) {
        $error_msg = curl_error($Channel);
        echo "Error connecting to the API";
    }  
    else{
        curl_close($Channel2);

        $pokemon_abilities = json_decode($response2, true);

        echo '<H1>'.$pokemon_abilities['name']. '</H1>';
        echo '<img src="'.$pokemon_abilities['sprites']['front_default'].'" alt="'.$pokemon_abilities['name'].'"</H1>';
        echo '<img src="'.$pokemon_abilities['sprites']['back_female'].'" alt="'.$pokemon_abilities['name'].'"</H1>';
        echo '<img src="'.$pokemon_abilities['sprites']['back_shiny'].'" alt="'.$pokemon_abilities['name'].'"</H1>';
        echo '<img src="'.$pokemon_abilities['sprites']['front_default'].'" alt="'.$pokemon_abilities['name'].'"</H1>';
        echo '<img src="'.$pokemon_abilities['sprites']['back_female'].'" alt="'.$pokemon_abilities['name'].'"</H1>';
    }        

    ?>
</body>

</html>