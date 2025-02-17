<?php
session_start();

$fileName = $_FILES['userfile']['name'];
$fileSize = $_FILES['userfile']['size'];
$fileTmpName = $_FILES['userfile']['tmp_name'];
$fileType = $_FILES['userfile']['type'];

$errors = [];
$fileExtensionsAllowed = ['jpg', 'png', 'txt', 'docx', 'csv', 'ppt', 'odt', 'pdf', 'zip', 'rar', 'exe', 'svg', 'mp3', 'mp4'];
$filetmp = (explode('.', $fileName));
$fileExtension = strtolower(end($filetmp));
$uploadDirectory = $_SESSION['absolutePath'] . '/' . basename($fileName);

if (!in_array($fileExtension, $fileExtensionsAllowed)) {
  $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
}

if ($fileSize > 4000000) {
  $errors[] = "File exceeds maximum size (4MB)";
}

if (empty($errors)) {
  $didUpload = move_uploaded_file($fileTmpName, $uploadDirectory);
}


if (isset($_SESSION['relativePath'])) {
  $returnPath = $_SESSION['relativePath'];
}

header("Location: index.php?p=$returnPath");