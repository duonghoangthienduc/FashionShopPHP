<div class="container-fluid py-5">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May
            Also Like</span></h2>
    <div class="row px-xl-5 ">
        <div class="col ">
            <div class="owl-carousel related-carousel">
                @forelse ($datas as $data)
                    <div class="product-item bg-light mb-4">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="{{ $data->thumb }}" alt="{{ $data->name_product }}">

                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate text-wrap"
                                href="">{{ $data->name_product }}</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                @if ($data->new_price != 0)
                                    <h5>{{ number_format($data->new_price) }}</h5>
                                    <h6 class="text-muted ml-2"><del>{{ number_format($data->old_price) }}</del></h6>
                                @else
                                    <h5>{{ number_format($data->old_price) }}</h5>
                                @endif
                                &nbsp; VNĐ
                            </div>
                        </div>
                        <x-productAction id='{{ $data->id }}'></x-productAction>
                    </div>
                @empty
                @endforelse

            </div>
        </div>
    </div>
</div>
