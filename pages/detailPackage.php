<?php
include ('connect.php');
$id = $_GET["id"];
//echo "woiiiiiiiiiiiiiiiiiiiii $id";
//DATA package
$query = "SELECT * from package where id_package ='$id'";
$hasil=mysqli_query($conn, $query);
while($baris = mysqli_fetch_array($hasil)){
	$id=$baris['id_package'];
	$name=$baris['name'];
	$price=$baris['price'];
	$itinerary=$baris['itinerary'];	
  // $tourism_type=$baris['tourism_type'];
  // $lng=$baris['lon'];
  // $lat=$baris['lat'];
  // if ($lat=='' || $lng==''){
  //   $lat='<span style="color:red">Kosong</span>';
  //   $lng='<span style="color:red">Kosong</span>';
  // }
}
?>

<div class="card bg">
	<div class="card-header">
		<center>
			<h3 class="card-title bg-info">
				<b><?php echo $name ?></b>
			</h3>
		</center>
	</div>
	<div class="card-body">
		<center>
			<h6 style="color: red">Rp <?php echo $price ?></h6>
			<div class="card col-md-4" id="galleryrecommendxxx">
				<div class="slider" id="gallery1">
					<div class="isi-slider">
					  <?php
						$id=$_GET['id'];
						$querysearch="SELECT gallery_package FROM package_gallery where id_package='$id'";
						$hasil=mysqli_query($conn, $querysearch);			 
						$xx = 0;
				     	while($baris = mysqli_fetch_array($hasil)){
			     			$nilai=$baris['gallery_package'];
			     			$xx++;
				 	?>			
					  <a href="#" onclick="galeri1('tw001')">
					  	<img src="../_foto/<?php echo $nilai; ?>" style="object-fit: contain;">
					  </a>
					<?php } ?>

					</div>
				</div>
			</div>			
			<button type="button" class="btn btn-round bg-info mb-2" data-toggle="modal" data-target="#modal_theme_info"><i class="icon-play3 mr-1"></i>Show Video</button>
		</center>

				<div class="card col-md-12 bg-light">
					<div class="card-header header-elements-inline">
						<h3 class="card-title">
							<b>Destination</b>
						</h3>
						<div class="header-elements">
							<div class="list-icons">
		                		<a class="list-icons-item" data-action="collapse"></a>
		                	</div>
	                	</div>
					</div>

					<table id="dataTable" class="table table-bordered table-hover datatable-highlight">
						<thead>
							<tr style="text-align: center;">
								<th>NO.</th>
								<th>Object</th>
								<th>District</th>
								<th>Lama Perjalanan</th>
								<th>Durasi</th>								
							</tr>
						</thead>
						<?php

						$arr1 = array();
						$arr2 = array();
							$query = "SELECT * from package join object_point where package.id_package=object_point.id_package and package.id_package ='$id'";


								$data0=mysqli_query($conn, $query); $indexArray = 0;
								while($row = mysqli_fetch_array($data0)){
								$arr1[$indexArray] = array(
								$row['no_urut'],
								$row['id_souvenir'],
								$row['id_worship_place'],
								$row['id_restaurant'],
								$row['id_tourism'],
								$row['id_hotel'],
								$row['objek'],
								$row['lama_perjalanan'],
								$row['estimasi_waktu']
								); $indexArray += 1;
								}	

								$a = count($arr1);

								$arr2[6] = "travel";
								$arr2[5] = "hotel";
								$arr2[4] = "tourism";
								$arr2[3] = "restaurant";
								$arr2[2] = "worship_place";
								$arr2[1] = "souvenir";
								for($i=0;$i<$a;$i++)	
								{
								$column = 0;
								
						        $query2="SELECT  
						         a.name AS n1,
						         b.name AS n2
						         FROM ".$arr2[$arr1[$i][6]]." AS a, district as b 
						         WHERE st_contains(b.geom, a.geom) and a.id_".$arr2[$arr1[$i][6]]." = '".$arr1[$i][$arr1[$i][6]]."'";

										$data0=mysqli_query($conn, $query2);
						      
										while($row = mysqli_fetch_array($data0))
						        {					
						?>
						<tbody>			
							<tr>
                                <td style="text-align: center; width: 5%"><?php echo $arr1[$i][0]; ?></td>
                                <td style="width: 30%"><a href="?page=detail<?php echo $arr2[$arr1[$i][6]] ?>&id=<?php echo $arr1[$i][$arr1[$i][6]] ?>"><?php echo "$row[n1]"; ?></a></td>
                                <td style="width: 25%"><?php echo "$row[n2]"; ?></td>
                                <td style="width: 20%"><?php echo $arr1[$i][7]; ?></td>
                                <td style="width: 20%"><?php echo $arr1[$i][8]; ?></td>
							</tr>			
						</tbody>
						<?php }} ?>
					</table>
				</div>				
	</div>
</div>



<!-- Info modal -->
<div id="modal_theme_info" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<h4 class="modal-title">Upload Picture of <?php echo $name ?></h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			
			<form role="form" action="act/saveVidPack.php" enctype="multipart/form-data" method="post">
				<div class="modal-body">

					<div class="row">
						<div class="col-sm-12"> <!-- menampilkan peta-->
						    <section class="panel">
						        <div class="panel-body">
						        	<center>
			                        <div class="html5gallery" style="max-height:700px;overflow:auto;" data-skin="horizontal" data-width="350" data-height="200" data-resizemode="fit">  
							    	<?php
										$id=$_GET['id'];
										$querysearch="SELECT gallery_package FROM package_gallery where id_package='$id'";
										$hasil=mysqli_query($conn, $querysearch);			 
										$xx = 0;
								     	while($baris = mysqli_fetch_array($hasil)){
							     			$nilai=$baris['gallery_package'];
							     			$xx++;
								 	?>
										<image src="../_foto/<?php echo $nilai; ?>" style="width:10%;">
										<!--image src="../foto/tw002_a.jpg" style="width:10%;"-->
									<?php
							    		}
							    		if($xx==0){
									?>
										<image src="../global_assets/images/pnotify/danger.png" style="width:10%;">
									<?php
							    		}
							    		echo "nilai foto $nilai";
									?>
									</div>
									</center>
						        </div>				  					  
						    </section>
						</div>
					</div>	
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
				</div>
			</form>				
		</div>
	</div>
</div>
<!-- /info modal -->


<script type="text/javascript">
$('#dataTable').dataTable( {
  "columnDefs": [ {
  		"display": none;
    } ]
} );
</script>

<script type="text/javascript">
	$('#twp').hide();
	$('#tay').hide();
	$('#spn').hide();
	$('#spd').hide();
</script>