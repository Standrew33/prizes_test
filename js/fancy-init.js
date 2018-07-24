$(document).ready(function(){
    $("[data-fancybox]").fancybox();
    
    $(".modal-save__btn-yes").on("click",function(e){
        e.preventDefault();
        $.fancybox.close();
        $("#add-company__option-btn").click(); 
        $("#add-user__save").click();
    });
    $(".modal-save__btn-no").on("click",function(){
        $.fancybox.close();
    });
    
    $(".modal-save__btn-yes").on("click",function(e){
        e.preventDefault();
        $.fancybox.close();
       $("#add-user__save").click(); 
    });
});