<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyResult</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

</head>
<body>
<div class="container NoArea">

<div class="card notFoundArea">

  <div class="card-body">
    <div class="image-found ">
            <img src="../../../images/notFound.gif" class="img img-fluid"  width="500" height="500" alt="Not Publish">
    </div>
    <h5 class="card-text" style="font-family: poppins; color : gray; font-size : 22px; text-align: center; font-weight:700">🙂 This result have not yet been published</h5>
     <p style="text-align : center" class="description">To Resolve Plz Contact The <kbd>Exam Office</kbd> Or Mail Us To Solve Your Issue. <a href="../../../login/auth-login.php">Back To Login</a></p>
        <div class="btns">
          
                
                    <button type="button"  class="btn btn-secondary" id="mail">Send Mail</button>
               
                    <a href="https://wa.link/48htul" title="Result Issue" target="_blank" class="btn btn-secondary">Exam Office</a>
           
        </div>
    </div>
</div>
</div>

<div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Result Issue</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="error-area">
            <div class="row display-error">
                
            </div>
        </div>
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Email:</label>
            <input type="email" class="form-control" id="email">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" rows="10" cols="10" id="message"></textarea>
          </div>
          <button type="button" class="btn btn-primary" id="send">Send</button>
        </form>
      </div>
      <div class="modal-footer">
      
       
      </div>
    </div>
  </div>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script src="./contact.js"></script>
</body>
</html>