<table>
  <thead>
  <tr>
      <th>Category Id</th>
      <th>Category Name</th>
      <th>Specialization Id</th>
      <th>Specialization Name</th>
  </tr>
  </thead>
  <tbody>
  @foreach($rows as $row)
      <tr>
          <td>{{ $row->course_category_id }}</td>
          <td>{{ $row->getCategory->category_name }}</td>
          <td>{{ $row->id }}</td>
          <td>{{ $row->specialization_name }}</td>
      </tr>
  @endforeach
  </tbody>
</table>
