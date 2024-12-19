<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="robots" content="index, follow" />
<title><?php echo ucwords($meta_title); ?></title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="description" content="<?php echo $meta_description; ?>">
<meta name="keywords" content="<?php echo $meta_keyword; ?>">
<link rel="canonical" href="<?php echo $page_url; ?>" />
<meta property="og:title" content="<?php echo $meta_title; ?>" />
<meta property="og:description" content="<?php echo $meta_description; ?>" />
<link rel="shortcut icon" href="{{ asset('/front/') }}/assets/img/favicon.png" type="image/x-icon">
<link rel="apple-touch-icon" href="{{ asset('/front/') }}/assets/img/favicon.png" />
<meta property="og:site_name" content="Education Malaysia Education" />
<meta property="og:url" content="<?php echo $page_url; ?>/" />
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="Education Malaysia Education" />
<meta name="twitter:creator" content="@BritannicaOEdu" />
<meta name="twitter:url" content="<?php echo $page_url; ?>/" />
<meta name="twitter:title" content="<?php echo $meta_title; ?>" />
<meta name="twitter:description" content="<?php echo $meta_description; ?>" />
@if ($og_image_path != null)
  <meta name="twitter:image" content="<?php echo asset($og_image_path); ?>" />
@endif
<meta property="twitter:image:type" content="image/jpg" />
@if ($og_image_path != null)
  <meta property="og:image" content="<?php echo asset($og_image_path); ?>" />
@endif
