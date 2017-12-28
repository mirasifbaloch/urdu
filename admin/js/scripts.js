tinymce.init({
    selector: 'textarea',
    directionality :"rtl",
    rtl_ui:true
});
// tinymce.init({
//     selector: 'textarea',
//     height: 500,
//     theme: 'modern',
//     plugins: 'print preview fullpage powerpaste searchreplace autolink directionality advcode visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount tinymcespellchecker a11ychecker imagetools mediaembed  linkchecker contextmenu colorpicker textpattern help',
//     toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
//     image_advtab: true,
//     templates: [
//         { title: 'Test template 1', content: 'Test 1' },
//         { title: 'Test template 2', content: 'Test 2' }
//     ],
//     content_css: [
//         '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
//         '//www.tinymce.com/css/codepen.min.css'
//     ]
// });



$(document).ready(function(){
    
$('#selectAllBoxes').click(function(event){
    
    if(this.checked) {
        
 $('.checkBoxes').each(function(){
     
     
     this.checked = true;
     
});       
        
} else {
    
 $('.checkBoxes').each(function(){
     
     
     this.checked = false;
});
    
}

    
});
    
    
    
});
//
//
//var div_box = "<div id='load-screen'><div id='loading'></div></div>";
//
//$("body").prepend(div_box);
//    
//$('#load-screen').delay(700).fadeout(600, function(){
//    $(this).remove();
//});

function loadUsersOnline() {
    
    $.get("functions.php?onlineusers=result", function(data){
        
          $(".usersonline").text(data);
    });
          
}

setInterval(function(){
    
loadUsersOnline();    
    
},500);

