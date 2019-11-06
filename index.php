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

<!-- 初期宣言 -->
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>KABUの実行メモ</title>
  <link rel="icon" href="html_php_css/img/head_icon.png">
  <meta name="description" content="KABUの実行メモ。">
  <?php if (isSmartPhone()): {?>  <!-- スマホで閲覧 -->
    <link rel="stylesheet" href="html_php_css/top_mobile.css" />
    <?php }else: {?>  <!-- PCで閲覧 -->
    <!-- <link rel="stylesheet" href="html_php_css/top_mobile.css" /> -->
    <link rel="stylesheet" href="html_php_css/top_styles.css">
  <?php }endif; ?>
</head>

<body>
<header>
</header>

<!-- ヘッダーボタン -->
<div class="header_bot">
  <!-- <?php if (isSmartPhone()): ?>
  <img src="icon/gal_icon_text.png" height=250px alt="gallery"></a> スマホで閲覧中-->
  <?php else: ?>
  <!--PCで閲覧中-->
  <?php endif; ?> 
  <div class="botton_gal">
    <a href="html_php_css/second.php">
    <img src="icon/gallery_text.png" height=30px alt="gallery"></a>
    <p class="fukidashi_gal">実行したことを作業時間等と一緒にメモしています。</p>
  </div>
  <div class="botton_pos">
    <a href="html_php_css/login_form.php" target="_blank">
    <img src="icon/post_text.png" height=30px alt="post"></a> 
    <p class="fukidashi_pos">掲示板作ってみました。何かあれば投稿してみてください。</p>
  </div>
</div>

<!-- トップ絵 -->
<div class="top">
  <?php if (isSmartPhone()): ?>
  <!-- スマホで閲覧中 -->
  <img src="icon/top_mobile_intext.png" width=1100px alt="top">
  <?php else: ?>
  <!-- PCで閲覧中 -->
  <img src="icon/top_big.png" width=1100px alt="top">
  <?php endif; ?>
</div>

<!-- フッター -->
<footer>
  <p>(c) kabu</p>
</footer>
</body>
</html>