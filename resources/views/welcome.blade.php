<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
</head>
<body>
<input type="text" id="message">
<button onclick="test()">test</button>
</body>
<script src="{{ asset('js/app.js') }}"></script>
<script>
    window.Echo.private('ch5').listen('TestEvent', e => console.log(e))
    function test() {
        let message = document.querySelector('#message');
        let v = message.value.replace(/(^\s+)|(\s+$)/g, "")
        if (!v) {
            alert('no message')
            return
        }
        axios.get(`http://192.168.1.222/laravel-echo-socket.io/public/index.php/emit/${v}`)
    }
</script>
</html>
