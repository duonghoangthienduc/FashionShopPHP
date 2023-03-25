@extends('index')
@section('content')
    <x-breadCrumb></x-breadCrumb>
    <div class="container-fluid">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Contact
                Us</span></h2>
        <div class="row px-xl-5">
            <div class="col-lg-6 mb-5">
                <div class="bg-light p-30 mb-3">
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>
                        14 Lý Thường Kiệt, Phường 15, Quận 11, Thành phố Hồ Chí Minh, Việt Nam
                    </p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                    <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>0966908907</p>
                </div>
            </div>
            <div class="col-lg-6 mb-5">
                <div class="bg-light p-30 mb-30">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.474751702565!2d106.6519259143368!3d10.774904262169251!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752ec0b669f8f5%3A0x1b6610e990c1a04d!2zMTQgTMO9IFRoxrDhu51uZyBLaeG7h3QsIFBoxrDhu51uZyAxNSwgUXXhuq1uIDExLCBUaMOgbmggcGjhu5EgSOG7kyBDaMOtIE1pbmgsIFZpZXRuYW0!5e0!3m2!1sen!2sbd!4v1678611370561!5m2!1sen!2sbd"
                        width="100%" height="250px" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>

                </div>
            </div>
        </div>
    </div>
@endsection
