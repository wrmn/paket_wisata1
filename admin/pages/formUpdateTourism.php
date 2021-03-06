<!-- Animated markers --> 

  <div class="card col-sm-12">
    <div class="card-header header-elements-inline" style="padding-top: 5px; padding-bottom: 0px; padding-right: 5px;">
      <h4 class="card-title">
        <b>Mark Tourism Locations</b>
      </h4>
        
        <header class="card-header" style="float:right; padding-top: 2px; padding-bottom: 1px; padding-right: 2px;">
          <div class="card-title">

            <input id="latlng" type="text" class="form-control" style="width:200px" value="" placeholder="Latitude, Longitude">

            <button class="btn btn-sm btn-outline bg-teal-400 text-teal-400 border-teal-400 mt-1 mb-1" id="btnlatlng" type="button" title="Geocode"><i class="icon icon-search4"></i></button>

            <button class="btn btn-sm btn-outline bg-danger-400 text-danger-400 border-danger-400 mt-1 mb-1 ml-2" id="delete-button" type="button" title="Remove shape"><i class="icon icon-close2"></i></button>

          </div>           
        </header>
    </div>
    <div class="centered" id="map" style="margin-bottom: 5px; z-index:50"></div>

    <!-- Horizontal form modal -->
    <div class="container">
    <button type="button" class="btn col-sm-12 btn-sm bg-blue-400 text-blue-400 border-blue-400 mt-0 mb-1 ml-0" data-toggle="modal" data-target="#modal_form_horizontal">Input Data<i class="icon-pencil7 ml-2"></i></button>

            <div id="modal_form_horizontal" class="modal fade" tabindex="-1">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Input Data</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>

                  <form name="form_update" action="act/saveUpdateTourism.php" class="form-horizontal" enctype="multipart/form-data" method="POST">
                    <?php
                      include '../connect.php';
                          if (isset($_GET['id']))
                            {
                              $id=$_GET['id'];
                              $sql = mysqli_query($conn,"SELECT 
                                  tourism.id_tourism, 
                                  tourism.name as nama, 
                                  tourism.address, 
                                  tourism.open, 
                                  tourism.close, 
                                  tourism.ticket, 
                                  tourism.description, 
                                  
                                  ST_AsText(geom) as geom 
                                  FROM tourism
                                  where tourism.id_tourism='$id'");
                    
                            $data =  mysqli_fetch_array($sql);
                          }
                    ?>
                    <div class="form-group row">
                      <!-- <label class="col-form-label col-sm-3">Last name</label> -->
                      <div class="col-sm-9">
                        <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $id;?>">
                      </div>
                    </div>                

                    <div class="modal-body">
                      <div class="form-group row">
                        <label class="col-form-label col-sm-3">Coordinat</label>
                        <div class="col-sm-9">
                          <textarea type="text" id="geom" name="geom" class="form-control" readonly><?php echo $data['geom'] ?></textarea>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-form-label col-sm-3">Name</label>
                        <div class="col-sm-9">
                          <input type="text" name="name" value="<?php echo $data['nama'] ?>" class="form-control">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-form-label col-sm-3">Address</label>
                        <div class="col-sm-9">
                          <textarea type="text" name="address" class="form-control"><?php echo $data['address'] ?></textarea>
                        </div>
                      </div>    

                      <div class="form-group row">
                        <label class="col-form-label col-sm-3">Open Hour</label>
                        <div class="col-sm-9">
                          <input type="time" name="open" value="<?php echo $data['open'] ?>" class="form-control">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-form-label col-sm-3">Close Hour</label>
                        <div class="col-sm-9">
                          <input type="time" name="close" value="<?php echo $data['close'] ?>" class="form-control">
                        </div>
                      </div> 

                      <div class="form-group row">
                        <label class="col-form-label col-sm-3">Ticket</label>
                        <div class="col-sm-9">
                          <input type="number" name="ticket" value="<?php echo $data['ticket'] ?>" class="form-control">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-form-label col-sm-3">Description</label>
                        <div class="col-sm-9">
                          <textarea type="text" name="description" class="form-control"><?php echo $data['description'] ?></textarea>
                        </div>
                      </div>                                                                                     

                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn bg-primary">Submit form</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
    </div>       
    <!-- /horizontal form modal --> 

  </div>

  <script type="text/javascript" src="inc/mapdraw.js"></script>

<!-- Form -->
<!-- <div class="card col-sm-12">
      <form  name = "form_input" action="act/simpantwbaru.php" enctype="multipart/form-data" method="POST">
        <?php
          include '../connect.php';
              $query = mysqli_query($conn,"SELECT MAX(id_tourism) AS id FROM tourism");
              $result = mysqli_fetch_array($query);
              $idmax = $result['id'];
              if ($idmax==null) {$idmax=1;}
              else {$idmax++;}
        ?>
        <input type="text" class="form-control" id="id" name="id" value="<?php echo $idmax;?>">
        <label for="geom">Coordinat</label>
        <input class="form-control" id="geom" name="geom" readonly required></input>
        <button type="submit" class="btn btn-primary pull-center">Save <i class="fa fa-floppy-o"></i></button>
      </form>
</div> -->
<!-- Form -->

