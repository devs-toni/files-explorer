<?php

session_start();
require_once('utils/utils.php');
$absolutePath = $_SESSION['absolutePath'];
$fileName = $_POST['fileName'];
$oldPath = $absolutePath . '/' . $fileName;
$newPath = './trash/' . $fileName;
$finalName = Utils::chooseName($newPath, $fileName);
Utils::moveFiles($oldPath, './trash/' . $finalName);

$_SESSION['recovers'][$fileName] = $oldPath;
Utils::saveSession(SESSION);
echo json_encode('ok');
?>