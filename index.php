
<html>
    <head>
        <meta content="@author @ken @1039110278"/>
        <meta content="转载请注明"/>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="style/base.css" type="text/css"/>
        <link rel="stylesheet" href="style/common.css"/><!-- 基本样式 -->
        <link rel="stylesheet" href="style/animate.min.css"/> <!-- 动画效果 -->
        <link rel="stylesheet" href="style/shortcut.css"/> <!-- 动画效果 -->
       
        <title>又欠欢的留言墙</title>
    </head>
    <body>
    <div class="shortcut">
    	<?php
    			$classarry = array('bounceIn dialog',
    						'bounceInDown dialog',
    						'bounceInLeft dialog',
							'bounceInRight dialog',
							'bounceInUp dialog',
							'rollIn dialog',
							'fadeIn dialog',
							'fadeInUpBig dialog',
							'lightSpeedIn dialog',
							'flipInX dialog',
							'rotateInDownLeft dialog',
							'rotateInDownRight dialog',
							'rotateInUpLeft dialog',
							'rotateInUpRight dialog',
							'rubberBand dialog',
							'zoomIn dialog',
							'zoomInDown dialog',
							'zoomInLeft dialog',
							'zoomInRight dialog',
							'zoomInUp dialog');

    			echo '<h1><a href="javascript:;" class="'.$classarry[rand(0,20)].'">欢迎大家给我留言，也可以给网站提建议，我好完善，可以匿名哦！点我吧。。。</a></h1>';
    			echo '<span class="right">';
    			echo '<a href="javascript:;" class="'.$classarry[rand(0,20)].'">欢欢，我要说说你</a>';
    			echo '</span>';
    	?>
		
		
			
		
	</div><!-- shortcut -->
	<!--
        <div class="mymain">
            <a href="javascript:;" class="rotateInDownLeft dialog">欢迎大家给我留言，可以匿名哦！点我。。。</a>
        </div>
    -->
        <div class="main" id="main">
            
            <?php
			error_reporting(0);
            //定义常量
            define(DB_HOST, 'qdm158082378.my3w.com');
            define(DB_USER, 'qdm158082378');
            define(DB_PASS, '13955338825');
            define(DB_DATABASENAME, 'qdm158082378_db');
            define(DB_TABLENAME, 'message');
            //数据库表的列名
            $dbcolarray = array('id', 'content', 'name', 'expression', 'skin','time');

            //mysql_connect
            $conn = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("connect failed" . mysql_error());
            mysql_select_db(DB_DATABASENAME, $conn);
            mysql_query("SET NAMES 'UTF8'"); 
            mysql_query("SET CHARACTER SET UTF8"); 
            mysql_query("SET CHARACTER_SET_RESULTS=UTF8'");

            
            $sql = sprintf("select %s from %s", implode(",",$dbcolarray), DB_TABLENAME);
            $result = mysql_query($sql, $conn);
                while ($row=mysql_fetch_array($result, MYSQL_ASSOC))//与$row=mysql_fetch_assoc($result)等价
                {
                    
                   echo  '<div name="note" class="note">';
                      echo  '<div class="nhead" style="background-image: url(./images/a'.$row["skin"].'_1.gif);">';
                      echo  $row["time"];
                      echo  '</div>';
                      echo  '<div class="nbody" style="background-image: url(./images/a'.$row["skin"].'_2.gif);">';
                      echo  $row["content"];
                      echo  '</div>';
                      echo  '<div class="nfoot" style="background-image: url(./images/a'.$row["skin"].'_3.gif);">';
                      echo      '<div class="moodpic">';
                      echo          '<img src="images/'.$row["expression"].'.gif"/>';
                      echo      '</div>';
                      echo      '<div class="username">';
                      echo      $row["name"];
                      echo      '</div>';
                      echo  '</div>';
                   echo  '</div> '; 
                }

                mysql_free_result($result);
            mysql_close($conn);
            ?>
            
     
        </div>


        <div id="HBox">
            <form action="" method="post" onsubmit="return false;">
                <ul class="list">
                    <li>
                        <strong>说点什么呢</strong>
                        <div class="fl">
                        
                        <textarea rows="3" cols="30" name="content" class="ipt content"></textarea>
                    </li>
                    <li>
                        <strong>表情</strong>
                        <div class="fl">
                            <input type="radio" name="expression" value="1"/><img src="images/1.gif">
                            <input type="radio" name="expression" value="2"/><img src="images/2.gif">
                            <input type="radio" name="expression" value="3"/><img src="images/3.gif">
                            <input type="radio" name="expression" value="4"/><img src="images/4.gif">
                            <input type="radio" name="expression" value="5"/><img src="images/5.gif">
                            <input type="radio" name="expression" value="6"/><img src="images/6.gif"></br>
                            <input type="radio" name="expression" value="7"/><img src="images/7.gif">
                            <input type="radio" name="expression" value="8"/><img src="images/8.gif">
                            <input type="radio" name="expression" value="9"/><img src="images/9.gif">
                            <input type="radio" name="expression" value="10"/><img src="images/10.gif">
                            <input type="radio" name="expression" value="11"/><img src="images/11.gif">
                            <input type="radio" name="expression" value="12"/><img src="images/12.gif"></br>
                            <input type="radio" name="expression" value="13"/><img src="images/13.gif">
                            <input type="radio" name="expression" value="14"/><img src="images/14.gif">
                            <input type="radio" name="expression" value="15"/><img src="images/15.gif">
                            <input type="radio" name="expression" value="16"/><img src="images/16.gif">
                            <input type="radio" name="expression" value="17"/><img src="images/17.gif">
                            <input type="radio" name="expression" value="18"/><img src="images/18.gif"></br>
                            <input type="radio" name="expression" value="19"/><img src="images/19.gif">
                            <input type="radio" name="expression" value="20"/><img src="images/20.gif">
                            <input type="radio" name="expression" value="21"/><img src="images/21.gif">
                            <input type="radio" name="expression" value="22"/><img src="images/22.gif">
                            <input type="radio" name="expression" value="23"/><img src="images/23.gif">
                            <input type="radio" name="expression" value="24"/><img src="images/24.gif"></br>
                            <input type="radio" name="expression" value="25"/><img src="images/25.gif">
                            <input type="radio" name="expression" value="26"/><img src="images/26.gif">
                            <input type="radio" name="expression" value="27"/><img src="images/27.gif">
                            <input type="radio" name="expression" value="28"/><img src="images/28.gif">
                            <input type="radio" name="expression" value="29"/><img src="images/29.gif">
                            <input type="radio" name="expression" value="30"/><img src="images/30.gif">
                        
                        </div>
                    </li>
                    <li>
                        <strong>贴纸颜色</strong>
                        <div class="fl">
                            <input type="radio" name="skin" value="1"/><img src="images/bg1.gif">
                            <input type="radio" name="skin" value="2"/><img src="images/bg2.gif">
                            <input type="radio" name="skin" value="3"/><img src="images/bg3.gif">
                            <input type="radio" name="skin" value="4"/><img src="images/bg4.gif"><br>
                            <input type="radio" name="skin" value="5"/><img src="images/bg5.gif">
                            <input type="radio" name="skin" value="6"/><img src="images/bg6.gif">
                            <input type="radio" name="skin" value="7"/><img src="images/bg7.gif">
                            <input type="radio" name="skin" value="8"/><img src="images/bg8.gif">
                        </div>
                    </li>
                   
                    <li>
                        <strong>您是谁</strong>
                        <div class="fl"><input type="text" name="name" value="" class="ipt name" /></div>
                    </li>
                    <li><input type="button" value="对他说" class="submitBtn" /></li>
                </ul>
            </form>
        </div>
        <div class="bottom_tools">
            <div class="qr_tool">二维码</div>
            <?php 
               echo '<a id="feedback" href="javascript:;" class="'.$classarry[rand(0,20)].'" title="给我留言">给我留言</a>';
            ?>
            
            <a id="scrollUp" href="javascript:;" title="飞回顶部"></a>
            <img class="qr_img" src="images/qr_img.png">
        </div>
    <script src="js/jquery.min.js"></script>
        <script src="js/jquery.hDialog.min.js"></script>
        <script src="js/index.js" type="text/javascript"></script>
    </body>
</html>