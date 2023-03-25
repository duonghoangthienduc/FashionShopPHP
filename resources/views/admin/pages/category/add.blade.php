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
                        <label>Tiêu đề</label>
                        <input type="text" class="form-control" name="name_category" placeholder="Nhập tiêu đề">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Tiêu đề cha</label>
                        <p>
                            <select name="parent_id" id="title" class="form-control" name="parent_id">
                                <option value="0"></option>
                                @foreach ($datas as $data)
                                    @if ($data->parent_id == 0)
                                        <option value="{{ $data->id }}">{{ $data->name_category }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </p>
                    </div>
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
