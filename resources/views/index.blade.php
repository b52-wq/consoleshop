@extends('layouts.app')
@section('content')
<main>

<section class="swiper-container js-swiper-slider swiper-number-pagination slideshow" data-settings='{
    "autoplay": {
      "delay": 5000
    },
    "slidesPerView": 1,
    "effect": "fade",
    "loop": true
  }'>
  <div class="swiper-wrapper">
    <div class="swiper-slide">
      <div class="overflow-hidden position-relative h-100">
        <div class="slideshow-character position-absolute bottom-0 pos_right-center">
          <img loading="lazy" src="{{ asset ( 'assets/images/slideshow-character1.png' ) }}" width="542" height="733"
            alt="Woman Fashion 1"
            class="slideshow-character__img animate animate_fade animate_btt animate_delay-9 w-auto h-auto" />
        </div>
        <div class="slideshow-text container position-absolute start-50 top-50 translate-middle">
          <h6 class="text_dash text-uppercase fs-base fw-medium animate animate_fade animate_btt animate_delay-3">
            Sản Phẩm Mới</h6>
          <h2 class="h1 fw-normal mb-0 animate animate_fade animate_btt animate_delay-5">PLAYSTATION</h2>
          <h2 class="h1 fw-bold animate animate_fade animate_btt animate_delay-5">5</h2>
          <a href="#"
            class="btn-link btn-link_lg default-underline fw-medium animate animate_fade animate_btt animate_delay-7">Mua
            Ngay</a>
        </div>
      </div>
    </div>

    <div class="swiper-slide">
      <div class="overflow-hidden position-relative h-100">
        <div class="slideshow-character position-absolute bottom-0 pos_right-center">
          <img loading="lazy" src="{{ asset ( 'assets/images/slideshow-character2.png' ) }}" width="542" height="733"
            alt="Woman Fashion 2"
            class="slideshow-character__img animate animate_fade animate_btt animate_delay-9 w-auto h-auto" />
          <div class="character_markup">
            <p class="text-uppercase font-sofia fw-bold animate animate_fade animate_rtl animate_delay-10">Summer
            </p>
          </div>
        </div>
        <div class="slideshow-text container position-absolute start-50 top-50 translate-middle">
          <h6 class="text_dash text-uppercase fs-base fw-medium animate animate_fade animate_btt animate_delay-3">
            New Arrivals</h6>
          <h2 class="h1 fw-normal mb-0 animate animate_fade animate_btt animate_delay-5">Night Spring</h2>
          <h2 class="h1 fw-bold animate animate_fade animate_btt animate_delay-5">Dresses</h2>
          <a href="#"
            class="btn-link btn-link_lg default-underline fw-medium animate animate_fade animate_btt animate_delay-7">Shop
            Now</a>
        </div>
      </div>
    </div>

    <div class="swiper-slide">
      <div class="overflow-hidden position-relative h-100">
        <div class="slideshow-character position-absolute bottom-0 pos_right-center">
          <img loading="lazy" src="{{ asset ( 'assets/images/slideshow-character3.png' ) }}" width="542" height="733"
            alt="Woman Fashion 3"
            class="slideshow-character__img animate animate_fade animate_rtl animate_delay-10 w-auto h-auto" />
        </div>
        <div class="slideshow-text container position-absolute start-50 top-50 translate-middle">
          <h6 class="text_dash text-uppercase fs-base fw-medium animate animate_fade animate_btt animate_delay-3">
            New Arrivals</h6>
          <h2 class="h1 fw-normal mb-0 animate animate_fade animate_btt animate_delay-5">Night Spring</h2>
          <h2 class="h1 fw-bold animate animate_fade animate_btt animate_delay-5">Dresses</h2>
          <a href="#"
            class="btn-link btn-link_lg default-underline fw-medium animate animate_fade animate_btt animate_delay-7">Shop
            Now</a>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div
      class="slideshow-pagination slideshow-number-pagination d-flex align-items-center position-absolute bottom-0 mb-5">
    </div>
  </div>
</section>
<div class="container mw-1620 bg-white border-radius-10">
  <div class="mb-3 mb-xl-5 pt-1 pb-4"></div>
  

  <div class="mb-3 mb-xl-5 pt-1 pb-4"></div>

  <div class="mb-3 mb-xl-5 pt-1 pb-4"></div>

  
  <div class="mb-3 mb-xl-5 pt-1 pb-4"></div>

  <section class="products-grid container">
    <h2 class="section-title text-center mb-3 pb-xl-3 mb-xl-4">Featured Products</h2>

    <div class="row">
      @foreach($products as $product)
      <div class="col-6 col-md-4 col-lg-3">
        <div class="product-card product-card_style3 mb-3 mb-md-4 mb-xxl-5">
          <div class="pc__img-wrapper">
            <a href="{{ route('shop.product_details', ['product_slug' => $product->slug]) }}">
              <img loading="lazy"
                src="{{ $product->image_name ? asset('uploads/products/' . $product->image_name) : asset('assets/images/products/product_0.jpg') }}"
                width="330" height="400"
                alt="{{ $product->name }}" class="pc__img">
            </a>
            @if($product->is_new)
                <div class="product-label text-uppercase bg-white top-0 left-0 mt-2 mx-2">Mới</div>
            @endif
            @if($product->discount_percent)
                <div class="product-label bg-red text-white right-0 top-0 left-auto mt-2 mx-2">
                    -{{ $product->discount_percent }}%
                </div>
            @endif
          </div>
          <div class="pc__info position-relative">
            <h6 class="pc__title">
              <a href="{{ route('shop.product_details', ['product_slug' => $product->slug]) }}">{{ $product->name }}</a>
            </h6>
            <div class="product-card__price d-flex align-items-center">
                @if($product->discount_price)
                    <span class="money price-old">{{ number_format($product->price, 0, ',', '.') }}₫</span>
                    <span class="money price text-secondary">{{ number_format($product->discount_price, 0, ',', '.') }}₫</span>
                @else
                    <span class="money price text-secondary">{{ number_format($product->price, 0, ',', '.') }}₫</span>
                @endif
            </div>
            <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body">
                <form method="POST" action="{{ route('cart.add') }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <input type="hidden" name="name" value="{{ $product->name }}">
                    <input type="hidden" name="price" value="{{ $product->price }}">
                    <input type="hidden" name="image" value="{{ $product->image_name }}">
                    <input type="hidden" name="slug" value="{{ $product->slug }}">
                    <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside"
                        data-aside="cartDrawer" title="Thêm vào giỏ">Thêm vào giỏ</button>
                </form>
                <a class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view"
                    data-bs-toggle="modal" data-bs-target="#quickView" title="Xem nhanh">
                    <span class="d-none d-xxl-block">Xem nhanh</span>
                    <span class="d-block d-xxl-none">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <use href="#icon_view" />
                        </svg>
                    </span>
                </a>
                <button class="pc__btn-wl bg-transparent border-0 js-add-wishlist" title="Thêm vào yêu thích">
                    <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_heart" />
                    </svg>
                </button>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div><!-- /.row -->

    <div class="text-center mt-2">
      <a class="btn-link btn-link_lg default-underline text-uppercase fw-medium" href="#">Load More</a>
    </div>
  </section>
</div>

<div class="mb-3 mb-xl-5 pt-1 pb-4"></div>

</main>
@endsection