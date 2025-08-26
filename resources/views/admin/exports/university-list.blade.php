<table>
  <thead>
    <tr>
      <th>id</th>
      <th>name</th>
      <th>views</th>
      <th>city</th>
      <th>state</th>
      <th>institute_type</th>
      <th>rating</th>
      <th>rank</th>
      <th>qs_rank</th>
      <th>times_rank</th>
      <th>latitude_longitude</th>
      <th>featured</th>
      <th>shortnote</th>
      <th>established_year</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($rows as $row)
      <tr>
        <td>{{ $row->id }}</td>
        <td>{{ $row->name }}</td>
        <td>{{ $row->views }}</td>
        <td>{{ $row->city }}</td>
        <td>{{ $row->state }}</td>
        <td>{{ $row->institute_type }}</td>
        <td>{{ $row->rating }}</td>
        <td>{{ $row->rank }}</td>
        <td>{{ $row->qs_rank }}</td>
        <td>{{ $row->times_rank }}</td>
        <td>{{ $row->latitude_longitude }}</td>
        <td>{{ $row->featured }}</td>
        <td>{{ $row->shortnote }}</td>
        <td>{{ $row->established_year }}</td>
      </tr>
    @endforeach
  </tbody>
</table>
