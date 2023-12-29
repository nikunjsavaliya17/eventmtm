<?php

use Illuminate\Support\Facades\File;

function formatDate($date, $format = 'd M, Y h:i A'): ?string
{
    if ($date != null) {
        return Carbon\Carbon::parse($date)->format($format);
    }
    return null;
}

function uploadFile($file, $path, $exist_file = null, $dimensions = []): string
{
    if (isset($exist_file)) {
        removeFile($exist_file, $path);
    }
    $extension = $file->getClientOriginalExtension();
    $fileName = rand(11111111, 99999999).time() . '.' . $extension;
    $uploadPath = storage_path('app/public/' . $path . '/');

    $file->move($uploadPath, $fileName);
    return $fileName;
}

function removeFile($exist_file, $path): string
{
    $uploadPath = storage_path('app/public/' . $path . '/');
    $imagePath = $uploadPath . $exist_file;
    @unlink($imagePath);
    return true;
}

function fileExist($file_name, $path): bool
{
    return File::exists(storage_path('app/public/' . $path . '/') . $file_name);
}

function getFileUrl($file_name, $path): string|\Illuminate\Contracts\Routing\UrlGenerator|\Illuminate\Contracts\Foundation\Application
{
    return url('storage/' . $path . '/' . $file_name);
}

function formatAmount($amount): string
{
    return '₹ '.number_format($amount, 2);
}

function getNameInitials($name): string
{
    $letters = explode(' ', $name);
    return ucfirst(substr($letters[0], 0, 1));
}

function generateInvoiceId($order_id): string
{
    if (date('m') <= 3) {
        $financial_year = (date('y') - 1) . '' . date('y');
    } else {
        $financial_year = date('y') . '' . (date('y') + 1);
    }
    $last_no = ($order_id < 10) ? '0'.$order_id : $order_id;
    return 'CSPL'.$financial_year.$last_no;
}

function getIndianCurrency(float $number): string
{
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'One', 2 => 'Two',
        3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
        7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
        10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
        13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
        16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
        19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
        40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
        70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
    $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
    while ($i < $digits_length) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . $plural . ' ' . $hundred : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural . ' ' . $hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
}
