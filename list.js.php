<?php

header('content-type:text/html;charset=utf-8');

if (is_file($_SERVER['DOCUMENT_ROOT'] . '/config/configure.php')) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/config/configure.php';
}



// 数据查询返回值

    $isp_code=substr($_GET["number"], 0, 3); //服务商前三位
    $province_code=substr($_GET["number"], 3, 2); //省级四五两位
    $city_code=substr($_GET["number"], 5, 2); //市级六七两位
    //实例化数据连接类
    $li = new dblink();
    //$li->conn();
    $sql = "SELECT `title`,`author`,`url`,`pic`,`lrc` FROM `music` WHERE `state` =1 ORDER BY RAND() LIMIT 100 ";//查询数据
    $query = mysql_query($sql,$li->conn());
    
    if ($query === false) {
        exit;
    }
        //取数组
        //mysql_fetch_assoc  保留字符串 表的列名的键     mysql_fetch_array 数字字符都要   mysql_fetch_row  只留数字键
        while($row = mysql_fetch_assoc($query))
        {
            $results[]=$row;
           /*  $title = $row["title"];
            $author = $row["author"];
            $url = $row["url"];
			$pic = $row["pic"];
            $lrc = $row["id"];
			$s=array("title" => "$title", "author" => "$author", "url" => "$url", "pic" => "$pic", "lrc" => "./lrc/lrc.php?id="."$lrc"); */
        }
        $h="var ap5 = new APlayer({
    element: document.getElementById('player5'),
    narrow: false,
    autoplay: false,
    showlrc: false,
    mutex: true,
    theme: '#ad7a86',
    mode: 'random',
    listmaxheight: '8em',
    music:";
        $f="});";
        echo $h.json_encode($results).$f;


// 封装一个数据库连接类
class dblink
{
    public function conn()
    {
        //--------------数据操作---------------
        /*连接数据库所需要的五要素（可从数据库详情页中查到相应信息）*/
        $dbname = ServiceConf::$mysql_cfg['dbname'];
        $host = ServiceConf::$mysql_cfg['host'];
        $port = ServiceConf::$mysql_cfg['port'];
        $user = ServiceConf::$aksk['ak'];
        $pwd = ServiceConf::$aksk['sk'];
        /*接着调用mysql_connect()连接服务器*/
        $link = @mysql_connect("{$host}:{$port}", $user, $pwd, true);
        if (!$link) {
            die('Connect Server Failed: ' . 'mysql_error()');
        }
        /*连接成功后立即调用mysql_select_db()选中需要连接的数据库*/
        if (!mysql_select_db($dbname, $link)) {
            die('Select Database Failed: ' . "mysql_error({$link})");
        }
        mysql_query("set names utf8"); //设置编码//防止中文乱码
        return $link;
    }
}

?>