$(document).ready(function(){
    $('.category').click(function(){
        // var selected_category = $('.category-content button').val();
        var selected_category = $(this).attr('id');
        // alert(selected_category)
        $.ajax({
            type: "POST",
            url: "Search.php",
            data: {
                Category: selected_category
            },
            success: function (html) {
                $("#display").html(html).show();
            }
        })
    })
    $("#search").keyup(function(){
        var content = $("#search").val();
        // console.log(content)
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