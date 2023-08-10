$(document).ready(function () {

    // validate only input number
    $(".input-price, .input-price-sale").keypress(function (event) {
        return /\d/.test(String.fromCharCode(event.keyCode));
    });

    
    var format = function (num) {
        var str = num.toString().replace("", ""), parts = false, output = [], i = 1, formatted = null;
        if (str.indexOf(".") > 0) {
            parts = str.split(".");
            str = parts[0];
        }
        str = str.split("").reverse();
        for (var j = 0, len = str.length; j < len; j++) {
            if (str[j] != ",") {
                output.push(str[j]);
                if (i % 3 == 0 && j < (len - 1)) {
                    output.push(",");
                }
                i++;
            }
        }
        formatted = output.reverse().join("");
        return ("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
    };

    // convert price
    function convertNumberToPrice(classParent,classChild){
        var money = $(classParent).val();
        $(classChild).html(format(money));
        if (money == '') {
            $(classChild).html('0');
        }
    }
    $('.input-price').keyup(function () {
        convertNumberToPrice('.input-price', '.convert-price span');
    }); 
    $('.input-price-sale').keyup(function(){
        convertNumberToPrice('.input-price-sale', '.convert-price-sale span');
    });
    
    // auto format price
    convertNumberToPrice('.input-price', '.convert-price span');
    convertNumberToPrice('.input-price-sale', '.convert-price-sale span');
})