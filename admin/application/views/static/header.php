<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Admin MyPaJaLe</title>
	<!-- css -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/css/bootstrap/bootstrap.css' ?>">
	<link rel="stylesheet" href="<?php echo base_url().'assets/css/bootstrap/dataTables.bootstrap4.css' ?>">
	<link rel="stylesheet" href="<?php echo base_url().'assets/css/jquery/jquery.dataTables.css' ?>">
	<link rel="stylesheet" href="<?php echo base_url().'assets/css/custom.css' ?>">
	<link rel="stylesheet" href="<?php echo base_url().'assets/icons/fontawesome/css/all.css'?>">
	<!-- Quill Text Editor -->
	<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

	<!-- script -->
	<script src="<?php echo base_url().'assets/js/jquery/jquery-3.4.1.min.js' ?>" charset="utf-8"></script>
	<script src="<?php echo base_url().'assets/js/jquery/jquery.dataTables.js' ?>" charset="utf-8"></script>
	<script src="<?php echo base_url().'assets/js/bootstrap/bootstrap.js' ?>" charset="utf-8"></script>
	<script src="<?php echo base_url().'assets/js/bootstrap/dataTables.bootstrap4.js' ?>" charset="utf-8"></script>
	<script src="<?php echo base_url().'assets/js/jquery/notify.js' ?>" charset="utf-8"></script>

</head>
<body>
	<input type="hidden" class="form-control" id="id-user" value="<?php echo $this->session->userdata('userId'); ?>">
	<nav class="navbar navbar-dark fixed-top bg-success flex-md-nowrap p-0 shadow">
	  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="<?php echo base_url(); ?>"><strong>MyPaJaLe</strong></a>
	  <ul class="navbar-nav px-3">
	    <li class="nav-item text-nowrap">
	      <a class="nav-link" href="<?php echo base_url('users/logout') ?>" id="keluar"><span class="fas fa-sign-out-alt h6 mr-1"></span>Keluar</a>
	    </li>
	  </ul>
	</nav>
	<div class="container-fluid">
	  <div class="row">
	    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
	      <div class="sidebar-sticky">
	        <ul class="nav flex-column">
						<!-- Dashboard -->
	          <li class="nav-item">
	            <a class="nav-link <?php if($this->uri->segment(1) === 'welcome') { echo 'active'; }?>" href="<?php echo base_url().'welcome'?>" id="dashboard">
	              <span class="fas fa-tachometer-alt h5 mr-2"></span><span class="h6">Dashboard</span>
	            </a>
	          </li>
						<!-- Berita -->
						<li class="nav-item">
	            <a class="nav-link <?php if($this->uri->segment(1) === 'berita') { echo 'active'; }?>" href="<?php echo base_url().'berita'?>" id="berita">
								<span class="fas fa-newspaper h5 mr-2"></span>
								<span class="h6">Berita</span>
	            </a>
	          </li>
						<!-- Gejala -->
						<li class="nav-item">
							<a class="nav-link <?php if($this->uri->segment(1) === 'gejala') { echo 'active'; }?>" href="<?php echo base_url().'gejala'?>" id="gejala">
								<span class="fas fa-book-medical h5 mr-2"></span>
								<span class="h6">Gejala</span>
							</a>
						</li>
						<!-- Opt -->
						<li class="nav-item">
	            <a class="nav-link dropdown-toggle <?php if($this->uri->segment(1) === 'opt') { echo 'active'; }?>" href="#opt-sub-menu" data-toggle="collapse" aria-expanded="false" id="opt">
								<span class="fas fa-bug h5 mr-2"></span>
								<span class="h6">OPT</span>
	            </a>
							<ul class="collapse list-unstyled ml-3 <?php if($this->uri->segment(1) === 'opt') { echo 'show'; }?>" id="opt-sub-menu">
						    <li class="nav-item">
						       <a class="nav-link <?php if($this->uri->segment(1) === 'opt' && $this->uri->segment(2) === 'data') { echo 'active'; }?>" href="<?php echo base_url().'opt/data'?>">
										 <span class="fas fa-database h5 mx-2"></span>
										 <span class="h6">Data</span>
									 </a>
						    </li>
								<li class="nav-item">
						       <a class="nav-link <?php if($this->uri->segment(1) === 'opt' && $this->uri->segment(2) === 'kategori') { echo 'active'; }?>" href="<?php echo base_url().'opt/kategori'?>">
										<span class="fas fa-th h5 mx-2"></span>
										<span class="h6">Kategori</span>
									 </a>
						    </li>
								<li class="nav-item">
						       <a class="nav-link <?php if($this->uri->segment(1) === 'opt' && $this->uri->segment(2) === 'laporan') { echo 'active'; }?>" href="<?php echo base_url().'opt/laporan'?>">
										<span class="fas fa-book h5 mx-2"></span>
										<span class="h6">Laporan</span>
									 </a>
						    </li>
							</ul>
	          </li>
						<!-- Produk -->
						<li class="nav-item">
	            <a class="nav-link dropdown-toggle <?php if($this->uri->segment(1) === 'produk') { echo 'active'; }?>" href="#produk-sub-menu" data-toggle="collapse" aria-expanded="false" id="produk">
								<span class="fas fa-boxes h5 mr-2"></span>
								<span class="h6">Produk</span>
	            </a>
							<ul class="collapse list-unstyled ml-3 <?php if($this->uri->segment(1) === 'produk') { echo 'show'; }?>" id="produk-sub-menu">
						    <li class="nav-item">
						       <a class="nav-link <?php if($this->uri->segment(1) === 'produk' && $this->uri->segment(2) === 'data') { echo 'active'; }?>" href="<?php echo base_url().'produk/data'?>">
										 <span class="fas fa-database h5 mx-2"></span>
										 <span class="h6">Data</span>
									 </a>
						    </li>
								<li class="nav-item">
						       <a class="nav-link <?php if($this->uri->segment(1) === 'produk' && $this->uri->segment(2) === 'kategori') { echo 'active'; }?>" href="<?php echo base_url().'produk/kategori'?>">
										<span class="fas fa-th h5 mx-2"></span>
										<span class="h6">Kategori</span>
									 </a>
						    </li>
							</ul>
	          </li>
						<!-- Tanaman -->
	          <!-- <li class="nav-item">
	            <a class="nav-link <?php if($this->uri->segment(1) === 'tanaman') { echo 'active'; }?>" href="<?php echo base_url().'tanaman'?>" id="tanaman">
								<span class="fas fa-seedling h5 mr-2"></span>
								<span class="h6">Tanaman</span>
	            </a>
	          </li> -->
						<!-- Tips -->
					  <li class="nav-item">
	            <a class="nav-link dropdown-toggle <?php if($this->uri->segment(1) === 'tips') { echo 'active'; }?>" href="#tips-sub-menu" data-toggle="collapse" aria-expanded="false" id="tips">
								<span class="fas fa-star h5 mr-2"></span>
								<span class="h6">Tips</span>
	            </a>
							<ul class="collapse list-unstyled ml-3 <?php if($this->uri->segment(1) === 'tips') { echo 'show'; }?>" id="tips-sub-menu">
						    <li class="nav-item">
						       <a class="nav-link <?php if($this->uri->segment(1) === 'tips' && $this->uri->segment(2) === 'data') { echo 'active'; }?>" href="<?php echo base_url().'tips/data'?>">
										 <span class="fas fa-database h5 mx-2"></span>
										 <span class="h6">Data</span>
									 </a>
						    </li>
								<li class="nav-item">
						       <a class="nav-link <?php if($this->uri->segment(1) === 'tips' && $this->uri->segment(2) === 'kategori') { echo 'active'; }?>" href="<?php echo base_url().'tips/kategori'?>">
										<span class="fas fa-th h5 mx-2"></span>
										<span class="h6">Kategori</span>
									 </a>
						    </li>
							</ul>
	          </li>
						<!-- User -->
	          <li class="nav-item">
	            <a class="nav-link <?php if($this->uri->segment(1) === 'user') { echo 'active'; }?>" href="<?php echo base_url().'user'?>" id="user">
								<span class="fas fa-user h5 mr-2"></span>
								<span class="h6">User</span>
	            </a>
	          </li>
	        </ul>
	      </div>
	    </nav>
