var viewPosts=document.getElementById("viewPosts");
	var viewFollowers=document.getElementById("viewFollowers");
	var viewActivities=document.getElementById("viewActivities");
	var deleteUser=document.getElementById("deleteUser");

	function onLoadPage()
	{
		viewPosts.style.display="none";
		viewFollowers.style.display="none";
		viewActivities.style.display="block";
		deleteUser.style.display="none";
	}

	function showDiv(text)
	{
		if(text =="viewActivities")
		{
			viewActivities.style.display="block";
			viewPosts.style.display="none";
			viewFollowers.style.display="none";
			deleteUser.style.display="none";
		}

		if(text == "viewPosts")
		{
			viewPosts.style.display="block";
			viewFollowers.style.display="none";
			viewActivities.style.display="none";
			deleteUser.style.display="none";
		}

		if(text == "viewFollowers")
		{
			viewFollowers.style.display="block";
			viewPosts.style.display="none";
			viewActivities.style.display="none";
			deleteUser.style.display="none";
		}

		if(text == "deleteUser")
		{
			viewFollowers.style.display="none";
			viewPosts.style.display="none";
			viewActivities.style.display="none";
			deleteUser.style.display="block";
		}
		
	}