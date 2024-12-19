@php
  echo $utf;
@endphp
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  @foreach ($scholarships as $scholarship)
    <url>
      <loc>{{ url($scholarship->university->slug . '/scholarship/' . $scholarship->slug) }}</loc>
      <lastmod>{{ $scholarship->updated_at->format('Y-m-d') }}</lastmod>
      <changefreq>always</changefreq>
      <priority>0.8</priority>
    </url>
  @endforeach
</urlset>
