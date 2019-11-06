<!-- スマフォPC判定関数 -->
<?php
/**
* UA取得
* @return string
*/
function getUserAgent()
{
  $userAgent = isset($_SERVER['HTTP_USER_AGENT'])? $_SERVER['HTTP_USER_AGENT'] : '';
  return $userAgent;
}
/**
* 判定関数
* @return bool
*/
function isSmartPhone()
{
  $ua = getuserAgent();
  if (stripos($ua, 'iphone') !== false || // iphone
  stripos($ua, 'ipod') !== false || // ipod
  (stripos($ua, 'android') !== false && stripos($ua, 'mobile') !== false) || // android
  (stripos($ua, 'windows') !== false && stripos($ua, 'mobile') !== false) || // windows phone
  (stripos($ua, 'firefox') !== false && stripos($ua, 'mobile') !== false) || // firefox phone
  (stripos($ua, 'bb10') !== false && stripos($ua, 'mobile') !== false) || // blackberry 10
  (stripos($ua, 'blackberry') !== false) // blackberry
  )
  {
    $isSmartPhone = true;
  } else {
    $isSmartPhone = false;
  }
  return $isSmartPhone;
}
?>

<!-- 投稿フォーム関数 -->
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

<!-- 初期設定 -->
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>KABUの実行メモ</title>
  <link rel="icon" href="img/head_icon.png">
  <meta name="description" content="KABUの実行メモ。">
  <?php if (isSmartPhone()): {?>  <!-- スマホで閲覧 -->
      <link rel="stylesheet" href="body_mobile.css" />
    <?php }else: {?>  <!-- PCで閲覧 -->
      <!-- <link rel="stylesheet" href="body_mobile.css" /> -->
      <link rel="stylesheet" href="body_styles.css">
  <?php }endif; ?>
</head>

<body>
<header>
</header>

<!-- ヘッダーボタン -->
<div class="header_bot">
  <div class="botton_top">
    <a href="../index.php">
    <?php if (isSmartPhone()): ?>
    <img src="../icon/top_text.png" height=250px alt="top"></a> <!--スマホで閲覧中-->
    <?php else: ?>
    <img src="../icon/top_text.png" height=30px alt="top"></a> <!--PCで閲覧中-->
    <?php endif; ?>
    <p class="fukidashi_top">トップ画面に戻ります。</p>
  </div>
  <div class="botton_pos">
    <a href="login_form.php" target="_blank">
    <?php if (isSmartPhone()): ?>
    <img src="../icon/post_text.png" height=250px alt="post"></a> <!--スマホで閲覧中-->
    <?php else: ?>
    <img src="../icon/post_text.png" height=30px alt="post"></a> <!--PCで閲覧中-->
    <?php endif; ?>
    <p class="fukidashi_pos">掲示板作ってみました。何かあれば投稿してみてください。</p>
  </div>
</div>

<!-- ドロップシャドウ -->
<div class="drop">
  <p>　</p>
</div> 

<!-- 判定用関数 -->
<!-- <?php if (isSmartPhone()): ?>
  <p>スマホで閲覧中</p>
  <?php else: ?>
  <p>PCで閲覧中</p>
<?php endif; ?> -->

<!-- 前書き -->
<div class="maeoki">
  <h1>こんにちは。KABUです。</h1>
  <p>　義務教育を受けていた年齢はとうの昔になり、何かを人が教えてくれることもめっきり減ってきました。ものは人に教えてもらうのではなく自分で調べる。年齢を得るにつれて、これが当然の流れになってきています。僕の頭はあまり賢くはない。これまで生きてきて、なんとなく受け止めつつある現実。調べたこと、勉強したこと、大切なはずなのに、すぐに忘れてしまう。
  </p>
  <h1>メモしておかなければ...</h1>
</div>
<!-- 概要解説頁  -->
<div class="top">
  <p>
    イメージ写真の後に、<br /><br />タイトル<br /><br />①作業環境<br />（おこなった場所や環境、使ったPCのOS、ソフト等）<br /><br />②作業環境の経験時間<br />（その環境の下で、以前にどれだけ時間を経験しているか）<br /><br />③作業所要時間<br />（小休憩とか細かいものも含めたザックリとした時間）<br /><br />④投稿日（西暦下二桁年/月/日）<br /><br />⑤メモ<br /><br />と続けてメモっていきます。<br /><br />
  </p>
</div>

<!-- 作品紹介 -->
<!-- <div class="works"> -->
  <div class="container">
    <img src="img/smart_phone.png" alt ="login">
    <div class="text_box">
      <h1>PCとスマフォでのレイアウト変更</h1>
      <p>①PHP MacOS<br />
      ②24.1h ③5.0h ④19/11/05<br />⑤PC用に作った画面をスマートフォンで見るとやはり文字が小さい。僕の視力は最近低い。サッカーボールがにじむ。僕と同年代の彼や彼女らももしかすると同じかもしれない。WEBサイトを作ったのなら、現在世界中に普及しているスマフォにも対応したレイアウトを実装するのが僕の責任だ。PHPはサーバサイドなので、PCとスマフォの判定をできないって記事をいくつか見た。残念がっていたが、世の中にはなんとかできる人が必ずいる。探してみると良さそうな記事を見つけて参考にした。助かる。<a href="https://www.suzuco.net/entry/php-useragent-method/" target="blank">参考サイト</a></p>
    </div>
  </div>
  <div class="container">
    <img src="img/fukidashi.png" alt ="fukidashi">
    <div class="text_box">
      <h1>マウスオーバーでの吹き出し表示</h1>
      <p>①PHP MacOS<br />
      ②16.1h ③8.0h ④19/10/29<br />⑤これはなんだろう。物を手に取った際に誰かがパッと教えてくれたらいいな。WEBサイトででもボタンにマウスを重ねると、そのボタンの行き先・ガイドなんかが出て来たら嬉しいな。なんて思って実装。スマフォにはマウスって概念がないため未実装。<a href="https://www.tam-tam.co.jp/tipsnote/html_css/post9815.html" target="blank">参考サイト</a></p>
    </div>
  </div>
  <div class="container">
    <img src="img/toukou_post.png" alt ="tokou">
    <div class="text_box">
      <h1>投稿掲示板の追加</h1>
      <p>①PHP MacOS<br />
      ②11.1h ③5.0h ④19/10/29<br />⑤最近ダ・ゾーンを見ていて感じたのが、独りで見ているという感覚。ダ・ゾーンを使う前まではニコニコ動画でプレミアリーグを見ていた。ニコニコでは選手入場時から言葉が飛び交い、意見を交わす。「今日は誰が出ていない。誰は調子がいい。この前の試合の...」。そこには情報や感情を共有する同志のような存在があった。それは非常に良いものだった。このサイトにも投稿機能を実装しよう。<br />やってみると投稿情報を記録する「.dat」ファイルが認識されない。なんでだ。調べてみたが「.datはただのデータファイルだから問題なくいけるでしょ」的な書き込みを見る。僕が見たのと同じサイトを参考にした人が質問している記事を見たが、その記事への返信の意味を理解できず。結局わからないので、拡張子を「.txt」に変更して試してみる。これでもダメだった。仮想OSのセキュリティを変更して試してみる。やはりダメ。しょうがないので諦めてしまった。他のことをやり始めてしまった。為せば成るさと、実際にサーバにアップロードした時に再確認しよう。サーバに上げた後は上手く機能してくれた。それ以降、仮想OS上でもちゃんと動くようになった。何が原因だったのかいまだに分からないが、とりあえずチャレンジしてみることが大切だね。<a href="https://dotinstall.com/lessons/bbs_php_v2" target="blank">参考サイト</a></p>
    </div>
  </div>
  <div class="container">
    <img src="img/login.png" alt ="login">
    <div class="text_box">
      <h1>ログイン機能の追加</h1>
      <p>①PHP MacOS<br />
      ②10.1h ③1.0h ④19/10/29<br />⑤PHPでのログイン機能を追加。IDの保管とかは実装していないので形のみだが、それっぽいものは結構簡単にできそう。このページ、ヘッダー「POST」ボタン押下後、ログイン画面に移行する。ログインID：「login」、パスワード：「pass」でログイン可能にした。ログインしようがすまいが機能面に変わりはない。僕の心は弱い。難しい単語が出てくると逃げてしまうのだ。いずれは追加したいな。<a href="https://www.web-officer.com/php/make-login-system-with-php.php" target="blank">参考サイト</a></p>
    </div>
  </div>
  <div class="container">
    <img src="img/kaimen.png" alt ="海面の質感">
    <div class="text_box">
      <h1>海面と石</h1>
      <p>①Blender2.8 MacOS ver.10.14.6<br />
      ②0h ③2.0h ④19/10/23<br />⑤Blender初触り。平面に「海洋」のモブファイアーとやらを導入してみた。別途立方体を作成し、どんどん角を取り、石っぽいものを作成（この作業が一番楽しい）。それを海面に浮かべてみた。</p>
    </div>
  </div>
  <div class="container">
    <img src="img/shibahu.png" alt ="芝の質感">
    <div class="text_box">
      <h1>芝生やし</h1>
      <p>①Blender2.8 Mac ver.10.14.6<br />②2.0h ③4.0h ④19/10/23<br />⑤YouTubeの動画を参考に、平面にパーティクルヘアーを生やしてみた。２色の草を作成して配置したが、地面部分の平面には上手くテクスチャーが貼れず苦戦。テクスチャーブラシ？どうやって反映するんだ？と四苦八苦。結局諦め（飽き）て他の作業に移った。</p>
    </div>
  </div>
  <div class="container">
    <img src="img/dotinstall.png" alt ="dotin">
    <div class="text_box">
      <h1>プログラミング学習</h1>
      <p>①GoogleChrome ＆ ヘッドホン<br />②0h ③3.0h ④19/10/23<br />⑤PHPやHTML、CSSを動画をみながら学習できるサイト<a href="https://dotinstall.com" target="_blank">ドットインストール</a>。文章、画像だけのWEBサイトではわからなかった、そのデータ名がどの階層のものなのかとか、ウィンドウのどのボタンをクリックして次に進んでいるのかだとか、そういうところを確認できる点が非常によかった。一講座単位も短く、整理しやすい。講師の人はすごく早口で、こちらに唾が飛んできそう。とても感謝しています。</p>
    </div>
  </div>
  <div class="container">
    <img src="img/golden.jpg" alt ="ゴールデンカムイ">
    <div class="text_box">
      <h1>ゴールデンカムイ</h1>
      <p>①1〜10巻をトイレで通読<br />②3回目くらい ③1.5h ④19/10/23<br />⑤トイレの中、独りで漫画を読み進める。何度も行ったことのある流れだ。風呂やトイレは、唯一ひとりになれる場所だ。誰にも邪魔されず、静かで狭い。ほぼ内容の入っている10冊程度の漫画なら、1時間半ほどで読み終わるだろう。それだけトイレにこもることが許される人には試してほしい。</p>
    </div>
  </div>
  <div class="container">
    <img src="img/kutsu.jpg" alt ="靴">
    <div class="text_box">
      <h1>妻の靴選び</h1>
      <p>①デパートにて ②1回目 ③1.5h ④19/10/23<br />⑤売り場をあらかた周り、やはり目につくのは同じ靴。妻は言う。「これのここがもうちょっとこうだったらなあ。これのこの部分がこっちにもあればなあ」。「そうだねえ」と僕も言う。</p>
    </div>
  </div>
  <div class="container">
    <img src="img/homonsya_count.png" alt ="訪問者数">
    <div class="text_box">
      <h1>訪問者数カウント</h1>
      <p>①Mac PHP ②10.0h ③0.1h ④19/10/26<br />⑤訪問者数カウントの追加。やはり人、数字が好きだ。アクセス回数は知り得たい。参考にした<a href="https://on-ze.com/archives/1422" target="_blank">サイト</a>。</p>
    </div>
  </div>
  <div class="container">
    <img src="img/icon.png" alt ="pas">
    <div class="text_box">
      <h1>手書きからパス化</h1>
      <p>①MacOS イラストレーターCS4 ②多い ③1.0h ④19/10/23<br />⑤手書きでのメモをスマフォのカメラで撮影。フォトショップに取り込んで、2階調化。レベル補正して、白とばし。選択範囲で白地を選択し、削除。データを保存し、イラストレーターに配置、ライブトレースでパス化。</p>
    </div>
  </div>
  <div class="container">
    <img src="img/yama_mori.png" alt ="yuhi">
    <div class="text_box">
      <h1>夕日と奥行き</h1>
      <p>①Mac Blender2.8<br />②10.0h ③3.0h ④19/10/23<br />⑤平面をランダム化。凹凸を山っぽくし、山の面には別で作った気をパーティクルヘアーで生やした。地面には、一応テクスチャーを貼り付け。カメラの被写界深度を調整し、奥行きを作ってみた。</p>
    </div>
  </div>
  <div class="container">
    <img src="img/visual_studio.jpg" alt ="vs">
    <div class="text_box">
      <h1>Visual Studio Code の使用</h1>
      <p>①Visual Studio Code MacOS
      ②2.0h ③0.2h ④19/10/23<br />⑤これまでテキストエディタを使用していたが、このアプリを落として使ってみた。今の所試したのはHTMLやCSS、PHPだけだが、こちらの方が格段に使いやすい。</p>
    </div>
  </div>
  <div class="container">
    <img src="img/web_site.png" alt ="ウェブサイト">
    <div class="text_box">
      <h1>ウェブサイトの作成</h1>
      <p>①アプリ:VSCode CyberDuck ターミナル GoogleChrome VirtualBox<br />ドメイン＆サーバ:freenom XFREE<br />PC:MacOS<br />
      ②21.0h ③18.0h ④19/10/23<br />⑤最初はdockerを使って作業していたが、使い方が分からずじまい。サーフィンした結果、とりあえずVirtualBoxとCyberDuckに替えて再度チャレンジ。上手くいって、このサイトの公開に至る。</p>
    </div>
  </div>
  <div class="container">
    <img src="img/font.png" alt ="フォント">
    <div class="text_box">
      <h1>フォントの作成</h1>
      <p>①GlyphsMini イラストレーターCS4 MacOS<br />
      ②6.0h ③13.0h ④19/10/23<br />⑤アルファベットとかひらがなとか、シンプルで素敵な文字を自分でも作りたかった。憧れだ。もしかしたらこんな文字もあったかもしれない。なんて想像しながら夢中で作った。気が向いたら別の文字も作ってみたい。</p>
    </div>
  </div>
  <div class="container">
    <img src="img/xfree_a_code_user.png" alt ="xfree_a_code_user">
    <div class="text_box">
      <h1>レンタルサーバ側での新規ドメイン追加設定</h1>
      <p>①XFREE　ドメイン設定追加<br />
      ②0.0h ③9.0h ④19/10/23<br />⑤最初は「Web認証」や「メール認証」で進めようとしていたが、どうやら自分の環境のことではないらしい。「Aレコード認証」で進めることにした。「ドメイン名」を入力し、ドット以降の文字を選択。認証方法の「Aレコード認証」を選択。一番下の「ドメイン設定を追加する（確認）」を押す。が、だめ。なぜだ、と思いやり直してみる。進んだ。どうやら情報の更新には数分から數十分時間がかかるようだ。気長に待とう。</p>
    </div>
  </div>
  <div class="container">
    <img src="img/freenom.png" alt ="freenom">
    <div class="text_box">
      <h1>ドメイン取得後のAレコード反映</h1>
      <p>①freenom ②0.0h ③10.0h ④19/10/23<br />⑤自分のものとは、どんなものでもいいもんだ。自分の部屋や自分の漫画、ゲーム機。好きな時に好きなようにいじれる。WEBのドメインも自分だけのオリジナルを使いたい。<br />「freenom」でドメインを取得してみる。しかしどうしてか、欲しいドメインの取得はできているっぽいが、「My Domains」に反映されない。かれこれ二日間同じような申請を続けていたが、今日は「My Domains」に反映さた。「Manage Domain」、「Nameserver」、「Use default nameservers (Freenom Nameservers)」を選択。「Manage Freenom DNS」で「Name」にこのドメインを入力し、「Target」にはレンタルサーバ側のコンテンツ（IPアドレス）を入力し「Save Changes」を押下。上手く登録されたようだが、なぜか「Modify Records」の「Name」にはドメインが記載されず。こういう仕様なのかな。でも問題なく進められそう。<a href="https://www.freenom.com/ja/index.html?lang=ja" target="_blank">参考サイト</a></p>
    </div>
  </div>
<!-- </div> -->

<!-- 投稿フォーム -->
<!-- <h1>フォームデータの送信</h1>
<form action = “login_form.php” method = “post”>
<input type = “text” name =“login/“><br/>
<input type = “submit” value =“送信/“>
</form>
<?php
if(isset($_POST["login"])){
  $login = $_POST["login"];
  echo '<p>';
  echo ('あなたは <em>'.$login.'</em> です。');
  echo '</p>';
}?>
<p>失敗</p> -->
  <div class="POSTBOX">
    <div class="post_icon">
      <img src="img/post_retext.png" alt="icon">
    </div>
    <section class="mes_user">
      <form action="" method="post">
        MESSAGE　: <input type="text" name="message"><br />
        USERNAME : <input type="text" name="user"><br />
        <input type="submit" value="POST">
      </form>
    </section>
    <section class="toukou">
      <h2>LIST OF POSTS (<?php echo count($posts); ?>)</h2>
      <ul>
        <?php if (count($posts)) : ?>
        <?php foreach ($posts as $post) : ?>
        <?php list($message, $user, $postedAt) = explode("\t", $post); ?>
        <li><?php echo h($user); ?><br /><?php echo h($postedAt); ?><br /><?php echo h($message); ?></li>
        <?php endforeach; ?>
        <?php else : ?>
        <li>まだ投稿はありません。</li>
        <?php endif; ?>
      </ul>
    </section>
  </div>

<!-- 訪問者数カウント -->
<div class="count">
  <?php
    $counter_file = 'count.txt';
    $counter_lenght = 8;
    $fp = fopen($counter_file, 'r+');
    if ($fp) {
      if (flock($fp, LOCK_EX)) {
        $counter = fgets($fp, $counter_lenght);
        $counter++;
        rewind($fp);
        if (fwrite($fp,  $counter) === FALSE) {
          echo ('<p>'.'ファイル書き込みに失敗しました'.'</p>');
        }
        flock ($fp, LOCK_UN);
      }
    }
    fclose ($fp);
    echo '<p>';
    echo ('あなたは <em>'.$counter.'</em> 人目の訪問者です。');
    echo '</p>';
  ?>

<footer>
  <p>(c) kabu</p>
</footer>
</div>

</body>
</html>