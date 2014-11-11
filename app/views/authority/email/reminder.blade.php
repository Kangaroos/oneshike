<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>密码重置</h2>
		<div>
			点击以下链接完成密码重置: {{ URL::to('password/reset', array($token)) }}.<br/>
			有效期 {{ Config::get('auth.reminder.expire', 60) }} 分钟.
		</div>
	</body>
</html>
