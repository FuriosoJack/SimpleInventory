<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$titlePage}}</title>
    <link rel="stylesheet" type="text/css" href="{{asset('semantic/semantic.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/dataTables.semanticui.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/animate.css')}}">
    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('semantic/semantic.js')}}"></script>
    <script src="{{asset('js/datatables.min.js')}}"></script>
    <script src="{{asset('js/alasql.min.js')}}"></script>
    <script src="{{asset('js/dataTables.semanticui.min.js')}}"></script>
</head>
<body>
<div class="ui container fluid" style="padding: 10px;">
    @yield('body')
</div>

<script type="text/javascript">

    $('.ui.dropdown').dropdown();
</script>
</body>
</html>