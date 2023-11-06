<?php 

if(isset($_POST['submit'])) {
    // die(
    //     var_dump(
    //         // getimagesize($_FILES['file']['tmp_name'])
    //         // $_FILES['file']
    //     )
    // );

    $dir = 'image/';
    // $targerFile = $dir . md5_file($_FILES['file']['tmp_name']);
    $extenstion = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    $targerFile = $dir . hash('md5',$_FILES['file']['name']) . '.' . $extenstion;

    move_uploaded_file($_FILES['file']['tmp_name'], $targerFile);
    // die($targerFile);
}

$file = fopen("test.txt","w");
echo fwrite($file,"Hello World. Testing!");
fclose($file);

unlink("test.txt");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="file" id="">
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>