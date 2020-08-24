	<!--   Core JS Files   -->
    <script src="../assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="../assets/js/bootbox.min.js" type="text/javascript"></script>


	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="../assets/js/bootstrap-checkbox-radio.js"></script>

	<!--  Charts Plugin -->
	<script src="../assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="../assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

    <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
	<script src="../assets/js/paper-dashboard.js"></script>

	<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/js/demo.js"></script>
	<script src="../assets/js/chart.min.js"></script>

	<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
    <!-- <script src="../assets/js/jquery.js"></script> -->
    <script src="../assets/js/jquery.dataTables.min.js"></script>
    <script src="../assets/js/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
function seeAll() {
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.open("GET", "readAll.php", true);
  xhttp.send();
}
$(document).ready(function(){
    $(".readAll").click(function(){
        $("a.activenotif .notification").html("");
        $("a").removeClass("activenotif");
        $(".notif li").removeClass("notif-active");
    });
});
</script>
