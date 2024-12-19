@php
  echo $utf;
@endphp
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  @foreach ($services as $service)
    <url>
      <loc>{{ url($service->slug) }}</loc>
      <lastmod>{{ $service->updated_at->format('Y-m-d') }}</lastmod>
      <changefreq>always</changefreq>
      <priority>0.8</priority>
    </url>
  @endforeach
</urlset>
