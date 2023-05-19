<?php
error_reporting(E_ERROR);
include('db.php');
function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}


$act = $_REQUEST['act'];
$page = $_REQUEST['page'];
GLOBAL $db;
GLOBAL $authResult,$auth_error;
$db = new dbClass();
switch ($act){
    case 'auth':
        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];
        $db->setQuery(" SELECT  id,
                                group_id
                        FROM    users
                        WHERE   actived = 1 AND `username` = '$username' AND `password` = '$password'");
        $USERDATA = $db->getResultArray();
        $USERID = $USERDATA['result'][0]['id'];
        $USERGR = $USERDATA['result'][0]['group_id'];
        //$USEROBJ = $USERDATA['result'][0]['object_id'];
        if($USERID == ''){
            $authResult = 'NO';
        }
        else{
			$db->setQuery("	SELECT	work_group_users.id, work_group_users.is_boss
							FROM 	work_group_users
							JOIN 	work_group ON work_group.id = work_group_users.work_group_id AND work_group.finished_work = 0 AND work_group.actived = 1 AND work_group.work_date = CURDATE()
							WHERE 	work_group_users.user_id = '$USERID' AND work_group_users.finished_work = 0 AND work_group_users.actived = 1");
			$checkGroup = $db->getResultArray()['result'][0];

			if($checkGroup['id'] == ''){
				$_SESSION['USERID'] = $USERID;
				$_SESSION['GRPID'] = $USERGR;
				$_SESSION['OBJID'] = $USEROBJ;
			}
			else{
				if($checkGroup['is_boss'] == 1){
					$_SESSION['USERID'] = $USERID;
					$_SESSION['GRPID'] = $USERGR;
					$_SESSION['OBJID'] = $USEROBJ;

					
				}
				else{
					$auth_error = 'თქვენ დღეს იმყოფებით სამუშაო ჯგუფში, ვერ გაივლით ავტორიზაციას';
				}
			}
			
            
        }
        
    break;
    case 'sign_out':
        session_destroy();
        unset($_SESSION['USERID']);
        unset($_SESSION['GRPID']);
        unset($_SESSION['OBJID']);
    break;
}

if(isset($_SESSION['USERID'])){
	$db->setQuery(" SELECT  users.id,
							users.group_id,
							`groups`.welcome_page
					FROM    users
					JOIN 	`groups` ON `groups`.id = users.group_id
					WHERE   users.actived = 1 AND users.id = '$_SESSION[USERID]'");
	$USERDATA = $db->getResultArray();
	$USERGR = $USERDATA['result'][0]['group_id'];
	$_SESSION['GRPID'] = $USERGR;
    if($page == ''){
		if($USERDATA['result'][0]['welcome_page'] != ''){
			header('Location: '.$USERDATA['result'][0]['welcome_page']);
		}
		else{
			include('main.php');
		}
        
    }
    else{
        include($page.'.php');
    }
}
else{
    include('login.php');
}
?>
<script>
$(function() {
	$('.main-sidebar .with-sub').on('click', function(e) {
		e.preventDefault();
		$(this).parent().toggleClass('show');
		$(this).parent().siblings().removeClass('show');
	})
	$('.main-sidebar .with-sub1').on('click', function(e) {
		e.preventDefault();
		$(this).parent().toggleClass('show');
		$(this).parent().siblings().removeClass('show');
	})
	$('.main-sidebar .with-sub2').on('click', function(e) {
		e.preventDefault();
		$(this).parent().toggleClass('show');
		$(this).parent().siblings().removeClass('show');
	})
	$(document).on('click touchstart', function(e) {
		e.stopPropagation();
		// closing of sidebar menu when clicking outside of it
		if (!$(e.target).closest('.main-header-menu-icon').length) {
			var sidebarTarg = $(e.target).closest('.main-sidebar').length;
			if (!sidebarTarg) {
				$('body').removeClass('main-sidebar-show');
			}
		}
	});
	
	$(document).on('click', '#mainSidebarToggle' ,function(event) {
		event.preventDefault();
		if (window.matchMedia('(min-width: 768px)').matches) {
			$('body').toggleClass('main-sidebar-hide');
		} else {
			$('body').toggleClass('main-sidebar-show');
		}
	});
	$(".side-menu").hover(function() {
		if ($('body').hasClass('main-sidebar-hide')) {
			$('body').addClass('main-sidebar-open');
		}
	}, function() {
		if ($('body').hasClass('main-sidebar-hide')) {
			$('body').removeClass('main-sidebar-open');
		}
	});
	
	/*---Scroling ---*/
	//P-scroll
	new PerfectScrollbar('.side-menu', {
		suppressScrollX: true
	});
	
});
</script>