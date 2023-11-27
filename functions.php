<?php
require 'config.php';
require_once 'db.php';

function createTableUsers()
{
  $dbh = connect();
  //echo  $dbh;
  if ($dbh) {
    $sql = 'CREATE TABLE IF NOT EXISTS users (
                id serial PRIMARY KEY,
                login varchar(255) NOT NULL,
                email varchar(100) NOT NULL,
                passward varchar(100) NOT NULL
                )';
    $dbh->exec($sql);

    if (isset($_POST['login'])) {
      $LOGIN = $_POST['login'];
    }
    if (isset($_POST['password'])) {
      $PASSWARD = $_POST['password'];
    }
    $EMAIL = $_POST['email'];
    $CONFIRMPASS  = $_POST['password_confirm'];
    $hash = password_hash($PASSWARD, PASSWORD_DEFAULT);
    $sql = 'INSERT INTO users(login, email, passward) VALUES(:login, :email, :password)';
    $stmt = $dbh->prepare($sql);

    $stmt->bindValue(':login',  $LOGIN);
    $stmt->bindValue(':email', $EMAIL);
    $stmt->bindValue(':password', $hash);

    $res = $dbh->query("SELECT login FROM users WHERE login = '$LOGIN'");

    $result = $res->FetchAll(PDO::FETCH_ASSOC);
    //var_dump($result);
    if (empty($result) && $CONFIRMPASS == $PASSWARD) {
      $stmt->execute();
      return true;
    } else {
      return false;
    }
  }
}

function login()
{
  $dbh = $dbh = connect();
  $LOGIN = $_POST['login'];
  $PASSWARD = password_hash($_POST['password'], PASSWORD_DEFAULT);

  if ((!empty($LOGIN)) && (!empty($PASSWARD))) {
    $res = $dbh->query("SELECT login, passward FROM users WHERE login = '$LOGIN'");

    $result = $res->Fetch(PDO::FETCH_ASSOC);

    if (password_verify($_POST["password"], $result["passward"])) {
      return  true;
    } else {
      return  false;
    }
  }
}
