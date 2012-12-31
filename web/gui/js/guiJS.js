function checkBDD ()
{		
		var adress = $('#adress').val();
		var pwd = $("#pwd").val();
		var name = $("#name").val();
		var user = $("#user").val();
		
		if (adress && name && user)
		{
			$.ajax
			({
   				type: "POST",
   				url: "../gui/js/checkBDD.php",
   				data: "name="+name+"&user="+user+"&pwd="+pwd+"&adress="+adress,
   				success: function(msg){ alert(msg); }
 			});
 		}
}