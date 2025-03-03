@php
  echo $utf;
@endphp
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">
  <url>
    <loc>{{ route('blog') }}</loc>
    <lastmod><?php echo date('Y-m-d'); ?></lastmod>
    <changefreq>always</changefreq>
    <priority>1</priority>
  </url>
  @foreach ($categories as $row)
    <url>
      <loc>{{ url('blog/' . $row->slug) }}</loc>
      <priority>0.8</priority>
      <changefreq>always</changefreq>
      <lastmod><?php echo date('Y-m-d', strtotime($row->updated_at)); ?></lastmod>
    </url>
    @foreach ($row->blogs as $b)
      <url>
        <loc>{{ url('blog/' . $row->slug . '/' . $b->slug . '-' . $b->id) }}</loc>
        <priority>0.5</priority>
        <changefreq>always</changefreq>
        <lastmod><?php echo date('Y-m-d', strtotime($b->updated_at)); ?></lastmod>
      </url>
    @endforeach
  @endforeach

</urlset>
