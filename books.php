<?php

require "vendor/autoload.php";

use GuzzleHttp\Client;

function getBooks() {
    $token = 'aedeec30db6207585290f2b091b4a59eb50cc4fdca5b3feb763245c2458289f3eaee469c3d1a7de59a22375753ac297d1cc17a5b8a6da31526da2b39e02121cf0a36c4c2f62368d7f6408360f337256ba4799f283d6a1b53a4c66e5b5daf59e7c7c5a42de54d5308d25ec96f13cc154c4651634b35c7a182538213fed62f8d3f';

    $client = new Client([
        'base_uri' => 'http://localhost:1337/api/',
    ]);

    $headers = [
        'Authorization' => 'Bearer ' . $token,        
        'Accept'        => 'application/json',
    ];

    $response = $client->request('GET', 'books?pagination[pageSize]=66', [
        'headers' => $headers
    ]);

    $body = $response->getBody();
    $decoded_response = json_decode($body);
    return $decoded_response;
}

$books = getBooks();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <title>Scriptures Books List from Strapi</title>

</head>
<body>
    <div class="container">
        <h1>Scriptures Books List from Strapi</h1>
        <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Author</th>
                        <th scope="col">Category</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach($books->data as $bookData){ 
                    $book = $bookData->attributes;?>
                    <tr>
                        <th scope="row"><?php echo $bookData->id?></th>
                        <td><?php echo $book->name ?></td>
                        <td><?php echo $book->author?></td>
                        <td><?php echo $book->category?></td>
                    </tr>
                    <?php }?>
                </tbody>
        </table>
    </div>
</body>
</html>