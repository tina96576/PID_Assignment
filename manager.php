

<!-- <!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Lab - Upload file</title>
</head>
<body>
	<form method="post" enctype="multipart/form-data" action="">
		1. Select a file：<input type="file" name="file1" /><br /> <input
			type="submit" name="btnOK" value="2. 送出資料" />
	</form>
</body>
</html> -->

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Lab</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style_ok.css" rel="stylesheet">
</head>
<body>


    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                   
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" >管理頁</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
             
                 
                <ul class="nav navbar-nav navbar-right">
                <a href="login.php?logout=1" class="btn btn-warning btn-lg" role="button">登出</a>
               
                <a href="index.php" class="btn btn-primary btn-lg" role="button">回首頁</a>
               
                </ul>

                

                
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">管理</h3>
                    </div>
                    <div class="panel-body">
                        <ul class="list-group list-group">
                            <li class="list-group-item">

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                    Collapsible Group 2</a>
                                </h4>
                                </div>
                                <div id="collapse2" class="panel-collapse collapse">
                                <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                                minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                commodo consequat.</div>
                                </div>
                            </div>
                            </li>

                        </ul>

                    </div>
                </div>    

            </div>

            <div class="col-sm-9">

                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Summer</h3>
                    </div>
                    <div class="panel-body">

                        <ul class="list-group list-group">
                            <li class="list-group-item"></li>
                           
                        </ul>

                    </div>
                </div>

            </div>

            

        </div>
    </div>



    
</body>
</html>