$(document).ready(function(){ 
    var urlPage = window.location.href;
    
   switch(urlPage) {
        case "http://footzone.group/admin/company/add.php":
            $(".menu-list .menu-item:nth-child(1)").addClass("active");
            break;
       case "http://footzone.group/admin/company/":
           $(".menu-list .menu-item:nth-child(1)").addClass("active");
            break;
        case "http://footzone.group/admin/discount/":
           $(".menu-list .menu-item:nth-child(2)").addClass("active");
            break;
        case "http://footzone.group/admin/discount/add.php":
           $(".menu-list .menu-item:nth-child(2)").addClass("active");
            break;
        case "http://footzone.group/admin/discount/edit.php":
           $(".menu-list .menu-item:nth-child(2)").addClass("active");
            break;
        case "http://footzone.group/admin/user/":
           $(".menu-list .menu-item:nth-child(3)").addClass("active");
            break;
        case "http://footzone.group/admin/user/add.php":
           $(".menu-list .menu-item:nth-child(3)").addClass("active");
            break;
        case "http://footzone.group/admin/user/list.php":
           $(".menu-list .menu-item:nth-child(3)").addClass("active");
            break;
        case "http://footzone.group/admin/bonus/":
           $(".menu-list .menu-item:nth-child(4)").addClass("active");
            break;
        case "http://footzone.group/admin/support/":
           $(".menu-list .menu-item:nth-child(4)").addClass("active");
        break;
        case "http://footzone.group/admin/journal/index.php":
           $(".menu-list .menu-item:nth-child(5)").addClass("active");
        break;
        case "http://footzone.group/admin/journal/add.php":
           $(".menu-list .menu-item:nth-child(5)").addClass("active");
        break;
        case "http://footzone.group/admin/art/index.php":
           $(".menu-list .menu-item:nth-child(6)").addClass("active");
        break;
        case "http://footzone.group/admin/art/add.php":
           $(".menu-list .menu-item:nth-child(6)").addClass("active");
        break;
   }
    
    $(".menu-item").hover(function(){
        if($(this).hasClass("active")) {
           $(this).removeClass("active"); 
            $(this).siblings().removeClass("active");
        }else {
            $(this).addClass("active");    
        }
    });
    
    $(".mobile-menu").on("click",function(){
        if($(this).hasClass("active")) {
            $(this).removeClass("active");
            $(".mobile-menu__list").slideUp();
        }else {
            $(this).addClass("active");
            $(".mobile-menu__list").slideDown();
        }
    });
    $(".mobile-menu__item-link").on("click",function(){
        if($(this).parent().hasClass("active")) {
            $(this).parent().removeClass("active");
            $(this).parent().find(".mobile-drop__list").slideUp();
            $(this).find(".mobile-menu__item-icon").removeClass("active");
        }else {
            $(this).parent().addClass("active"); 
            $(this).parent().siblings().removeClass('active');
            $(this).find(".mobile-menu__item-icon").addClass("active");
            $(this).parent().siblings().find(".mobile-drop__list").slideUp();
            $(this).parent().find(".mobile-drop__list").slideDown();
            $(this).parent().siblings().find(".mobile-menu__item-icon").removeClass("active");
        }
    });
    
    $(document).on('click', function(e) {
      if (!$(e.target).closest(".nav").length) {
        $('.mobile-menu').removeClass("active");
        $(".mobile-menu__list").slideUp();
        $(".mobile-menu__item").removeClass("active");
        $(".mobile-drop__list").slideUp();
        $(".mobile-menu__item-icon").removeClass("active");
      }
      e.stopPropagation();
});
    
//     $('#add-company__cat').niceSelect();
//     $('#add-company__cat-eng').niceSelect();
//    $(".menu-item").hover(function(){
//        if($(this).hasClass("active")) {
//            $(this).removeClass("active");
//        }else {
//            $(this).addClass("active");
//        }
//    });
    
    /* Переключатель */
    $(".add-discount__bottom-switchr").change(function(){
        if($(this).prop("checked")) {
            $(".discount__bottom-block-text").text("Вкл");
        }else {
           $(".discount__bottom-block-text").text("Выкл");
        }
    });
    
//    $('.table-block__col').each(function(){
//		var newText = $(this).text();
//		newText = '<span class="table-block__col-inner">' + newText + '</span>';
// 
//		$(this).html(newText);
//	});
    
    
    /* Mobile menu */
    
$(".add-company__right-usert").on("click",function(e){
    e.preventDefault();
    if($(this).closest(".add-company__right-user").hasClass("active")) {
        $(this).closest(".add-company__right-user").removeClass("active");
    }else {
        $(this).closest(".add-company__right-user").addClass("active");
        $(this).closest(".add-company__right-user").siblings().removeClass("active");
    }
    
});
    
    $(document).on('click', function(e) {
      if (!$(e.target).closest(".add-company__right-wrap").length) {
        $('.add-company__right-user').removeClass("active");
      }
      e.stopPropagation();
});
    
    
    
});