@extends('admin.main')
@section('job')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Danh sách khách hàng</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width:1%">#</th>
                        <th scope="col">Họ</th>
                        <th scope="col">Tên</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Mã hóa đơn</th>
                        <th scope="col">Chỉnh sửa</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($datas as $key => $data)
                        <tr>
                            <td style="vertical-align: middle;">{{ $data->id }}</td>
                            <td>{{ $data->first_name }}</td>
                            <td>
                                <span class="align-middle"> {{ $data->last_name }}</span>
                            </td>
                            <td>
                                <span class="align-middle"> {{ $data->email }}</span>
                            </td>
                            <td>
                                <span class="align-middle"> {{ $data->phone }}</span>
                            </td>
                            <td>
                                <span class="align-middle"> {{ $data->bill_id }}</span>
                            </td>

                            <td style="vertical-align: middle;">
                                <a href="#" data-toggle="modal" data-target="#dialogConfrim{{ $data->id }}">
                                    Chỉnh sửa</a>
                            </td>
                        </tr>
                        <div class="modal fade" id="dialogConfrim{{ $data->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="dialogConfrim" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="dialogConfrim">
                                            Thông tin khách hàng
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="POST">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>Họ</label>
                                                    <input type="text" class="form-control" name="first_name"
                                                        placeholder="Nhập tiêu đề" value="{{ $data->first_name }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Tên</label>
                                                    <input type="text" class="form-control" name="last_name"
                                                        placeholder="Nhập tiêu đề" value="{{ $data->last_name }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Email</label>
                                                    <input type="text" class="form-control" name="email"
                                                        placeholder="Nhập tiêu đề" value="{{ $data->email }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Phone</label>
                                                    <input type="text" class="form-control" name="phone"
                                                        placeholder="Nhập tiêu đề" value="{{ $data->phone }}">
                                                </div>
                                            </div>
                                            <div class="card-footer float-right">
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
