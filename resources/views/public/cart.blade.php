<x-front-layout title="Cart">
    <x-slot:breadcrumb>
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">Cart</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> Home</a></li>
                            <li><a href="{{ route('products.index') }}">Shop</a></li>
                            <li>Cart</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-slot:breadcrumb>

    <div class="shopping-cart section">
        <div class="container">
            <div class="cart-list-head">
                <!-- Cart List Title -->
                <div class="cart-list-title">
                    <div class="row">
                        <div class="col-lg-1 col-md-1 col-12">

                        </div>
                        <div class="col-lg-4 col-md-3 col-12">
                            <p>Product Name</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Quantity</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Subtotal</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Discount</p>
                        </div>
                        <div class="col-lg-1 col-md-2 col-12">
                            <p>Remove</p>
                        </div>
                    </div>
                </div>
                <!-- End Cart List Title -->
                @forelse ($cart->get() as $item)
                    <!-- Cart Single List list -->
                    <div class="cart-single-list" id="{{ $item->id }}">
                        <div class="row align-items-center">
                            <div class="col-lg-1 col-md-1 col-12">
                                <a href="{{ route('products.show', $item->product->slug) }}">
                                    <img src="{{ $item->product->image_url }}" alt="#"></a>
                            </div>
                            <div class="col-lg-4 col-md-3 col-12">
                                <h5 class="product-name"><a href="{{ route('products.show', $item->product->slug) }}">
                                        {{ $item->product->name }}</a></h5>
                                <p class="product-des">
                                    <span><em>Type:</em> Mirrorless</span>
                                    <span><em>Color:</em> Black</span>
                                </p>
                            </div>
                            <div class="col-lg-2 col-md-2 col-12">
                                <div class="count-input">
                                    <input class="form-control item-qty" data-id="{{ $item->id }}"
                                        value="{{ $item->qty }}">
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-12">
                                <p>{{ Currency::format($item->qty * $item->product->price) }}</p>
                            </div>
                            <div class="col-lg-2 col-md-2 col-12">
                                <p>{{ Currency::format(0) }}</p>
                            </div>
                            <div class="col-lg-1 col-md-2 col-12">
                                <a href="#" class="text-muted" onclick="removeCartItem({{ $item->id }})">
                                    <i class="lni lni-close"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- End Single List list -->

                @empty
                    <center>
                        <div class="col-12 mt-15 mb-15">
                            <p class="h5">Cart is Empty! <a href="{{ route('home') }}"> Continue Shopping </a></p>
                        </div>
                    </center>
                @endforelse

            </div>
            <div class="row">
                <div class="col-12">
                    <!-- Total Amount -->
                    <div class="total-amount">
                        <div class="row">
                            <div class="col-lg-8 col-md-6 col-12">
                                <div class="left">
                                    <div class="coupon">
                                        <form action="#" target="_blank">
                                            <input name="Coupon" placeholder="Enter Your Coupon">
                                            <div class="button">
                                                <button class="btn">Apply Coupon</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="right">
                                    <ul>
                                        <li>Cart Subtotal<span>{{ Currency::format($cart->total()) }}</span></li>
                                        <li>Shipping<span>Free</span></li>
                                        <li>You Save<span>$29.00</span></li>
                                        <li class="last">You Pay<span>{{ Currency::format($cart->total()) }}</span>
                                        </li>
                                    </ul>
                                    <div class="button">
                                        <form action="{{ route('checkout') }}" method="post">
                                            <a href="{{ route('checkout') }}" class="btn mb-10">Checkout</a>
                                        </form>
                                        <a href="{{ route('home') }}" class="btn btn-alt mt-10">Continue shopping</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ End Total Amount -->
                </div>
            </div>
        </div>
    </div>
    <x-slot:footer>
        @isset($categories)
            <div class="single-footer f-link">
                <h3>Shop Departments</h3>
                <ul>
                    @foreach ($categories as $item)
                        <li><a href="javascript:void(0)">{{ $item->name }}</a></li>
                    @endforeach
                </ul>
            </div>
        @endisset
    </x-slot:footer>
    @push('scripts')
        <script>
            (function($) {
                var _token = "{{ csrf_token() }}";

                $('.item-qty').on('change', function(e) {
                    var itemId = $(this).data('id');
                    $.ajax({
                        url: "/cart/" + itemId,
                        method: 'put',
                        data: {
                            qty: $(this).val(),
                            _token: _token
                        },
                        success: function(response) {
                            console.log('Quantity updated successfully');
                        }
                    });
                });

                // $('.remove-item').on('click', function(e) {
                //     e.preventDefault();
                //     let id = $(this).data('id');
                //     $.ajax({
                //         url: "{{ route('cart.destroy', '_id_') }}".replace('_id_', id),
                //         method: 'delete',
                //         data: {
                //             _token: _token
                //         },
                //         success: response => {
                //             $(`#${id}`).remove();
                //             console.log('Item removed from cart');
                //         }
                //     });
                // });
            })(jQuery);

        //     function removeCartItem(cartItemId) {
        //         $.ajax({
        //             type: 'POST',
        //             url: '{{ route('cart.remove', ['id']) }}/' + cartItemId,
        //             data: {
        //                 _token: '{{ csrf_token() }}',
        //             },
        //             success: function(response) {
        //                 location.reload();
        //             },
        //             error: function(error) {
        //                 console.error('Error removing cart item:', error);
        //             }
        //         });
        //     }
        // </script>
    @endpush
</x-front-layout>
