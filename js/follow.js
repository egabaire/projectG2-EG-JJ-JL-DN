
$(document).ready(function(){
    var result = '';
    $('#followBtn').click(function(){
    
        $.ajax({
            url:"insert_follow.php",
            method:"POST",
            data : {
                userId :$('#userId').val(),
                follows :$('#follows').val()
            },
            dataType:"text",
            success:function(data)
            {
                console.log("success");
            }
       });
       
       return false;
    });

});

