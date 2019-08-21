<?php

namespace App\Helpers;
use App\Modules\ServerStorage\Models\StorageServer;
use App\Modules\Filehost\Models\user_ftp;
use Crypt;

class CurlHelper
{

    public static function curl_post($url, $data) {

        if(is_array($data))
            $dataPost = http_build_query($data);
        else
            $dataPost = $data;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataPost);
        $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        curl_setopt($ch, CURLOPT_REFERER, $actual_link);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    public static function curl_get($url){

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_FAILONERROR, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curl);
        curl_close($curl);

        return $result;
    }

    /**
     * Get all ServerStorage information and status
     * Timeout 5 seconds
     * @return False or JSON Object
     */
    public function getAllSystemInfo($url,$apikey){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'api-key:'.$apikey
        ));
        $result = curl_exec($ch);
        curl_close($ch);
        if($result == false){
            return false;
        }else{
            return $result;
        }
    }
    /**
     * Create a new User FTP
     *
     * @return json
     */
    public function createFTPUser($url, $username, $password, $apiKey){
        $data = array('username'=>$username,'password'=>$password);
        $data_json = json_encode($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
        $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        curl_setopt($ch, CURLOPT_REFERER, $actual_link);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'api-key:'.$apiKey
        ));
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    public function uploadFTPFile($url, $username, $file, $apiKey){
        $data = array('username'=>$username,'uploadFile'=>$file);
        $data_json = json_encode($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
        $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        curl_setopt($ch, CURLOPT_REFERER, $actual_link);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'api-key:'.$apiKey
        ));
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    /**
     * Update a password User FTP
     *
     * @return json
     */
    public function updateFTPPassword($url, $username, $newPassword, $apikey){
        $data = array('username'=>$username,'password'=>$newPassword);
        $data_json = json_encode($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
        $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        curl_setopt($ch, CURLOPT_REFERER, $actual_link);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'api-key:'.$apikey,
        ));
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
    /**
     * Delete a user FTP
     *
     * @return json
     */
    public function deleteFTPUser($url, $username,$apikey){
        $data = array('username'=>$username);
        $data_json = json_encode($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
        $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        curl_setopt($ch, CURLOPT_REFERER, $actual_link);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'api-key:'.$apikey
        ));
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
    /**
     * Decrypt a file to download.
     *
     * @return json
     */
    public function DecryptFile($username,$fileName,$url,$apikey){
        $data = array('username'=>$username, 'filename'=>$fileName);
        $data_json = json_encode($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
        $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        curl_setopt($ch, CURLOPT_REFERER, $actual_link);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'api-key:'.$apikey,
        ));
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
    /**
     * Delete a Decrypt File
     *
     * @return json
     */
    public function DeleteDecryptFile($username,$fileName,$url,$apikey){
        $data = array('username'=>$username, 'filename'=>$fileName);
        $data_json = json_encode($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
        $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        curl_setopt($ch, CURLOPT_REFERER, $actual_link);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'api-key:'.$apikey,
        ));
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
    /**
     * Delete a file in the storage
     *
     * @return json
     */
    public function DeleteEncryptFile($username,$fileName,$url,$apikey){
        $data = array('username'=>$username, 'filename'=>$fileName);
        $data_json = json_encode($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
        $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        curl_setopt($ch, CURLOPT_REFERER, $actual_link);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'api-key:'.$apikey,
        ));
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
    /**
     * Upload file form URL
     * Param: a url the file
     * @return json
     */
    public function UploadFileFormUrl($username,$url,$urlFIle,$apikey){
        $data = array('url'=>$urlFIle);
        $data_json = json_encode($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
        $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        curl_setopt($ch, CURLOPT_REFERER, $actual_link);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'api-key:'.$apikey,
            'username:'.$username
        ));
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    /**
     * Get min Storage
     *
     * @return array
     */
    public function getMinStorage(){
        $arrayData = $this->getSystemInfo();
        if($arrayData === "errors"){
            return "errors";
        }
        $i=0;
        for($i; $i <= count($arrayData);$i++){
            if($arrayData[$i]["mount"] > $arrayData[$i++]["mount"]){
                return $arrayData[$i];
            }else{
                return $arrayData[0];
            }
        }
    }
    /**
     * Get System information
     *
     * @return array
     */
    public function getSystemInfo(){
        $storage = StorageServer::all();
        $arrayStorage = array();

        for($i=0; $i < count($storage); $i++){

            $data = json_decode($this->getAllSystemInfo($storage[$i]['url'], $storage[$i]['api_key']));
            if($data == null){
                continue;
            }
            $total_mem = $data->mem->total;

            $free_mem = $data->mem->free;

            $mount = ($free_mem / $total_mem) * 100;

            $new_array = array($i,"model"=>$data->model,"mount" => $mount);

            $arrayStorage[] = $new_array;

        }
        return $arrayStorage;
    }

}
