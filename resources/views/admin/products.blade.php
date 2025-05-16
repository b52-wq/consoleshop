@extends('layouts.admin')
@section('content')
<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Toàn Bộ Sản Phẩm</h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li>
                    <a href="{{ route('admin.index') }}">
                        <div class="text-tiny">Dashboard</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">Toàn Bộ Sản Phẩm</div>
                </li>
            </ul>
        </div>

        <div class="wg-box">
            <div class="flex items-center justify-between gap10 flex-wrap">
                <div class="wg-filter flex-grow">
                    <form class="form-search">
                        <fieldset class="name">
                            <input type="text" placeholder="Search here..." class="" name="name" tabindex="2" value="" aria-required="true" required="">
                        </fieldset>
                        <div class="button-submit">
                            <button class="" type="submit"><i class="icon-search"></i></button>
                        </div>
                    </form>
                </div>
                <a class="tf-button style-1 w208" href="{{ route('admin.product.create') }}"><i class="icon-plus"></i>Thêm Mới</a>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên Sản Phẩm</th>
                            <th>Giá</th>
                            <th>Mặt Hàng</th>
                            <th>Thương Hiệu</th>
                            <th>Nổi Bật</th>
                            <th>Hàng Tồn Kho</th>
                            <th>Số Lượng</th>
                            <th>Trạng Thái</th>
                            <th>Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td class="pname">
                                <div class="image">
                                    <img src="{{ $product->image_name ? asset('uploads/products/' . $product->image_name) : asset('assets/images/products/product_0.jpg') }}" alt="{{ $product->name }}" class="image">
                                </div>
                                <div class="name">
                                    <a href="{{ $product->slug ? route('shop.product_details', ['product_slug' => $product->slug]) : '#' }}" class="body-title-2">{{ $product->name }}</a>
                                    <div class="text-tiny mt-3">{{ $product->slug }}</div>
                                </div>
                            </td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->brand->name }}</td>
                            <td>{{ $product->is_featured == 0 ? "Không" : "Có" }}</td>
                            <td>{{ $product->status }}</td>
                            <td>{{ $product->amount }}</td>
                            <td>{{ $product->status }}</td>
                            <td>
                                <div class="list-icon-function">
                                    <a href="#" target="_blank">
                                        <div class="item eye" title="Xem">
                                            <i class="icon-eye"></i>
                                        </div>
                                    </a>
                                    <a href="{{ route('admin.product.edit', $product->id) }}">
                                        <div class="item edit" title="Sửa">
                                            <i class="icon-edit-3"></i>
                                        </div>
                                    </a>
                                    <form action="{{ route('admin.product.delete', ['id' => $product->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="item text-danger delete" title="Xóa">
                                            <i class="icon-trash-2"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="divider"></div>
            <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function() {
        $('.delete').on('click', function(e) {
            e.preventDefault();
            swal({
                title: "Bạn có chắc chắn muốn xóa?",
                text: "Bạn sẽ không thể khôi phục sản phẩm này!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then(function (result) {
                if (result) {
                    e.target.closest('form').submit(); 
                }
            });
        });
    });
</script>
@endpush