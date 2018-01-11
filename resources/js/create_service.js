(function($) {
 $("#siguiente1").click(function(){
     var next = $(this).data("next");
     console.log(next);
    $("li.active").removeClass("active");
     $("li."+next).addClass("active");
     console.log("VALIDAR FORMULARIO");
 });
}(jQuery));
