@extends('layouts.app')

@section('head')
<script src="https://js.pusher.com/5.0/pusher.min.js"></script>
<script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('daac01c5e5a1237f4168', {
      cluster: 'ap1',
      forceTLS: true
    });

    // var channel = pusher.subscribe('MyChannel');
    // channel.bind('MyEvent', function(data) {
    // //   alert(JSON.stringify(data));
    //     console.log("data");
    //     document.getElementById("p").innerHTML=data;
    // });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
      //alert(JSON.stringify(data));
      
      var data = data.message;
        var para = document.createElement("p");
        var node = document.createTextNode(data);
        para.appendChild(node);
        var element = document.getElementById("div1");
        element.appendChild(para);
    });
  </script>
@endsection

@section('content')
   <pushers></pushers>
  <input id="input" type="text">
  <input id="_token" type="hidden" value="{{ csrf_token() }}">
  <button onclick="send()">Send</button>
  <h1>Pusher Test</h1>
  <div id="div1">
  </div>
  
@endsection

@section('scripts')
    <script>
        function send(){
            let data = document.getElementById("input").value;
            // let _token = document.getElementById("_token").value;
            // let data = [{input},{_token}];
            // console.log({data});
            // axios.post('/send/pusher',data);
            axios.post('/send/pusher', {
                    data: data
            });
        }
    </script>
   
@endsection
