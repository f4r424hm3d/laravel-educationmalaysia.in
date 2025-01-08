<table>
  <thead>
    <tr>
      <th>id</th>
      <th>course_name</th>
      <th>course_category_id</th>
      <th>specialization_id</th>
      <th>level</th>
      <th>duration</th>
      <th>study_mode</th>
      <th>intake</th>
      <th>application_deadline</th>
      <th>tution_fee</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($rows as $row)
      <tr>
        <td>{{ $row->id }}</td>
        <td>{{ $row->course_name }}</td>
        <td>{{ $row->course_category_id }}</td>
        <td>{{ $row->specialization_id }}</td>
        <td>{{ $row->level }}</td>
        <td>{{ $row->duration }}</td>
        <td>{{ $row->study_mode }}</td>
        <td>{{ $row->intake }}</td>
        <td>{{ $row->application_deadline }}</td>
        <td>{{ $row->tution_fee }}</td>
      </tr>
    @endforeach
  </tbody>
</table>
