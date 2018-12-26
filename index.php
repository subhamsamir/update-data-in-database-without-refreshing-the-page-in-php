<?php
include 'connection.php';
?>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <p>update user info with jquery</p>
        <table class="table">
            <thead>
                <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $table = mysqli_query($connection,'SELECT * FROM user');
                while($row = mysqli_fetch_array($table)){?>
                <tr id="<?php echo $row['id']; ?>">
                <td data-target="firstName"><?php echo $row['firstName']; ?></td>
                <td data-target="lastName"><?php echo $row['lastName']; ?></td>
                <td data-target="email"><?php echo $row['email']; ?></td>
                <td><a href="#" data-role="update" data-id="<?php echo $row['id']; ?>">update</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <!-- Trigger the modal with a button 
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>-->
    </div>


    <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
                    <div class="form-group">
                        <label>first Name</label>
                        <input type="text" id="firstName" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>last Name</label>
                        <input type="text" id="lastName" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>email</label>
                        <input type="text" id="email" class="form-control">
                    </div>
                    <input type="text" id="userId" class="form-control">
                    </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-primary pull-right" data-dismiss="modal">Update</button>
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</body>
<script>
    $(document).ready(function(){
        $(document).on('click','a[data-role=update]',function(){
            var id = $(this).data('id');
            var firstName = $('#'+id).children('td[data-target=firstName]').text();
            var lastName = $('#'+id).children('td[data-target=lastName]').text();
            var email = $('#'+id).children('td[data-target=email]').text();
            
            $('#firstName').val(firstName);
            $('#lastName').val(lastName);
            $('#email').val(email);
            $('#userId').val(id);
            $('#myModal').modal('toggle');
        }); 

        //now create event to get data from field and update in database
       
        $('#save').click(function(){
            
            var id = $('#userId').val();
            var firstName = $('#firstName').val();
            var lastName = $('#lastName').val();
            var email = $('#email').val();

            $.ajax({
                url     :   'connection.php',
                method  :   'post',
                data    :   {firstName  :   firstName   ,   lastName:   lastName    ,   email: email, id: id},
                success :   function(response){
                    console.log("Hello world!");
                }
            });
        });
    });
    </script>