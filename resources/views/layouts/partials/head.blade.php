<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ config('app.name', 'Laravel') }}</title>
<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
{{-- <script src="{{ asset('js/Chart.bundle.js') }}" defer></script> --}}
{{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
{{-- <link href="{{ asset('css/loading.css') }}" rel="stylesheet"> --}}
{{-- <script src="https://js.pusher.com/4.4/pusher.min.js"></script>
<script>
    Pusher.logToConsole = true;
     var pusher = new Pusher('daac01c5e5a1237f4168', {
  cluster: 'ap1',
  forceTLS: true
});
var channel = pusher.subscribe('UserPostChannel');
channel.bind('UserPostEvent', function(data) {
  console.log("FROM SCRIPT");
});
</script> --}}