{{-- <div class="table">
{{ Illuminate\Mail\Markdown::parse($slot) }}
</div> --}}
<div style="padding-top:10px">
<table class="table" width="100%">
<thead>
<tr >
<th scope="col" >Tên sản phẩm</th>
<th scope="col" >Size</th>
<th scope="col" >Số Lượng</th>
<th scope="col" >Thành tiền (VND)</th>
</tr>
</thead>
<tbody>
@foreach($bills as $key => $bill)
    <?php
    $prod_size = explode(', ', $bill->prod_size);
    $prod_id = explode(', ', $bill->prod_id);
    $prod_qty = explode(', ', $bill->prod_qty);
    $prod_price = explode(', ', $bill->prod_price);
    $total = 0;
    foreach ($prod_id as $key => $id) {
        $total += $prod_qty[$key] * $prod_price[$key];
    }
    ?>
@foreach ($prod_id as $key => $id)
<?php    
$name_prod = '';
$name_product = App\Models\admin\Product::where('id', $id)->get('name_product');
if (count($name_product) > 0) {
$name_prod .= $name_product[0]['name_product'];
}
?>
<tr align="center">
@if ($name_prod != null)
<td scope="row">{{ $name_prod }}</td>
@else
<td scope="row">---</td>
@endif    
<td scope="row">{{ $prod_size[$key] }}</td>
<td scope="row">{{ $prod_qty[$key] }}</td>
<td scope="row">{{ number_format($prod_price[$key]) }}</td>
</tr>
@endforeach
@endforeach

</tbody>
</table>
</div>
<div style="float: right; font-size:16px;padding-top:5px">
<span style="font-weight: bold">Tổng giá tiền:</span> {{ number_format($total)}} VNĐ
</div>
</div>

