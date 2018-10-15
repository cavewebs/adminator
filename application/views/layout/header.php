<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Hello !</title>
        <link rel="stylesheet" href="https://bootswatch.com/4/cosmo/bootstrap.min.css">
            </head>
    <body>
        <nav class="navbar navbar-expand-sm navbar-dark bg-primary mb-3">
<div class="container">
  <a href="<?=base_url()?>" class="navbar-brand">Adminator</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mobile-nav">
    <span class="navbar-toggle-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="mobile-nav">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a href="<?=base_url()?>" class="nav-link">Home</a>
      </li>
      <li class="nav-item">
        <a href="<?=base_url()?>groups" class="nav-link">Groups</a>
      </li>
      <li class="nav-item">
        <a href="<?=base_url()?>users" class="nav-link">Users</a>
      </li>
      <li class="nav-item">
        <a href="<?=base_url()?>logout" class="nav-link">Logout</a>
      </li>
    </ul>
  </div>
</div>
</nav>
        <div class="container">
        <style>
    .example-wrapper { margin: 1em auto; max-width: 800px; width: 95%; font: 18px/1.5 sans-serif; }
    .example-wrapper code { background: #F5F5F5; padding: 2px 6px; }
</style>
