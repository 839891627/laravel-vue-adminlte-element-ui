<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href="http://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<link href="http://cdn.bootcss.com/animate.css/3.5.2/animate.min.css" rel="stylesheet">
	{{--<link href="http://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">--}}
	{{--<link href="http://cdn.bootcss.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">--}}
	<![endif]-->
	<script>
		window.Laravel = {
			csrfToken: '{{ csrf_token() }}'
		}
	</script>
	<title>Vue-Laravel</title>
	<style>
		html, body, #app, .wrapper {
			height: 100% !important
		}

		a {
			text-decoration: none;
		}
	</style>
</head>
<body class="body">
<div id="app"></div>
{{--<script src="http://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>--}}
{{--<script src="http://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>--}}
<script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
