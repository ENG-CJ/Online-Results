<?php

include 'header.php';

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
                               
                                        <div class="card-header">
                                            <h5>List Of Users Data</h5>
                                            <span class="d-block m-t-5">Manage Users Information</span>
                                        </div>
                                        <div class="card-block table-border-style">
                                       
                                        <button class="btn btn-success fw-bold " style="width: 20%; float: right" id="newUser">Add New</button>
                                            <div class="table-responsive">
                                                <table class="table table-hover" id="usersTable">
                                                    <thead class="thead-dark">
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Username</th>
                                                            <th>User Type</th>
                                                            <th>Status</th>
                                                            <th>JoinedDate</th>  
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                       
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- end table -->
                              <!-- <div class="col-sm-8">
                              
                              </div> -->

                              <!-- [ adding model  ] -->
  <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">User Registration</h5>
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
          <form action="" method="POST">

          <div class="form-group mb-2">
              <label for="">UserID</label>
              <input type="text" class="form-control" id="userID">
            </div>

            <div class="form-group mb-2">
              <label for="">Username</label>
              <input type="text" class="form-control" id="Username">
            </div>

            <div class="form-group mb-2">
            <label for="">Password</label>
            <input type="password" class="form-control" id="password">
            </div>


            <div class="form-group mb-2">
            <label for="">UserType</label>
           <select name="" id="type" class="form-control">
            <option value="admin">Admin</option>
            <option value="user">User</option>
           </select>
            </div>


            <div class="form-group mb-2">
            <label for="">Status</label>
           <select name="" id="status" class="form-control">
            <option value="active">Active</option>
            <option value="Blocked">Blocked</option>
           </select>
            </div>

            <div class="form-group mb-2">
              <!-- user photo based -->
            </div>

            
            <button type="button" class="btn btn-primary" id="saveData">Save</button>
          </form>
          </div>
          <div class="modal-footer">
            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Close</button>
            -->
          </div>
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
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
          <form action="" method="POST">
          <div class="form-group mb-2">
              <label for="">Username</label>
              <input type="text" class="form-control" id="ui_user_id">
            </div>


            <div class="form-group mb-2">
              <label for="">Username</label>
              <input type="text" class="form-control" id="ui_Username">
            </div>

            <div class="form-group mb-2">
            <label for="">Password</label>
            <input type="password" class="form-control" id="ui_password">
            </div>

            <div class="form-group mb-2">
            <label for="">UserType</label>

           <select name="" id="user_type" class="form-control">
            <option value="admin">Admin</option>
            <option value="user">User</option>
           </select>

            </div>

            <div class="form-group mb-2">
            <label for="">Status</label>
           <select name="" id="ui_status" class="form-control">
            <option value="active">Active</option>
            <option value="Blocked">Blocked</option>
           </select>
            </div>

           

            
            <button type="button" class="btn btn-primary" id="editData">Update</button>
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
    <script src="../js/users.js"></script>



<?php
include 'footer.php';

?>