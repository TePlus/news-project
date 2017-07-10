<?php

$PAGE_VAR["css"][] = "news";
$PAGE_VAR["js"][] = "news";

// if(!isset($_SESSION["user_id"])){
//   header("Location: " . WEB_META_BASE_URL . "auth");
//   exit;
// }''
?>

<script>
    var session_id = "";
    var session_status = "";
</script>

<?php if (isset($_SESSION["user_id"])) { ?>
    <script>
        session_id = <?php echo json_encode($_SESSION['user_id']); ?>;
        session_status = <?php echo json_encode($_SESSION['user_status']); ?>;
    </script>
<?php } ?>

<nav class="navbar navbar-fixed-top navbar-color-on-scroll navbar-transparent" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button id="menu-toggle" type="button" class="navbar-toggle" data-target="#navigation-doc">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar bar1"></span>
                <span class="icon-bar bar2"></span>
                <span class="icon-bar bar3"></span>
            </button>
            <a href="<?= WEB_META_BASE_URL ?>news">
                <div class="logo-container">
                    <div class="logo">
                        <img src="<?= WEB_META_BASE_URL ?>img/logo.png" alt="Creative Tim Logo">
                    </div>
                    <div class="brand">
                        Creative TePlus
                    </div>
                </div>
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navigation-doc">
            <ul class="nav navbar-nav navbar-right">

                <?php if (isset($_SESSION["user_id"])) { ?>
                    <li class="dropdown">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="material-icons">face</i>&nbsp<?php echo $_SESSION['username']; ?>
                            &nbsp&nbsp<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">View Profile</a></li>
                            <li class="divider"></li>
                            <li><a href="<?= WEB_META_BASE_URL ?>auth/logout.php?logout"><i class="fa fa-sign-in"></i>&nbsp
                                    Sign Out</a></li>
                        </ul>
                    </li>
                    </li>
                <?php } else { ?>
                    <li>
                        <a href="<?= WEB_META_BASE_URL ?>auth">
                            <i class="material-icons">lock_outline</i> Login
                        </a>
                    </li>
                <?php } ?>

            </ul>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<div class="wrapper">
    <div class="header header-filter"
         style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&amp;dpr=2&amp;fit=crop&amp;fm=jpg&amp;h=750&amp;ixjsv=2.1.0&amp;ixlib=rb-0.3.5&amp;q=50&amp;w=1450');">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="main main-raised">
    <div class="section section-basic">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 hero-feature">
                    <div class="title">
                        <h2>บทความ</h2>
                    </div>
                </div>

                <?php if (isset($_SESSION["user_id"])) { ?>
                    <div class="col-md-6 col-sm-6 text-right">
                        <div class="title">
                            <button class="btn btn-primary btn-create-dialog" data-toggle="modal"
                                    data-target="#modelCreate" pull-right>
                                เพิ่มหัวข้อ
                            </button>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <!-- widget grid -->
            <section id="widget-grid">
                <!-- NEW WIDGET START -->
                <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <fieldset>

                        <div class="row">
                            <div id="results">
                                <div class="position-create-button">
                                </div>

                                <!-- Widget ID (each widget will need unique ID)-->
                                <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0"
                                     data-widget-editbutton="false">
                                    <!-- widget div-->
                                    <div>
                                        <!-- widget content -->
                                        <div class="widget-body no-padding">
                                            <table id="dt_basic" class="table table-striped table-bordered rwd-table"
                                                   width="100%">
                                                <thead>
                                                <tr style="height:42px">
                                                    <!--<th data-hide="phone,tablet">No.</th>-->
                                                    <th data-hide="phone,tablet" class="text-center" style="width:5%">
                                                        ลำดับ
                                                    </th>
                                                    <th data-hide="phone,tablet">หัวเรื่อง</th>
                                                    <th data-hide="phone,tablet">ผู้เขียน</th>
                                                    <th data-hide="phone,tablet" class="text-center" style="width:20%">
                                                        วันที่สร้างข้อมูล
                                                    </th>
                                                    <th data-hide="phone,tablet" class="text-center" style="width:15%"
                                                        colspan="3">ดำเนินการ
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- end widget content -->
                                    </div>
                                    <ul id="pagination" class="pagination-sm" style="float:right;">

                                    </ul>
                                    <!-- end widget div -->
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </article>
                <!-- end widget -->
        </div>
    </div>
</div>

<!--
* Modal View
-->
<div class="modal fade" id="modalView" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">View</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="formView">

                    <div class="form-group">
                        <h4>หัวเรื่อง</h4>
                        <p id="title"></p>
                    </div>

                    <div class="form-group">
                        <h4>เนื้อหา</h4>
                        <p id="content"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-simple" id="btnClose" data-dismiss="modal">
                            Close
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--
* Modal Create
-->
<div class="modal fade" id="modelCreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Create</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="formCreate">

                    <div class="form-group">
                        <label for="inputContent">หัวเรื่อง*</label>
                        <input type="text" class="form-control" id="title" name="title">
                        <div class="col-sm-5">
                            <span class="text-danger messages"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputContent">เนื้อหา*</label>
                        <textarea class="form-control" id="content" name="content" rows="5"></textarea>
                        <div class="col-sm-5">
                            <span class="text-danger messages"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-simple" id="btnClose" data-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-info btn-simple" id="btnConfirmCreate">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--
* Modal Update
-->
<div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="formUpdate">

                    <input type="hidden" name="news_id"/>

                    <div class="form-group">
                        <label for="inputContent">หัวเรื่อง*</label>
                        <input type="text" class="form-control" id="title" name="title">
                        <div class="col-sm-5">
                            <span class="text-danger messages"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputContent">เนื้อหา*</label>
                        <textarea class="form-control" id="content" name="content" rows="5"></textarea>
                        <div class="col-sm-5">
                            <span class="text-danger messages"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-simple" id="btnClose" data-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-info btn-simple" id="btnConfirmUpdate">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!--
* Modal Delete
-->
<div class="modal fade" id="modelDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Delete</h4>
            </div>
            <div class="modal-body">

                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-simple" id="btnClose" data-dismiss="modal">Close
                    </button>
                    <button type="submit" class="btn btn-info btn-simple" id="btnConfirmDelete">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>


<footer class="footer">
    <div class="container">
        <div class="copyright pull-right">
            &copy; 2017, made with by TePlus
        </div>
    </div>
</footer>