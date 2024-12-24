@php
  echo $utf;
@endphp
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url>
    <loc>{{ url('courses-in-malaysia') }}</loc>
    <lastmod>{{ date('Y-m-d') }}</lastmod>
    <changefreq>always</changefreq>
    <priority>0.8</priority>
  </url>
  @foreach ($levels as $row)
    <url>
      <loc>{{ url(slugify($row->level) . '-courses') }}</loc>
      <lastmod>{{ $row->updated_at->format('Y-m-d') }}</lastmod>
      <changefreq>always</changefreq>
      <priority>0.8</priority>
    </url>
  @endforeach
  @foreach ($categories as $row)
    <url>
      <loc>{{ url($row->slug . '-courses') }}</loc>
      <lastmod>{{ $row->updated_at->format('Y-m-d') }}</lastmod>
      <changefreq>always</changefreq>
      <priority>0.8</priority>
    </url>
  @endforeach
  @foreach ($specializations as $row)
    <url>
      <loc>{{ url($row->slug . '-courses') }}</loc>
      <lastmod>{{ $row->updated_at->format('Y-m-d') }}</lastmod>
      <changefreq>always</changefreq>
      <priority>0.8</priority>
    </url>
  @endforeach
</urlset>
