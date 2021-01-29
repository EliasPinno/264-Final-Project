$(document).ready(function(){  
    // Standard search Jquery
    $("button").click(function(){
        //extract the value of the title text field
        var t = $("#search").val();
        //and send request as a GET to the server using the key title 
        //(this will be the key for the $_GET SuperGlobal on the server)
        $.get("searchPHP.php",
        { search: t })
        .done(function(data){
        $(".mainContent").html(data);     //and update the results to the div with id = reuslts
        });
    });
    // Author/Category Link Search Jquery
    $(document).on("click",'.searchLink',function(){
        var val = $(this).html();
        $.get("searchPHP.php",
        { search: val })
        .done(function(data){
        $(".mainContent").html(data);     //and update the results to the div with id = reuslts
        });
    });

});
var var2 = setInterval(servertimer, 1000);

function servertimer() {
    var time = $.get("http://cosc499.ok.ubc.ca/currentTime.php");
    time.done(function(data) {
        $(".time").html("Current time: " + data);
        console.log(data)
    });
    time.fail(function(jqXHR) { // Can't get the time
        console.log("Error: " + jqXHR.status);
    });
    time.always(function() {
        console.log("done");
    });
}