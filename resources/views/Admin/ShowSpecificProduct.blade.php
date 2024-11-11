<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h3>hello</h3>
    <form id="myForm" action="{{url("admin/product_key/$jsonData")}}" method="POST">
        @csrf
        <input type="hidden" name="jsonData" value="{{$jsonData}}">
    </form>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('myForm').submit();
        });
    </script>
</body>
</html>