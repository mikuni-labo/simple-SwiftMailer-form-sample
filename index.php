<?= header('X-Frame-Options: SAMEORIGIN');// クリックジャッキング対策(同一生成元のみ許可) ?>
<?php require_once ('./require_page.php');?>

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
					<li><a href="#"><span class="glyphicon glyphicon-blackboard"></span>&nbsp;メニュー1</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-blackboard"></span>&nbsp;メニュー2</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-blackboard"></span>&nbsp;メニュー3</a></li>
				</ul>
				
				<!-- Right Side Of Navbar -->
				<ul class="nav navbar-nav navbar-right">
					<!-- Authentication Links -->
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
							<span class="glyphicon glyphicon-home"></span>&nbsp;ゲストさん</a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="/"><span class="glyphicon glyphicon-home"></span>&nbsp;ホーム</a></li>
							<li><a href="#"><span class="glyphicon glyphicon-edit"></span>&nbsp;メニュー</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	
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
										<input type="text" class="form-control" name="last_name" required="required" value="" placeholder="姓" />
									</div>
									<div class="col-md-3">
										<input type="text" class="form-control" name="first_name" required="required" value="" placeholder="名" />
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-4 control-label" for="email">E-Mail<span class="attention">*</span></label>
									<div class="col-md-6">
										<div class="input-group">
											<span class="input-group-addon">@</span>
											<input type="email" class="form-control" name="email" required="required" value="" />
										</div>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-4 control-label">お問い合わせ内容<span class="attention">*</span></label>
									<div class="col-md-6">
										<textarea name="content" class="form-control" rows="5" placeholder=""></textarea>
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-md-6 col-md-offset-4">
										<a href="javascript:history.back();" class="btn btn-success"><span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;前の画面に戻る</a>
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
