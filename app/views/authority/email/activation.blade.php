<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>激活账号</h2>
<div>
    <p>感谢您注册食客网，请点击以下链接激活您的账号：
        <br /><a href="{{ route('activate', $activationCode) }}" target="_blank">{{ route('activate', $activationCode) }}</a>
    </p>
</div>
</body>
</html>