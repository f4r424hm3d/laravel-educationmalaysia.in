@extends('front.layouts.main')
@push('seo_meta_tag')
  @include('front.layouts.dynamic_page_meta_tag')
@endpush
@push('breadcrumb_schema')
  <!-- breadcrumb schema Code -->
  <script type="application/ld+json">
    {
      "@context": "https://schema.org/",
      "@type": "BreadcrumbList",
      "name": "{{ ucwords($meta_title) }}",
      "description": "{{ $meta_description }}",
      "itemListElement": [{
        "@type": "ListItem",
        "position": 1,
        "name": "Home",
        "item": "{{ url('/') }}"
      }, {
        "@type": "ListItem",
        "position": 2,
        "name": "Get Info",
        "item": "{{ route('blog') }}"
      }, {
        "@type": "ListItem",
        "position": 3,
        "name": "Get Info By category",
        "item": "{{ route('blog.category',['category_slug'=>$blog->category->slug]) }}"
      }, {
        "@type": "ListItem",
        "position": 4,
        "name": "{{ $blog->headline }}",
        "item": "{{ url()->current() }}"
      }]
    }
  </script>
  <!-- breadcrumb schema Code End -->
@endpush
@section('main-section')
  <div class="image-cover ed_detail_head lg" style="background:url({{ url('/front/') }}/assets/img/ub.jpg);"
    data-overlay="8">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-12 col-md-12">
          <div class="ed_detail_wrap light">
            <ul class="cources_facts_list">
              <li class="facts-1"><a href="{{ url('/') }}">Home</a></li>
              <li class="facts-1"><a href="{{ route('blog') }}">Get Info</a></li>
              <li class="facts-1"><a
                  href="{{ route('blog.category', ['category_slug' => $blog->category->slug]) }}">{{ $blog->category->cate_name }}</a>
              </li>
              <li class="facts-1">{{ $blog->headline }}</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <section class="bg-light blog-page">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-12 col-sm-12 col-12">
          <div class="article_detail_wrapss single_article_wrap format-standard">
            <div class="article_body_wrap">
              <div class="article_featured_image">
                <img class="img-fluid w-100" src="{{ asset($blog->imgpath) }}" alt="{{ $blog->headline }}">
              </div>
              <div class="article_top_info">
                <ul class="article_middle_info">
                  @if ($blog->author_id != null)
                    <li class="before-set" >
                      <a href="javascript:void()">
                        <span class="icons"><i class="ti-user"></i></span>
                        by {{ $blog->author->name }}
                      </a>
                    </li>
                  @endif
                </ul>
              </div>
              <h2 class="post-title">{{ $blog->headline }}</h2>
              @foreach ($blog->contents as $row)
                <h2 id="{{ $row->slug }}">{{ $row->title }}</h2>
                <p>{{ $row->description }}</p><br>
              @endforeach
              {!! $blog->description !!}
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12 col-12">
          <div class="single_widgets widget_category">
            <h4 class="title">Categories</h4>
            <ul>
              @foreach ($categories as $row)
                <li><a href="{{ route('blog.category', ['category_slug' => $row->slug]) }}">{{ $row->cate_name }}
                <span><i class="fa fa-angle-right"></i></span>    
              </a>
                </li>
              @endforeach
            </ul>
          </div>
          <div class="single_widgets widget_thumb_post">
            <h4 class="title mb-3">Trending Posts</h4>
            <ul>
              @foreach ($blogs as $row)
                <li>
                  <span class="left">
                    <img data-src="{{ asset($row->imgpath) }}" alt="{{ $row->headline }}" class="">
                  </span>
                  <span class="right">
                    <a class="feed-title"
                      href="{{ route('blog.detail', ['category_slug' => $row->category->slug, 'slug' => $row->slug . '-' . $row->id]) }}">{{ $row->headline }}</a>
                    <span class="post-date">
                      <i class="ti-calendar"></i>{{ getFormattedDate($row->created_at, 'd M, Y') }}
                    </span>
                  </span>
                </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
