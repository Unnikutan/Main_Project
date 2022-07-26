<?php
    include 'header.php';
    $worker_id = $_SESSION['worker_id'];
    $res = fetch_driver_by_id($conn,$worker_id);
    $row = mysqli_fetch_array($res);
    $worker_id = $row['id'];
    $gb_id = $row['gb_id'];
?>




<section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Welcome 
            <?php 
  				echo $row['name'];
  			?></h2>
        </div>

  </div>
</section>
<div class="pricing section-bg pb-5" data-aos="fade-up">
    <div class="container">
        <div id="msg_alert">
        </div>
        <script>
            const binStatus = setInterval(binCheck,5000);

            function binCheck(){
                $.ajax({
                    data: {
                        id: "<?php echo $worker_id ?>",
                    },
                    type: 'POST',
                    url:"bin_check.php",
                    success: function(result){
                        document.getElementById('msg_alert').innerHTML=result;
                    }
                })
            }
        </script>
        <div class="section-title">
          <h2>Overview</h2>
        </div>
        <div class="row no-gutters">
            <div class="col-lg-4 box">
                <h3>Workers</h3>
                <h4><?php echo "20" ?></h4>
                <a href="#" class="get-started-btn">Get Started</a>
            </div>

            <div class="col-lg-4 box featured">
                <h3>Bins</h3>
                <h4><?php echo "25" ?></h4>
                <a href="#" class="get-started-btn">View More</a>
            </div>

            <div class="col-lg-4 box">
                <h3>Trucks</h3>
                <h4><?php echo "25" ?></h4>
                <a href="#" class="get-started-btn">Get Started</a>
            </div>

        </div>

    </div>
</div>

<?php
    include 'footer.php';
    

?>