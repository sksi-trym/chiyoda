<?php
session_start();
require_once './class/conf.php';
require_once './class/viewClass.php';
$view = new view();
//$view->backTop();
require_once './class/validateClass.php';
$_SESSION['ticket'] = md5(uniqid().mt_rand());

$err_array = array(
		'name' => '氏名（姓）',
		'furigana' => '氏名（名）',
    'tel' => '電話番号',
		'email' => 'メールアドレス',
    'cmt' => 'お問い合わせ内容',
);
setData();
$validate = new validate($err_array);
$err = $validate->setStr();
if(count($err) > 0){
	$_SESSION['err_msg'] = $err;
	header('location:' . TMPL_CONFIRM);
	exit();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.6">
  <meta name="description" content="花の総合トータルプロデュース">
  <meta name="keywords" content="千代田園芸株式会社,千代田園芸,２４時間受付,東京都,東京,千代田区,東京都千代田区岩本町,03-3862-2647,03-3865-0337,花,ラン,蘭,花束,生花,アレンジ,アレンジメント,花屋,生花店,訃報,葬儀,葬儀社,花祭壇,弔花,ぱれっと,パレット,スタンド花,お祝い">
  <!-- og -->
  <meta property="og:title" content="">
  <meta property="og:description" content="">
  <meta property="og:type" content="article">
  <meta property="og:url" content="">
  <meta property="og:image" content="">
  <!-- /og -->
  <title>お問い合わせ｜千代田園芸株式会社</title>
  <link rel='stylesheet' id='font-awesome-css'  href='//maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css?ver=all' type='text/css' media='all' />
  <link href="/common/css/mmenu.css" rel="stylesheet">
	<link href="/common/css/common.css" rel="stylesheet">
  <link href="/css/contents.css" rel="stylesheet">
  <link href="/common/css/sp.css" rel="stylesheet">
</head>
<body>

  <!--wrap-->
  <div id="wrap">

		<!-- header -->
		<?php
      $root = $_SERVER['DOCUMENT_ROOT'] . '/common/inc/';
      include($root . 'header.html');
    ?>
    <!-- /header -->

    <!--contents-->
    <div id="contents">
      <!-- main -->
      <main>

        <section id="contact" class="confirm">
          <h2><span>お問い合わせ</span></h2>
          <form id="form" action="mailsend.php" method="post" enctype="multipart/form-data" >

            <div id="contact-list">
              <dl>
                <dt>お名前<span class="required">必須</span></dt>
                <dd>
                  <?php echo $view->escape($_SESSION['name']); ?>
                </dd>
              </dl>
              <dl>
                <dt>フリガナ<span class="required">必須</span></dt>
                <dd><?php echo $view->escape($_SESSION['furigana']); ?></dd>
              </dl>
              <dl>
                <dt>電話番号<span class="required">必須</span></dt>
                <dd><?php echo $view->escape($_SESSION['tel']); ?></dd>
              </dl>
              <dl>
                <dt>メールアドレス<span class="required">必須</span></dt>
                <dd><?php echo $view->escape($_SESSION['email']); ?></dd>
              </dl>
              <dl>
                <dt>お問合わせ内容<span class="required">必須</span></dt>
                <dd>
                  <?php echo $view->escape($_SESSION['cmt']); ?>
                </dd>
              </dl>
            </div>
            <p id="submit-bt">
							<input type="hidden" name="ticket" value="<?php echo htmlspecialchars($_SESSION['ticket'], ENT_QUOTES); ?>" />
              <input type="submit" id="submit_confirm" value="送信" class="btn">
              <button type="button" onclick="history.back();" value="入力へ戻る" class="backBtn">入力へ戻る</button>
            </p>

          </form>
        </section>

        <section class="all gray">
					<?php
			      $root = $_SERVER['DOCUMENT_ROOT'] . '/common/inc/';
			      include($root . 'banner.html');
			    ?>
        </section>

      </main>
      <!-- /main -->
    </div>
    <!--/contents-->

		<!-- footer -->
		<?php
      $root = $_SERVER['DOCUMENT_ROOT'] . '/common/inc/';
      include($root . 'footer.html');
    ?>
    <!-- /footer -->

  </div>
  <!--/wrap-->

  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="/common/js/mmenu.js"></script>
  <script src="/common/js/common.js"></script>
</body>
</html>
