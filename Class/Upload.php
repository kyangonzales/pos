<?php
    function upload($file) {
        $target_dir = "./uploads/_pic".uniqid();
        $target_file = $target_dir . basename($file['name']);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["file"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
                die();
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
                die();
            }
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
            die();
        }

        // Check file size
        if ($file["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
            die();
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            return "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            // "The file ". htmlspecialchars( basename( $file["name"])). " has been uploaded.";
            return $target_file;
        } else {
            //"Sorry, there was an error uploading your file.";
            return false;
        }
        }
    }
?>