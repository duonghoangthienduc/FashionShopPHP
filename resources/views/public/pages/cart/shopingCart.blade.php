@extends('index')
@section('content')
    <x-breadCrumb></x-breadCrumb>
    <div class="container-fluid">

        @if ($carts != null)
            <div class="row px-xl-5">

                <div class="col-lg-8 table-responsive mb-5">

                    <table class="table table-light table-borderless table-hover text-center mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th>Products</th>
                                <th>Size</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">

                            @foreach ($carts as $key => $cart)
                                <tr>
                                    <td class="align-middle">
                                        <a href="{{ route('Product Detail', $cart['id']) }}"
                                            style="text-decoration: none; display:block; color:black">
                                            {{ $cart['name'] }}
                                        </a>
                                    </td>
                                    <td class="align-middle">
                                        {{ $cart['size'] }}
                                    </td>
                                    <td class="align-middle">
                                        {{ number_format($cart['price']) }}
                                    </td>
                                    <td class="align-middle">
                                        <form method="GET" action="{{ route('Change Cart', $key) }}"
                                            class="input-group quantity mx-auto" style="width: 100px;">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-primary btn-minus" type="submit">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <input type="text" name="qty"
                                                class="form-control form-control-sm bg-secondary border-0 text-center"
                                                value="{{ $cart['qty'] }}" min='1' readonly>
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-primary btn-plus" type="submit">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </td>
                                    <td class="align-middle">{{ number_format($cart['price'] * $cart['qty']) }}</td>
                                    <td class="align-middle">
                                        <a href="{{ route('Remove Cart', $key) }}" class="btn btn-sm btn-danger">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach



                        </tbody>
                    </table>

                </div>
                <div class="col-lg-4">
                    {{-- <form class="mb-30" action="">
                    <div class="input-group">
                        <input type="text" class="form-control border-0 p-4" placeholder="Coupon Code">
                        <div class="input-group-append">
                            <button class="btn btn-primary">Apply Coupon</button>
                        </div>
                    </div>
                </form> --}}
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                            Summary</span></h5>
                    <div class="bg-light p-30 mb-5">
                        {{-- <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6>{{ number_format($cart['price'] * $cart['qty']) }}</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">$10</h6>
                        </div>
                    </div> --}}
                        <div class="pt-2">
                            <div class="d-flex justify-content-between mt-2">
                                <h5>Total</h5>
                                <?php
                                function total($carts)
                                {
                                    $total = 0;
                                    foreach ($carts as $key => $cart) {
                                        $total += $cart['price'] * $cart['qty'];
                                    }
                                    return number_format($total);
                                }
                                ?>
                                <h5> {{ total($carts) }} VND</h5>

                            </div>
                            <a href="{{ route('Check Out') }}"
                                class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To
                                Checkout</a>
                        </div>
                    </div>
                </div>

            </div>
        @else
            <div class="px-xl-5">
                <div class="table-responsive mb-5">
                    @include('public.pages.BlankPage.blank_page')
                </div>
            </div>
        @endif
    </div>
@endsection
