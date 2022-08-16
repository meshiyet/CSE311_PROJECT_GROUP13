<?php 
	include("connection.php");
	session_start();
?>

<!doctype html>
<html lang="en">
  <head>
  	<title> TEST </title>


    
		
		<link rel="stylesheet" href="CSS/index.css">
  </head>
  <body>
		<?php include("navbar.php");?>
		<section class="ftco-section" style="border:5px solid green; width: 80%; margin: 0 auto;">
			

			<div class="container">
				<div class="row">

					<div class="col-md-12">
						<div class="featured-carousel owl-carousel">
							
							<!-- Repeats -->
							<?php 
								$sql = "SELECT cover, isbn FROM book";
								$result = mysqli_query($db,$sql);
								while($book = $result->fetch_assoc())
								{
									$img = base64_encode($book['cover']);
									$isbn = $book['isbn'];
									 echo "

									 	<div class='item'>
									 	<a href = 'user_bookinfo.php?isbn=$isbn'>
												<div class='book'>
												<img src='data:image/jpg;charset=utf8;base64,$img'  height='480' width='300'/>
												</div></a>
										</div>";
									 
								}
							?>



							<!-- Repeats -->
							<!-- <div class='item'  style='border:2px solid aqua;'>
								<div class='book'></div>
							</div> -->
							<!-- Repeats -->

						
					
						</div>
					</div>
				</div>
			</div>
		</section>

    <script src="js/jquery.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
  </body>
  <?php include("footer.html");?>
</html>