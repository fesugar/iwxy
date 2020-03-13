<?php
header('content-type:text/html;charset=utf-8');

echo  "var ap5 = new APlayer({
    element: document.getElementById('player5'),
    narrow: false,
    autoplay: false,
    showlrc: false,
    mutex: true,
    theme: '#ad7a86',
    mode: 'random',
    listmaxheight: '8em',
    music:[";
        
$url = 'https://music.163.com/api/playlist/detail?id=???????';
$json = file_get_contents($url);
$obj = json_decode($json);
if (!is_object($obj) || $obj->code != 200) {
    exit('fetch data fail');
}
$result = $obj->result;
if (count($result->tracks)) {
    foreach ($result->tracks as $key => $row) {
        $title = $row->name;
        $author = $row->artists[0]->name;
        $url = "https://music.163.com/song/media/outer/url?id=" . $row->id . ".mp3";
        $pic = $row->album->picUrl."?param=130y130";
		$pic = str_replace("http://","https://",$pic);
      $s = array("title" => "{$title}", "author" => "{$author}", "url" => "{$url}", "pic" => "{$pic}");
	  echo  json_encode($s).",";
    }
   

   echo "]});";
	

}