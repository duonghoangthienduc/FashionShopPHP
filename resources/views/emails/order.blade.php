@component('mail::message')
    # THÔNG BÁO ĐƠN HÀNG
<span style="font-size:16px;">
    Đơn đặt hàng của bạn đã được xác nhận !
</span>

<h2 style="font-weight:bold; padding-top:10px">
    Thông tin hóa đơn
</h2>

@component('mail::table', ['bills' => $bills])

@endcomponent


<div style="padding-top:10px">
@component('mail::button', ['url' => $url, 'color' => 'success'])
    Ghé thăm cửa hàng
@endcomponent
</div>

    Cảm ơn đã mua và tin dùng,
    {{ config('app.name') }}
@endcomponent
