<?= header('X-Frame-Options: SAMEORIGIN');// クリックジャッキング対策(同一生成元のみ許可) ?>
<?php require_once ('./require_page.php'); ?>

<!DOCTYPE html>
<html lang="ja">
<head>
	
	<!-- Meta Data -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<title><?= SITE_NAME ?></title>
	
	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
	
	<!-- Styles -->
	<link type="text/css" href="<?= HTTP_URL ?>/public/bootstrap/css/bootstrap-umi.min.css" rel="stylesheet">
	<link type="text/css" href="<?= HTTP_URL ?>/public/css/style.css" rel="stylesheet" media="screen">
	<!-- <link type="image/vnd.microsoft.icon" rel="shortcut icon" href="/favicon.ico"> -->
	
</head>
<body>
	<header class="header">
		<!-- Global Navigation Header -->
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					
					<!-- Collapsed Hamburger -->
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
						<span class="sr-only">Toggle Navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					
					<!-- Branding Image -->
					<a class="navbar-brand" href="<?= HTTP_URL ?>"><?= SITE_NAME ?></a>
				</div>
				
				<div class="collapse navbar-collapse" id="app-navbar-collapse">
					<!-- Left Side Of Navbar -->
					<ul class="nav navbar-nav">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
								<span class="glyphicon glyphicon-user"></span>&nbsp;メニュー1&nbsp;<span class="caret"></span>
							</a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="#"><span class="glyphicon glyphicon-info-sign"></span>&nbsp;子メニュー1</a></li>
								<li><a href="#"><span class="glyphicon glyphicon-info-sign"></span>&nbsp;子メニュー2</a></li>
								<li><a href="#"><span class="glyphicon glyphicon-info-sign"></span>&nbsp;子メニュー3</a></li>
							</ul>
						</li>
						
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
								<span class="glyphicon glyphicon-blackboard"></span>&nbsp;メニュー2&nbsp;<span class="caret"></span>
							</a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="#"><span class="glyphicon glyphicon-info-sign"></span>&nbsp;子メニュー1</a></li>
								<li><a href="#"><span class="glyphicon glyphicon-info-sign"></span>&nbsp;子メニュー2</a></li>
								<li><a href="#"><span class="glyphicon glyphicon-info-sign"></span>&nbsp;子メニュー3</a></li>
							</ul>
						</li>
						
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
								<span class="glyphicon glyphicon-leaf"></span>&nbsp;メニュー3&nbsp;<span class="caret"></span>
							</a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="#"><span class="glyphicon glyphicon-info-sign"></span>&nbsp;子メニュー1</a></li>
								<li><a href="#"><span class="glyphicon glyphicon-info-sign"></span>&nbsp;子メニュー2</a></li>
								<li><a href="#"><span class="glyphicon glyphicon-info-sign"></span>&nbsp;子メニュー3</a></li>
							</ul>
						</li>
					</ul>
					
					<!-- Right Side Of Navbar -->
					<ul class="nav navbar-nav navbar-right">
						<!-- Authentication Links -->
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
								<span class="glyphicon glyphicon-home"></span>&nbsp;ゲストさん <span class="caret"></span>
							</a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="<?= HTTP_URL ?>"><span class="glyphicon glyphicon-home"></span>&nbsp;ホーム</a></li>
								<li><a href="#"><span class="glyphicon glyphicon-edit"></span>&nbsp;アカウント情報</a></li>
								<li><a href="#"><span class="glyphicon glyphicon-cog"></span>&nbsp;設定</a></li>
								<li><a href="#"><span class="glyphicon glyphicon-off"></span>&nbsp;ログアウト</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</header>
	
	<!-- Contents -->
	<section class="section">
		<div class="container">
			<div class="row animated fadeIn">
				<div class="col-md-4 col-md-offset-1">
					<ul class="breadcrumb">
						<li><a href="/">Home</a></li>
						<li class="active">Contact</li>
					</ul>
				</div><!-- .col -->
			</div><!-- .row -->
		</div><!-- .container -->
	</section>
	<section class="section">
		<div class="container">
			<div class="row animated fadeIn">
				<div class="col-md-10 col-md-offset-1">
					
					<div class="panel panel-info">
						<div class="panel-heading">ユーザー登録</div>
						<div class="panel-body">
						
							<form class="form-horizontal" role="form" method="POST" action="sendmail.php">
								<input type="hidden" class="form-control" name="_token" required="required" value="<?php //$token ?>" />
								
								<div class="form-group">
									<label class="col-md-4 control-label">お名前<span class="attention">*</span></label>
									<div class="col-md-3">
										<input type="text" class="form-control" name="last_name" required="required" maxlength="255" value="" placeholder="姓" />
									</div>
									<div class="col-md-3">
										<input type="text" class="form-control" name="first_name" required="required" maxlength="255" value="" placeholder="名" />
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-4 control-label">フリガナ<span class="attention">*</span></label>
									<div class="col-md-3">
										<input type="text" class="form-control" name="last_name_kana" required="required" maxlength="255" value="" placeholder="セイ" />
									</div>
									<div class="col-md-3">
										<input type="text" class="form-control" name="first_name_kana" required="required" maxlength="255" value="" placeholder="カナ" />
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-4 control-label">性別</label>
									<div class="col-md-6 form-control-static">
										<label><input type="radio" name="gender" value="女性" />&nbsp;女性&nbsp;&nbsp;&nbsp;</label>
										<label><input type="radio" name="gender" value="男性" />&nbsp;男性&nbsp;&nbsp;&nbsp;</label>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-4 control-label">生年月日(西暦)</label>
									<div class="input-group">
										<div class="col-md-3">
											<input type="tel" class="form-control" name="birth_y" value="" placeholder="YYYY" maxlength="4" />
										</div>
										<div class="col-md-3">
											<input type="tel" class="form-control" name="birth_m" value="" placeholder="MM" maxlength="2" />
										</div>
										<div class="col-md-3">
											<input type="tel" class="form-control" name="birth_d" value="" placeholder="DD" maxlength="2" />
										</div>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-4 control-label">E-Mail<span class="attention">*</span></label>
									<div class="col-md-6">
										<div class="input-group">
											<span class="input-group-addon">@</span>
											<input type="email" class="form-control" name="email" required="required" maxlength="255" value="" />
										</div>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-4 control-label">電話番号</label>
									<div class="input-group">
										<div class="col-md-3">
											<input type="tel" class="form-control" name="tel1" value="" placeholder="012" maxlength="5" />
										</div>
										<div class="col-md-3">
											<input type="tel" class="form-control" name="tel2" value="" placeholder="3456" maxlength="5" />
										</div>
										<div class="col-md-3">
											<input type="tel" class="form-control" name="tel3" value="" placeholder="7890" maxlength="5" />
										</div>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-4 control-label">お問い合わせ内容<span class="attention">*</span></label>
									<div class="col-md-6">
										<textarea name="content" class="form-control" rows="5" maxlength="5000" placeholder="5000文字まで入力できます。"></textarea>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-4 control-label">フリーテキスト1</label>
									<div class="col-md-6">
										<input type="text" class="form-control" name="free_text1" value="" maxlength="255" placeholder="オプションとして利用してください。" />
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-4 control-label">フリーテキスト2</label>
									<div class="col-md-6">
										<input type="text" class="form-control" name="free_text2" value="" maxlength="255" maxlength="" placeholder="オプションとして利用してください。" />
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-4 control-label">フリーテキスト3</label>
									<div class="col-md-6">
										<input type="text" class="form-control" name="free_text3" value="" maxlength="255" placeholder="オプションとして利用してください。" />
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-4 control-label">フリーテキスト4</label>
									<div class="col-md-6">
										<input type="text" class="form-control" name="free_text4" value="" maxlength="255" placeholder="オプションとして利用してください。" />
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-4 control-label">フリーテキスト5</label>
									<div class="col-md-6">
										<input type="text" class="form-control" name="free_text5" value="" maxlength="255" placeholder="オプションとして利用してください。" />
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-4 control-label">フリーテキスト6</label>
									<div class="col-md-6">
										<input type="text" class="form-control" name="free_text6" value="" maxlength="255" placeholder="オプションとして利用してください。" />
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-4 control-label">フリーテキスト7</label>
									<div class="col-md-6">
										<input type="text" class="form-control" name="free_text7" value="" maxlength="255" placeholder="オプションとして利用してください。" />
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-4 control-label">フリーテキストエリア1</label>
									<div class="col-md-6">
										<textarea name="free_area1" class="form-control" rows="5" maxlength="3000" placeholder="オプションとして利用してください。"></textarea>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-4 control-label">フリーテキストエリア2</label>
									<div class="col-md-6">
										<textarea name="free_area2" class="form-control" rows="5" maxlength="3000" placeholder="オプションとして利用してください。"></textarea>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-4 control-label">フリーテキストエリア3</label>
									<div class="col-md-6">
										<textarea name="free_area3" class="form-control" rows="5" maxlength="3000" placeholder="オプションとして利用してください。"></textarea>
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-md-6 col-md-offset-4">
										<button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-import"></span>&nbsp;登録</button>
									</div>
								</div>
							</form>
						</div><!-- .panel-body -->
					</div><!-- .panel -->
				</div><!-- .col -->
			</div><!-- .row -->
		</div><!-- .container -->
	</section>
	
	<!-- Footer -->
	<footer class="footer text-center">
		<div class="container">
			<small>&copy;&nbsp;<?= date('Y', time()) ?>&nbsp;<a href="<?= HTTP_URL ?>">和田</a>&nbsp;All&nbsp;Rights&nbsp;Reserved.</small>
		</div>
	</footer>
	
	<!-- Scripts -->
	<script type="text/javascript" src="<?= HTTP_URL ?>/public/js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="<?= HTTP_URL ?>/public/bootstrap/js/bootstrap-3.3.6.min.js"></script>
	<script type="text/javascript" src="<?= HTTP_URL ?>/public/bootstrap/js/bootstrap-confirmation.min.js"></script>
	
</body>
</html>
