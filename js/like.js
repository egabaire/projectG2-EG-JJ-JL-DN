
$(document).ready(function(){
    var result = '';
    $('#submit1').click(function(){
    
        $.ajax({
            url:"insert_like.php",
            method:"POST",
            data : {
                newsId :$('#newsId').val(),
                user_id :$('#user_id').val()
            },
            dataType:"text",
            success:function(data)
            {
                console.log("success");
            }
       });
        
    });

     setInterval (function(){
        var newsIdLink = $('#newsId').val();
         $('#like').load("fetch_like.php?q="+ newsIdLink).fadeIn("slow");
     }, 1000);

});

