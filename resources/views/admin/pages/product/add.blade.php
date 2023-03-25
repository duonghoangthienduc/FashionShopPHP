@extends('admin.main')
@section('job')
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
                        <label>Tên sản phẩm</label>
                        <input type="text" class="form-control" name="name_product" placeholder="Nhập tiêu đề">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Danh mục sản phẩm</label>
                        <p>
                            <select name="category_id" id="title" class="form-control" name="parent_id">
                                @foreach ($datas as $data)
                                    <option value="{{ $data->id }}">{{ $data->name_category }}</option>
                                @endforeach
                            </select>
                        </p>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Giá gốc (VNĐ)</label>
                            <input type="number" class="form-control" name="old_price" placeholder="Nhập tiêu đề"
                                min="1000" step="1000">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Giá giảm (VNĐ)</label>
                            <input type="number" class="form-control" name="new_price" placeholder="Nhập tiêu đề"
                                min="0" step="1000">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Miêu tả ngắn</label>
                    <input type="text" class="form-control" name="short_description" placeholder="Nhập miêu tả">
                </div>
                <div class="form-group">
                    <label>Thông tin</label>
                    <textarea type="text" class="form-control" name="info" placeholder="Nhập miêu tả sản phẩm" id="content"
                        rows="10" cols="80"></textarea>
                </div>
                <div class="form-group">
                    <label>Miêu tả</label>
                    <textarea type="text" class="form-control" name="description" placeholder="Nhập thông tin sản phẩm" id="content2"
                        rows="10" cols="80"></textarea>
                </div>
                <div class="form-check">
                    <label>Size sản phẩm</label>
                    <br>
                    <input type="checkbox" id="S" name="size[]" class="form-check-input" value="S">
                    <label class="form-check-label" for="S">S</label>
                    <br>
                    <input type="checkbox" id="M" name="size[]" class="form-check-input" value="M">
                    <label class="form-check-label" for="M">M</label>
                    <br>
                    <input type="checkbox" id="L" name="size[]" class="form-check-input" value="L">
                    <label class="form-check-label" for="L">L</label>
                    <br>
                    <input type="checkbox" id="XL" name="size[]" class="form-check-input" value="XL">
                    <label class="form-check-label" for="XL">XL</label>
                    <br>
                    <input type="checkbox" id="XXL" name="size[]" class="form-check-input" value="XXL">
                    <label class="form-check-label" for="XXL">XXL</label>
                </div>
                <div class="form-group pt-3">
                    <label>Hình ảnh</label>
                    <input type="file" class="form-control" name="thumb">
                </div>
                <div class="form-group">
                    <label>Ảnh chi tiết 1</label>
                    <input type="file" class="form-control" name="image1">
                </div>
                <div class="form-group">
                    <label>Ảnh chi tiết 2</label>
                    <input type="file" class="form-control" name="image2">
                </div>
                <div class="form-group">
                    <label>Ảnh chi tiết 3</label>
                    <input type="file" class="form-control" name="image3">
                </div>
                <div class="form-check">
                    <input type="radio" id="active" name="is_active" class="form-check-input" value="1"
                        checked>
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
    <script>
        CKEDITOR.replace('content');
        CKEDITOR.replace('content2');
    </script>
@endsection
