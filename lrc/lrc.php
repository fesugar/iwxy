<?php

header('content-type:text/html;charset=utf-8');

if (is_file($_SERVER['DOCUMENT_ROOT'] . '/config/configure.php')) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/config/configure.php';
}

if(is_array($_GET)&&count($_GET)>0)//判断是否有Get参数 
{ 
    if(isset($_GET["id"]))//判断所需要的参数是否存在，isset用来检测变量是否设置，返回true or false 
    { 
       
		   //实例化数据连接类
		$li = new dblink();
		//$li->conn();
		$sql = "SELECT `lrctext` FROM `music` WHERE id=".$_GET["id"] ;//查询数据
		$query = mysql_query($sql,$li->conn());

		if ($query === false) {
			exit;
		}
			//取数组
			while($row = mysql_fetch_array($query))
			{
				$lrc = $row["lrctext"];
			}
			echo $lrc;
	   
    }else{
        $code=1;//变量未设置
        }

}else{
    exit;
}



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