function np() {
    return void(0);
}

function showCart() {
 if ($('#cart').attr('value') == '' || $('#cart').attr('value') == undefined) {
     alert('Cart is empty!')
 } else {
     window.location.replace('cart.php');
 }
}

function getCart(wchUserId) {
 $('#panelCart').load('getCart.php', {userId: wchUserId});
}

function addToCart(wchUserId, wchProductId) {
    $.ajax({
        url: 'addToCart.php',
        type: 'POST',
        data: {userId: wchUserId, productId: wchProductId},
        success: function(response) {
            getCart(wchUserId);
        }
        });
}

function getQty(response) {
    $('#qty').text(response)
}

function getPrice(response, wchUserId, wchProductId) {
    $("#total-price-".concat(wchProductId)).text(response);
    $.ajax({
        url: 'calculateTotal.php',
        type: 'POST',
        data: {userId: wchUserId},
        success: function(response2) {
            $('#total-amount').text(response2);
        }
    });
}

function updateQty(wchUserId, wchProductId) {
    const qty = document.getElementById("qty-".concat(wchProductId)).value;
    console.log(qty);
    $.ajax({
        url: 'updateQty.php',
        type: 'POST',
        data: {userId: wchUserId, productId: wchProductId, qty: qty},
        success: function(response) {
            getCart(wchUserId);
            getPrice(response, wchUserId, wchProductId);
        }
    });
}

function removeItem(wchUserId, wchProductId) {
    $.ajax({
        url: 'removeItem.php',
        type: 'POST',
        data: {userId: wchUserId, productId: wchProductId},
        success: function(response) {
            location.reload();
        }
    });
}
