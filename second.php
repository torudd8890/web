<?php

$dataFile = 'bbs.txt';

function h($s) {
  return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
  echo "hello";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['message']) && isset($_POST['user'])) {
  $message = $_POST['message'];
  $user = $_POST['user'];
  
  if ($message !== '') {
    $user = ($user === '') ? '名無しさん' : $user;
    $message = str_replace("\t",' ', $message);
    $user = str_replace("\t",' ', $user);
    $postedAt = date('Y-m-d H:i:s');
    $newData = $message . "\t" . $user . "\t" . $postedAt . "\n";
    $fp = fopen($dataFile, 'a');
    fwrite($fp, $newData);
    fclose($fp);
  }
}

$posts = file($dataFile, FILE_IGNORE_NEW_LINES);
$posts = array_reverse($posts);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <title>KABUの実行メモ</title>
  <link rel="icon" href="">
  <meta name="description" content="KABUの実行メモ。">
  <link rel="stylesheet" href="css/styles.css">
</head>

<body>

<section class="works">
  <h1>WORKS</h1>
  <section>
    <img src="img/icon.png" wight="400" height="400" alt ="pas">
    <h1>手書きからパス化</h1>
    <p>イラストレーターCS4 MacOS ver.10.14.6<br />
    環境経験:多い 作業時間:0.5h<br />メモ:手書きでのメモをスマフォのカメラで撮影。フォトショップに取り込んで、2階調化。レベル補正して、白とばし。選択範囲で白地を選択し、削除。データを保存し、イラストレーターに配置、ライブトレースでパス化。</p>
  </section>
  <section>
    <img src="img/yama_mori.png" wight="400" height="260" alt ="yuhi">
    <h1>夕日と奥行き</h1>
    <p>Blender2.8 Mac ver.10.14.6<br />環境経験:10.0h 作業時間:3.0h<br />メモ:平面をランダム化。凹凸を山っぽくし、山の面には別で作った気をパーティクルヘアーで生やした。地面には、一応テクスチャーを貼り付け。カメラの被写界深度を調整し、奥行きを作ってみた。</p>
  </section>
  <section>
    <img src="img/visual_studio.jpg" wight="400" height="320" alt ="vs">
    <h1>Visual Studio Code の使用</h1>
    <p>Visual Studio Code MacOS ver.10.14.6<br />
    環境経験:2.0h 作業時間:0.2h<br />メモ:これまでテキストエディタを使用していたが、このアプリを落として使ってみた。今の所試したのはHTMLやCSS、PHPだけだが、こちらの方が格段に使いやすい。</p>
  </section>
  <section>
    <img src="img/web_site.png" wight="400" height="300" alt ="ウェブサイト">
    <h1>ウェブサイトの作成</h1>
    <p>アプリ:VSCode CyberDuck ターミナル GoogleChrome VirtualBox<br />ドメイン＆サーバ:freenom XFREE<br />PC:MacOS ver.10.14.6<br />
    環境経験:21.0h 作業時間:18.0h<br />メモ:最初はdockerを使って作業していたが、使い方が分からずじまい。サーフィンした結果、とりあえずVirtualBoxとCyberDuckに替えて再度チャレンジ。上手くいきそう。</p>
  </section>    
  <section>
    <img src="img/font.png" wight="400" height="260" alt ="フォント">
    <h1>フォントの作成</h1>
    <p>GlyphsMini イラストレーター<br />MacOS ver.10.14.6<br />
    環境経験:13.0h 作業時間:13.0h<br />メモ:アルファベットとかひらがなとか、シンプルで素敵な文字を自分でも作りたかった。憧れだ。もしかしたらこんな文字もあったかもしれない。そんな風に考えながら作った。</p>
  </section>          
  <section>
    <img src="img/freenom.png" wight="400" height="320" alt ="freenom">
    <h1>ドメイン取得後のAレコード反映</h1>
    <p>freenom 環境経験:10.0h 作業時間:10.0h<br />メモ:どうしてか、欲しいドメインの取得はできるが、「My Domains」に反映されない。かれこれ二日間同じような申請を続けていたが、今日は「My Domains」に反映さた。「Manage Domain」「Nameserver」、「Use default nameservers (Freenom Nameservers)」を選択。「Manage Freenom DNS」で「Name」にこのドメインを入力し、「Target」にはレンタルサーバ側のコンテンツ（IPアドレス）を入力し「Save Changes」を押下。上手く登録されたようだが、なぜか「Modify Records」の「Name」にはドメインが記載されず。でも問題なく勧められた。</p>
  </section>          
  <section>
    <img src="img/xfree_a_code_user.png" wight="400" height="460" alt ="xfree_a_code_user">
    <h1>レンタルサーバ側での新規ドメイン追加設定</h1>
    <p> XFREE　ドメイン設定追加<br />
    環境経験:9.0h 作業時間:9.0h<br />メモ:最初は「Web認証」や「メール認証」で進めようとしていたが、どうやら自分の環境のことではないらしい。「Aレコード認証」で進めることにした。「ドメイン名」を入力し、ドット以降の文字を選択。認証方法の「Aレコード認証」を選択。一番下の「ドメイン設定を追加する（確認）」を押す。が、だめ。なぜだ、と思いやり直してみる。進んだ。どうやら情報の更新には数分から數十分時間がかかるようだ。気長に待とう。</p>
  </section>          
</section>


<div class="post_icon">
    <img src="img/post_retext.png" width="120" height="120" alt="icon">
  </div>
  <section class="POSTBOX">
    <!-- <section class="post_box">
      <img src="img/post_re.png" width="40" height="40" alt="icon">
      <h1>POST</h1> -->
    <!-- </section> -->
    <section class="mes_user">
      <form action="" method="post">
      message: <input type="text" name="message">
      user: <input type="text" name="user">
      <input type="submit" value="投稿">
    </form>
    </section>
    <section class="toukou">
      <h2>List of posts (<?php echo count($posts); ?>)</h2>
      <ul>
        <?php if (count($posts)) : ?>
        <?php foreach ($posts as $post) : ?>
        <?php list($message, $user, $postedAt) = explode("\t", $post); ?>
        <li><?php echo h($message); ?> (<?php echo h($user); ?>) - <?php echo h($postedAt); ?></li>
        <?php endforeach; ?>
        <?php else : ?>
        <li>まだ投稿はありません。</li>
        <?php endif; ?>
      </ul>
    </section>
  </section>

<footer>
  <p>(c) kabu</p>
</footer>
  
  </body>
  </html>