<?php
function elapsedTime($time_since) {
    $time = time() - $time_since;
    $tokens = array (
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second'
    );
    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
            $numberOfUnits = floor($time / $unit);
            return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
    }
}
?>
            <div class="collapse navbar-collapse">
                <?php
                $sqltest = mysql_query("select * from notification where seen=0 and person_id=$id and type_person='fonct'");
                $notif_count = mysql_num_rows($sqltest);
                ?>
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#">
                                <i class="ti-user"></i>
                                <p><?php echo $fname; ?></p>
                            </a>
                        </li>
                        <li class="dropdown">
                            <?php
                                if($notif_count){
                                    echo '<a href="#" class="dropdown-toggle activenotif" data-toggle="dropdown">';
                                }else{
                                    echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown">';
                                }
                            ?>
                                    <i class="ti-bell"></i>
                                    <p class="notification">
                                        <?php
                                        if($notif_count){
                                            echo $notif_count;
                                        }
                                        ?>
                                    </p>
                                    <p>Notifications</p>
                                    <b class="caret"></b>
                              </a>
                              <ul class="dropdown-menu notif" style="overflow-y: auto; overflow-x: hidden;">
                                <div class="dropdown-header row">
                                    <div class="col-sm-5">
                                        <tt>Notification</tt>
                                    </div>
                                    <div class="col-sm-7 readAll" style="text-align: right;">
                                        <a href="#" ><tt onclick="seeAll()">marquer tout comme lu</tt></a>
                                    </div>
                                </div>
                                <li class="divider"></li>
                                <?php
                                $getNotif = mysql_query("select * from notification where person_id=$id and type_person='fonct' order by notif_id desc");
                                while($data = mysql_fetch_array($getNotif)){
                                    $link = '';
                                    switch ($data['link']) {
                                        case 'message':
                                            $link = 'message.php';
                                            break;
                                        case 'formation':
                                            $link = 'formations.php';
                                            break;
                                        case 'conge':
                                            $link = 'conges.php';
                                            break;
                                        case 'payslip':
                                            $link = 'payslip.php';
                                            break;
                                        default:
                                            $link = '#';
                                            break;
                                    }
                                    if($data['seen']){
                                        echo "<li class='notification' title='".$data['content']."'>";
                                    }else{
                                        echo "<li class='notification notif-active' title='".$data['content']."'>";
                                    }
                                ?>
                                        <a href="<?php echo $link; ?>">
                                            <?php
                                            echo '<p class="notif-text">'.$data['content'].'</p>';
                                            $date = date("Y-m-d H:i",strtotime($data['date']));
                                            echo '<p class="date">'.$date.'</p>';
                                            ?>
                                        </a>
                                <?php
                                        echo "</li>";
                                }
                                ?>
                              </ul>
                        </li>
                        <li>
                            <a href="../logout.php">
                                <i class="ti-direction"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </div>