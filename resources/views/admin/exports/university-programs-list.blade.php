<table>
  <thead>
    <tr>
      <th>id</th>
      <th>program_name</th>
      <th>course_category_id</th>
      <th>specialization_id</th>
      <th>level_id</th>
      <th>duration</th>
      <th>study_mode</th>
      <th>course_mode</th>
      <th>exam_accepted</th>
      <th>intake</th>
      <th>tution_fees</th>
      <th>overview</th>
      <th>entry_requirement</th>
      <th>ielts</th>
      <th>toefl</th>
      <th>pte</th>
      <th>duolingo</th>
      <th>gre</th>
      <th>gmat</th>
      <th>sat</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($rows as $row)
      @php
        $study_mode = json_to_string($row->study_mode);
        $course_mode = json_to_string($row->course_mode);
        $exam_accepted = json_to_string($row->exam_accepted);
        $intake = json_to_string($row->intake);
      @endphp
      <tr>
        <td>{{ $row->id }}</td>
        <td>{{ $row->program_name }}</td>
        <td>{{ $row->course_category_id }}</td>
        <td>{{ $row->specialization_id }}</td>
        <td>{{ $row->level_id }}</td>
        <td>{{ $row->duration }}</td>
        <td>{{ $study_mode }}</td>
        <td>{{ $course_mode }}</td>
        <td>{{ $exam_accepted }}</td>
        <td>{{ $intake }}</td>
        <td>{{ $row->tution_fees }}</td>
        <td>{{ $row->overview }}</td>
        <td>{{ $row->entry_requirement }}</td>
        <td>{{ $row->ielts }}</td>
        <td>{{ $row->toefl }}</td>
        <td>{{ $row->pte }}</td>
        <td>{{ $row->duolingo }}</td>
        <td>{{ $row->gre }}</td>
        <td>{{ $row->gmat }}</td>
        <td>{{ $row->sat }}</td>
      </tr>
    @endforeach
  </tbody>
</table>
