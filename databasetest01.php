<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">

<html>

 <head>
  <meta charset="utf-8">
  <title>LoginPage</title>
</head>

<body>
<!--?php
// 接続設定
    $ODBC_DBname = "test01";
    $ODBC_DBuser = "root";
    $ODBC_DBpass = "pi";

    // SQL文
    $sql = "SELECT * FROM 学生";        // ○○○○はAccessで作成したテーブル名

    // データベース接続
    $conn_id = odbc_connect($ODBC_DBname,$ODBC_DBuser,$ODBC_DBpass);

    // クエリ実行
    $result_page = odbc_exec($conn_id,$sql)  or die("Query failed : ".$sql);

    // 配列に格納（odbc_fetch_array以外にも色々用意されています）
    $i = 0;
    while($row = odbc_fetch_array($result_page)){
        $data[$i] = $row;
        $i++;
    }
    ?-->
    hello!<br>
    <?php

  $DSN        = "test01";    //データソース名
  $DBUSER     = "";             //ログインユーザー名
  $DBPASSWORD = "";             //パスワード

  //Accessデータベースに接続
  $con = odbc_connect($DSN ,$DBUSER, $DBPASSWORD);
  if ($con) 
  {
    print "Accessデータベースに接続しました！＜br＞";
  }
  else
  {
    print "Accessデータベースに接続できませんでした！＜br＞";
  }


  //--- 以下の行から、DBアクセス＝書き換え部分 ---

  // Helloテーブルからmsgカラムの内容を出力

  $sql = 'SELECT * FROM 学生';
  $result = odbc_exec($con, $sql);
  while ($rows = odbc_fetch_object($result))
  { 
    print($rows-＞msg . "＜br＞");
  }

  //---- ここまで  -------------------------------


  //Accessデータベースとの接続を解除
  odbc_close($con);
  print "Accessデータベースとの接続を解除しました！＜BR＞＜BR＞";

?>
</body>
</html>
