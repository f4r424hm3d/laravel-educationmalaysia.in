@php
  echo $utf;
@endphp

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">
  <url>
    <loc>{{ url('/solutions') }}</loc>
    <lastmod><?php echo date('Y-m-d'); ?></lastmod>
    <changefreq>always</changefreq>
    <priority>1</priority>
  </url>
  <?php foreach ($categories as $row) { ?>
  <url>
    <loc>{{ url($row->category_slug) }}</loc>
    <priority>0.80</priority>
    <changefreq>always</changefreq>
    <lastmod><?php echo date('Y-m-d', strtotime($row->updated_at)); ?></lastmod>
  </url>
  @foreach ($row->subCategories as $sc)
    <url>
      <loc>{{ url($row->category_slug . '/' . $sc->sub_category_slug) }}</loc>
      <priority>0.80</priority>
      <changefreq>always</changefreq>
      <lastmod><?php echo date('Y-m-d', strtotime($sc->updated_at)); ?></lastmod>
    </url>
    @foreach ($sc->products as $p)
      <url>
        <loc>{{ url($row->category_slug . '/' . $sc->sub_category_slug . '/' . $p->product_slug) }}</loc>
        <priority>0.80</priority>
        <changefreq>always</changefreq>
        <lastmod><?php echo date('Y-m-d', strtotime($p->updated_at)); ?></lastmod>
      </url>
    @endforeach
  @endforeach
  <?php } ?>

</urlset>
