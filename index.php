<?php
session_start();

if(isset($_SESSION["name"])){
    $sname=$_SESSION["name"];

}else{
    $sname="Guest"; 
}


?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Lab</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

    
    <nav class="navbar navbar-default">
        <p style="text-align:right; position: relative; margin:5px;">Hello! <?= $sname;?> &nbsp &nbsp</p>
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">aa</span>
                   
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Brand</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
                    <li><a href="#">Link</a></li>
                   
                    
                    <!-- <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#">One more separated link</a></li>
                        </ul>
                    </li> -->
                </ul>
                <form class="navbar-form navbar-left">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>

                
                <ul class="nav navbar-nav navbar-right">
                    
                    <?php if($sname=="Guest"):?>
                    <a href="login.php" class="btn btn-primary btn-lg" role="button">登入</a>
                    <?php else: ?>
                    <a href="login.php?logout=1" class="btn btn-warning btn-lg" role="button">登出</a>
                    <?php endif; ?>
                    <a href="secret.php" class="btn btn-primary btn-lg" role="button">會員專用頁</a>
                    
                </ul>
                
                
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    


    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3">

                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">產品類別</h3>
                    </div>
                    <div class="panel-body">

                        <ul class="list-group list-group">
                            <li class="list-group-item">Beginning of Spring 立春</li>
                            <li class="list-group-item">Rain Water 雨水</li>
                            <li class="list-group-item">Waking of Insects 驚蟄</li>
                            <li class="list-group-item">Spring Equinox 春分</li>
                            <li class="list-group-item">Pure Brightness 清明</li>
                            <li class="list-group-item">Grain Rain 穀雨</li>
                            <li class="list-group-item">Beginning of Spring 立春</li>
                            <li class="list-group-item">Rain Water 雨水</li>
                            <li class="list-group-item">Waking of Insects 驚蟄</li>
                            <li class="list-group-item">Spring Equinox 春分</li>
                            <li class="list-group-item">Pure Brightness 清明</li>
                            <li class="list-group-item">Grain Rain 穀雨</li>
                        </ul>

                    </div>
                </div>  
                  
            </div>

            <div class="col-sm-9">

                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">產品</h3>
                    </div>
                    <div class="panel-body">

                        <ul class="list-group list-group">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="thumbnail">
                                <a href="/w3images/lights.jpg">
                                    <img src="/w3images/lights.jpg" alt="Lights" style="width:100%">
                                    <div class="caption">
                                    <p>Lorem ipsum...</p>
                                    </div>
                                </a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="thumbnail">
                                <a href="/w3images/lights.jpg">
                                    <img src="/w3images/lights.jpg" alt="Lights" style="width:100%">
                                    <div class="caption">
                                    <p>Lorem ipsum...</p>
                                    </div>
                                </a>
                                </div>
                            </div>
                            
                        </div>
                        </ul>

                    </div>
                </div>  
                  
            </div>
</div>  
  
</div>


        </div>
    </div>



    <div class="container">
        <div class="bs-callout bs-callout-danger">
            <h4>Cross-browser compatibility</h4>
            <p>Avoid using <code>&lt;select&gt;</code> elements here as they cannot be fully styled in WebKit browsers.</p>
        </div>
    </div>


    <img src="./image/candy/水果糖.jpeg" alt="Girl in a jacket" width="500" height="600">
    
</body>
</html>
