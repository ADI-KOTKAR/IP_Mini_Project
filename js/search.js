$(document).ready(function(){
    $("#search").keyup(function(){
        var content = $("#search").val();
        if(content.length>0){
            $.ajax({
                type: "POST",
                url: "Search.php",
                data: {
                    Search: content,
                },
                success: function (html) {
                    $("#display").html(html).show();

                },
            });
        }else{
            // console.log("everything")
            $.ajax({
                type: "POST",
                url: "Search.php",
                data: {
                    Search: 'everything',
                },
                success: function (html) {
                    $("#display").html(html).show();

                },
            });
        }
    })
})