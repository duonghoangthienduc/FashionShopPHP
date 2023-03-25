<div class="row px-xl-5 d-none d-xl-flex">
    @forelse ($recent_product as $data)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="product-item bg-light mb-4">
                <div class="product-img position-relative overflow-hidden">
                    <img class="img-fluid w-100" src="{{ $data->thumb }}" alt="{{ $data->name_product }}">
                </div>
                <div class="text-center py-4 ">
                    <span class="h6 text-decoration-none text-truncate text-wrap">{{ $data->name_product }}</span>
                    <div class="d-flex align-items-center justify-content-center mt-2 text-wrap">
                        @if ($data->new_price != 0)
                            <h5>{{ number_format($data->new_price) }}</h5>
                            <h6 class="text-muted ml-2">
                                <del> {{ number_format($data->old_price) }}</del>
                            </h6>
                        @else
                            <h5>{{ number_format($data->old_price) }}</h5>
                        @endif
                        &nbsp; VNĐ
                    </div>
                </div>
                <div class="product-action">
                    <x-productAction id='{{ $data->id }}'></x-productAction>
                </div>
            </div>
        </div>
    @empty
    @endforelse
</div>
{{-- <div class="row d-sm-block d-md-block d-lg-block d-xl-none">
    <div class="col">
        <div class="owl-carousel related-carousel">
            @forelse ($recent_product as $data)
                <div class="product-item bg-light ">
                    <div class="product-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="{{ $data->thumb }}" alt="{{ $data->name_product }}">

                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate" href="">{{ $data->name_product }}</a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5>{{ number_format($data->new_price) }}</h5>
                            <h6 class="text-muted ml-2"><del>{{ number_format($data->old_price) }}</del></h6>
                            &nbsp; VNĐ
                        </div>
                    </div>
                    <div class="product-action">
                        <a class="btn btn-outline-dark btn-square" href=""><i
                                class="fa fa-shopping-cart"></i></a>
                        <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                        <a class="btn btn-outline-dark btn-square" href="{{ route('Product Detail', $data->id) }}"><i
                                class="fa fa-search"></i></a>
                    </div>
                </div>
            @empty
            @endforelse

        </div>
    </div>

</div> --}}
