<?php

if (isset($_FILES['image'])) {
    $targetDirectory = 'app/uploads/'; // Directory to store uploaded images
    $uploadedFile = $_FILES['image'];

    // Check if the file is an image
    $imageFileType = strtolower(pathinfo($uploadedFile['image'], PATHINFO_EXTENSION));
    $allowedExtensions = ['jpeg', 'jpg', 'png', 'gif', 'bmp', 'webp'];

    if (!in_array($imageFileType, $allowedExtensions)) {
        echo 'Invalid file - not an image.';
        exit;
    }

    // Generate a unique filename
    $newFileName = uniqid() . '.' . $imageFileType;
    $targetPath = $targetDirectory . $newFileName;

    // Move the uploaded file to the target directory
    if (move_uploaded_file($uploadedFile['tmp_name'], $targetPath)) {
        // Respond with the image URL (use a full URL for a production environment)
        echo json_encode(['url' => $targetPath]);
    } else {
        echo 'Error uploading the image';
    }
} else {
    echo 'Invalid request';
}

// $data = array();
//     if(isset($_FILES['upload']['name'])){
//         $file_name = $_FILES['upload']['name'];
//         $file_path = "actions/upload/".$file_name;
//         $file_extension = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
        
//         if($file_extension=='jpg' || $file_extension=='jpeg' || $file_extension=='png'){
//             if(move_uploaded_file($_FILES['upload']['tmp_name'], $file_path)){
//                 $data['file']=$file_name;
//                 $data['url']=$file_path;
//                 $data['uploaded']= 1;
//             }else{
//                 $data['uploaded']= 0;
//                 $data['error']['message'] = 'Error! File not uploaded.';
//             }
//         }else{
//             $data['uploaded']= 0;
//             $data['error']['message'] = 'Invalid extension';
//         }
//     }
// echo json_encode($data);
?>
