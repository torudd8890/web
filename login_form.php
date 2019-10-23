<?php
session_start();
 
$error_message = "";
 
if(isset($_POST["login"])) {
    if($_POST["user_name"] == "login" && $_POST["password"] == "pass") {
        $_SESSION["user_name"] = $_POST["user_name"];
        $login_success_url = "second.php";
        header("Location: {$login_success_url}");
        exit;
    }else{
        $error_message = "※ID、もしくはパスワードが間違っています。<br>　もう一度入力して下さい。";
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>KABUの実行メモ</title>
  <meta name="description" content="KABUの実行メモ。">
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <section class="works">
        <section>
            <h4>過去の作品をみる場合はログインしてください！</h1>
                <?php
                if($error_message) {
                echo $error_message;
                }
                ?>
                <form action="login_form.php" method="POST">
                <p>ログインID：<input type="text" name="user_name"></p>
                <p>パスワード：<input type="password" name="password"></p>
                <input type="submit" name="login" value="ログイン">
            </form>
        </section>
    </section>
 
</body>
</html>


