@extends('index')
@section('content')
    <x-breadCrumb></x-breadCrumb>
    <div class="container-fluid">
        <form action="{{ route('Store Bill') }}" method="post" class="row px-xl-5">

            <div class="col-lg-8">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Billing
                        Address</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Họ</label>
                            <input name="first_name" class="form-control" type="text">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Tên</label>
                            <input name="last_name" class="form-control" type="text">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>E-mail</label>
                            <input class="form-control" type="text" placeholder="example@email.com" name="email">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Số điện thoại</label>
                            <input class="form-control" type="text" name="phone">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Địa chỉ</label>
                            <input class="form-control" type="text" name="address">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Thành phố</label>
                            <select id="province" onChange="val()" class="custom-select" name="province">
                                <option value="">Tỉnh / Thành phố</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->id }}">
                                        {{ $province->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Quận / Huyện</label>
                            <select class="custom-select" id="district" name="district">
                                <option value="">Quận / Huyện</option>
                            </select>

                        </div>
                        <div class="col-md-6 form-group">
                            <label>Phường / Xã</label>
                            <select class="custom-select" id="ward" name="ward">
                                <option value="">Phường / Xã</option>
                            </select>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Ghi chú</label>
                            <input class="form-control" type="text" placeholder="Ghi chú...." name="note">
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Order
                        Total</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom">
                        <h6 class="mb-3">Products</h6>
                        @foreach ($carts as $cart)
                            <div class="d-flex justify-content-between">
                                <p>{{ $cart['name'] }} - SL: {{ $cart['qty'] }}</p>
                                <p>{{ number_format($cart['price']) }} VND</p>
                            </div>
                        @endforeach
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5>{{ number_format($total) }} VND</h5>
                        </div>
                    </div>
                </div>
                <div class="mb-5">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span
                            class="bg-secondary pr-3">Payment</span></h5>
                    <div class="bg-light p-30">
                        <button type="submit" class="btn btn-block btn-primary font-weight-bold py-3">Place
                            Order</button>
                    </div>
                </div>
            </div>
            @csrf
        </form>
    </div>
@endsection
