<?php
$posts = json_decode(file_get_contents('posts.json'), true);
foreach ($posts as &$post) {
    $post['image'] = 'downloaded_images/' . basename($post['image']); // Update the folder name
}

header('Content-Type: application/json');
echo json_encode($posts);
?>
