<div class="card mb-2">
  <div id="headingLevel" class="card-header bg-white shadow-sm border-0 pt-2 pb-2 pl-4 pr-4">
    <h6 class="mb-0 accordion_title size-xs">
      <a rel="nofollow" href="#" data-toggle="collapse" data-target="#collapseLevel" aria-expanded="true"
        aria-controls="collapseLevel" class="d-block position-relative text-dark collapsible-link py-2"
        role="region">Study Level</a>
    </h6>
  </div>
  <div id="collapseLevel" aria-labelledby="headingLevel" data-parent="#accordionExample" class="collapse show"
    role="region">
    <div class="scrlbar">
      <div class="card-body pl-4 pr-4 pb-2">
        <ul class="no-ul-list mb-3">
          @foreach ($levelListForFilter as $level)
            <li>
              <input id="level{{ $level->getLevel->id }}" class="checkbox-custom" name="filter_level" type="checkbox"
                onclick="{{ session()->get('FilterLevel') == $level->getLevel->id
                    ? "removeFilter('FilterLevel')"
                    : "ApplyFilter('" . $level->getLevel->slug . "')" }}"
                {{ session()->get('FilterLevel') == $level->getLevel->id ? 'checked' : '' }}>
              <label for="level{{ $level->getLevel->id }}" class="checkbox-custom-label">
                {{ $level->getLevel->level }}
              </label>
            </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="card mb-2">
  <div id="headingCat" class="card-header bg-white shadow-sm border-0 pt-2 pb-2 pl-4 pr-4">
    <h6 class="mb-0 accordion_title size-xs">
      <a rel="nofollow" href="#" data-toggle="collapse" data-target="#collapseCat" aria-expanded="true"
        aria-controls="collapseCat" class="d-block position-relative text-dark collapsible-link py-2"
        role="region">Course
        Category</a>
    </h6>
  </div>
  <div id="collapseCat" aria-labelledby="headingCat" data-parent="#accordionExample" class="collapse show"
    role="region">
    <div class="scrlbar">
      <div class="card-body pl-4 pr-4 pb-2">
        <ul class="no-ul-list mb-3">
          @foreach ($categoryListForFilter as $cat)
            <li>
              <input id="cat{{ $cat->getCategory->id }}" class="checkbox-custom" name="filter_category" type="checkbox"
                onclick="{{ session()->get('FilterCategory') == $cat->getCategory->id
                    ? "removeFilter('FilterCategory')"
                    : "ApplyFilter('" . $cat->getCategory->category_slug . "')" }}"
                {{ session()->get('FilterCategory') == $cat->getCategory->id ? 'checked' : '' }}>
              <label for="cat{{ $cat->getCategory->id }}" class="checkbox-custom-label">
                {{ $cat->getCategory->category_name }}
              </label>
            </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="card mb-2">
  <div id="headingSpc" class="card-header bg-white shadow-sm border-0 pt-2 pb-2 pl-4 pr-4">
    <h6 class="mb-0 accordion_title size-xs">
      <a rel="nofollow" href="#" data-toggle="collapse" data-target="#collapseSpc" aria-expanded="true"
        aria-controls="collapseSpc" class="d-block position-relative text-dark collapsible-link py-2"
        role="region">Stream</a>
    </h6>
  </div>
  <div id="collapseSpc" aria-labelledby="headingSpc" data-parent="#accordionExample" class="collapse show"
    role="region">
    <div class="scrlbar">
      <div class="card-body pl-4 pr-4 pb-2">
        <ul class="no-ul-list mb-3">
          @foreach ($spcListForFilter as $spc)
            <li>
              <input id="spc{{ $spc->getSpecialization->id }}" class="checkbox-custom" name="filter_specialization"
                type="checkbox"
                onclick="{{ session()->get('FilterSpecialization') == $spc->getSpecialization->id
                    ? "removeFilter('FilterSpecialization')"
                    : "ApplyFilter('" . $spc->getSpecialization->specialization_slug . "')" }}"
                {{ session()->get('FilterSpecialization') == $spc->getSpecialization->id ? 'checked' : '' }}>
              <label for="spc{{ $spc->getSpecialization->id }}" class="checkbox-custom-label">
                {{ $spc->getSpecialization->specialization_name }}
              </label>
            </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="card mb-2">
  <div id="headingStudyModes" class="card-header bg-white shadow-sm border-0 pt-2 pb-2 pl-4 pr-4">
    <h6 class="mb-0 accordion_title size-xs">
      <a rel="nofollow" href="#" data-toggle="collapse" data-target="#collapseStudyModes" aria-expanded="true"
        aria-controls="collapseStudyModes" class="d-block position-relative text-dark collapsible-link py-2"
        role="region">
        Study Mode
      </a>
    </h6>
  </div>
  <div id="collapseStudyModes" aria-labelledby="headingStudyModes" data-parent="#accordionExample" class="collapse show"
    role="region">
    <div class="scrlbar">
      <div class="card-body pl-4 pr-4 pb-2">
        <ul class="no-ul-list mb-3">
          @foreach ($studyModes as $sm)
            <li>
              <input id="sm{{ $sm->study_mode }}" class="checkbox-custom" name="filter_study_mode" type="checkbox"
                onclick="{{ isset($_GET['study_mode']) && $_GET['study_mode'] == $sm->study_mode
                    ? "removeStaticFilter('study_mode')"
                    : "ApplyStaticFilter('study_mode','" . $sm->study_mode . "')" }}"
                {{ isset($_GET['study_mode']) && $_GET['study_mode'] == $sm->study_mode ? 'checked' : '' }}>
              <label for="sm{{ $sm->study_mode }}" class="checkbox-custom-label">
                {{ $sm->study_mode }}
              </label>
            </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="card mb-2">
  <div id="headingIntake" class="card-header bg-white shadow-sm border-0 pt-2 pb-2 pl-4 pr-4">
    <h6 class="mb-0 accordion_title size-xs">
      <a rel="nofollow" href="#" data-toggle="collapse" data-target="#collapseIntake" aria-expanded="true"
        aria-controls="collapseIntake" class="d-block position-relative text-dark collapsible-link py-2"
        role="region">
        Intake
      </a>
    </h6>
  </div>
  <div id="collapseIntake" aria-labelledby="headingIntake" data-parent="#accordionExample" class="collapse show"
    role="region">
    <div class="scrlbar">
      <div class="card-body pl-4 pr-4 pb-2">
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
                {{ $intake->month_short_name }}
              </label>
            </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>

<div class="card mb-2">
  <div id="headingOne" class="card-header bg-white shadow-sm border-0 pt-2 pb-2 pl-4 pr-4">
    <h6 class="mb-0 accordion_title size-xs"><a rel="nofollow" href="#" data-toggle="collapse"
        data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"
        class="d-block position-relative text-dark collapsible-link py-2" role="region">Institute Type</a></h6>
  </div>
  <div id="collapseOne" aria-labelledby="headingOne" data-parent="#accordionExample" class="collapse show"
    role="region">
    <div class="scrlbar">
      <div class="card-body pl-4 pr-4 pb-2">
        <ul class="no-ul-list mb-3">
          @foreach ($instTYpe as $inst)
            <li>
              <input id="inst{{ $inst->getInstType->id }}" class="checkbox-custom" name="institute_type"
                type="checkbox"
                onclick="{{ session()->get('FilterInstituteType') == $inst->getInstType->id ? "removeFilter('FilterInstituteType')" : "ApplyFilter('" . $inst->getInstType->seo_title_slug . "')" }}"
                {{ session()->get('FilterInstituteType') == $inst->getInstType->id ? 'checked' : '' }}>
              <label for="inst{{ $inst->getInstType->id }}"
                class="checkbox-custom-label">{{ $inst->getInstType->type }}</label>
            </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="card mb-2">
  <div id="headingTwo" class="card-header bg-white shadow-sm border-0 pt-2 pb-2 pl-4 pr-4">
    <h6 class="mb-0 accordion_title size-xs"><a rel="nofollow" href="#" data-toggle="collapse"
        data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo"
        class="d-block position-relative text-dark collapsible-link py-2" role="region">State</a></h6>
  </div>
  <div id="collapseTwo" aria-labelledby="headingTwo" data-parent="#accordionExample" class="collapse show"
    role="region">
    <div class="scrlbar">
      <div class="card-body pl-4 pr-4 pb-2">
        <ul class="no-ul-list mb-3">
          @foreach ($states as $row)
            <li>
              <input id="state{{ $row->state_slug }}" class="checkbox-custom" name="state_filter" type="checkbox"
                onclick="{{ session()->get('FilterState') == $row->state_slug
                    ? "removeFilter('FilterState')"
                    : "ApplyFilter('" . $row->state_slug . "')" }}"
                onclick="ApplyStateFilter('{{ $row->state_slug }}')"
                {{ session()->get('FilterState') == $row->state_slug ? 'checked' : '' }}>
              <label for="state{{ $row->state_slug }}" class="checkbox-custom-label">{{ $row->state }}</label>
            </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="card mb-2">
  <div id="headingThree" class="card-header bg-white shadow-sm border-0 pt-2 pb-2 pl-4 pr-4">
    <h6 class="mb-0 accordion_title size-xs"><a rel="nofollow" href="#" data-toggle="collapse"
        data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree"
        class="d-block position-relative text-dark collapsible-link py-2" role="region">City</a></h6>
  </div>
  <div id="collapseThree" aria-labelledby="headingThree" data-parent="#accordionExample" class="collapse show"
    role="region">
    <div class="scrlbar">
      <div class="card-body pl-4 pr-4 pb-2">
        <ul class="no-ul-list mb-3">
          @foreach ($cities as $row)
            <li>
              <input id="city{{ $row->city_slug }}" class="checkbox-custom" name="city_filter" type="checkbox"
                onclick="{{ session()->get('FilterCity') == $row->city_slug
                    ? "removeFilter('FilterCity')"
                    : "ApplyFilter('" . $row->city_slug . "')" }}"
                onclick="ApplyStateFilter('{{ $row->city_slug }}')"
                {{ session()->get('FilterCity') == $row->city_slug ? 'checked' : '' }}>
              <label for="city{{ $row->city_slug }}" class="checkbox-custom-label">{{ $row->city }}</label>
            </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>
