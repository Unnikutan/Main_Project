

<?php

function map_view($result,$center){
    ?>    
   <script>
       var map = L.map('office_map2').setView([<?php echo $center['lat']; ?>,<?php echo $center['lon']; ?>],12);
       L.tileLayer('https://api.maptiler.com/maps/basic/{z}/{x}/{y}.png?key=rnildL47RCqVyg8E4kOb',{
       attribution:'<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>'
       }).addTo(map);

       var icon_3 = L.icon({
           iconUrl: '../assets/img/small_red.ico',
           iconSize: [40,40],
           iconAnchor: [20,40]
       });

       var icon_1 = L.icon({
           iconUrl: '../assets/img/small_green.ico',
           iconSize: [40,40],
           iconAnchor: [20,40]
       });
       var icon_6 = L.icon({
           iconUrl: '../assets/img/large_red.ico',
           iconSize: [40,40]
       });
       var icon_4 = L.icon({
           iconUrl: '../assets/img/large_green.ico',
           iconSize: [40,40]
       });
       var icon_5 = L.icon({
           iconUrl: '../assets/img/large_blue.ico',
           iconSize: [40,40],
       });
       var icon_9 = L.icon({
           iconUrl: '../assets/img/con_red.ico',
           iconSize: [40,40],
       });
       var icon_7 = L.icon({
           iconUrl: '../assets/img/con_green.ico',
           iconSize: [40,40],
       });
       var icon_8 = L.icon({
           iconUrl: '../assets/img/con_blue.ico',
           iconSize: [40,40],
       });

       <?php
           while($row=mysqli_fetch_array($result)){
               if (!strcmp($row['type'],"S")){
                   if($row['status']=='0'){
                       ?> 
                       var markerOption = {
                           icon: icon_1
                       } 
                       <?php
                   }
                   elseif ($row['status']=='2'){
                       ?>
                       var markerOption = {
                       icon: icon_3
                       }
                       <?php
                   }
                   else{
                       ?>
                       var markerOption = {
                       }
                       <?php
                   }
               }
               elseif (strcmp($row['type'],"L")==0){
                   if($row['status']=='0'){
                       ?> 
                       var markerOption = {
                           icon: icon_4
                       } 
                       <?php
                   }
                   elseif ($row['status']=='1'){
                       ?>
                       var markerOption = {
                       icon: icon_5
                       }
                       <?php
                   }
                   else{
                       ?>
                       var markerOption = {
                           icon: icon_6 
                       }
                       <?php
                   }
               }
               else{
                   if($row['status']=='0'){
                       ?> 
                       var markerOption = {
                           icon: icon_7
                       } 
                       <?php
                   }
                   elseif ($row['status']=='1'){
                       ?>
                       var markerOption = {
                       icon: icon_8
                       }
                       <?php
                   }
                   else{
                       ?>
                       var markerOption = {
                           icon: icon_9
                       }
                       <?php
                   }
               }
                   ?>
               var marker = L.marker([<?php echo $row['lat']; ?>,<?php echo $row['lon']; ?>],markerOption).addTo(map);
               marker.bindPopup("<?php echo $row['b_name']; ?>");
               <?php
           } 
       ?>
   </script>
   <?php
    }

function map_view_dark($result,$center,$conn){
    ?>    
       <script>
           var map = L.map('office_map2').setView([<?php echo $center['lat']; ?>,<?php echo $center['lon']; ?>],16);
           L.tileLayer('https://api.maptiler.com/maps/basic/{z}/{x}/{y}.png?key=rnildL47RCqVyg8E4kOb',{
           attribution:'<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>'
           }).addTo(map);
    
           var icon_1 = L.icon({
               iconUrl: '../assets/img/unassigned.ico',
               iconSize: [40,40],
               iconAnchor: [20,40]
           });
           var icon_2 = L.icon({
               iconUrl: '../assets/img/assigned.ico',
               iconSize: [40,40],
               iconAnchor: [20,40]
           });
           <?php
               while($row=mysqli_fetch_array($result)){
                    if ($row['pick_up']==0){
                        ?>
                        var markerOption = {
                            icon:icon_1
                        }
                        <?php
                    }
                    else{
                        $sql_dr = fetch_driver_by_id($conn,$row['pick_up']);
                        $result_dr = mysqli_fetch_array($sql_dr);
                        $collector_name = $result_dr['name'];
                        ?>
                        var markerOption = {
                            icon:icon_2
                        }
                        <?php
                    }
                       ?>
                   var marker = L.marker([<?php echo $row['lat']; ?>,<?php echo $row['lon']; ?>],markerOption).addTo(map);
                   <?php
                   if($row['pick_up']==0){
                    ?>
                    marker.bindPopup("<?php echo $row['b_name']." is not assigned"; ?>");
                    <?php 
                   }
                   else{
                    ?>
                    marker.bindPopup("<?php echo $row['b_name']." assigned to ".$collector_name; ?>");
                    <?php
                   }
               } 
           ?>
       </script>
       <?php
        }

    function path($conn,$res){
            $route = fetch_bin_by_type_wm($conn,0,"C");
            
        ?>

            <script type="text/javascript">

                

                var map = L.map('route_map1').setView([8.957796454971353,76.98957829736175],12);
                L.tileLayer('https://api.maptiler.com/maps/basic/{z}/{x}/{y}.png?key=rnildL47RCqVyg8E4kOb',{
                attribution:'<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>'
                }).addTo(map);

                var icon_9 = L.icon({
                    iconUrl: '../assets/img/con_red.ico',
                    iconSize: [40,40],
                });
                var icon_7 = L.icon({
                    iconUrl: '../assets/img/con_green.ico',
                    iconSize: [40,40],
                });
                var icon_8 = L.icon({
                    iconUrl: '../assets/img/con_blue.ico',
                    iconSize: [40,40],
                });

            

                <?php

                while($row = mysqli_fetch_array($route)){

                    if($row['status']=='0'){
                       ?> 
                       var markerOption = {
                           icon: icon_7
                       } 
                       <?php
                   }
                   elseif ($row['status']=='1'){
                       ?>
                       var markerOption = {
                       icon: icon_8
                       }
                       <?php
                   }
                   else{
                       ?>
                       var markerOption = {
                           icon: icon_9
                       }
                       <?php
                   }
                   ?>
                    var marker = L.marker([<?php echo $row['lat']; ?>,<?php echo $row['lon']; ?>],markerOption).addTo(map);
                    marker.bindPopup("<?php echo $row['b_name']; ?>");

                   <?php
                }
                   ?>

                L.Routing.control({
 	 			waypoints: [
 	 			<?php
 	 			while($len=mysqli_fetch_array($res)) {
	 	 			$bin_id = $len['bins'];
	 	 			$sql4 = "select * from tbl_bins where bin_id='$bin_id'";
	 	 			$result = mysqli_query($conn,$sql4);
	 	 			$val = mysqli_fetch_array($result);
	 	 			?>
	 	 			L.latLng(<?php echo $val['lat']?>, <?php echo $val['lon']?>),
 	 			<?php } ?>
  					]
				}).addTo(map);
            </script>
        <?php
    }

    function path_optimum($conn,$res){
        $route = fetch_bin_by_type_wm($conn,0,"C");
        
    ?>

        <script type="text/javascript">

            

            var map = L.map('route_map1').setView([8.957796454971353,76.98957829736175],12);
            L.tileLayer('https://api.maptiler.com/maps/basic/{z}/{x}/{y}.png?key=rnildL47RCqVyg8E4kOb',{
            attribution:'<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>'
            }).addTo(map);

            var icon_9 = L.icon({
                iconUrl: '../assets/img/con_red.ico',
                iconSize: [40,40],
            });
            var icon_7 = L.icon({
                iconUrl: '../assets/img/con_green.ico',
                iconSize: [40,40],
            });
            var icon_8 = L.icon({
                iconUrl: '../assets/img/con_blue.ico',
                iconSize: [40,40],
            });

        

            <?php

            while($row = mysqli_fetch_array($route)){

                if($row['status']=='0'){
                   ?> 
                   var markerOption = {
                       icon: icon_7
                   } 
                   <?php
               }
               elseif ($row['status']=='1'){
                   ?>
                   var markerOption = {
                   icon: icon_8
                   }
                   <?php
               }
               else{
                   ?>
                   var markerOption = {
                       icon: icon_9
                   }
                   <?php
               }
               ?>
                var marker = L.marker([<?php echo $row['lat']; ?>,<?php echo $row['lon']; ?>],markerOption).addTo(map);
                marker.bindPopup("<?php echo $row['b_name']; ?>");

               <?php
            }
               ?>

            L.Routing.control({
              waypoints: [
              <?php
              while($val=mysqli_fetch_array($res)) {
                  ?>
                  L.latLng(<?php echo $val['lat']?>, <?php echo $val['lon']?>),
              <?php } ?>
                  ]
            }).addTo(map);
        </script>
    <?php
    }
?>