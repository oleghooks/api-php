$(document).ready(function(){
    console.log('Завелся');
    var textEnter = "";
    var lastTimeStamp;
    $('body').keypress(function(e){
        //console.log(e);
        var key = e.originalEvent.key;
        var timeStamp = e.timeStamp;
        if(textEnter == ""){
            textEnter = key;
            lastTimeStamp = timeStamp;
        }
        else if((timeStamp - lastTimeStamp) < 15){
            if(key != "Enter"){
                //console.log(textEnter);
                textEnter = textEnter + key;
                lastTimeStamp = timeStamp;
            }
            else
                barcodeAdd(textEnter);
        }
        else{
            textEnter = key;
            lastTimeStamp = timeStamp;
        }
    });
});


/*
function templateReturn(template, template_var, data){
    $.ajax({
        url: '/template/'+template+'/'+template_var,
        type: 'POST',
        data: data,
        success: function(response){
            return response;
        }
    });
}*/

function barcodeAdd(barcode){

    if($('#bar-'+barcode).length > 0){
        $('#bar-'+barcode+' #count').val(Number($('#bar-'+barcode+' #count').val()) + 1);
        summBarcodeUpdate(barcode);
    }
    else{
        $.ajax({
            url: '/api/v1/monitor/infoBarcode/'+barcode,
            success: function(response){
               // console.log('sdsad');
                console.log(response);
                if(response.response == 'fail')
                    $.ajax({
                        url: '/template/monitor/NO_PRODUCT',
                        type: 'POST',
                        data: {barcode: barcode},
                        success: function(response){
                            $('table').append(response);
                        }
                    });
                else
                    $.ajax({
                        url: '/template/monitor/PRODUCT',
                        type: 'POST',
                        data: response.body,
                        success: function(response){
                            $('table').append(response);
                            if($(response).find('#price').val() == "0")
                                $('#bar-'+barcode+' #price').focus();
                            updateCount();
                            summBarcodeUpdate(barcode);
                        }
                    });

            }
        });
    }
}
function updateCount(){
    $('.product').each(function(index){
        $(this).find("td:first").text(index + 1);
    });
}
function insertBarcode(barcode){
    var title = $('#bar-'+barcode+' #title').val();
    $.ajax({
        url: '/api/v1/monitor/insertBarcode',
        method: 'POST',
        data: {barcode: barcode, title: title},
        success: function(response){
            barcodeRemove(barcode);
            barcodeAdd(barcode);
        }
    });

}
function barcodeRemove(barcode){
    $('#bar-'+barcode).remove();
    updateCount();
}
function summBarcodeUpdate(barcode){
    var countBar = Number($('#bar-'+barcode+' #count').val());
    var priceBar = Number($('#bar-'+barcode+' #price').val());
    $('#bar-'+barcode+' #summ span').text(countBar * priceBar);
}
function updatePriceBarcode(barcode){
    var priceBar = Number($('#bar-'+barcode+' #price').val());
    $.ajax({
        url: '/api/v1/monitor/updatePriceBarcode',
        method: 'POST',
        data: {price: priceBar, barcode: barcode}
    });

}