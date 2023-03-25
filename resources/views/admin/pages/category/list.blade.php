@extends('admin.main')
@section('job')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Danh sách danh mục</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width: 5%;" class="align-middle">#</th>
                        <th style="width: 25%;text-align:center">Tiêu đề</th>
                        <th style="width: 10%;text-align:center">Tiêu đề cha</th>
                        <th style="width:10%;text-align:center">Tình trạng</th>
                        <th style="width:10%;text-align:center">Chỉnh sửa</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($datas as $key => $data)
                        <tr>
                            <td style="vertical-align: middle;">{{ $key + 1 }}</td>
                            <td style="vertical-align: middle;">{{ $data->name_category }}</td>
                            <td style="vertical-align: middle; text-align:center">
                                <span class="align-middle"> {{ $data->parent_id }}</span>
                            </td>

                            <td style="vertical-align: middle;text-align:center">
                                @if ($data->is_active == 0)
                                    <span class="badge bg-danger">Không hoạt động</span>
                                @else
                                    <span class="badge bg-success">Hoạt động</span>
                                @endif
                            </td>
                            <td style="vertical-align: middle;text-align:center">
                                <a href="{{ route('Update Category', $data) }}">Sửa</a> / Xóa
                            </td>
                        </tr>
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
