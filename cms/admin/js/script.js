// ClassicEditor
// .create( document.querySelector( '#body' ) )
// .catch( error => {
//     console.error( error );
$(document).ready(function(){
    console.log("Hello");
});
function loadUserOnline(){
    $.get("functions.php?onlineusers=result", function(data){
        $(".usersonline").text(data)
    });
}
// loadUserOnline();
setInterval(function(){
    loadUserOnline();
}, 500)