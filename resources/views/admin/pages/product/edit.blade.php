@extends('admin.main')
@section('job')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Thêm danh mục</h3>
        </div>
        {{-- {{ dd($category) }} --}}
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Tên sản phẩm</label>
                        <input type="text" class="form-control" name="name_product" placeholder="Nhập tiêu đề"
                            value="{{ $data->name_product }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Danh mục sản phẩm</label>
                        <p>
                            <select name="category_id" id="title" class="form-control" name="parent_id">
                                @foreach ($category as $cate)
                                    <option value="{{ $cate->id }}">{{ $cate->name_category }}</option>
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
                                min="1000" step="1000" value="{{ $data->old_price }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Giá giảm (VNĐ)</label>
                            <input type="number" class="form-control" name="new_price" placeholder="Nhập tiêu đề"
                                min="0" step="1000" value="{{ $data->new_price }}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Miêu tả ngắn</label>
                    <input type="text" class="form-control" name="short_description" placeholder="Nhập miêu tả"
                        value="{{ $data->short_description }}">
                </div>
                <div class="form-group">
                    <label>Thông tin</label>
                    <textarea type="text" class="form-control" name="info" placeholder="Nhập miêu tả sản phẩm" id="content"
                        rows="10" cols="80">{!! $data->info !!}</textarea>
                </div>
                <div class="form-group">
                    <label>Miêu tả</label>
                    <textarea type="text" class="form-control" name="description" placeholder="Nhập thông tin sản phẩm" id="content2"
                        rows="10" cols="80">{!! $data->description !!}</textarea>
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
                    <img class="w-25" src="{{ $data->thumb }}">
                    <input hidden name="img_thumb" value="{{ $data->thumb }}">
                </div>
                <div class="form-group">
                    <label>Ảnh chi tiết 1</label>
                    <input type="file" class="form-control" name="image1">
                    <img class="w-25" src="{{ $data->image1 }}">
                    <input hidden name="img_1" value="{{ $data->image1 }}">
                </div>
                <div class="form-group">
                    <label>Ảnh chi tiết 2</label>
                    <input type="file" class="form-control" name="image2">
                    <img class="w-25" src="{{ $data->image2 }}">
                    <input hidden name="img_2" value="{{ $data->image2 }}">
                </div>
                <div class="form-group">
                    <label>Ảnh chi tiết 3</label>
                    <input type="file" class="form-control" name="image3">
                    <img class="w-25" src="{{ $data->image3 }}">
                    <input hidden name="img_3" value="{{ $data->image3 }}">
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
