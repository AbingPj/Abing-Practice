
  <script src="{{ asset('js/app.js') }}" defer></script>
  {{-- <script src="{{ asset('js/Chart.bundle.js') }}" defer></script> --}}
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.js" integrity="sha256-qSIshlknROr4J8GMHRlW3fGKrPki733tLq+qeMCR05Q=" crossorigin="anonymous"></script> --}}

 <script>
 
function LoadingLoadingLoading() {
 LoadingOverlay();
 setTimeout(() => {
    //  LoadingOverlayHide();
    window.location.href = "/";
 }, 2000);
}

function LoadingLoading() {
 LoadingOverlay();
 setTimeout(() => {
    LoadingOverlayHide();
 }, 3000);
}

function LoadingOverlay() {
 var customElement = $("<img>", {
     class: "ld ld-breath",
     src: "{{ asset('img/luffy.svg') }}"
 });
 $.LoadingOverlay("show", {
     custom: customElement,
     image: "",
     imageAnimation: ""
 });
}

function LoadingOverlayHide() {
 $.LoadingOverlay("hide");
}





 </script>