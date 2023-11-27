<?php

function connect()
{

  $dbuser = 'admin';
  $dbpass = 'root';
  $host = 'db';
  $dbname = 'postgres';
  $dbh = new PDO("pgsql:host=localhost;dbname=$dbname", $dbuser, $dbpass);

  return $dbh;
}



// public static function create_data()
//   {
//     $dbh = self::dbconn();
//     $LOGIN = $_POST['login'];
//     $EMAIL = $_POST['email'];
//     $PASSWARD = $_POST['password'];
//     $CONFIRMPASS  = $_POST['password_confirm'];
//     $hash = password_hash($PASSWARD, PASSWORD_DEFAULT);
//     $sql = 'INSERT INTO users(login, email, passward) VALUES(:login, :email, :password)';
//     $stmt = $dbh->prepare($sql);

//     $stmt->bindValue(':login',  $LOGIN);
//     $stmt->bindValue(':email', $EMAIL);
//     $stmt->bindValue(':password', $hash);

//     $res = $dbh->query("SELECT login FROM users WHERE login = '$LOGIN'");

//     $result = $res->FetchAll(PDO::FETCH_ASSOC);
//     //var_dump($result);
//     if (empty($result) && $CONFIRMPASS == $PASSWARD) {
//       $stmt->execute();
//     }
//     return  $result;
//   }
