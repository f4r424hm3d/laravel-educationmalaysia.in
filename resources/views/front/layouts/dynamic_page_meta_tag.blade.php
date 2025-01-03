<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="robots" content="index, follow" />
<title>{{ ucwords($meta_title) }}</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="description" content="<?php echo $meta_description; ?>">
<meta name="keywords" content="<?php echo $meta_keyword; ?>">
<link rel="canonical" href="<?php echo $page_url; ?>" />

<link rel="shortcut icon" href="{{ asset('/front/') }}/assets/img/favicon.png" type="image/x-icon">
<link rel="apple-touch-icon" href="{{ asset('/front/') }}/assets/img/favicon.png" />

<!-- FB Meta Tag Starts-->
<meta property="og:title" content="<?php echo $meta_title; ?>" />
<meta property="og:description" content="<?php echo $meta_description; ?>" />
<meta property="og:url" content="{{ url()->current() }}" />
@if ($og_image_path != null)
  <meta property="og:image" content="<?php echo asset($og_image_path); ?>" />
@endif
<meta property="og:site_name" content="Education Malaysia" />
<!-- FB MEta Tag Ends -->
<!-- twitter tag -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@educatemalaysia">
<meta name="twitter:title" content="<?php echo $meta_title; ?>" />
<meta name="twitter:description" content="<?php echo $meta_description; ?>" />
@if ($og_image_path != null)
  <meta name="twitter:image" content="<?php echo asset($og_image_path); ?>" />
@endif

<!-- twitter tag -->

<script type="application/ld+json">
  {
      "@context": "https://schema.org",
      "@type": "WebPage",
      "inLanguage": "en-US",
      "name": "<?php echo $meta_title; ?>",
      "description": "<?php echo $meta_description; ?>",
      "url": "{{ url()->current() }}",
      "publisher": {
          "@type": "Organization",
          "name": "Education Malaysia",
          "logo": {
              "@type": "ImageObject",
              "url": "https://www.educationmalaysia.in/assets/web/images/education-malaysia-new-logo.png",
              "width": "230",
              "height": "55"
          }
      }
  }
</script>
<script type="application/ld+json">
  {
      "@context": "http://schema.org",
      "@type": "Organization",
      "name": "EducationMalaysia",
      "url": "https://www.educationmalaysia.in/",
      "logo": "https://www.educationmalaysia.in/assets/web/images/education-malaysia-new-logo.png",
      "image": "https://www.educationmalaysia.in/assets/web/images/education-malaysia-new-logo.png",
      "sameAs": ["https://www.facebook.com/educationmalaysia.in", "https://www.pinterest.com/educationmalaysiain/",
          "https://twitter.com/educatemalaysia/", "https://www.instagram.com/educationmalaysia.in/", "https://www.quora.com/profile/Education-Malaysia-3", "https://www.linkedin.com/company/educationmalaysia/", "https://www.youtube.com/channel/UCK7S9yvQnx08CgcDMMfYAyg"
      ],
      "contactPoint": [{
          "@type": "ContactPoint",
          "telephone": "+91 9818560331",
          "contactType": "customer support"
      }]
  }
</script>
