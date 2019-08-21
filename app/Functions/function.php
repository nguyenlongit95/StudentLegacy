<?php
/**
 * Created by PhpStorm.
 * User: nguyenlongit95
 * Date: 2/22/18
 * Time: 4:36 PM.
 */

// Mở composer.json
// Thêm vào trong "autoload" chuỗi sau
// "files": [
//         "app/function/function.php"
// ]

// Chạy cmd : composer dumpautoload
// ---------------------------------------------------------------
/*
 * Tại đây viết các phương thức đơn lẻ
 * Các phương thức bổ sung thêm cho các chức năng của website
 *  - Hạn chế số lượng ký tự hiển thị trong tiel của bài viết
 *  - Hạn chế số lượng ký tự hiển thị trong phần ìnfo của bài viết
 * */

function helloworld()
{
    echo 'Hello world';
}

// Đổi chuỗi bình thuường thành chuỗi không dấu
function changeTitle($str, $strSymbol = '-', $case = MB_CASE_LOWER)
{// MB_CASE_UPPER / MB_CASE_TITLE / MB_CASE_LOWER
    $str = trim($str);
    if ($str == '') {
        return '';
    }
    $str = str_replace('"', '', $str);
    $str = str_replace("'", '', $str);
    $str = stripUnicode($str);
    $str = mb_convert_case($str, $case, 'utf-8');
    $str = preg_replace('/[\W|_]+/', $strSymbol, $str);

    return $str;
}
function stripUnicode($str)
{
    if (!$str) {
        return '';
    }
    //$str = str_replace($a, $b, $str);
    $unicode = array(
        'a' => 'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ|å|ä|æ|ā|ą|ǻ|ǎ',
        'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ|Å|Ä|Æ|Ā|Ą|Ǻ|Ǎ',
        'ae' => 'ǽ',
        'AE' => 'Ǽ',
        'c' => 'ć|ç|ĉ|ċ|č',
        'C' => 'Ć|Ĉ|Ĉ|Ċ|Č',
        'd' => 'đ|ď',
        'D' => 'Đ|Ď',
        'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|ë|ē|ĕ|ę|ė',
        'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ|Ë|Ē|Ĕ|Ę|Ė',
        'f' => 'ƒ',
        'F' => '',
        'g' => 'ĝ|ğ|ġ|ģ',
        'G' => 'Ĝ|Ğ|Ġ|Ģ',
        'h' => 'ĥ|ħ',
        'H' => 'Ĥ|Ħ',
        'i' => 'í|ì|ỉ|ĩ|ị|î|ï|ī|ĭ|ǐ|į|ı',
        'I' => 'Í|Ì|Ỉ|Ĩ|Ị|Î|Ï|Ī|Ĭ|Ǐ|Į|İ',
        'ij' => 'ĳ',
        'IJ' => 'Ĳ',
        'j' => 'ĵ',
        'J' => 'Ĵ',
        'k' => 'ķ',
        'K' => 'Ķ',
        'l' => 'ĺ|ļ|ľ|ŀ|ł',
        'L' => 'Ĺ|Ļ|Ľ|Ŀ|Ł',
        'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|ö|ø|ǿ|ǒ|ō|ŏ|ő',
        'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ|Ö|Ø|Ǿ|Ǒ|Ō|Ŏ|Ő',
        'Oe' => 'œ',
        'OE' => 'Œ',
        'n' => 'ñ|ń|ņ|ň|ŉ',
        'N' => 'Ñ|Ń|Ņ|Ň',
        'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|û|ū|ŭ|ü|ů|ű|ų|ǔ|ǖ|ǘ|ǚ|ǜ',
        'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự|Û|Ū|Ŭ|Ü|Ů|Ű|Ų|Ǔ|Ǖ|Ǘ|Ǚ|Ǜ',
        's' => 'ŕ|ŗ|ř',
        'R' => 'Ŕ|Ŗ|Ř',
        's' => 'ß|ſ|ś|ŝ|ş|š',
        'S' => 'Ś|Ŝ|Ş|Š',
        't' => 'ţ|ť|ŧ',
        'T' => 'Ţ|Ť|Ŧ',
        'w' => 'ŵ',
        'W' => 'Ŵ',
        'y' => 'ý|ỳ|ỷ|ỹ|ỵ|ÿ|ŷ',
        'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ|Ÿ|Ŷ',
        'z' => 'ź|ż|ž',
        'Z' => 'Ź|Ż|Ž',
    );
    foreach ($unicode as $khongdau => $codau) {
        $arr = explode('|', $codau);
        $str = str_replace($arr, $khongdau, $str);
    }

    return $str;
}

/*
 * Phuong thuc lay du lieu tu 1 file
 * $file la duong dan vat ly toi file
 * $conver_to_array la: chuyen doi du lieu doc duoc sang dang mang(array)
 * */
function get_file_data($file, $convert_to_array = true)
{
    $file = @file_get_contents($file);
    if (!empty($file)) {
        if ($convert_to_array) {
            return json_decode($file, true);
        }

        return $file;
    }

    return false;
}
///////////////////////////////////////////////////////////
///
/// ///////////////////////////////////////////////////////

/*
 * function cat chuoi, han che so luong ky tu trong 1 chuoi
 * Tham so truyen vao gom chuoi ky tu va so luong chu toi da
 * Ky tu thua se bien thanh dau ...
 * $text la: chuoi ky tu truyen vao
 * $num la: so luong ky tu toi da co the hien thi
 * */
function trimText($text, $num = 15)
{
    if (strlen($text) <= $num) {
        return $text;
    }
    $text = substr($text, 0, $num);
    if ($text[$num - 1] == ' ') {
        return trim($text).'...';
    }
    $x = explode(' ', $text);
    $sz = sizeof($x);
    if ($sz <= 1) {
        return $text.'...';
    }
    $x[$sz - 1] = '';

    return trim(implode(' ', $x)).'...';
}
////////////////////////////////////////////////////////////
/// Phuong thuc cat chuoi va chuyen phan thua thanh dau ...
/// ////////////////////////////////////////////////////////

/*
 * Phuong thuc lay username trong 1 chuoi email
 * Username se duoc lay truoc ky tu @ trong chuoi email
 * */
function trimUserFormEmail($strEmail)
{
    $userFormEmail = strstr($strEmail, '@', true);

    return $userFormEmail.'<br>';
}

////////////////////////////////////////////////////////////
/// Ham chuyen doi chu thuong thanh chu hoa
/// Ham chuyen doi chu hoa thanh chu thuong
////////////////////////////////////////////////////////////

/*
 * Ham chuyen chu hoa thanh chu thuong
 * Tham so dau vao la 1 chuoi chu thuong
 * */
function upCase($str)
{
    return strtoupper($str);
}
/*
 * Ham chuyen chu thuong thanh chu hoa
 * Tham so dau vao la 1 chuoi chu Hoa
 * */
function downCase($str)
{
    return strtolower($str);
}

////////////////////////////////////////////////////////////
// Ham auto crop hinh anh theo kich co
////////////////////////////////////////////////////////////
