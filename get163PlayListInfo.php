<?php 
        function netease_http($url)
        {
            $refer = "http://music.163.com/";
            $header[] = "Cookie: " . "appver=1.5.0.75771;";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
            curl_setopt($ch, CURLOPT_REFERER, $refer);
            $cexecute = curl_exec($ch);
            curl_close($ch);
  
            if ($cexecute) {
                $result = $cexecute;
                return $result;
            }else{
                return false;
            }
        }
?>
<?php 
    $playlist_id = $_REQUEST['id'];
    $url = "http://music.163.com/api/playlist/detail?id=".$playlist_id ;
    $response = netease_http($url);
    echo $response; //此文件中没有设置编码，所以接收的网页上最好是uft-8编码
?>