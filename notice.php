<?php
    $jsonString = file_get_contents('php://input');
    $logFile = "notice.log";
    file_put_contents($logFile, "test", FILE_APPEND);
    file_put_contents($logFile, $jsonString, FILE_APPEND);
    echo "test";
    $jsonObj = json_decode($jsonString);
?>