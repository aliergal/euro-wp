$(document).ready(function(){
    $('.add-to-cart-form').submit(function(e){
        e.preventDefault();
        var prodCode = $(this).find('.prodCode').val();
        var data = {
            'action': 'add_to_cart',
            'prodCode': prodCode
        };
        $.post(adminurl, data, function(response) {
            console.log(response);
        });
    });




    $('#addtocart').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var prodCode = button.data('code');
        var prodName = button.data('name');
        var prodSize = button.data('size');
        var prodPrice = button.data('price');
        var prodUnitRate = button.data('unitrate');
        var modal = $(this);
        modal.find('.modal-title').text(prodName);
        modal.find('#prodCode').val(prodCode);
        modal.find('#prodName').text(prodName);
        modal.find('#prodSize').text(prodSize);
        modal.find('#prodPrice').text(prodPrice);
        modal.find('#prodUnitRate').text(prodUnitRate);
        modal.find(".prodImg").attr("src", "/wp-content/product-pics/"+prodCode+".jpg");
    })
});