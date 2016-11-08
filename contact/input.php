<?php
session_start();
require_once './class/conf.php';
require_once './class/viewClass.php';
$view = new view();
//$view->backTop();
$name = '';
$furigana = '';
$tel = '';
$email = '';
$cmt = '';
//$upfile = '';
if(isset($_SESSION['family_name'])) $name = $_SESSION['name'];
if(isset($_SESSION['first_name'])) $furigana = $_SESSION['$furigana'];
if(isset($_SESSION['tel'])) $tel = $_SESSION['tel'];
if(isset($_SESSION['email'])) $email  = $_SESSION['email'];
if(isset($_SESSION['cmt'])) $cmt  = $_SESSION['cmt'];
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
  <link href="/common/css/validationEngine.jquery.css" rel="stylesheet">
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

        <section id="contact">
          <h2><span>お問い合わせ</span></h2>
          <form id="form" action="confirm.php" method="post" enctype="multipart/form-data" >

            <div id="contact-list">
              <dl>
                <dt>お名前<span class="required">必須</span></dt>
                <dd>
                  <input type="text" name="name" class="name01 validate[required] text-input" data-prompt-position="topLeft" value="<?php echo $name;?>" />
                </dd>
              </dl>
              <dl>
                <dt>フリガナ<span class="required">必須</span></dt>
                <dd><input type="text" name="furigana" class="name02 validate[required] text-input" data-prompt-position="topLeft" value="<?php echo $furigana;?>" /></dd>
              </dl>
              <dl>
                <dt>電話番号<span class="required">必須</span></dt>
                <dd><input type="tel" name="tel" class="tell_number validate[required,custom[phone]]" data-prompt-position="topLeft" value="<?php echo $tel;?>" /><span>ハイフンなし、半角数字</span></dd>
              </dl>
              <dl>
                <dt>メールアドレス<span class="required">必須</span></dt>
                <dd><input type="email" name="email" class="email validate[required,custom[email]]" data-prompt-position="topLeft" value="<?php echo $email;?>" /></dd>
              </dl>
              <dl>
                <dt>お問合わせ内容<span class="required">必須</span></dt>
                <dd><textarea name="cmt" cols="45" rows="5" class="long validate[required]" data-prompt-position="topLeft" id="cmt"></textarea></dd>
              </dl>
            </div>
            <p id="submit-bt">
              <input type="hidden" name="mode" value="confirm" />
              <input type="submit" id="submit" value="確認画面へ" class="btn">
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
  <script src="/common/js/jquery.validationEngine.js"></script>
  <script src="/common/js/jquery.validationEngine-ja.js"></script>
  <script src="/common/js/common.js"></script>
  <script type="text/javascript">
    $(function(){
      $("#form").validationEngine();
    });
  </script>
</body>
</html>
