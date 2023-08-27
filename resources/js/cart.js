
(function($) {

    $('.item-qty').on('change', function(e){

        $.ajax({
            url: "/cart/" + $(this).data('id'),
            method: 'put',
            data: {
                qty: $(this).val(),
                _token: _token
            }
        });
    });

    $('.remove-item').on('click', function(e){

        let id = $(this).data('id');
        $.ajax({
            url: "/cart/" + id,
            method: 'delete',
            data: {
                _token: _token
            },
            success: response=> {
                $(`#${id}`).remove();
            }
        });
    });

})(jQuery);
