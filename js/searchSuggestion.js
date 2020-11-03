function searchSuggestion()
{

	$(document).ready(function(e) {
		$("#search2").keyup(function()
		{
			$("#here").show();
			var x=$(this).val();
			$.ajax(
			{
				type:'GET',
				url:'search.php',
				data:'q='+x,
				success:function(data)
				{
					$("#here").html(data);
				}
				,
			});
		});
	});
		
}