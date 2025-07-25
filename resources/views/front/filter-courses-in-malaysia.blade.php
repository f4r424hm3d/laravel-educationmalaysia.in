<div class="all-cardbx">
  <h3 class="filter-title">Filter by <span><a href="javascript:void(0)" onclick="removeAllFilter()" class="clearAll"
        rel="nofollow">Clear
        All</a></span> </h3>
  <div class="card mb-2 p-2 ">
    <div id="headingLevel" class="card-header secondarybxa shadow-sm border-0 ">
      <h6 class="mb-0 accordion_title size-xs">
        <a rel="nofollow" href="#" data-toggle="collapse" data-target="#collapseLevel" aria-expanded="true"
          aria-controls="collapseLevel" class="d-block position-relative text-dark collapsible-link "
          role="region">Study Level By Name</a>
      </h6>
    </div>
    <div id="collapseLevel" aria-labelledby="headingLevel" data-parent="#accordionExample" class="collapse show"
      role="region">
      <div class="scrlbar mt-2 mr-0 ">
        <div class="card-body p-0">
          <ul class="no-ul-list mb-3">
            @foreach ($levelListForFilter as $level)
              <li>
                <input id="level{{ $level->level }}" class="checkbox-custom" name="filter_level" type="checkbox"
                  onclick="{{ session()->get('CFilterLevel') == $level->level
                      ? "removeFilter('CFilterLevel')"
                      : "ApplyFilter('" . slugify($level->level) . "')" }}"
                  {{ session()->get('CFilterLevel') == $level->level ? 'checked' : '' }}>
                <label for="level{{ $level->level }}" class="checkbox-custom-label">
                <div class="check-texts"> {{ $level->level }}</div> 
                </label>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="card mb-2 p-2 ">
    <div id="headingCat" class="card-header secondarybxa shadow-sm border-0 ">
      <h6 class="mb-0 accordion_title size-xs">
        <a rel="nofollow" href="#" data-toggle="collapse" data-target="#collapseCat" aria-expanded="true"
          aria-controls="collapseCat" class="d-block position-relative text-dark collapsible-link "
          role="region">Select Course By Name</a>
      </h6>
    </div>
    <div id="collapseCat" aria-labelledby="headingCat" data-parent="#accordionExample" class="collapse show"
      role="region">
      <div class="scrlbar mt-2 mr-0 ">
        <div class="card-body p-0">
          <ul class="no-ul-list mb-3">
            @foreach ($categoryListForFilter as $cat)
              <li>
                <input id="cat{{ $cat->id }}" class="checkbox-custom" name="filter_category" type="checkbox"
                  onclick="{{ session()->get('CFilterCategory') == $cat->id
                      ? "removeFilter('CFilterCategory')"
                      : "ApplyFilter('" . $cat->slug . "')" }}"
                  {{ session()->get('CFilterCategory') == $cat->id ? 'checked' : '' }}>
                <label for="cat{{ $cat->id }}" class="checkbox-custom-label">
                  <div class="check-texts">{{ $cat->name }}</div>
                </label>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="card mb-2 p-2 ">
    <div id="headingSpc" class="card-header secondarybxa shadow-sm border-0 ">
      <h6 class="mb-0 accordion_title size-xs">
        <a rel="nofollow" href="#" data-toggle="collapse" data-target="#collapseSpc" aria-expanded="true"
          aria-controls="collapseSpc" class="d-block position-relative text-dark collapsible-link "
          role="region">Select Stream By Name</a>
      </h6>
    </div>
    <div id="collapseSpc" aria-labelledby="headingSpc" data-parent="#accordionExample" class="collapse show"
      role="region">
      <div class="scrlbar mt-2 mr-0 ">
        <div class="card-body p-0">
          <ul class="no-ul-list mb-3">
            @foreach ($spcListForFilter as $spc)
              <li>
                <input id="spc{{ $spc->id }}" class="checkbox-custom" name="filter_specialization" type="checkbox"
                  onclick="{{ session()->get('FilterSpecialization') == $spc->id
                      ? "removeFilter('FilterSpecialization')"
                      : "ApplyFilter('" . $spc->slug . "')" }}"
                  {{ session()->get('FilterSpecialization') == $spc->id ? 'checked' : '' }}>
                <label for="spc{{ $spc->id }}" class="checkbox-custom-label">
                <div class="check-texts"> {{ $spc->name }}</div> 
                </label>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="card mb-2 p-2 ">
    <div id="headingIntake" class="card-header secondarybxa shadow-sm border-0 ">
      <h6 class="mb-0 accordion_title size-xs">
        <a rel="nofollow" href="#" data-toggle="collapse" data-target="#collapseIntake" aria-expanded="true"
          aria-controls="collapseIntake" class="d-block position-relative text-dark collapsible-link " role="region">
          Select Intake By Month
        </a>
      </h6>
    </div>
    <div id="collapseIntake" aria-labelledby="headingIntake" data-parent="#accordionExample" class="collapse show"
      role="region">
      <div class="scrlbar mt-2 mr-0 ">
        <div class="card-body p-0">
          <ul class="no-ul-list mb-3">
            @foreach ($intakes as $intake)
              <li>
                <input id="intake{{ $intake->month_short_name }}" class="checkbox-custom" name="filter_study_mode"
                  type="checkbox"
                  onclick="{{ isset($_GET['intake']) && $_GET['intake'] == $intake->month_short_name
                      ? "removeStaticFilter('intake')"
                      : "ApplyStaticFilter('intake','" . $intake->month_short_name . "')" }}"
                  {{ isset($_GET['intake']) && $_GET['intake'] == $intake->month_short_name ? 'checked' : '' }}>
                <label for="intake{{ $intake->month_short_name }}" class="checkbox-custom-label">
                 <div class="check-texts">{{ $intake->month_short_name }}</div> 
                </label>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="card mb-2 p-2 ">
    <div id="headingStudyModes" class="card-header secondarybxa shadow-sm border-0 ">
      <h6 class="mb-0 accordion_title size-xs">
        <a rel="nofollow" href="#" data-toggle="collapse" data-target="#collapseStudyModes"
          aria-expanded="true" aria-controls="collapseStudyModes"
          class="d-block position-relative text-dark collapsible-link " role="region">
          Course Delivery Mode
        </a>
      </h6>
    </div>
    <div id="collapseStudyModes" aria-labelledby="headingStudyModes" data-parent="#accordionExample"
      class="collapse show" role="region">
      <div class="scrlbar mt-2 mr-0 ">
        <div class="card-body p-0">
          <ul class="no-ul-list mb-3">
            @foreach ($studyModes as $sm)
              <li>
                <input id="sm{{ $sm->study_mode }}" class="checkbox-custom" name="filter_study_mode"
                  type="checkbox"
                  onclick="{{ isset($_GET['study_mode']) && $_GET['study_mode'] == $sm->study_mode
                      ? "removeStaticFilter('study_mode')"
                      : "ApplyStaticFilter('study_mode','" . $sm->study_mode . "')" }}"
                  {{ isset($_GET['study_mode']) && $_GET['study_mode'] == $sm->study_mode ? 'checked' : '' }}>
                <label for="sm{{ $sm->study_mode }}" class="checkbox-custom-label">
                 <div class="check-texts">{{ $sm->study_mode }}</div> 
                </label>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
