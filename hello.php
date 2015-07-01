<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>DBサンプル</title>
</head>
<body>
	DBのテスト
<p><?php echo 'Hello, World!' ?></p>
<br><br>

  <form name="form1" action="" method="post">
    Name    :<input type = "text" name="Name" /><br>
    Address :<input type = "text" name="Address" /><br>
    Station :<input type = "text" name="Station" /><br>
    Distance:<input type = "number" name="Distance" /><br>
    Time    :<input type = "time" name="Time" /><br>
    WalkTime:<input type = "time" name="Walk_time" /><br>
    Link    :<input type = "text" name="Link" /><br>
    Other   :<input type = "text" name="Other" /><br>
    <input type = "submit" name='insert_submit' value="追加" /><br>
  </form>

  <br>
  <form name="delete_form" action="" method="post">
    ID:<input type = "number" name="ID" />
    <input type="submit" name="delete_submit" value="削除" />
  </form>
<br><br>

<?php
  $url = 'localhost';
  $user = 'iken_nameko';
  $pass = 'nameko';
  $db = 'iken_nameko';

  $deleteflg = $_POST['delete_submit'];
  $insertflg = $_POST['insert_submit'];

  $link = mysqli_connect($url, $user, $pass, $db);

  if(mysqli_connect_errno())
  {
    echo 'error';
  }
  //else echo 'success<br>';

  mysqli_query($link, 'SET NAMES utf8');

  if($deleteflg != ''){
    $ID = $_POST['ID'];
    $Dresult = mysqli_query($link, 'DELETE FROM test01 WHERE id = '.$ID);
  }
  else if($insertflg != ''){
    $Address = $_POST['Address'];
    $Station = $_POST['Station'];
    $Distance = $_POST['Distance'];
    $Link = $_POST['Link'];
    $Time = $_POST['Time'];
    $Walk_time = $_POST['Walk_time'];
    $Name = $_POST['Name'];
    $Other = $_POST['Other'];


    $IDresult = mysqli_query($link, 'SELECT MAX(id) as max FROM test01');
    if(!$IDresult){
        echo 'QUERY ERROR';
    }
    else {
      $Id = mysqli_fetch_assoc($IDresult);
      $Id['max']++;

      $INSERTresult = mysqli_query($link, 'INSERT INTO test01 (id, address, station, distance, link, time, walk_time, name, other) 
      VALUES ('.$Id['max'].', "'.$Address.'", "'.$Station.'", '.$Distance.', "'.$Link.'", "'.$Time.'", "'.$Walk_time.'", "'.$Name.'", "'.$Other.'")');

      if(!$INSERTresult){
        echo 'INSERT error';
      }
    }
  }

  //$result = mysql_query($link, 'INSERT INTO table01 (id, address, station, distance, link, time, name, other) VALUE (,,,,,,)');
  $result = mysqli_query($link, 'SELECT * FROM test01 ORDER BY id');
  if(!$result){
    echo 'QUERY ERROR';
  }
  else {
    //echo 'QUERY success<br><br>';
    echo 'id | name | address | station | distance | time | walk_time | link | other<br>';
    while($data = mysqli_fetch_array($result)){
      echo $data['id'].' | '.$data['name'].' | '.$data['address'].' | '.$data['station'].' | '.$data['distance'].'km | '.$data['time'].' | '.$data['walk_time'].' | '.$data['link'].' | '.$data['other'].'<br>';
    }
  }
  if(mysqli_close($link)){
    //echo '<br>close DB';
  }
?>
</body>
</html>