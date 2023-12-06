$(document).ready(function(){

    $(".click_fun").click(function() {
       $(".click_fun").removeClass("active");
       $(this).addClass("active");
    });

    $(".open-model").click(function() {
        $('.down-up').css("transform","translateY(0)");
    });

    $('.closer').click(function(){
        if($('.down-up').css("transform") == 'matrix(1, 0, 0, 1, 0, 270)'){
            $('.down-up').css("transform","translateY(0)");
        }else{
            $('.down-up').css("transform","translateY(90%)");
        }
    });
 });

    function up(id){
        let val = parseInt($(id).val());
        val +=1;
        if(val <10){
            $(id).val("0"+val);
        }else{
            $(id).val(val);
        }
    }

    function down(id){
        let val = parseInt($(id).val());
        if(val > 1){
            val-=1;
            if(val <10){
                $(id).val("0"+val);
            }else{
                $(id).val(val);
            }
        }
    }


