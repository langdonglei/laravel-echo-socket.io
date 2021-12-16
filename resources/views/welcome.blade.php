<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Laravel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
@auth
    <input type="text" id="message">
    <button onclick="test()">test</button>
    <button onclick="location.href='{{ url('/logout') }}'">logout</button>
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
@else
    <button onclick="location.href = '{{ url('/login/3') }}'">login</button>
@endauth
</body>
</html>
