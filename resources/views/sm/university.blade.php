@php
  echo $utf;
@endphp
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  @foreach ($universities as $university)
    <url>
      <loc>{{ url($university->slug) }}</loc>
      <lastmod>{{ $university->updated_at->format('Y-m-d') }}</lastmod>
      <changefreq>always</changefreq>
      <priority>0.8</priority>
    </url>
    @if ($university->getPrograms->count() > 0)
      <url>
        <loc>{{ url($university->slug . '/courses') }}</loc>
        <lastmod>{{ $university->updated_at->format('Y-m-d') }}</lastmod>
        <changefreq>always</changefreq>
        <priority>0.5</priority>
      </url>
    @endif
  @endforeach
</urlset>
