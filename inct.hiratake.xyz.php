<!DOCTYPE html>
<!-- (c) 2014 Hirotaisou2012 -->
<html lang="ja">
<?php 
    date_default_timezone_set("Asia/Tokyo");  
    $timetable = array(array("解析学","英語表現","実験","なし"), 
                       array("現代社会","電磁気","アルゴリズム","ディジタル"), 
                       array("OS","体育","解析","特活"),
                       array("DB", "代数幾何", "アーキテクチャ", "英語講読"),
                       array("国語","電気回路","電子回路","なし"));
    $weekday = date('w');
    $ydate = date('Y');
    $mdate = date('m');
    $ddate = date('d');
    $flag = false;
    $hwfp = fopen("Homework.txt", "r");
    $hwflag = false;

    if(date("a") != "am"){
        $ddate = date("d",strtotime("+1 day"));
        $weekday++;
    }
    if($weekday < 1 || $weekday > 5)
    {
        $weekday = 1;
    }
    $weekday--;
    $nexttimetabel = $timetable[$weekday];

    $fp = fopen("ChangeClass.txt", "r");
    if($fp)
    {
        while(!feof($fp))
        {
            $ChangeClass = explode("/", fgets($fp, 20));
            if($ChangeClass[0] == $mdate){
                if($ChangeClass[1] == $ddate){
                    $nexttimetabel[intval($ChangeClass[2])-1] = $ChangeClass[3];
                    $flag = true;
                }
            }
        }
    }
?>
<head>
	<!-- META -->
	<meta charset="utf-8">
    <meta name="keywords" content="INCT,電子情報工学科,3i,石川高専">
	<meta name="description" content="どっかの高専のどっかのクラスの非公式Webサイト。">
	<meta name="author" content="Hirotaisou2012">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- TITLE -->
	<title>3i非公式Web</title>
	<!-- CSS -->
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/main.css">
    <!-- JavaScript -->
	<script src="js/analytics.js"></script>
</head>
<body>
	<header>
		<div>
            <img src="img/logo.png" alt="3i-logo">
		</div>
		<nav>
			<ul>
				<li class="current"><a href="http://inct.hiratake.xyz">ホーム</a></li>
				<li><a href="http://inct.hiratake.xyz/class">クラス紹介</a></li>
				<li><a href="http://inct.hiratake.xyz/siryou">資料</a></li>
                <li><a href="http://inct.hiratake.xyz/picture">しゃしん</a></li>
                <li><a href="http://inct.hiratake.xyz/about">このページについて</a></li>
			</ul>
		</nav>
	</header>
	<main id="top">
		<div id="main-header">
            <img src="img/img1.png" alt="">
            <div id="main-header-img">
                <img src="img/img2.png" alt="">
                <img src="img/img3.png" alt="">
            </div>
            <p>石川工業高等専門学校<br>3年電子情報工学科</p>
        </div>
        <div id="main">
            <section>
                <section>
                    <h2>3iからのお知らせ</h2>
                    <ul>
                        <li>サイト制作者が進級できることを信じて、先に3i非公式Webを設立しちゃいました。</li>
                        <li>サイト内に貼る写真とか募集中してます。載せてほしいお知らせ(?)もお気軽にどうぞ。</li>
                    </ul>
                </section>
                <section>
                    <h2>更新情報</h2>
                    <ul>
                        <li>2i非公式Webから3i非公式Webになっちゃいました。</li>
                        <li>デザインを一新。なんか大きく変わりました。</li>
                        <li>春休みの課題一覧表っぽい何かを作りました。</li>
                    </ul>
                </section>
                <section>
                    <h2>次の日の予定</h2>
                    <p><?php echo ($ydate.'-'.$mdate.'-'.$ddate) ?>の授業は以下の通りです。<br>
                        <?php
                            for($i = 0; $i < 4; $i++){
                                echo ($i+1)."コマ目 : ".$nexttimetabel[$i].'<br> ';
                            } 
                        ?>
                        （<?php echo $flag ? "授業の変更 があります" : "授業の変更　がありません"; ?>）<br><br>
                        <?php echo ($ydate.'-'.$mdate.'-'.$ddate) ?> に提出の課題 
                        <?php 
                              if($hwfp)
                             {
                                 while(!feof($hwfp))
                                 {
                                     $Homework = explode("/", fgets($hwfp));
                                     if($Homework[0] == $mdate){
                                         if($Homework[1] == $ddate){
                                            if(!$hwflag) echo "があります 。";
                                            echo "<br>".$nexttimetabel[intval($Homework[2])-1]." : ".$Homework[3]."";
                                            $hwflag = true;
                                         }
                                     }
                                 }
                             }
                        if(!$hwflag)
                            echo "はありません 。"?><br>　  <br>　  <br>　  </p>
                </section>
            </section>
            <nav>
                <a href="#">なんか</a>
                <a href="#">なんか</a>
                <a href="http://www.ishikawa-nct.ac.jp/">学校のホームページ</a>
                <a href="https://twitter.com/IshikawaNCT">Twitter</a>
                <a href="http://goo.gl/forms/2xPNRpphCy">ご意見・ご提案</a>
            </nav>
        </div>
	</main>
	<footer>
        <p id="copyright"><small>&copy; 2014-2015 Hirotaisou2012</small></p>
	</footer>
</body>
</html>