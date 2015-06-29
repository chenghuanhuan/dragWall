
<?php 
		error_reporting(0);
        //定义常量
        define(DB_HOST, 'qdm158082378.my3w.com');
        define(DB_USER, 'qdm158082378');
        define(DB_PASS, '13955338825');
        define(DB_DATABASENAME, 'qdm158082378_db');
        define(DB_TABLENAME, 'message');
        //数据库表的列名
        //$dbcolarray = array('id', 'content', 'name', 'expression', 'skin','time');

			//mysql_connect
        $conn = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("connect failed" . mysql_error());
        mysql_select_db(DB_DATABASENAME, $conn);
        mysql_query("SET NAMES 'UTF8'"); 
        //mysql_query("SET CHARACTER SET UTF8"); 
        //mysql_query("SET CHARACTER_SET_RESULTS=UTF8'");
        
        $name = $_POST[name];
		$content = $_POST[content];
		$skin = $_POST[skin];
		$expression = $_POST[expression];
		$time = time();
		$sql="insert into message( name, content, skin, time, expression) values ( '$name','$content','$skin', now(),'$expression')";
		if (!mysql_query($sql,$conn))
		 {
		   die('Error: ' . mysql_error());
		   $response='{"success":"false","msg":'+msql_error()+'}';
		 }else{
		 	$response='{"success":"true","time":"'.date("Y-m-d H:i:s",$time).'","content":"'.$content.'"}';
		 	echo $response;
		 }
		 
		  //关闭连接
		 mysql_close($conn);
?>