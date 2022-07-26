<?php
    include '../db/connection.php';
    include '../controls/admin_controls.php';

    extract($_POST);

    $res = fetch_notification($conn,$id,0);

    $count = mysqli_num_rows($res);
    ?>

    <div id="notification_content">
      <div id="not_body">

      
      <?php
    $num = 0;
    if($count > 0){
        ?>
          <?php
        while($dis = mysqli_fetch_array($res)){
          if($dis['mark_read']==0){
            $num++;
          }
      ?>
          <a href="notification_action.php?id=<?php echo $dis['id'] ?>" style="text-decoration: none; color:#121;">
            <div class="card border-0">
              <?php
              if ($dis['mark_read']==1){
                ?>
                <div class="card-header">
                <?php
              }
              else{
                ?>
                <div class="card-header rounded-0" style="background-color: rgba(92, 189, 102, 0.5)">
                <?php
              }
              ?>
                <div class="d-flex col justify-content-between">
                  <div class="card-title fw-bold"><?php echo $dis['title'] ?> </div>
                  <div class="">
                    <?php 
                      $already = $dis['not_time'] ;
                      $timeAgo = getDateAgo($already);
                      echo $timeAgo;
                      ?>
                    </div>
                  </div>
                  <p class="office_notification_text">
                  <?php  
                    echo $dis['sub'];
                    ?>
                </p>
              </div>
            </div>
            </a>
    <?php
        }
        ?>
        <?php

}
else{
      ?>
        <div class="text-center p-5"> 
          No new notifications
        </div>
       <?php
    }
?>
</div>
<div id="not_try">
          <?php
              echo $num;
          ?>
        </div>
</div>