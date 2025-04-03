@php
  echo $utf;
@endphp
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  @foreach ($universities as $row)
    <url>
      <loc>{{ url('university/' . $row->uname) }}</loc>
      <lastmod>{{ $row->updated_at->format('Y-m-d') }}</lastmod>
      <changefreq>always</changefreq>
      <priority>0.8</priority>
    </url>
    @if ($row->photos->count() > 0)
      <url>
        <loc>{{ url('university/' . $row->uname . '/gallery') }}</loc>
        <lastmod>{{ $row->updated_at->format('Y-m-d') }}</lastmod>
        <changefreq>always</changefreq>
        <priority>0.5</priority>
      </url>
    @endif
    @if ($row->videos->count() > 0)
      <url>
        <loc>{{ url('university/' . $row->uname . '/video') }}</loc>
        <lastmod>{{ $row->updated_at->format('Y-m-d') }}</lastmod>
        <changefreq>always</changefreq>
        <priority>0.5</priority>
      </url>
    @endif
    @if ($row->reviews->count() > 0)
      <url>
        <loc>{{ url('university/' . $row->uname . '/reviews') }}</loc>
        <lastmod>{{ $row->updated_at->format('Y-m-d') }}</lastmod>
        <changefreq>always</changefreq>
        <priority>0.5</priority>
      </url>
    @endif
    @if ($row->programs->count() > 0)
      <url>
        <loc>{{ url('university/' . $row->uname . '/courses') }}</loc>
        <lastmod>{{ $row->updated_at->format('Y-m-d') }}</lastmod>
        <changefreq>always</changefreq>
        <priority>0.5</priority>
      </url>
    @endif
  @endforeach
</urlset>
