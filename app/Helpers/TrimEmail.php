<?php
namespace App\Helpers;
class TrimEmail{
    /**
     * Phuong thuc lay username trong 1 chuoi email
     * Username se duoc lay truoc ky tu @ trong chuoi email
     * */
    public function trimUserFormEmail($strEmail)
    {
        $userFormEmail = strstr($strEmail, '@', true);
        return $userFormEmail;
    }
}
?>
