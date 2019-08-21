<?php
/**
 * Created by PhpStorm.
 * User: nguyenlongit95
 * Date: 1/25/19
 * Time: 3:46 PM
 */
namespace App\Helpers;
class buildSecureLink{

    /**
     * @param $baseUrl - non protected part of the URL including hostname, e.g. http://example.com
     * @param $path - protected path to the file, e.g. /downloads/myfile.zip
     * @param $secret - the shared secret with the nginx server. Keep this info secure!!!
     * @param $ttl - the number of seconds until this link expires
     * @param $userIp - ip of the user allowed to download
     * @return string
     */
    public function SecureLink($baseUrl, $path, $secret, $ttl, $userIp)
    {
        $expires = time() + $ttl;
        $md5 = md5("$expires$path$userIp $secret", true);
        $md5 = base64_encode($md5);
        $md5 = strtr($md5, '+/', '-_');
        $md5 = str_replace('=', '', $md5);
        return $baseUrl . $path . '?md5=' . $md5 . '&expires=' . $expires;
    }
}
