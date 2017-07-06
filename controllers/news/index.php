<?php

$PAGE_VAR["css"][] = "news";
$PAGE_VAR["js"][] = "news";

$user = getUserData();

var_dump($user);
exit();

if(empty($user)){
    header("Location: " . WEB_META_BASE_URL . "index");
}
?>

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
      <a href="http://www.creative-tim.com">
           <div class="logo-container">
                <div class="logo">
                    <img src="<?=WEB_META_BASE_URL?>img/logo.png" alt="Creative Tim Logo">
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
      <li class="dropdown">
              <li class="dropdown">
        			<a href="#" class="dropdown-toggle" data-toggle="dropdown"> TePlus &nbsp<b class="caret"></b></a>
        			<ul class="dropdown-menu">
                <li><a href="#">View Profile</a></li>
                <li class="divider"></li>
                <li><a href="<?=WEB_META_BASE_URL?>auth/logout.php"><i class="fa fa-sign-in"></i>&nbsp Sign Out</a></li>

        			</ul>
        		</li>
        </li>
    	</ul>

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="wrapper">
<div class="header header-filter" style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&amp;dpr=2&amp;fit=crop&amp;fm=jpg&amp;h=750&amp;ixjsv=2.1.0&amp;ixlib=rb-0.3.5&amp;q=50&amp;w=1450');">
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

                <div class="col-md-6 col-sm-6 text-right">
                    <div class="title">
                        <button class="btn btn-primary btn-create-dialog" data-toggle="modal" data-target="#modelCreate" pull-right>
                          เพิ่มหัวข้อ
                        </button>
                    </div>
                </div>
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
        <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false">
          <!-- widget div-->
          <div>
            <!-- widget content -->
            <div class="widget-body no-padding">
              <table id="dt_basic" class="table table-striped table-bordered rwd-table" width="100%">
                <thead>
                  <tr style="height:42px">
                    <!--<th data-hide="phone,tablet">No.</th>-->
                    <th data-hide="phone,tablet" class="text-center" style="width:5%">ลำดับ</th>
                    <th data-hide="phone,tablet" >หัวเรื่อง</th>
                    <th data-hide="phone,tablet" class="text-center" style="width:20%">วันที่สร้างข้อมูล</th>
                    <th data-hide="phone,tablet" class="text-center" style="width:15%" colspan="3">ดำเนินการ</th>
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
Modal View 
-->
<div class="modal fade" id="modalView" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">ดูรายละเอียด</h4>
      </div>
      <div class="modal-body" id="modal-body">

      </div>
      <div class="modal-footer" id="modal-footer">
        <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-info btn-simple" >Save</button>
      </div>
    </div>
  </div>
</div>

<!-- 
Modal Create 
-->
<div class="modal fade" id="modelCreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">เพิ่มข้อมูล</h4>
      </div>
      <div class="modal-body" id="modal-body">

      <form id="formCreate" data-toggle="validator" novalidate="novalidate" method="POST"  enctype="multipart/form-data">
            
                  <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>

                    <div class="form-group">
                        <input type="text" name="title" value="" placeholder="หัวเรื่อง" class="form-control" />
                    </div>

                    <div class="form-group">
                      <textarea class="form-control" name="content" placeholder="รายละเอียดเนื้อหา" rows="5"></textarea>
              </div>
        </form>

      </div>
      <div class="modal-footer" id="modal-footer">
        <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-info btn-simple" id="btnConfirmCreate">Save</button>
      </div>
    </div>
  </div>
</div>

<!-- 
Modal Update 
-->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">แก้ไขข้อมูล</h4>
      </div>
      <div class="modal-body" id="modal-body">
            <form id="formUpdate" data-toggle="validator" novalidate="novalidate" method="POST"  enctype="multipart/form-data">
              <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>

                <input type="hidden" name="news_id" value="" class="form-control" />
                     
                  <div class="form-group">
                        <input type="text" name="title" value="" placeholder="หัวเรื่อง" class="form-control" />
                    </div>

                    <div class="form-group">
                      <textarea class="form-control" name="content" placeholder="รายละเอียดเนื้อหา" rows="5"></textarea>
                    </div>
            </form>         
        </div>
      <div class="modal-footer" id="modal-footer">
        <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-info btn-simple" id="btnConfirmUpdate">Update</button>
      </div>
    </div>
  </div>
</div>

<!-- 
Modal Delte 
-->
<div class="modal fade" id="modelDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">ลบข้อมูล</h4>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-info btn-simple" id="btnConfirmDelete">Delete</button>
      </div>
    </div>
  </div>
</div>

<footer class="footer">
	    <div class="container">
	        <div class="copyright pull-right">
	            &copy; 2017, made with <i class="material-icons">favorite</i> by TePlus
	        </div>
	    </div>
	</footer>