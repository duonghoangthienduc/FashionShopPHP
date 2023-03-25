@extends('admin.main')
@section('job')
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Chỉnh sửa danh mục</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="" method="post" enctype="multipart/form-data">
            @method('PUT')
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Tiêu đề</label>
                        <input type="text" class="form-control" name="name_banner" placeholder="Nhập tiêu đề"
                            value="{{ $data->name_banner }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Thứ tự</label>
                        <input type="number" class="form-control" name="number_sort" value="{{ $data->number_sort }}">
                    </div>
                </div>
                <div class="form-group">
                    <label>Nội dung</label>
                    <input type="text" class="form-control" name="banner_content" placeholder="Nhập nội dung"
                        value="{{ $data->banner_content }}">
                </div>
                <div class="form-group">
                    <label>Hình ảnh</label>
                    <input type="file" class="form-control" name="thumb">
                    @if ($data->thumb != null)
                        <img class="w-25" src="{{ $data->thumb }}">
                        <input hidden name="img_category" value="{{ $data->thumb }}">
                    @endif
                </div>
                <div class="form-check">
                    @if ((int) $data->is_active == 0)
                        <input type="radio" id="active" name="is_active" class="form-check-input" value="1">
                        <label class="form-check-label" for="active">Kích hoạt</label>
                        <br>
                        <input checked type="radio" id="non-active" name="is_active" class="form-check-input"
                            value="0">
                        <label class="form-check-label" for="non-active">Tắt</label>
                    @else
                        <input checked type="radio" id="active" name="is_active" class="form-check-input"
                            value="1">
                        <label class="form-check-label" for="active">Kích hoạt</label>
                        <br>
                        <input type="radio" id="non-active" name="is_active" class="form-check-input" value="0">
                        <label class="form-check-label" for="non-active">Tắt</label>
                    @endif
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="button" class="btn btn-primary" data-toggle="modal"
                    data-target="#dialogConfrim">Submit</button>
            </div>
            <div class="modal fade" id="dialogConfrim" tabindex="-1" role="dialog" aria-labelledby="dialogConfrim"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="dialogConfrim">Xác nhận chỉnh sửa, thay đổi nội dung</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Bạn có chắc muốn thay đổi những gì bạn đã cập nhật ?
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">
                                Có
                            </button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Không</button>
                        </div>
                    </div>
                </div>
            </div>
            @csrf
        </form>
    </div>
@endsection
