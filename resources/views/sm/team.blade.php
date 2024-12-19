@php
  echo $utf;
@endphp
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  @foreach ($teams as $team)
    <url>
      <loc>{{ url('team/' . $team->slug) }}</loc>
      <lastmod>{{ $team->updated_at->format('Y-m-d') }}</lastmod>
      <changefreq>always</changefreq>
      <priority>0.8</priority>
    </url>
  @endforeach
</urlset>
