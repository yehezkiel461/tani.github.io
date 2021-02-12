<!--Navigation-->
			<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="text-align:right" id="mainNav">
					<b><a class="navbar-brand" href="index.php">Petani</a></b>
					<div class="container">
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>

				<div class="collapse navbar-collapse" id="navbarsExampleDefault">
					<ul class="navbar-nav mr-auto">
					  <li class="nav-item active">
						<a class="nav-link" href="#">| <span class="sr-only">(current)</span></a>
					  </li>
					  <li class="nav-item active">
						<a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
					  </li>
					  <!--Jika sudah login(ada session pelanggan)-->
					  <?php if(isset($_SESSION["pelanggan"])):?>
					  <li class="nav-item">
							<a class="nav-link" href="riwayat.php" style="color:#fff">Riwayat</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="logout.php" style="color:#fff">Logout</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="checkout.php" style="color:#fff">Checkout</a>
						</li>
						<!--Selain itu belum login belum ada session-->
						<?php else:?>
						<li class="nav-item">
							<a class="nav-link" href="login.php" style="color:#fff">Login</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="daftar.php" style="color:#fff">Daftar</a>
						</li>
						<?php endif?>
						
					</ul>
				<form action="pencarian.php" method="get" class="form-inline my-2 my-lg-0">
				  <input class="form-control mr-sm-2" name="keyword" type="search" placeholder="search" aria-label="Search">
				  <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
					<path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
					</svg></button>
				</form>
				</div>
					</div>
			</nav>