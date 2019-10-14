
 <script src="{{ asset('js/app.js') }}" defer></script>
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