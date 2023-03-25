@extends('index')
@section('content')
    <x-breadCrumb></x-breadCrumb>
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by
                        price</span></h5>
                <div class="bg-light p-4 mb-30 ">
                    <form method="GET" action="{{ route('Filter Price') }}">
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-all" name="getAll" checked
                                value="0">
                            <label class="custom-control-label" for="price-all">All Product</label>
                            <span class="badge border font-weight-normal">{{ count($datas) }}</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-1" name="price[]"
                                value="10000, 50000">
                            <label class="custom-control-label" for="price-1">10,000 - 50,000 (VNĐ)</label>

                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-2" name="price[]"
                                value="50000, 100000">
                            <label class="custom-control-label" for="price-2">50,000 - 100,000 (VNĐ)</label>

                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-3" name="price[]"
                                value="100000, 300000 ">
                            <label class="custom-control-label" for="price-3">100,000 - 300,000 (VNĐ)</label>

                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-4" name="price[]"
                                value="300000, 500000">
                            <label class="custom-control-label" for="price-4">300,000 - 500,000 (VNĐ)</label>

                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input" id="price-5" name="price[]"
                                value="500000">
                            <label class="custom-control-label" for="price-5"> > 500,000 (VNĐ)</label>
                        </div>
                        <div class="custom-control justify-content-between d-flex float-right mt-3 pt-2">
                            <button class="btn btn-primary px-3" type="submit">
                                <i class="fa fa-search mr-1"></i>
                                Filter
                            </button>
                        </div>
                    </form>
                </div>
                <!-- Price End -->

                <!-- Size Start -->
                {{-- <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by
                        size</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="size-all">
                            <label class="custom-control-label" for="size-all">All Size</label>
                            <span class="badge border font-weight-normal">{{ count($datas) }}</span>
                        </div>
                        <?php
                        $countS = 0;
                        $countM = 0;
                        $countL = 0;
                        $countXL = 0;
                        $countXXL = 0;
                        foreach ($datas as $key => $data) {
                            if (strpos($data->size, 'S') !== false) {
                                $countS++;
                            }
                            if (strpos($data->size, 'M') !== false) {
                                $countM++;
                            }
                            if (strpos($data->size, 'L') !== false) {
                                $countL++;
                            }
                            if (strpos($data->size, 'XL') !== false) {
                                $countXL++;
                            }
                            if (strpos($data->size, 'XXL') !== false) {
                                $countXXL++;
                            }
                        }
                        ?>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-2">
                            <label class="custom-control-label" for="size-2">S</label>
                            <span class="badge border font-weight-normal">{{ $countS }}</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-3">
                            <label class="custom-control-label" for="size-3">M</label>
                            <span class="badge border font-weight-normal">{{ $countM }}</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-4">
                            <label class="custom-control-label" for="size-4">L</label>
                            <span class="badge border font-weight-normal">{{ $countL }}</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-5">
                            <label class="custom-control-label" for="size-5">XL</label>
                            <span class="badge border font-weight-normal">{{ $countXL }}</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between ">
                            <input type="checkbox" class="custom-control-input" id="size-1">
                            <label class="custom-control-label" for="size-1">XXL</label>
                            <span class="badge border font-weight-normal">{{ $countXXL }}</span>
                        </div>

                    </form>
                </div> --}}
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    {{-- <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4 float-right">
                            <div class="ml-2">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                                        data-toggle="dropdown">Sorting</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">Latest</a>
                                        <a class="dropdown-item" href="#">Popularity</a>
                                    </div>
                                </div>
                                <div class="btn-group ml-2">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                                        data-toggle="dropdown">Showing</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">10</a>
                                        <a class="dropdown-item" href="#">20</a>
                                        <a class="dropdown-item" href="#">30</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    @foreach ($datas as $data)
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" src="{{ $data->thumb }}" alt="">
                                </div>
                                <div class="text-center py-4">
                                    <span class="h6 text-decoration-none text-truncate text-wrap">
                                        {{ $data->name_product }}</span>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        @if ($data->new_price != 0)
                                            <h5>{{ number_format($data->new_price) }}</h5>
                                            <h6 class="text-muted ml-2">
                                                <del>{{ number_format($data->old_price) }}</del>
                                            </h6>
                                        @else
                                            <h5>{{ number_format($data->old_price) }}</h5>
                                        @endif
                                        &nbsp; VNĐ
                                    </div>

                                </div>
                                <x-productAction id='{{ $data->id }}'></x-productAction>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-12">
                        {{ $datas->links('pagination::default') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
