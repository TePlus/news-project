$(document).ready(function(){

	console.log('ready !!!!! overview');
	testAjax();
	
});

function testAjax(){
 	$.ajax({
       type: "POST",
       url: BASE_URL + "controllers/overview/cmd.php",
       data: {
       	"cmd" : "add",
       	"news_id" : "5",
       	"title" : "hello_o1"
       }, // serializes the form's elements.
       dataType:"html",
       success: function(data)
       {
          	console.log(data);
       }
     });
}