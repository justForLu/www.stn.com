<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>欢迎登录贤芯智能电动车CMS管理系统</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    @include('admin.public.css')
</head>
<body>
    <div class="login-box">
         @yield('content')
    </div>
@include('admin.public.js')
</body>
</html>