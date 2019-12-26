<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
    <div class="container" >
         <button class="btn btn-success" onclick="demot()">
            DEMO
        </button>
        <br>
        <div class="row">

            <div id="el1" class="col-sm-6 bg-primary">
                <h1>PRIMARY</h1>
            </div>

            <div id="el2" class="col-sm-6 bg-danger">
                <h1>DANGER</h1>
            </div>
        </div>
    </div>
</div>

    <script src="{{ asset('/js/app.js') }}" defer></script>
{{-- <script src="{{ asset('js/app.js') }}"></script> --}}
 <script>

    // $(document).ready(function() { 
    //     $("#demo").click(function() { 
    //            alert("oyee");
    //     }); 

    function demot(){
        // Instance the tour
        var tour = new Tour({
  steps: [
  {
    element: "#el1",
    title: "Title of my step 1",
    content: "Content of my step 1"
  },
  {
    element: "#el2",
    title: "Title of my step 2",
    content: "Content of my step"
  }
]});

// Initialize the tour
tour.init();
// Start the tour
tour.start();
    
}






    </script>
</body>
</html>