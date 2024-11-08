<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles.css">
    <title>Form Submission</title>
</head>

<body>

<?php
    if (isset($_POST['submit']) && (!empty($_FILES['file']['name']))) {
        $file = $_FILES['File'];
        $fileName = $_FILES['File']['name'];
        $fileTmpName = $_FILES['File']['tmp_name'];
        $fileSize = $_FILES['File']['size'];
        $fileError = $_FILES['File']['error'];
        $fileType = $_FILES['File']['type'];

        $fileArray = explode('.', $fileName);
        $fileExt = strtolower(end($fileArray));

        $allowed = array('jpg', 'jpeg', 'png', 'txt', 'pdf');

        if (in_array($fileExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 1000000) {
                    $fileNameNew = uniqid('', true) . '.' . $fileExt;
                    $fileDestination = 'uploads/' . $fileNameNew;
                    // Move the file to the uploads directory
                    if (move_uploaded_file($fileTmpName, $fileDestination)) {
                        $reply = 'File uploaded successfully!';
                    } else {
                        $reply = 'Error moving file to destination';
                    }
                } else {
                    $reply = 'File exceeds maximum allowed size';

                }
            } else {
                $reply = 'Error uploading file';

            }
        } else {
            $reply = 'File type not allowed';

        } echo $reply;
    }
?>

<h1>Your book has the following entries: </h1><br>
<div class="php-container">
    Title: <?php echo $_POST["Title"];?><br>
</div>
<div class="php-container">
    Author: <?php echo $_POST["Author"];?><br>
</div>
<div class="php-container">
    Genre: <?php echo $_POST["Genre"];?><br>
</div>
<div class="php-container">
    Type: <?php $type = isset($_POST['Type']) ? $_POST['Type'] : 'Not specified'; echo $type?><br>
</div>
<div class="php-container">
    Notes: <?php echo !empty($_POST['Notes']) ? $_POST['Notes'] : 'Not Uploaded';?><br>
</div>
<div class="php-container">
    File: <?php echo isset($fileNameNew) ? $fileNameNew : 'Not specified';?>
</div>

</body>
</html>