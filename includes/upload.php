<?php

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

function handleImageUpload($file, $type) {
    $uploadDir = __DIR__ . '/../uploads/';
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($file['type'], $allowedTypes)) {
        return [
            'success' => false,
            'message' => 'Invalid file type. Only JPG, PNG and GIF are allowed.'
        ];
    }

    $maxFileSize = 5 * 1024 * 1024; // 5MB
    if ($file['size'] > $maxFileSize) {
        return [
            'success' => false,
            'message' => 'File is too large. Maximum size is 5MB.'
        ];
    }

    $fileName = $type . '_' . time() . '_' . basename($file['name']);
    $targetFile = $uploadDir . $fileName;

    if (move_uploaded_file($file['tmp_name'], $targetFile)) {
        return [
            'success' => true,
            'path' => 'modules/addons/gameservers/uploads/' . $fileName
        ];
    }

    return [
        'success' => false,
        'message' => 'Failed to upload file.'
    ];
}
