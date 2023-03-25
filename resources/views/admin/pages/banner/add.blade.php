@extends('admin.main')
@section('job')
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Thêm danh mục</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="" method="post" enctype="multipart/form-data">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Tiêu đề</label>
                        <input type="text" class="form-control" name="name_banner" placeholder="Nhập tiêu đề">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Thứ tự</label>
                        <input type="number" class="form-control" name="number_sort" value="0">
                    </div>
                </div>
                <div class="form-group">
                    <label>Nội dung</label>
                    <input type="text" class="form-control" name="banner_content" placeholder="Nhập nội dung">
                </div>
                <div class="form-group">
                    <label>Hình ảnh</label>
                    <input type="file" class="form-control" name="thumb">
                </div>
                <div class="form-check">
                    <input type="radio" id="active" name="is_active" class="form-check-input" value="1" checked>
                    <label class="form-check-label" for="active">Kích hoạt</label>
                    <br>
                    <input type="radio" id="non-active" name="is_active" class="form-check-input" value="0">
                    <label class="form-check-label" for="non-active">Tắt</label>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            @csrf
        </form>
    </div>
@endsection
