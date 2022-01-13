<?php

function callAPI($method, $url, $data)
{
    //create a new cURL resource
    $curl = curl_init();

    switch ($method) {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);
            if ($data) {
                // Attach encoded JSON string to the POST fields
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            }
            break;
        case "PUT":
            //When you change the request method by setting CURLOPT_CUSTOMREQUEST to something, 
            //you do not actually change how libcurl behaves or acts in regards to the particular request method, 
            //it will only change the actual string sent in the request.
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            if ($data) {
                //CURLOPT_POSTFIELDS: giá trị của nó chính là một mảng các key => value, tương ứng với name và value của nó trong các thẻ input khi submit FORM
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            }
            break;
        // //chay duoc
        // case "POST":
        //     curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        //     if ($data) {
        //         //CURLOPT_POSTFIELDS: giá trị của nó chính là một mảng các key => value, tương ứng với name và value của nó trong các thẻ input khi submit FORM
        //         curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        //     }
        //     break;
        default:
            if ($data) {
                $url = sprintf("%s?%s", $url, http_build_query($data));
            }
    }
    // OPTIONS:
    curl_setopt($curl, CURLOPT_URL, $url);
    // Set the content type to application/json
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        //'APIKEY: 111111111111111111111',
        'Content-Type: application/json',
    ));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    // Execute the POST request
    $result = curl_exec($curl);
    if (!$result) {
        die("Connection Failure");
    }
    // Close cURL resource
    curl_close($curl);
    return $result;
}

function validation_email($string)
{
    $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";

    if (preg_match($pattern, $string) == true) {
        return true;
    } else {
        return false;
    }
}

function validation_phone($string)
{
    if (is_numeric($string) && strlen($string) == 10) {
        return true;
    } else {
        return false;
    }
}


function finduser($id, $array)
{
    $search_results = array();
    foreach ($array as $key => $value) {
        if ($id == $value['id']) {
            $search_results[] = $value;
        }
    }

    return $search_results;
}

function read_data_json_address($path_file)
{
    $filename = ROOT_PATH . $path_file;

    $fp = fopen($filename, "r");
    $data = fread($fp, filesize($filename));
    fclose($fp);

    return $data;
}

function cut_String($string, $char)
{
    $list_string = array();
    $index_begin = 0;
    $temp_string = $string;
    while (true) {
        //Find the character ';'
        $find_index_char = strpos($temp_string, $char);
        //Cut string
        if ($find_index_char == true) {
            //cut string behind character ;
            $new_string = substr($temp_string, $index_begin, $find_index_char);
            //Push new string in array
            array_push($list_string, $new_string);
            //trim the temporary string from the character ; find first to last place 
            $temp_string = substr($temp_string, $find_index_char + 1, strlen($temp_string));
        } else {
            //cut string behind character ;
            $new_string = substr($temp_string, $index_begin, strlen($temp_string));
            //Push new string in array
            array_push($list_string, $new_string);
            break;
        }
    }
    return $list_string;
}

function convert_path_to_serveURL($string){
    //Tach tung folder ra luu vao mang
    $arr = cut_String($string, '\\');

    $cut_string = "http://localhost";
    foreach ($arr as $index => $val){
        #find folder htdocs
        if($val == "htdocs"){
            //them cac gia tri (folder) bat dau sau folder htdocs
            for($i = $index + 1; $i < count($arr); $i++){
                //Them ki tu / truoc no
                $cut_string = $cut_string . "/" . $arr[$i];
            }
            //Thoat ngay khoi for ngay sau khi tim thay duoc folder htdocs lan dau tien
            break;
        }
    }

    return $cut_string;
}
