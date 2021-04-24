$(document).ready(function() {

    /* Кейсы */

    $(".ww1").on("mouseover", function() {
        $(".w1").css("opacity", "1");
    });

    $(".ww1").on("mouseout", function() {
        $(".w1").css("opacity", "0");
    });

    $(".ww2").on("mouseover", function() {
        $(".w2").css("opacity", "1");
    });

    $(".ww2").on("mouseout", function() {
        $(".w2").css("opacity", "0");
    });

    $(".ww3").on("mouseover", function() {
        $(".w3").css("opacity", "1");
    });

    $(".ww3").on("mouseout", function() {
        $(".w3").css("opacity", "0");
    });

    /* Переключение */

    $(".p1").on("click", function() {
        $(".otzz1").css("display", "flex");
        $(".otzz2").css("display", "none");
        $(".p1").addClass("point1");
        $(".p2").removeClass("point1");
    });

    $(".p2").on("click", function() {
        $(".otzz1").css("display", "none");
        $(".otzz2").css("display", "flex");
        $(".p2").addClass("point1");
        $(".p1").removeClass("point1");
    });

    /* Переходы */

    let count = 1;
    let pattern = /^[a-z0-9_-]+@[a-z0-9-]+\.[a-z]{2,6}$/i;
    let pattern2 = /^[a-z]+\.[a-z0-9-]+\.[a-z]{2,6}$/i;

    $(".btn-next").on("click", function() {
        if ((count == 2) && ($(".part2").val() == "")) {
            alert("Заполните данные корректно");
        } else if (((count == 5) && ($(".part5").val() == "")) || ((count == 5) && ($(".part5").val().search(pattern2) != 0))) {

            alert("Заполните данные корректно");
        } else if ((count == 6) && ($(".part61").val() == "")) {

            alert("Заполните имя");
        } else if (((count == 6) && ($(".part62").val() == "")) || ((count == 6) && ($(".part62").val().search(pattern) != 0))) {

            alert("Заполните e-mail корректно");
        } else {
            $(".pop_up" + count).css("display", "none");
            count++;
            $(".pop_up" + count).css("display", "block");
        }
    });

    $(".btn-prev").on("click", function() {
        $(".pop_up" + count).css("display", "none");
        count--;
        $(".pop_up" + count).css("display", "block");
    });

    /*if((count==2){
    	alert(part2);
    }
    else{
    	$(".btn-next").on("click",function(){
    		$(".pop_up"+count).css("display", "none");
    		count++;
    		$(".pop_up"+count).css("display", "block");
    	});
    	
    	$(".btn-prev").on("click",function(){
    		$(".pop_up"+count).css("display", "none");
    		count--;
    		$(".pop_up"+count).css("display", "block");
    	});
    }*/

});