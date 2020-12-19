<!DOCTYPE html>
<html lang="pl" dir="ltr">

<head>
  <meta http-equiv="Content-type" content="text/html;charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="keywords" content="Sup-up">
  <?php global $title; ?>
  <title>Sup-up</title>
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/static/dist/css/styles.css">
  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <main class="pageWrapper">
    <?php get_template_part( 'includes/components/social-badge'); ?>
    <?php get_template_part( 'includes/layout/header'); ?>