@php
  echo $utf;
@endphp
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url>
    <loc>{{ route('exams') }}</loc>
    <lastmod>{{ date('Y-m-d') }}</lastmod>
    <changefreq>always</changefreq>
    <priority>0.8</priority>
  </url>
  @foreach ($rows as $row)
    <url>
      <loc>{{ route('exam.detail', ['uri' => $row->uri]) }}</loc>
      <lastmod>{{ $row->updated_at->format('Y-m-d') }}</lastmod>
      <changefreq>always</changefreq>
      <priority>0.5</priority>
    </url>
  @endforeach
</urlset>
