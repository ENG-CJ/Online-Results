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
                                <!-- card -->
                                <div class="card-container">
                                    <div class="main-card">
                                        <div class="student-card">
                                            <div class="title">
                                                <h3>Register Student</h3>
                                                <p>Only You Can Register One Student Per/Execution</p>
                                            </div>
                                            <div class="student-form">
                                                <form action="">
                                                    <div class="form-grouping">
                                                        <label for="">Roll NO.</label>
                                                        <input type="text" id="rollNo" class="studentRoll">
                                                    </div>
                                                    <div class="form-grouping">
                                                        <label for="">Full-Name</label>
                                                        <input type="text" id="fullName" class="fullName">
                                                    </div>
                                                    <div class="form-grouping">
                                                        <label for="">Mobile</label>
                                                        <input type="number" id="number" class="number">
                                                    </div>
                                                    <div class="form-grouping">
                                                        <label for="">Address</label>
                                                        <input type="text" id="address" class="address">
                                                    </div>
                                                    <div class="form-grouping">
                                                        <label for="">Gender</label>
                                                        <select  class="form-control" name="" id="gender">
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-grouping">
                                                      <label for="">Semester</label>
                                                        <select  class="form-control" name="" id="semester">
                                                           <option value="Test">Test</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-grouping">
                                                      <label for="">Class</label>
                                                        <select  class="form-control" name="" id="class">
                                                            <option value="Male">Male</option>
                                                           
                                                        </select>
                                                    </div>
                                                    <div class="form-grouping">
                                                      <button type="button" id="saveStudent" class="btn btn-secondary" style="width: 190px;">Save</button>
                                                    </div>
                                                            
                                                    
                                                    
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
     
   
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
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="../js/students.js"></script>



<?php
include 'footer.php';

?>
