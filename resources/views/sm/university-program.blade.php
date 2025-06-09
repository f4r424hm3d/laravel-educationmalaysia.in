@php
  echo $utf;
@endphp
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  @foreach ($rows as $row)
    <url>
      <loc>{{ url('university/' . $row->university->uname . '/courses/' . $row->slug) }}</loc>
      <lastmod>{{ $row->updated_at->format('Y-m-d') }}</lastmod>
      <changefreq>always</changefreq>
      <priority>0.5</priority>
    </url>
  @endforeach
</urlset>
