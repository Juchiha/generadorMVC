<aside class="main-sidebar">
	<section class="sidebar">
	<form action="#" method="get" class="sidebar-form">
		<div class="input-group">
			<input type="text" style="color: white;" value="" name="q" id="" class="form-control" placeholder="Buscar...">
			<span class="input-group-btn">
				<button type="button" class="btn btn-flat">
					<i class="fa fa-search"></i>
				</button>
			</span>
		</div>
	</form>
		<ul class="sidebar-menu">
			<li id="Dashboard">
      			<a href="dashboard">
            		<i class="fa fa-dashboard"></i>
            		<span>Inicio</span>
      			</a>
			</li>
			<li id="Perfil">
      			<a href="perfil">
            		<i class="fa fa-user"></i>
            		<span>Perfil</span>
      			</a>
			</li>
			<?php if($_SESSION['membrecia'] == 1 || $_SESSION['perfil'] == 1 ){ ?>
			<li id="flowchart1100">
      			<a href="flowchart1100">
            		<i class="fa fa-sitemap"></i>
            		<span>Esquema 1100 USD</span>
      			</a>
			</li>
			<?php } ?>
			<?php if($_SESSION['membrecia'] == 2 || $_SESSION['perfil'] == 1 ){ ?>
			<li id="flowchart550">
      			<a href="flowchart550">
            		<i class="fa fa-sitemap"></i>
            		<span>Esquema 550 USD</span>
      			</a>
			</li>
			<?php }?>
			<!--<li id="Alianzas">
      			<a href="alianzas">
            		<i class="fa fa-hand-rock-o"></i>
            		<span>Alliances</span>
      			</a>
			</li>
			<li id="Faqs">
      			<a href="faqs">
            		<i class="fa fa-user"></i>
            		<span>Faqs</span>
      			</a>
			</li>-->
			<?php 
				if(isset($_SESSION['perfil']) && $_SESSION['perfil'] == 1){
			?>
			<!--<li id="NewsA">
      			<a href="news">
            		<i class="fa fa-newspaper-o"></i>
            		<span>News Admin</span>
      			</a>
			</li>
			<li id="Alianzas">
      			<a href="alianzasadmin">
            		<i class="fa fa-hand-rock-o"></i>
            		<span>Alliances Admin</span>
      			</a>
			</li>-->
			<li id="Buy">
      			<a href="buy">
            		<i class="cc BTC-alt"></i>
            		<span>&nbsp;Admin. compras</span>
      			</a>
			</li>
			<li id="Users">
      			<a href="users">
            		<i class="fa fa-users"></i>
            		<span>Admin. Usuarios</span>
      			</a>
			</li>
			<!--<li id="faqadmin">
      			<a href="faq">
            		<i class="fa fa-question-circle"></i>
            		<span>Faq Admin</span>
      			</a>
			</li>-->	
			<?php
				}
			?>
		</ul>
	</section>
</aside>