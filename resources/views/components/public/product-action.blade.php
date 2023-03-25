<div class="product-action">
    {{-- <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a> --}}
    <a class="btn btn-outline-dark btn-square" href="{{ route('Store Like', $product_id) }}"><i
            class="far fa-heart"></i></a>
    <a class="btn btn-outline-dark btn-square" href="{{ route('Product Detail', $product_id) }}"><i
            class="fa fa-search"></i></a>
</div>
