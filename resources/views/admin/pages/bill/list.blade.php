@extends('admin.main')
@section('job')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Danh sách hóa đơn</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Mã hóa đơn</th>
                        <th scope="col">Tình trạng</th>
                        <th scope="col">Tổng giá tiền(VND)</th>
                        <th scope="col">Ngày khởi tạo</th>
                        <th scope="col">Ghi chú</th>
                        <th scope="col">Chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($datas as $key => $data)
                        <tr>
                            <td style="vertical-align: middle;">{{ $data->id }}</td>
                            <td>
                                @switch($data->status)
                                    @case(1)
                                        <span class="badge bg-warning">Đơn hàng đang xử lý</span>
                                    @break

                                    @case(2)
                                        <span class="badge bg-success">Đơn hàng hoàn tất</span>
                                    @break

                                    @case(3)
                                        <span class="badge bg-danger">Đơn hàng thất bại</span>
                                    @break

                                    @default
                                        <span class="badge bg-secondary"> Đơn hàng mới </span>
                                @endswitch
                            </td>
                            <td>
                                <?php
                                $qty = explode(', ', $data->prod_qty);
                                $prices = explode(', ', $data->prod_price);
                                $toltal = 0;
                                foreach ($prices as $key => $price) {
                                    $toltal += $price * $qty[$key];
                                }
                                ?>
                                <span class="align-middle"> {{ number_format($toltal) }} </span>
                            </td>
                            <td>
                                @if ($data->created_at)
                                    <span class="align-middle"> {{ $data->created_at }}</span>
                                @else
                                    <span class="align-middle">---</span>
                                @endif

                            </td>
                            <td>
                                @if ($data->note)
                                    <span class="align-middle">{{ $data->note }}</span>
                                @else
                                    <span class="align-middle">---</span>
                                @endif

                            </td>

                            <td style="vertical-align: middle;">
                                <button class="btn btn-primary mt-1" data-toggle="modal" data-target="#dialogConfrim{{ $data->id }}">
                                    Chỉnh sửa</button>
                                @if ($data->status >= 1 && $data->status != 3)
                                <form method="POST" action="{{ route('Send Mail', $data->id) }}">
                                    <button type="submit " class="btn btn-primary mt-1">Thông báo</button>
                                    @csrf
                                </form>
                                {{-- @elseif ($data->status == 3)
                                <form method="POST" action="{{ route('Send Mail', $data->id) }}">
                                    <button type="submit " class="btn btn-danger mt-1 ">Thông báo</button>
                                    @csrf
                                </form> --}}
                                @endif
                            </td>
                        </tr>
                        <div class="modal  fade" id="dialogConfrim{{ $data->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="dialogConfrim" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable"
                                role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="dialogConfrim">
                                            Thông tin hóa đơn
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('Edit Bill', $data->id) }}" method="POST">
                                            <div class="row">
                                                <?php
                                                $customer_detail = App\Models\admin\Customer::where('bill_id', $data->id)->get();
                                                $customer_name = '';
                                                $customer_phone = '';
                                                $customer_email = '';
                                                foreach ($customer_detail as $key => $detail) {
                                                    $customer_name .= $detail->first_name . ' ' . $detail->last_name;
                                                    $customer_phone .= $detail->phone;
                                                    $customer_email .= $detail->email;
                                                }
                                                ?>
                                                <div class="form-group col-md-6">
                                                    <label>Họ và tên</label>
                                                    <input type="text" class="form-control" value="{{ $customer_name }}"
                                                        readonly>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Email</label>
                                                    <input type="text" class="form-control" value="{{ $customer_email }}"
                                                        readonly>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Phone</label>
                                                    <input type="text" class="form-control" value="{{ $customer_phone }}"
                                                        readonly>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Địa chỉ</label>
                                                    <input type="text" class="form-control" value="{{ $data->address }}"
                                                        readonly>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Thành phố / Tỉnh</label>
                                                    <?php
                                                    $city = \Kjmtrue\VietnamZone\Models\Province::where('id', $data->province_id)->get('name');
                                                    ?>
                                                    <input type="text" class="form-control"
                                                        value="{{ $city[0]['name'] }}" readonly>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Quận / Huyện</label>
                                                    <?php
                                                    $district = \Kjmtrue\VietnamZone\Models\District::where('id', $data->district_id)->get('name');
                                                    ?>
                                                    <input type="text" class="form-control"
                                                        value="{{ $district[0]['name'] }}" readonly>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Phường / Xã</label>
                                                    <?php
                                                    $ward = \Kjmtrue\VietnamZone\Models\Ward::where('id', $data->ward_id)->get('name');
                                                    ?>
                                                    <input type="text" class="form-control"
                                                        value="{{ $ward[0]['name'] }}" readonly>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Ghi chú</label>
                                                    @if ($data->note != null)
                                                        <input type="text" class="form-control"
                                                            value="{{ $data->note }}" readonly>
                                                    @else
                                                        <input type="text" class="form-control" value="Không có ghi chú"
                                                            readonly>
                                                    @endif

                                                </div>
                                                <div class="form-group col-md-12">
                                                    <div class="list-group">
                                                        <div class="list-group-item font-weight-bold">
                                                            <div class="row ">
                                                                <div class="col-md-3">
                                                                    Tên sản phẩm
                                                                </div>
                                                                <div class="col-md-3">
                                                                    Size
                                                                </div>
                                                                <div class="col-md-3">
                                                                    Số Lượng
                                                                </div>
                                                                <div class="col-md-3">
                                                                    Thành tiền (VND)
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        $prod_size = explode(', ', $data->prod_size);
                                                        $prod_id = explode(', ', $data->prod_id);
                                                        $prod_qty = explode(', ', $data->prod_qty);
                                                        $prod_price = explode(', ', $data->prod_price);
                                                        $total = 0;
                                                        foreach ($prod_id as $key => $id) {
                                                            $total += $prod_qty[$key] * $prod_price[$key];
                                                        }
                                                        ?>
                                                        @foreach ($prod_id as $key => $id)
                                                            <div class="list-group-item">
                                                                <div class="row ">
                                                                    <?php
                                                                    $name_prod = '';
                                                                    $name_product = App\Models\admin\Product::where('id', $id)->get('name_product');
                                                                    if (count($name_product) > 0) {
                                                                        $name_prod .= $name_product[0]['name_product'];
                                                                    }
                                                                    ?>
                                                                    @if ($name_prod != null)
                                                                        <div class="col-md-3">
                                                                            {{ $name_prod }}</div>
                                                                    @else
                                                                        <div class="col-md-3">
                                                                            ---</div>
                                                                    @endif

                                                                    <div class="col-md-3">{{ $prod_size[$key] }}</div>
                                                                    <div class="col-md-3">{{ $prod_qty[$key] }}</div>
                                                                    <div class="col-md-3">
                                                                        {{ number_format($prod_price[$key]) }} VND
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach

                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <div class="list-group ">
                                                        <div class="list-group-item ">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label>Trạng thái đơn hàng : </label>
                                                                    <select class="custom-select col-md-6" name="status">
                                                                        <option value="0">Đơn hàng mới</option>
                                                                        <option value="1">Đơn hàng đang xử lý</option>
                                                                        <option value="2">Đơn hàng đã thanh toán
                                                                        </option>
                                                                        <option value="3">Đơn hàng hủy</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <span class="float-right font-weight-bold">
                                                                        Tổng tiền : {{ number_format($total) }} VND
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="float-right">
                                                <button type="submit" class="btn btn-primary ">Submit</button>
                                                <button type="button" class="btn btn-danger"
                                                    data-dismiss="modal">Không</button>
                                            </div>

                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        @endforelse
                    </tbody>
                </table>

                <div class="card-body">
                    {{ $datas->links() }}
                </div>
            </div>
        </div>
    @endsection
