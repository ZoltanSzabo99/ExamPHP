<?php
/*
  PHP uses the POST method to recover files which are sent to the server.

  The file download form must have this form :
 */
?>
<form enctype="multipart/form-data" action="#" method="post">
    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
    Sélectionner le fichier : <input name="my-file" type="file" />
    <input type="text" name="lastname">
    <input type="submit" name='send-file' value="Envoyer le fichier" />
</form>

<?php
/*
  The hidden field MAX_FILE_SIZE must be placed before the field input type file.
  Its value represents the maximum file size which is accepted by PHP.
  If the user tries to send a bigger file, his browser will prevent it.

  Once the form submitted, we will find in the $_FILES array informations about the downloaded file.

  In this example, we will be able to access the following boxes:
 */

$_FILES['my-file']['name']; // Name of the file (orignal) 
$_FILES['my-file']['type']; // Type of file (example : image/png)
$_FILES['my-file']['size']; // File size in octets
$_FILES['my-file']['tmp_name']; // Temporary name of the file on the server
$_FILES['my-file']['error']; // Potential error

/*
  Downloaded files are placed in the temporary directory on the server.
  This temporary directory can be configured in the php.ini file, by changing the value of upload_tmp_dir
  These files must then be moved to the desired directories.
  This is done using the function move_uploaded_file ()
 */

$destinationDir = '/uploads/';
$destinationFilePath = $destinationDir . basename($_FILES['my-file']['name']);
// basename() return the name of the file without the full path of the directory and so on
if ($_FILES['my-file']['error'] != UPLOAD_ERR_OK) {
    echo 'Erreur lors du téléchargement.';
    die();
}

/*
  Once the file is downloaded, you can run tests to check if it is good according to the desired format.
  For example, we can read the contents of $ _FILES ['my-file'] ['size'] to obtain the size, and check that the file weighs at least 1 byte
 */
// Check if everything went well
if (move_uploaded_file($_FILES['my-file']['tmp_name'], $destinationFilePath)) {
    echo 'Le fichier a été téléchargé.';
} else {
    echo 'Erreur lors de l\'enregistrement.';
}

/*


Points to keep in mind regarding the security of uploads:
  - Allow file upload only to registered users
  - Always check the file name that is sent to the server
 */

// array_search will return the matchin key of the value in argument. Otherwise it returns false.
$extFoundInArray = array_search(
    $_FILES['file']['type'], array(
        'jpg' => 'image/jpeg',
        'png' => 'image/png',
        'gif' => 'image/gif',
    )
);
if ($extFoundInArray === false) {
    echo 'Le fichier n\'est pas une image';
    die();
}

/*
  It's a good practice to rename the file send by user : 
  that way server vulnerability can't be used


 */
$path = './uploads/' . sha1_file($_FILES['upfile']['tmp_name']) . '.' . $extFoundInArray;
$moved = move_uploaded_file($_FILES['upfile']['tmp_name'], $path);
if (!$moved) {
    echo 'Erreur lors de l\'enregistrement';
}
// sha1_file return the hash of the content of the file

// Give it a dynamical name each time
$shaFile = sha1_file($_FILES['upfile']['tmp_name']);
$nbFiles = 0;
do {
    $path = './uploads/' . $shaFile . '-' . $nbFiles . '.' . $extFoundInArray;
    $nbFiles++;
} while(file_exists($path));

$moved = move_uploaded_file($_FILES['upfile']['tmp_name'], $path);
if (!$moved) {
    echo 'Erreur lors de l\'enregistrement';
}

?>