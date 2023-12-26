<!DOCTYPE html>
<html>
<head>
    <title>Please enter the code to verify</title>
</head>
<body>
<h1>hello {{ $data['first_name'] }} {{ $data['last_name'] }}</h1>
<p>To increase security, please enter the verification code</p>
    <p>your code is : {{$data['code']}}</p>
</body>
</html> 
