@php
  echo $utf;
@endphp
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  @foreach ($jobs as $job)
    <url>
      <loc>{{ url($job->page_slug) }}</loc>
      <lastmod>{{ $job->updated_at->format('Y-m-d') }}</lastmod>
      <changefreq>always</changefreq>
      <priority>0.8</priority>
    </url>
  @endforeach
</urlset>
