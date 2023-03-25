<div class="container-fluid mb-3 mt-3">
    @if ($banner_carousel != null)
        <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
            <ol class="carousel-indicators">
                @forelse ($banner_carousel as $key => $data)
                    @if ($loop->first)
                        <li data-target="#header-carousel" data-slide-to="{{ $key }}" class="active"></li>
                    @endif
                    @if (!$loop->first)
                        <li data-target="#header-carousel" data-slide-to="{{ $key }}"></li>
                    @endif
                @empty
                @endforelse
            </ol>
            <div class="carousel-inner">
                @forelse ($banner_carousel as $data)
                    @if ($loop->first)
                        <div class="carousel-item position-relative active" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="{{ $data->thumb }}"
                                style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">
                                        {{ $data->name_banner }}
                                    </h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">
                                        {{ $data->banner_content }}
                                    </p>
                                    {{-- <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp"
                                        href="#">Shop Now</a> --}}
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (!$loop->first)
                        <div class="carousel-item position-relative" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="{{ $data->thumb }}"
                                style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">
                                        {{ $data->name_banner }}
                                    </h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">
                                        {{ $data->banner_content }}
                                    </p>
                                    {{-- <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp"
                                        href="#">Shop Now</a> --}}
                                </div>
                            </div>
                        </div>
                    @endif
                @empty
                @endforelse
            </div>
        </div>
    @endif
    {{-- <div class="row px-xl-5">
        <div class="col-lg-8">
            <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                <ol class="carousel-indicators">
                    @forelse ($banner_carousel as $key => $data)
                        @if ($key + 1 == 1)
                            <li data-target="#header-carousel" data-slide-to="{{ $key }}" class="active"></li>
                        @endif
                        @if ($key + 1 != 1)
                            <li data-target="#header-carousel" data-slide-to="{{ $key }}"></li>
                        @endif
                    @empty
                    @endforelse
                </ol>
                <div class="carousel-inner">
                    @forelse ($banner_carousel as $key => $data)
                        @if ($key + 1 == 1)
                            <div class="carousel-item position-relative active" style="height: 430px;">
                                <img class="position-absolute w-100 h-100" src="{{ $data->thumb }}"
                                    style="object-fit: cover;">
                                <div
                                    class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                    <div class="p-3" style="max-width: 700px;">
                                        <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">
                                            {{ $data->name_banner }}
                                        </h1>
                                        <p class="mx-md-5 px-5 animate__animated animate__bounceIn">
                                            {{ $data->banner_content }}
                                        </p>
                                        <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp"
                                            href="#">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($key + 1 != 1)
                            <div class="carousel-item position-relative" style="height: 430px;">
                                <img class="position-absolute w-100 h-100" src="{{ $data->thumb }}"
                                    style="object-fit: cover;">
                                <div
                                    class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                    <div class="p-3" style="max-width: 700px;">
                                        <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">
                                            {{ $data->name_banner }}
                                        </h1>
                                        <p class="mx-md-5 px-5 animate__animated animate__bounceIn">
                                            {{ $data->banner_content }}
                                        </p>
                                        <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp"
                                            href="#">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="product-offer mb-30" style="height: 200px;">
                <img class="img-fluid" src="img/offer-1.jpg" alt="">
                <div class="offer-text">
                    <h6 class="text-white text-uppercase">Save 20%</h6>
                    <h3 class="text-white mb-3">Special Offer</h3>
                    <a href="" class="btn btn-primary">Shop Now</a>
                </div>
            </div>
            <div class="product-offer mb-30" style="height: 200px;">
                <img class="img-fluid" src="img/offer-2.jpg" alt="">
                <div class="offer-text">
                    <h6 class="text-white text-uppercase">Save 20%</h6>
                    <h3 class="text-white mb-3">Special Offer</h3>
                    <a href="" class="btn btn-primary">Shop Now</a>
                </div>
            </div>
        </div>
    </div> --}}
</div>
