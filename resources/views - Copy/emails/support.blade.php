<!DOCTYPE html>
<html>
<head>
    <title>{{__('support')}}</title>
</head>
<body>
<h3>from {{ $mail['first_name'] }} {{ $mail['last_name'] }}</h3>
<h5>mobile : {{ $mail['mobile'] }}</h5> .....<h5> email : {{ $mail['email'] }}</h5>
    <p> {{ $mail['message'] }} </p>
</body>
</html> 