<?php 
require '../koneksi/connectdatabase.php'
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Company</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
  <!-- summernote -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js">

  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

  <!-- include libraries(jQuery, bootstrap) -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <link href="../css/summernote-list.min.css">
  <style>
  .image-list-content .col-lg-3 {
    width: 100%;
  }

  .image-list-content img {
    float: left;
    width: 20%;
  }

  .image-list-content p {
    float: left;
    padding-left: 200px;
  }

  .image-list-item {
    padding: 10px 0px 10px 0px;
  }
  </style>
</head>

<script src="../js/summernote-list.min.js"></script>

<script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
  integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>

<body class="container">
  <!-- awal header -->
  <header>
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Admin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Admin Halaman</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Admin Tutors</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Admin Partners</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Admin Contact</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">Logout >></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <!-- akhir header -->

  <!-- awal main -->
  <main>