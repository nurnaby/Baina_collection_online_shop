@extends('frontend.frontend_master')
@section('frontend')
@section('title')
    category wise product
@endsection
<div class="page-header mt-30 mb-50">
    <div class="container">
        <div class="archive-header">
            <div class="row align-items-center">
                <div class="col-xl-3">
                    <h1 class="mb-15">{{ $breadCate->category_name }}</h1>
                    <div class="breadcrumb">
                        <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                        <span></span> Product Category <span></span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="container mb-30">
    <div class="row flex-row-reverse">
        <div class="col-lg-4-5">
            <div class="shop-product-fillter">
                <div class="totall-product">
                    <p>We found <strong class="text-brand">{{ count($products) }}</strong> items for you!</p>
                </div>
                <div class="sort-by-product-area">
                    <div class="sort-by-cover mr-10">
                        <div class="sort-by-product-wrap">
                            <div class="sort-by">
                                <span><i class="fi-rs-apps"></i>Show:</span>
                            </div>
                            <div class="sort-by-dropdown-wrap">
                                <span> 50 <i class="fi-rs-angle-small-down"></i></span>
                            </div>
                        </div>
                        <div class="sort-by-dropdown">
                            <ul>
                                <li><a class="active" href="#">50</a></li>
                                <li><a href="#">100</a></li>
                                <li><a href="#">150</a></li>
                                <li><a href="#">200</a></li>
                                <li><a href="#">All</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="sort-by-cover">
                        <div class="sort-by-product-wrap">
                            <div class="sort-by">
                                <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                            </div>
                            <div class="sort-by-dropdown-wrap">
                                <span> Featured <i class="fi-rs-angle-small-down"></i></span>
                            </div>
                        </div>
                        <div class="sort-by-dropdown">
                            <ul>
                                <li><a class="active" href="#">Featured</a></li>
                                <li><a href="#">Price: Low to High</a></li>
                                <li><a href="#">Price: High to Low</a></li>
                                <li><a href="#">Release Date</a></li>
                                <li><a href="#">Avg. Rating</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row product-grid">
                @forelse ($products as $item)
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="{{ url('product/details/' . $item->id . '/' . $item->product_slug) }}">
                                        <img class="default-img" src="{{ asset($item->product_thumbnail) }}"
                                            alt="" />

                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Add To Wishlist" class="action-btn" href="shop-wishlist.html"><i
                                            class="fi-rs-heart"></i></a>
                                    <a aria-label="Compare" class="action-btn" href="shop-compare.html"><i
                                            class="fi-rs-shuffle"></i></a>
                                    <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal"
                                        data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                </div>
                                @php
                                    // $amount = $item->selling_price - $item->discount_price;
                                    $discount = ($item->selling_price * $item->discount_price) / 100;
                                @endphp
                                {{-- @php
                        $amount = $item->selling_price * $item->discount_price;
                        $discount = $item->selling_price - $item->selling_price * ($item->discount_price / 100);
                        // $amount = ($item->selling_price / 100) * $item->discount_price;
                        // $discount = $amount - $item->discount_price;
                    @endphp --}}
                                <div class="product-badges product-badges-position product-badges-mrg">
                                    @if ($item->discount_price == null)
                                        <span class="new">NEW</span>
                                    @else
                                        <span class="hot">{{ round($discount) }}%</span>
                                    @endif
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="shop-grid-right.html">{{ $item['category']['category_name'] }}</a>
                                </div>
                                <h2><a
                                        href="{{ url('product/details/' . $item->id . '/' . $item->product_slug) }}">{{ $item->product_name }}</a>
                                </h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (4.0)</span>
                                </div>
                                @if ($item->vendor_id == null)
                                    <div>
                                        <span class="font-small text-muted">By <a
                                                href="vendor-details-1.html">Owner</a></span>
                                    </div>
                                @else
                                    <div>
                                        <span class="font-small text-muted">By <a
                                                href="vendor-details-1.html">{{ $item['vendor']['name'] }}</a></span>
                                    </div>
                                @endif
                                <div class="product-card-bottom">
                                    @if ($item->discount_price == null)
                                        <div class="product-price">

                                            <span>${{ $item->selling_price }}</span>
                                        </div>
                                    @else
                                        <div class="product-price">
                                            @php
                                                $discount = $item->selling_price - $item->discount_price;
                                            @endphp
                                            <span>${{ $discount }}</span>
                                            <span class="old-price">${{ $item->selling_price }}</span>
                                        </div>
                                    @endif

                                    <div class="add-cart">
                                        <a class="add" href="shop-cart.html"><i
                                                class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <h5 class="text-danger">No Product Found</h5>
                @endforelse
                <!--end product card-->

            </div>
            <!--product grid-->
            <div class="pagination-area mt-20 mb-20">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-start">
                        <li class="page-item">
                            <a class="page-link" href="#"><i class="fi-rs-arrow-small-left"></i></a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item active"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                        <li class="page-item"><a class="page-link" href="#">6</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#"><i class="fi-rs-arrow-small-right"></i></a>
                        </li>
                    </ul>
                </nav>
            </div>

            <!--End Deals-->


        </div>
        <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
            <div class="sidebar-widget widget-category-2 mb-30">
                <h5 class="section-title style-1 mb-30">Category</h5>
                <ul>
                    @foreach ($categories as $category)
                        @php
                            $product = App\Models\product::where('category_id', $category->id)->get();
                        @endphp
                        <li>
                            <a href="shop-grid-right.html"> <img src="{{ asset($category->category_image) }}"
                                    alt="" />{{ $category->category_name }}</a><span
                                class="count">{{ count($product) }}</span>
                        </li>
                    @endforeach

                </ul>
            </div>

            <!-- Product sidebar Widget -->
            <div class="sidebar-widget product-sidebar mb-30 p-30 bg-grey border-radius-10">
                <h5 class="section-title style-1 mb-30">New products</h5>
                @foreach ($newProduct as $item)
                    <div class="single-post clearfix">
                        <div class="image">
                            <img src="{{ asset($item->product_thumbnail) }}" alt="#" />
                        </div>
                        <div class="content pt-10">
                            <h5><a
                                    href="{{ url('product/details/' . $item->id . '/' . $item->product_slug) }}l">{{ $item->product_name }}</a>
                            </h5>
                            @if ($item->discount_price == null)
                                <div class="product-price">

                                    <span>${{ $item->selling_price }}</span>
                                </div>
                            @else
                                <div class="product-price">
                                    @php
                                        $discount = $item->selling_price - $item->discount_price;
                                    @endphp
                                    <span>${{ $discount }}</span>

                                </div>
                            @endif
                            <div class="product-rate">
                                <div class="product-rating" style="width: 90%"></div>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>

        </div>
    </div>
</div>
@endsection
