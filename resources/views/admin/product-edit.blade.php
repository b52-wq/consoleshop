@extends('layouts.admin')
@section('content')
<div class="main-content-inner">
                            <!-- main-content-wrap -->
                            <div class="main-content-wrap">
                                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                                    <h3>Cập Nhật Sản Phẩm</h3>
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
                                            <a href="{{route('admin.products')}}">
                                                <div class="text-tiny">Products</div>
                                            </a>
                                        </li>
                                        <li>
                                            <i class="icon-chevron-right"></i>
                                        </li>
                                        <li>
                                            <div class="text-tiny">Add product</div>
                                        </li>
                                    </ul>
                                </div>
                                <!-- form-add-product -->
                                <form class="tf-section-2 form-add-product" method="POST" enctype="multipart/form-data" action="{{ route('admin.product.update', $product->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="wg-box">
                                        <fieldset class="name">
                                            <div class="body-title mb-10">Tên Sản Phẩm <span class="tf-color-1">*</span></div>
                                            <input class="mb-10" type="text" placeholder="Điền tên sản phẩm"
                                                name="name" tabindex="0" value="{{ $product->name }}" aria-required="true" required="">
                                            <div class="text-tiny">Đừng ghi quá 100 chữ.</div>
                                        </fieldset>
                                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror

                                        <fieldset class="name">
                                            <div class="body-title mb-10">Slug <span class="tf-color-1">*</span></div>
                                            <input class="mb-10" type="text" placeholder="Điền slug sản phẩm"
                                                name="slug" tabindex="0" value="{{ $product->slug }}" aria-required="true" required="">
                                            <div class="text-tiny">Đừng ghi quá 100 chữ.</div>
                                        </fieldset>
                                        @error('slug') <span class="text-danger">{{ $message }}</span> @enderror

                                        <div class="gap22 cols">
                                            <fieldset class="category">
                                                <div class="body-title mb-10">Mặt Hàng <span class="tf-color-1">*</span></div>
                                                <div class="select">
                                                    <select class="" name="category_id">
                                                        <option value="">Chọn Mặt Hàng</option>
                                                        @foreach($categories as $category)
                                                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? "selected" : "" }}>{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </fieldset>
                                            @error('category_id') <span class="text-danger">{{ $message }}</span> @enderror
                                            <fieldset class="brand">
                                                <div class="body-title mb-10">Thương Hiệu <span class="tf-color-1">*</span></div>
                                                <div class="select">
                                                    <select class="" name="brand_id">
                                                        <option value="">Chọn Thương Hiệu</option>
                                                        @foreach($brands as $brand)
                                                            <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? "selected" : "" }}>{{ $brand->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </fieldset>
                                            @error('brand_id') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>

                                        <fieldset class="processor_info">
                                            <div class="body-title mb-10">Chi tiết cấu hình <span class="tf-color-1">*</span></div>
                                            <textarea class="mb-10 ht-150" name="processor_info"
                                                placeholder="Chi tiết cấu hình" tabindex="0" aria-required="true"
                                                required="">{{ $product->processor_info }}</textarea>
                                            <div class="text-tiny">Đừng ghi quá 100 chữ.</div>
                                        </fieldset>
                                        @error('processor_info') <span class="text-danger">{{ $message }}</span> @enderror

                                        <fieldset class="description">
                                            <div class="body-title mb-10">Mô tả <span class="tf-color-1">*</span></div>
                                            <textarea class="mb-10" name="description" placeholder="Mô tả"
                                                tabindex="0" aria-required="true" required="">{{ $product->description }}</textarea>
                                            <div class="text-tiny">Đừng ghi quá 100 chữ.</div>
                                        </fieldset>
                                        @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="wg-box">
                                        <fieldset>
                                            <div class="body-title">Tải Ảnh <span class="tf-color-1">*</span></div>
                                            <div class="upload-image flex-grow">
                                                @if($product->image_name)
                                                <div class="item" id="imgpreview">
                                                    <img src="{{ asset('uploads/products/' . $product->image_name) }}" class="effect8" alt="">
                                                </div>
                                                @else
                                                <div class="item" id="imgpreview" style="display:none">
                                                    <img src="" class="effect8" alt="">
                                                </div>
                                                @endif
                                                <div id="upload-file" class="item up-load">
                                                    <label class="uploadfile" for="myFile">
                                                        <span class="icon">
                                                            <i class="icon-upload-cloud"></i>
                                                        </span>
                                                        <span class="body-text">Thả ảnh tại đây hoặc <span class="tf-color">bấn để tìm ảnh</span></span>
                                                        <input class="mb-10" type="file" id="myFile" name="image_name" accept="image/*">
                                                    </label>
                                                </div>
                                            </div>
                                        </fieldset>
                                        @error('image_name') <span class="text-danger">{{ $message }}</span> @enderror

                                        <div class="cols gap22">
                                            <fieldset class="name">
                                                <div class="body-title mb-10">Giá <span class="tf-color-1">*</span></div>
                                                <input class="mb-10" type="text" placeholder="Điền Giá"
                                                    name="price" tabindex="0" value="{{ $product->price }}" aria-required="true"
                                                    required="">
                                            </fieldset>
                                            @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                                            <fieldset class="name">
                                                <div class="body-title mb-10">Số Lượng <span class="tf-color-1">*</span></div>
                                                <input class="mb-10" type="text" placeholder="Điền Số Lượng"
                                                    name="amount" tabindex="0" value="{{ $product->amount }}" aria-required="true"
                                                    required="">
                                            </fieldset>
                                            @error('quantity') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="cols gap22">
                                            <fieldset class="name">
                                                <div class="body-title mb-10">Hàng Tồn Kho</div>
                                                <div class="select mb-10">
                                                    <select class="" name="status">
                                                        <option value="còn hàng" {{ $product->status == 'còn hàng' ? 'selected' : '' }}>Còn Hàng</option>
                                                        <option value="hết hàng" {{ $product->status == 'hết hàng' ? 'selected' : '' }}>Đã Hết Hàng</option>
                                                    </select>
                                                </div>
                                            </fieldset>
                                            @error('stock_status') <span class="text-danger">{{ $message }}</span> @enderror
                                            <fieldset class="name">
                                                <div class="body-title mb-10">Nổi Bật</div>
                                                <div class="select mb-10">
                                                    <select class="" name="is_featured">
                                                        <option value="0" {{ $product->is_featured == 0 ? 'selected' : '' }}>Không</option>
                                                        <option value="1" {{ $product->is_featured == 1 ? 'selected' : '' }}>Có</option>
                                                    </select>
                                                </div>
                                            </fieldset>
                                            @error('featured') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="cols gap10">
                                            <button class="tf-button w-full" type="submit">Cập Nhật Sản Phẩm</button>
                                        </div>
                                    </div>
                                </form>
                                <!-- /form-add-product -->
                            </div>
                            <!-- /main-content-wrap -->
                        </div>
@endsection

@push('scripts')
<script>
    $(function(){
        // Preview main image only
        $('#myFile').change(function(e) {
            const [file] = this.files;
            if (file) {
                $('#imgpreview img').attr('src', URL.createObjectURL(file));
                $('#imgpreview').show();
            }
        });

        // Slug generator
        $("input[name='name']").on('keyup', function() {
            var slug = StringToSlug($(this).val());
            $("input[name='slug']").val(slug);
        });

        function StringToSlug(TEXT) {
            var slug = TEXT.toLowerCase();
            slug = slug.replace(/^\s+|\s+$/g, '');
            slug = slug.replace(/\s+/g, '-');
            slug = slug.replace(/[^a-z0-9\-]/g, '');
            return slug;
        }
    });
</script>
@endpush