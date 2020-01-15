<?php
include_once("entete.php");

?>
<?php
//include_once("entete.php");
include_once("menu.php");

?>


<div class="page-content-wrap">
-----------------------------------------------------------accueil
    <div class="row">

        <div class="col-md-3">

            <!-- START WIDGET MESSAGES -->

            <div class="widget widget-info widget-item-icon">
                <div class="widget-item-left">
                    <span class="fa fa-archive" style="color: #0000ff"></span>
                </div>
                <div class="widget-data">
                    <div class="widget-int num-count">48888</div>
                    <div class="widget-title">Document(s)</div>
                    <div class="widget-subtitle">Dans la base de données</div>
                </div>
                <div class="widget-controls">
                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                </div>
                <a href="#" class="btn btn-info">VOIR LA LISTE</a>
            </div>
            <!-- END WIDGET MESSAGES -->

        </div>
        <div class="col-md-3">

            <!-- START WIDGET REGISTRED -->
            <div class="widget widget-default widget-item-icon" >
                <div class="widget-item-left">
                    <span class="fa fa-folder"></span>
                </div>
                <div class="widget-data">
                    <div class="widget-int num-count">375</div>
                    <div class="widget-title">Registred users</div>
                    <div class="widget-subtitle">On your website</div>
                </div>
                <div class="widget-controls">
                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                </div>
                <a href="#" class="btn btn-info">VOIR LA LISTE</a>
            </div>
            <!-- END WIDGET REGISTRED -->

        </div>

    </div>
</div>

<?php
include_once("footer.php");
?>