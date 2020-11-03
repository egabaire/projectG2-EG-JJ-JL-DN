
$(document).ready(function(){
    $('#submit').click(function(){
        var comments_txt=$('#comments').val();
        if($.trim(comments_txt) != '')
        {
           $.ajax({
                url:"insert.php",
                method:"POST",
                data : {
                    userId :$('#userId').val(),
                    newsId :$('#newsId').val(),
                    username:$('#username').val(),
                    comments : $('#comments').val()
                },
                dataType:"text",
                success:function(data)
                {
                    console.log("success");
                    $('#comments').val("");
                }
           });
        }
    });

    setInterval (function(){
        var newsIdLink = $('#newsId').val();
        $('#display_comments').load("fetch_comments.php?newsId="+newsIdLink).fadeIn("slow");
    }, 1000);

});

