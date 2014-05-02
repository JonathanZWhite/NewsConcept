$(document).ready(function() {

	var requestNews = {
		userInput: {}, 
		init: function() {
			this.initialRequest();
			this.userRequestNews();
		},

		initialRequest: function() {
			$.ajax({
				url: "scripts/RequestNews.php",
				type: "POST",
				success: function(returnData) {
					$("#news-feed").append(returnData);
				}, 
				error: function() {
					console.log("AJAX request failed");
				}
			});	
		},

		userRequestNews: function() {
			$("nav li").click(function() {
				requestNews.userInput['type_of_request'] = "Category";
				requestNews.userInput['request'] = $(this).attr("value");
				var jsonData = JSON.stringify(requestNews.userInput);
				$.ajax({
					url: "scripts/RequestNews.php",
					type: "POST",
					data: { data: jsonData },
					success: function(returnData) {
						$("#news-feed").stop().fadeOut(300, function(){
							$("#news-feed").empty().append(returnData).fadeIn();
						});
					}, 
					error: function() {
						console.log("AJAX request failed");
					}
				});
			});
		}

	};

	(function() {
		requestNews.init();
	}()); 

}); 
