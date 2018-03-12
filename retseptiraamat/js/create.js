
window.onload = function() {
    
    if (typeof jQuery === "undefined") {
    var script = document.createElement('script');
    script.src = 'http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js';
    script.type = 'text/javascript';
    document.getElementsByTagName('head')[0].appendChild(script);
}
    
    document.getElementById('imageUpload').addEventListener("change",function(){
        readURL(this);
    });
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
            
        reader.onload = function (e) {
            document.getElementById('showImage').setAttribute('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

