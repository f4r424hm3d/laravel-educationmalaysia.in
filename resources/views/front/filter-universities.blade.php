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
          @foreach ($instituteTypes as $row)
            @php
              $onClickFunction =
                  session()->get('FilterInstituteType') == $row->instituteType->seo_title_slug
                      ? "removeFilter('FilterInstituteType')"
                      : "applyFilter('FilterInstituteType','" . $row->instituteType->seo_title_slug . "')";
              $checked = session()->get('FilterInstituteType') == $row->instituteType->seo_title_slug ? 'checked' : '';
            @endphp
            <li>
              <input id="inst{{ $row->instituteType->id }}" class="checkbox-custom" name="institute_type"
                type="checkbox" onclick="{{ $onClickFunction }}" {{ $checked }}>
              <label for="inst{{ $row->instituteType->id }}" class="checkbox-custom-label">
                {{ $row->instituteType->type }}</label>
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
            @php
              $onClickFunctionState =
                  session()->get('FilterState') == $row->state
                      ? "removeFilter('FilterState')"
                      : "applyFilter('FilterState','" . $row->state . "')";
              $checkedState = session()->get('FilterState') == $row->state ? 'checked' : '';
            @endphp
            <li>
              <input id="state{{ slugify($row->state) }}" class="checkbox-custom" name="state_filter" type="checkbox"
                onclick="{{ $onClickFunctionState }}" {{ $checkedState }}>
              <label for="state{{ slugify($row->state) }}" class="checkbox-custom-label">{{ $row->state }}</label>
            </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>
