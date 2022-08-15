<?php
include 'header.php';
include 'sidebar.php';
?>

<div class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="pcoded-inner-content">
                    <!-- [ breadcrumb ] start -->

                    <!-- [ breadcrumb ] end -->
                    <div class="main-body">
                        <div class="page-wrapper">
                            <!-- [ Main Content ] start -->
                            <div class="row">
                                <!-- table [] -->
                               
                                <div class="col-sm-12">
                                <div class="card">
                               
                                     
                                <div class="row">
                                        <div class="col-md-4 col-sm-12">
                                        <div class="card-block table-border-style">
                                            <div class="table-responsive">
                                           
      <h1>Simester table</h1>
      <img src="../../assets/images/simister.png" style="width: 300px; height: 300px mt-6;" alt="" srcset="">
                                        <!-- <form action="" method="POST">
                                     
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">ClassID</label>
                                                            <input type="text" class="form-control" id="clasid" aria-describedby="emailHelp" placeholder="classid">
                                                       
                                                        </div>
                                                        <div class="form-group">
                                                            <label >Clas_name</label>
                                                            <input type="text" class="form-control" id="classname" placeholder="className">
                                                        </div>
                                                      
                                                        <button type="submit" class="btn btn-primary" id='submit_class'>Submit</button>
                                                    </form> -->
</div>
</div>
                                        </div>        
                                        <div class="col-md-8 col-sm-12"> 

                                        <div class="card-block table-border-style">
                                               <button class="btn btn-success fw-bold " style="width: 20%; float: right" id="addsmister" data-bs-toggle="modal" data-bs-target="#SimesterModal">Add New</button>
                                            <div class="table-responsive">
                                                <table class="table table-bordered border-primary" id="simistertable">
                                                    <thead class="bg-success text-light">
                                                        <tr>
                                                          
                                                            <th>Simister id</th>
                                                            <th>Simister Name</th>
                                                            <th>Action</th>
                                                          
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                      
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        </div>                                
                                       
                                        
                         
                                  <!-- [ end modal content] -->
                                </div>
                                <!-- [ Main Content ] end -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div> 



    <!-- edit model -->
    <div class="modal fade" id="SimesterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Simester rgester</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="fa fa-window-close" style="background-color: white; font-size: 20px;" aria-hidden="true"></i>
            </button>
          </div>
          <div class="modal-body">
          <div class="alert alert-success d-none" role="alert">
      This is a success alert—check it out!
      </div>
      <div class="alert alert-danger d-none" role="alert">
      This is a danger alert—check it out!
      </div>
          <form action="" ID="DISPLY" method="POST">
          <div class="alert alert-success d-none" role="alert">
            This is a success alert—check it out!
            </div>
            <div class="alert alert-danger d-none" role="alert">
            This is a danger alert—check it out!
            </div>
          <div class="form-group mb-2">
              <label for="">ID</label>
              <input type="text" class="form-control" id="simisterID">
            </div>

            <div class="form-group mb-2">
              <label for="">Name</label>
              <input type="text" class="form-control" id="simistername">
            </div>


          

        

           

            
            <button type="button" class="btn btn-primary" id="savebtn">save</button>
          </form>
          </div>
          <div class="modal-footer">
            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Close</button>
            -->
          </div>
        </div>
      </div>
      </div> 



    <!-- edit model -->
 <div class="modal fade" id="update_simister_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Expanse Creator</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="fa fa-window-close" style="background-color: white; font-size: 20px;" aria-hidden="true"></i>
            </button>
          </div>
          <div class="modal-body">
         
          <div class="alert alert-success d-none" role="alert">
      This is a success alert—check it out!
      </div>
      <div class="alert alert-danger d-none" role="alert">
      This is a danger alert—check it out!
      </div>
      
          <form action="" ID="DISPLY" method="POST">
          
          <div class="form-group mb-2">
              <label for="">ID</label>
              <input type="text" class="form-control" id="simisterIDupdate">
            </div>

            <div class="form-group mb-2">
              <label for="">Name</label>
              <input type="text" class="form-control" id="simisternameupdate">
            </div>



          

        

           

            
            <button type="button" class="btn btn-primary" id="simister_updates">Update</button>
          </form>
          </div>
          <div class="modal-footer">
            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Close</button>
            -->
          </div>
        </div>
      </div>
      </div> 

    <!-- edit modal end -->
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../js/simister.js"></script>



<?php
include 'footer.php';

?>