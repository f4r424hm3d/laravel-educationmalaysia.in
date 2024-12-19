<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  @foreach ($destinationsUniversities as $row)
    <url>
      <loc>{{ url($row->getDestination->destination_slug . '/universities/') }}</loc>
      <lastmod>{{ $row->getDestination->updated_at->format('Y-m-d') }}</lastmod>
      <changefreq>always</changefreq>
      <priority>0.8</priority>
    </url>
    <url>
      <loc>
        {{ url($row->getDestination->destination_slug . '/' . $row->getDestination->destination_slug . '-universities/') }}
      </loc>
      <lastmod>{{ $row->getDestination->updated_at->format('Y-m-d') }}</lastmod>
      <changefreq>always</changefreq>
      <priority>0.8</priority>
    </url>
  @endforeach
</urlset>
