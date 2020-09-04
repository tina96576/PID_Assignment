<?php
 

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="css/bootstrap.min.css" rel="stylesheet">

</head>

<body>



<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">WebSiteName</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1 <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">Page 1-1</a></li>
          <li><a href="#">Page 1-2</a></li>
          <li><a href="#">Page 1-3</a></li>
        </ul>
      </li>
      <li><a href="#">Page 2</a></li>
      <li><a href="#">Page 3</a></li>
    </ul>
  </div>
</nav>
  
<div class="container">
  <h3>Navbar With Dropdown</h3>
  <p>This example adds a dropdown menu for the "Page 1" button in the navigation bar.</p>
</div>

<div class="container">
  <h2>Modal Example</h2>
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" name="button1" data-toggle="modal" data-target="#myModal">Open Modal</button>
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">新增類別</h4>
        </div>
        <div class="modal-body">
        <input type="text" class="form-control" name="cname" id="cname" placeholder="請輸入新類別" required="required"> 
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" id="send" data-dismiss="modal">OK</button>
            <button type="button" class="btn btn-secondary" id="close" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <div id="show"><div>
</div>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.toast.js"></script>
<script>
    $(function () {
        $("#myModal").click(function () {
            $("#cname").val("");
            $("#button1").modal( { backdrop: "static" } );
        })

        $("#send").click(function(){
            $("#myModal").modal("hide");
           // cname=$("#cname").val();
          
             
            $.ajax({
                    type: 'post',
                    url: 'test2.php',
                    dataType:'JSON',
                    data: {cname:$("#cname").val()},
                    success: function(data)
                    {

                        $("#show").html(data);            
                    }
            });

            // $.ajax({
            // type: 'post',
            // data: {postdata: postdata},
            // success: function(response){
            //     // Code
            // }
            // });
        
            
        
        });
        $("#close").click(function(){
            $("#myModal").modal("hide");
        });


 
 

      

});
</script>

</body>
</html>
