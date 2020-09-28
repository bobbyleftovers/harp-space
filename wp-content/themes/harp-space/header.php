<!doctype html>
<html lang="en">
  <head>
    <!-- Favicon for old browsers -->
    <link rel="shortcut icon" type="image/x-icon" href="<?= get_stylesheet_directory_uri() ?>/favicon.ico"/>

    <!-- Favicons for browser with out support .ico file -->
    <link rel="icon" type="image/png" href="<?= get_stylesheet_directory_uri() ?>/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="<?= get_stylesheet_directory_uri() ?>/favicon-32x32.png" sizes="32x32"> 

    <!-- For Android Chrome -->
    <link rel="icon" type="image/png" href="<?= get_stylesheet_directory_uri() ?>/android-chrome-192x192.png" sizes="192x192">

    <!-- Favicons for apple devices iPhone, iPad -->
    <link rel="apple-touch-icon" sizes="57x57" href="<?= get_stylesheet_directory_uri() ?>/apple-touch-icon.png">

    <!-- Favicons for Windows 8.0 and IE 10 -->
    <meta name="msapplication-TileImage" content="mstile-150x150.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
  <?php do_action( "after_body_open" ); ?>
  <?php the_module('header'); ?>
