@extends('admin.main')
@section('job')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Danh sách sản phẩm</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width:1%">#</th>
                        <th scope="col" style="width:9%">Tiêu đề</th>
                        <th scope="col" style="width:10%">Nội dung</th>
                        <th scope="col" class="w-25">Hình ảnh</th>
                        <th scope="col" style="width:9%">Giá cũ</th>
                        <th scope="col" style="width:12%">Giá mới</th>
                        <th scope="col" style="width:12%">Mã danh mục</th>
                        <th scope="col" style="width:12%">Tình trạng</th>
                        <th scope="col" style="width:12%">Chỉnh sửa</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($datas as $key => $data)
                        <tr>
                            <td style="vertical-align: middle;">{{ $data->id }}</td>
                            <td style="vertical-align: middle;">{{ $data->name_product }}</td>
                            <td style="text-align: center; vertical-align: middle;">
                                <span class="align-middle"> {{ $data->short_description }}</span>
                            </td>
                            <td style="text-align: center; vertical-align: middle;">
                                <div class="w-25">
                                    <img class="img-thumbnail" src="{{ $data->thumb }}" alt="{{ $data->name_product }}">
                                </div>
                            </td>
                            <td style="text-align: center; vertical-align: middle;">
                                <span class="align-middle"> {{ number_format($data->old_price) }}</span>
                            </td>
                            <td style="text-align: center; vertical-align: middle;">
                                <span class="align-middle"> {{ number_format($data->new_price) }}</span>
                            </td>
                            <td style="text-align: center; vertical-align: middle;">
                                <span class="align-middle"> {{ $data->category_id }}</span>
                            </td>
                            <td style="vertical-align: middle;">
                                @if ($data->is_active == 0)
                                    <span class="badge bg-danger">Không hoạt động</span>
                                @else
                                    <span class="badge bg-success">Hoạt động</span>
                                @endif
                            </td>
                            <td style="vertical-align: middle;">
                                <a href="{{ route('Update Product', $data->id) }}">Sửa</a> /
                                <a href="#" data-toggle="modal"
                                    data-target="#dialogConfrim{{ $data->id }}">Xóa</a>

                            </td>
                        </tr>
                        <div class="modal fade" id="dialogConfrim{{ $data->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="dialogConfrim" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="dialogConfrim">Xác nhận chỉnh sửa, thay đổi nội
                                            dung
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Dữ liệu xóa không thể khôi phục.
                                        Bạn có chắc muốn xóa bản ghi này ?
                                        {{ $data->id }}
                                    </div>
                                    <form action="{{ route('Delete Product', $data->id) }}" method="post">
                                        @method('DELETE')
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">
                                                Có
                                            </button>
                                            <button type="button" class="btn btn-danger"
                                                data-dismiss="modal">Không</button>
                                        </div>
                                        @csrf
                                    </form>
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
