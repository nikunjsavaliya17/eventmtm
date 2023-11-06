<?php

use Illuminate\Support\Facades\DB;

function formatDate($date, $format = 'M d, Y h:i A')
{
    if ($date != null) {
        return Carbon\Carbon::parse($date)->format($format);
    }
    return null;
}

function uploadFile($file, $path, $exist_file = null)
{
    $uploadPath = storage_path('app/public/' . $path . '/');
    if (isset($exist_file)) {
        $imagePath = $uploadPath . $exist_file;
        @unlink($imagePath);
    }
    $extension = $file->getClientOriginalExtension();
    $fileName = rand(11111, 99999) . time() . '.' . $extension;
    if (!file_exists($uploadPath)) {
        mkdir($uploadPath, 666, true);
    }
    $file->move($uploadPath, $fileName);
    return $fileName;
}

function getFileUrl($file_name, $path)
{
    return url('storage/' . $path . '/' . $file_name);
}
