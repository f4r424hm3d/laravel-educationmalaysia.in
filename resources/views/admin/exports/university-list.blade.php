<table>
  <thead>
    <tr>
      <th>id</th>
      <th>name</th>
      <th>destination_id</th>
      <th>parent_university_id</th>
      <th>address</th>
      <th>city</th>
      <th>state</th>
      <th>country</th>
      <th>institute_type_id</th>
      <th>founded</th>
      <th>university_rank</th>
      <th>qs_rank</th>
      <th>us_world_rank</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($rows as $row)
      <tr>
        <td>{{ $row->id }}</td>
        <td>{{ $row->name }}</td>
        <td>{{ $row->destination_id }}</td>
        <td>{{ $row->parent_university_id }}</td>
        <td>{{ $row->address }}</td>
        <td>{{ $row->city }}</td>
        <td>{{ $row->state }}</td>
        <td>{{ $row->country }}</td>
        <td>{{ $row->institute_type_id }}</td>
        <td>{{ $row->founded }}</td>
        <td>{{ $row->university_rank }}</td>
        <td>{{ $row->qs_rank }}</td>
        <td>{{ $row->us_world_rank }}</td>
      </tr>
    @endforeach
  </tbody>
</table>
