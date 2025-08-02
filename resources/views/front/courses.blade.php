@extends('front.layouts.main')
@push('seo_meta_tag')
  @include('front.layouts.static_page_meta_tag')
@endpush
@push('breadcrumb_schema')
@endpush
@section('main-section')
  <!-- Breadcrumb -->
  <div class="ed_detail_head" data-overlay="10">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-12 col-md-12">
          <div class="ed_detail_wrap light">
            <ul class="cources_facts_list">
              <li class="facts-1"><a href="{{ url('/') }}">Home</a></li>
              <li class="facts-1"><a href="{{ url('select-level') }}">Courses</a></li>
              @if ($pageContent)
                <li class="facts-1">{{ strtoupper($pageContent->page_name) }}</li>
              @endif
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumb -->
  @if ($pageContent)
    <!-- === Hero Banner End ===-->
    <section class="bg-light new-home-box">
      <div class="container">
        <div class="graduate_bx">
          <div class="show-more-box-country">

            <div class="text show-more-height">
              <div class="author">
                <div class="new-uers">
                  <div class="img-div">
                    <img src="{{ userIcon($pageContent->author->profile_picture ?? null) }}"
                      alt="{{ $pageContent->author->name ?? 'Author' }}"><i class="fa fa-check-circle"></i>
                  </div>
                </div>
                <div class="cont-div">
                  <a
                    href="{{ $pageContent->author_id != null ? url('author/' . $pageContent->author->id . '-' . $pageContent->author->slug) : '#' }}">{{ $pageContent->author->name ?? 'Author' }}
                  </a><span> Updated on - {{ getFormattedDate($pageContent->updated_at, 'M d, Y') }}</span>
                </div>
              </div>
              <div class="study-bx mb-2">
                <h3>Study in {{ $pageContent->heading }}</h3>
              </div>
              {!! $pageContent->description !!}
            </div>
            <div class="show-more">Show More...</div>
          </div>
        </div>
      </div>
    </section>
  @endif

  <section class="pop-cour">
    <div class="container com-sp">
      @foreach ($categories as $row)
        <div class="home-top-cour">
          <div class="row">
            <div class="col-12 col-sm-12 col-md-3 text-center mb-3">
              <img data-src="{{ asset($row->thumbnail_path) }}" alt="{{ $row->name }}"
                class="img-responsive initial loaded">
            </div>
            <div class="col-12 col-sm-12 col-md-9 mb-3 ">
              <div class="home-top-cour-desc">
                <a href="{{ route('category.detail', ['slug' => $row->slug]) }}">
                  <h3>{{ $row->name }}</h3>
                </a>
                <p>{{ $row->shortnote }}</p>
                <div class="event-head-sub">
                  <ul>
                    @foreach ($row->specializations as $spc)
                      <li>
                        <a href="javascript:void()"
                          onclick="goToCourses('{{ $level }}','{{ $row->id }}','{{ $spc->slug }}')"><?php echo $spc->name; ?></a>
                      </li>
                    @endforeach
                  </ul>
                </div>
              </div>

            </div>
          </div>
        </div>
      @endforeach
    </div>
  </section>
  <script>
    $(document).ready(function() {
      // Wrap the table in a div with class 'table-responsive'
      $('table').before('<div class="table-responsive"></div>');

      // Move the table inside the newly created div
      $('table').prev('.table-responsive').append($('table'));
    });

    function goToCourses(CFilterLevel, CFilterCategory, CFilterSpecialization) {
      //alert(CFilterLevel + ' , ' + CFilterSpecialization);
      $.ajax({
        url: "{{ route('cl.apply.custom.filter') }}",
        method: "GET",
        data: {
          CFilterLevel: CFilterLevel,
          CFilterCategory: CFilterCategory,
          CFilterSpecialization: CFilterSpecialization
        },
        success: function(data) {
          window.open("{{ url('/') }}/" + CFilterSpecialization + "-courses", '_blank');
        }
      });
    }
  </script>
@endsection
