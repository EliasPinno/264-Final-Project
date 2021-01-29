$(document).ready(function(){ // Bonus type stuff
    changeNumber = function(){
        var textlength = $("#msg").val().length;
        if(textlength <= 199){
            $('#charNumber').text(199 - textlength);
        }
    }
    $("#msg").keydown(changeNumber);
    $("#msg").keyup(changeNumber);

});