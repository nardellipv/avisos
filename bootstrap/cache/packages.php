<?php return array (
  'artesaos/seotools' => 
  array (
    'aliases' => 
    array (
      'SEO' => 'Artesaos\\SEOTools\\Facades\\SEOTools',
      'JsonLd' => 'Artesaos\\SEOTools\\Facades\\JsonLd',
      'SEOMeta' => 'Artesaos\\SEOTools\\Facades\\SEOMeta',
      'Twitter' => 'Artesaos\\SEOTools\\Facades\\TwitterCard',
      'OpenGraph' => 'Artesaos\\SEOTools\\Facades\\OpenGraph',
    ),
    'providers' => 
    array (
      0 => 'Artesaos\\SEOTools\\Providers\\SEOToolsServiceProvider',
    ),
  ),
  'biscolab/laravel-recaptcha' => 
  array (
    'providers' => 
    array (
      0 => 'Biscolab\\ReCaptcha\\ReCaptchaServiceProvider',
    ),
    'aliases' => 
    array (
      'ReCaptcha' => 'Biscolab\\ReCaptcha\\Facades\\ReCaptcha',
    ),
  ),
  'intervention/image' => 
  array (
    'aliases' => 
    array (
      'Image' => 'Intervention\\Image\\Facades\\Image',
    ),
    'providers' => 
    array (
      0 => 'Intervention\\Image\\ImageServiceProvider',
    ),
  ),
  'jambasangsang/flash' => 
  array (
    'aliases' => 
    array (
      'LaravelFlash' => 'Jambasangsang\\Flash\\Facades\\LaravelFlash',
    ),
    'providers' => 
    array (
      0 => 'Jambasangsang\\Flash\\FlashNotificationServiceProvider',
    ),
  ),
  'laravel/ui' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Ui\\UiServiceProvider',
    ),
  ),
  'nesbot/carbon' => 
  array (
    'providers' => 
    array (
      0 => 'Carbon\\Laravel\\ServiceProvider',
    ),
  ),
  'nunomaduro/collision' => 
  array (
    'providers' => 
    array (
      0 => 'NunoMaduro\\Collision\\Adapters\\Laravel\\CollisionServiceProvider',
    ),
  ),
  'nunomaduro/termwind' => 
  array (
    'providers' => 
    array (
      0 => 'Termwind\\Laravel\\TermwindServiceProvider',
    ),
  ),
  'spatie/laravel-ignition' => 
  array (
    'aliases' => 
    array (
      'Flare' => 'Spatie\\LaravelIgnition\\Facades\\Flare',
    ),
    'providers' => 
    array (
      0 => 'Spatie\\LaravelIgnition\\IgnitionServiceProvider',
    ),
  ),
  'spatie/laravel-sitemap' => 
  array (
    'providers' => 
    array (
      0 => 'Spatie\\Sitemap\\SitemapServiceProvider',
    ),
  ),
);