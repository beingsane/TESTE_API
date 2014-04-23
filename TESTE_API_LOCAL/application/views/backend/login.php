<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	
	<title><?=_NAME_EMPRESA_?> - Login</title>
	<!-- Theme CSS -->
	<link rel="stylesheet" href="<?=_HTTP_CSSPATH_?>/backend/login.css">

	<!-- jQuery -->
	<script src="<?=_HTTP_JSPATH_?>/jquery-1.7.1.min.js"></script>
	<link rel="shortcut icon" href="/favicon.ico" />
	<!-- Apple devices Homescreen icon -->
	<link rel="apple-touch-icon-precomposed" href="img/apple-ico.png" />

</head>

<body class='login'>
	<div class="wrapper">
		<h1 style="text-align: center;"><img src="<?=_HTTP_IMGPATH_?>/logo.png" alt="" class='retina-ready'></h1>
		<div class="login-body">
			<h2>Login Administrativo</h2>
			<form action="<?=_HTTP_BASEPATH_?>/backend/login_mig/exec_login" method='post' class='form-validate' id="test">
				<input type="hidden" value="<?=$this->input->get("url")?>" name="url">
				<div class="control-group">
					<div class="email controls">
						<input type="text" name='user' placeholder="Usuário" class='input <?=(isset($email) ? "error" : "")?>'>
					</div>
				</div>
				<div class="control-group">
					<div class="pw controls">
						<input type="password" name="upw" placeholder="Senha" class='input <?=(isset($upw) ? "error" : "")?>' >
					</div>
				</div>
				<div class="submit">
					<div id="error">
						<div><?=(isset($email) 			? $email : "")?></div>
						<div><?=(isset($upw) 			? $upw : "")?></div>
						<div><?=(isset($_GET["error"]) 	? addslashes($_GET["error"]) : "")?></div>
						<div><?=(isset($error) 			? $error : "")?></div>
					</div>
					<input type="submit" value="Login" class='btn btn-primary'>
				</div>
				<span id="lost_pass" style="display: inline-block;font-size: 12px;text-align: right;cursor: pointer;float: right;margin-top: 3px;color: #999;">Esqueci minha senha</span>
				<div style="clear: both;"></div>
			</form>
		
		</div>
	</div>
	<div id="mask"></div>
	<div id="lost_pass_content">
		<div class="control-group">
			<div class="pw controls" style="width: 90%;margin: 10px auto 10px 10px;;text-align: center;">
				<input type="text" name="lost_pass" placeholder="Email" class='input' id="lost_pass_email"/>
				<span class='btn btn-primary' style="margin-top: 20px;display: block;" id="send_email">Recuperar</span>
				<div id="error_lost_pass"></div>
			</div>
		</div>
	</div>
	<script src="<?=_HTTP_JSPATH_?>/backend/login.js"></script>
</body>

</html>
