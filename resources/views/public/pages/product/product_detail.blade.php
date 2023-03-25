@extends('index')
@section('content')
    <x-breadCrumb></x-breadCrumb>
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="{{ $productDetail['thumb'] }}"
                                alt="{{ $productDetail['name_product'] }}">
                        </div>
                        @forelse ($productDetail['product_image'] as $key => $image)
                            @if ($image != null)
                                {
                                <div class="carousel-item">
                                    <img class="w-100 h-100" src="{{ $image }}"
                                        alt="{{ $productDetail['name_product'] }}">
                                </div>
                                }
                            @endif
                        @empty
                        @endforelse
                    </div>
                    @if ($productDetail['product_image'])
                        <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                            <i class="fa fa-2x fa-angle-left text-dark"></i>
                        </a>
                        <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                            <i class="fa fa-2x fa-angle-right text-dark"></i>
                        </a>
                    @endif

                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <form action="{{ route('Store Cart') }}" method="get">
                        <div class="d-flex mb-3">
                            <input hidden name="id" value="{{ $productDetail['id'] }}">
                            <input hidden name="name" value="{{ $productDetail['name_product'] }}">
                            <h3>{{ $productDetail['name_product'] }}</h3>
                        </div>
                        @if ($productDetail['new_price'] != 0)
                            <input hidden name="price" value="{{ $productDetail['new_price'] }}">
                            <h3 class="font-weight-semi-bold mb-4">
                                {{ number_format($productDetail['new_price']) }} VND
                            </h3>
                        @else
                            <input hidden name="price" value="{{ $productDetail['old_price'] }}">
                            <h3 class="font-weight-semi-bold mb-4">
                                {{ number_format($productDetail['old_price']) }} VND
                            </h3>
                        @endif
                        @if ($productDetail['short_description'])
                            <p class="mb-4">{{ $productDetail['short_description'] }}</p>
                        @endif
                        @if ($productDetail['size'])
                            <div class="d-flex mb-3">
                                <strong class="text-dark mr-3">Sizes:</strong>
                                @foreach ($productDetail['size'] as $size)
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="{{ $size }}"
                                            name="size" value={{ $size }}>
                                        <label class="custom-control-label" for="{{ $size }}">{{ $size }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="d-flex align-items-center mb-4 pt-2">
                                <div class="input-group quantity mr-3" style="width: 130px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary btn-minus" type="button">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control bg-secondary border-0 text-center"
                                        value="1" name="qty">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary btn-plus" type="button">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>

                                <button class="btn btn-primary px-3" type="submit">
                                    <i class="fa fa-shopping-cart mr-1"></i>
                                    Add To Cart
                                </button>
                            </div>
                        @else
                            <div class="d-flex mb-3">
                                <h5> Xin vui lòng liên hệ cửa hàng để biết thêm thông tin</h5>
                            </div>
                        @endif
                    </form>
                </div>
                {{-- <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div> --}}
            </div>
        </div>
    </div>
    <div class="row px-xl-5">
        <div class="col">
            <div class="bg-light p-30">
                <div class="nav nav-tabs mb-4">
                    <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Description</a>
                    <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-2">Information</a>
                </div>
                <div class="tab-content">
                    @if ($productDetail['description'])
                        <div class="tab-pane fade show active" id="tab-pane-1">
                            <h4 class="mb-3">Product Description</h4>
                            {!! $productDetail['description'] !!}
                        </div>
                    @endif
                    @if ($productDetail['info'])
                        <div class="tab-pane fade" id="tab-pane-2">
                            <h4 class="mb-3">Information</h4>
                            {!! $productDetail['info'] !!}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Shop Detail End -->
    <x-youMayAlsoLike id="{{ $productDetail['category_id'] }}" proId="{{ $productDetail['id'] }}"></x-youMayAlsoLike>
@endsection
