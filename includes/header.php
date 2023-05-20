<div class="main-header side-header sticky sticky-pin" style="margin-bottom: -64px;">
   <div class="container-fluid">
      <div class="main-header-left"> <a class="main-logo d-lg-none" href="index.html"> <img src="assets/img/brand/logo.png" class="header-brand-img desktop-logo" alt="logo"> <img src="assets/img/brand/icon.png" class="header-brand-img icon-logo" alt="logo"> <img src="assets/img/brand/logo-light.png" class="header-brand-img desktop-logo theme-logo" alt="logo"> <img src="assets/img/brand/icon-light.png" class="header-brand-img icon-logo theme-logo" alt="logo"> </a> <a class="main-header-menu-icon" href="" id="mainSidebarToggle"><span></span></a> </div>
      <div class="main-header-right">
      <?php
         $user_id = $_SESSION['USERID'];
         /* $group_id = $_SESSION['GRPID'];
         if($group_id == 3){
            $db->setQuery("SELECT cash_balance,real_balance FROM users WHERE id = '$_SESSION[USERID]'");
            $balances = $db->getResultArray();
            $balances = $balances['result'][0];
            echo '<div class="dropdown d-md-flex"> <p style="margin:0!important;font-weight: 700;">ქეშ-ბალანასი: <span id="money_cash"> - '.$balances['cash_balance'].'</span></p>  </div>
                  <div class="dropdown d-md-flex" style="margin-left:10px;"> <p style="margin:0!important;font-weight: 700;">ბალანასი: <span id="money_card"> + '.$balances['real_balance'].'</span></p>  </div>';
         }
         if($group_id == 4){
            echo '<div class="dropdown d-md-flex" style="margin-left:10px;"> <p style="margin:0!important;font-weight: 700;">ბალანასი: <span id="money_card"> + 24.75</span></p>  </div>';
         } */
      ?>
         
         
         <div class="dropdown main-header-notification">
            <a class="nav-link icon" href=""> <i class="fe fe-bell"></i>
            <?php
               $db->setQuery("SELECT COUNT(*) AS cc
                              FROM notifications
                              WHERE actived = 1 AND user_id = '$user_id' AND seen = 0");
               $cc = $db->getResultArray()['result'][0]['cc'];

               if($cc > 0){
                  echo '<span class="pulse bg-danger"></span> ';
               }
               else{
                  echo '<span style="display:none;" class="pulse bg-danger"></span> ';
               }
            ?>
             
            </a> 
            <div class="dropdown-menu">
               <div class="main-notification-list" style="    overflow: scroll;
    max-height: 600px;">
                  <?php
                     
                     $db->setQuery("SELECT *
                                    FROM notifications
                                    WHERE actived = 1 AND user_id = '$user_id'
                                    ORDER BY id DESC
                                    LIMIT 100");
                     $notifications = $db->getResultArray();

                     foreach($notifications['result'] AS $notification){
                        echo '
                        
                        <a href="';
                        if($notification['page'] != ''){
                           echo '?page='.$notification['page'];
                        }
                        else{
                           echo '#';
                        }
                        echo '"><div style="background-color:'.$notification['color'].'" notif-id="'.$notification['id'].'" class="media ';
                        if($notification['seen'] == 0){
                           echo 'new';
                        }
                        echo '">
                           <div class="media-body">
                              <p>'.$notification['text'].'</p>
                              <span>'.$notification['datetime'].'</span> 
                           </div>
                        </div>
                        </a>
                        ';
                     }
                  ?>
                  

               </div>
            </div>
         </div>
         <div class="dropdown main-profile-menu">
            <a class="main-img-user" href=""><img alt="avatar" src="assets/img/users/no.png"></a> 
            <div class="dropdown-menu">
               <div class="header-navheading">
                  <?php
                     $db->setQuery("SELECT CONCAT(firstname,' ',lastname) AS fullname FROM users WHERE id = '$_SESSION[USERID]'");
                     $userInfo = $db->getResultArray()['result'][0]['fullname'];

                     /*echo '<h6 class="main-notification-title">'.$userInfo[result][0][fullname].'</h6>'; */
                  ?>
                  
                  <p class="main-notification-text"><?php echo $userInfo; ?></p>
               </div>
               <a class="dropdown-item" href="index.php?act=sign_out"> <i class="fe fe-power"></i> Sign Out </a> 
            </div>
         </div>
      </div>
   </div>
</div>