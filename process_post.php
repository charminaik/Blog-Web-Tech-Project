<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image = $_FILES['image'];

    // Handle image upload
    $targetDir = 'downloaded_images/'; // Folder where images will be moved
    $targetFile = $targetDir . basename($image['name']);

    // Move the uploaded file to the designated folder
    if (move_uploaded_file($image['tmp_name'], $targetFile)) {
        // Save post details to a file or database
        $data = [
            'title' => $title,
            'content' => $content,
            'image' => $targetFile // Save the file path to retrieve later
        ];

        // Save to a JSON file for example
        $posts = [];
        if (file_exists('posts.json')) {
            $posts = json_decode(file_get_contents('posts.json'), true);
        }
        $posts[] = $data;
        file_put_contents('posts.json', json_encode($posts));

        // Redirect to home page after submission
        header('Location: index.html');
        exit;
    } else {
        // If file move fails, display an error or take necessary action
        echo "File upload failed.";
    }
}
?>
