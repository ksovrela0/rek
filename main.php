<html lang="en">
   <head>
      <style data-styles="">ion-icon{visibility:hidden}.hydrated{visibility:inherit}</style>
      <meta charset="utf-8">
      <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
      <meta name="description" content="Dashlead -  Admin Panel HTML Dashboard Template">
      <meta name="author" content="Spruko Technologies Private Limited">
      <meta name="keywords" content="sales dashboard, admin dashboard, bootstrap 4 admin template, html admin template, admin panel design, admin panel design, bootstrap 4 dashboard, admin panel template, html dashboard template, bootstrap admin panel, sales dashboard design, best sales dashboards, sales performance dashboard, html5 template, dashboard template">
      <!-- Favicon --> 
      <!-- <link rel="icon" href="assets/img/brand/logo.png" type="image/x-icon"> -->
      <!-- Title --> 
      <title>ტაბელი</title>
      <!---Fontawesome css--> 
      <?php include('includes/functions.php'); ?>
      <meta http-equiv="imagetoolbar" content="no">

      <style type="text/css" media="print">
         <!-- body{display:none} -->
      </style>
      <!--[if gte IE 5]>
      <frame>
      </frame><![endif]--><script src="https://www.spruko.com/demo/dashlead/assets/plugins/ionicons/ionicons/ionicons.suuqn5vt.js" type="module" crossorigin="true" data-resources-url="https://www.spruko.com/demo/dashlead/assets/plugins/ionicons/ionicons/" data-namespace="ionicons"></script>
      <style type="text/css">/* Chart.js */
         @-webkit-keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}@keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}.chartjs-render-monitor{-webkit-animation:chartjs-render-animation 0.001s;animation:chartjs-render-animation 0.001s;}
        .calendar {
            display: flex;
            flex-wrap: wrap;
            width: 1260px;;
        }
        
        .calendar .day {
            position: relative;
            width: 160px;
            height: 130px;
            text-align: left;
            border-left: 1px solid #691e94;
            border-bottom: 1px solid #691e94;
            margin: 10px;
            font-size: 30px;
            padding-left: 10px;
        }
        .day_title{
            width: 180px;
            height: 30px;
            line-height: 30px;
            text-align: center;
            
            font-weight: bold;
        }
        .title_red{
            color: red!important;
        }
        .title_wrapper{
            display: flex;
            background-color: #691e94;
            color: #fff;
        }
        .day_day{
            position: absolute;
            bottom: 0;
            color: #691e94;
        }
        .day_data{
            font-size: 14px;
        }
        .day_data td{
            padding-left: 5px;
            text-align: center;
            
        }
        .day_data_title{
            background-color: #691e94;
            color: #fff;
            padding-right: 5px;
            font-weight: bold;
        }
        .day_data_hours{
            background-color: #48c61d;
            color: #fff;
            padding-left: 5px;
            padding-right: 5px;
        }
        .calendarContainer{
            background-color: #b4b4b4;
            padding: 0!important;
            display:none;
        }
        .tabel_showed{
            display: block;
        }

        .user_div{
            background-color: #b4b4b4;
            padding: 0!important;
            display: flex;
            flex-direction: row;
            width: 100%;
            justify-content: space-between;
            font-weight: bold;
            font-size: 17px;
            cursor: pointer;
        }
        .user_div div{
            display: flex;
            flex: 1;
        }
        .triangle {
            width: 0;
            height: 0;
            border-left: 7px solid transparent;
            border-right: 7px solid transparent;
            border-bottom: 12px solid #fff;
            margin-top: 7px;
            margin-right: 5px;
            transition: transform 0.25s;
        }
        .rotated{
            transform: rotate(180deg);
            border-bottom: 12px solid #691e94;
        }
        .users_head{
            background-color: #691e94;
            color: #fff;
            padding: 0!important;
            display: flex;
            flex-direction: row;
            width: 100%;
            justify-content: space-around;
            font-weight: bold;
            font-size: 17px;
            margin-bottom: 15px;
        }
        .users_head div{
            display: flex;
        }

        .user_wrapper{
            margin-bottom: 10px;
        }
        .users_container{
            border: 2px solid #691e94;
            padding: 0!important;
            width: 100%;
        }
        .total_red{
            background-color: red;
        }
        .detailed_info{
            padding: 10px;
        }
        .detailed_left_side{
            background-color: #691e94;
            color: #fff;
            font-weight: bold;
            padding-left: 5px;
            border-bottom: 4px solid #b4b4b4;
            padding-right: 5px;
        }
        .detailed_right_side{
            padding-left: 5px;
            
        }
        .holiday_title{
            font-size: 10px;
            font-weight: bold;
        }
        .tabel_filter{
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
        }
      </style>
   </head>
   <body>
      
      <?php include('includes/switcher.php'); ?>
      <!-- End Switchessr --> <!-- Loader --> 
      <div id="global-loader" style="display: none;"> <img src="assets/img/loader.svg" class="loader-img" alt="Loader"> </div>
      <!-- End Loader --> <!-- Page --> 
      <div class="page">
         <!-- Sidemenu --> 
         <?php include('includes/menu.php'); ?>
         <!-- End Sidemenu --> <!-- Main Content--> 
         <div class="main-content side-content pt-0">
            <!-- Main Header--> 
            <?php include('includes/header.php'); ?>
            <!-- End Main Header--> 
            <div class="container-fluid">
               <!-- Page Header --> 
               <div class="page-header">
                  <div>
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">ტაბელი</a></li>
                        <li class="breadcrumb-item active" aria-current="page">ტაბელი</li>
                     </ol>
                  </div>
                  
               </div>
               <!-- End Page Header --> <!--Navbar--> 
               
               <!--End Navbar --> <!-- Row --> 
                <div class="row row-sm">
                    <div class="col-sm-2">
						<label>აირჩიეთ ჯგუფი</label>
						<select id="user_group" style="width:95%;">
							<?php getUserGroups(0); ?>
						</select>
					</div>

                    <div class="col-sm-2">
						<label>გვარი</label>
						<input data-nec="0" style="width: 95%;height: 20px;font-size: 16px; margin-bottom: 10px;padding: 6px;" type="text" id="user_lastname" class="idle form-input" autocomplete="off">
					</div>

                    <div class="col-sm-2">
						<label>აირჩიეთ წელი</label>
						<select style="width:95%;" id="tabel_year">
							<?php getYears(date('Y')); ?>
						</select>
					</div>
                    <div class="col-sm-2">
						<label>აირჩიეთ თვე</label>
						<select style="width:95%;" id="tabel_month">
							<?php getMonth(date('m')); ?>
						</select>
					</div>

                    <br><br><br>
                    <div class="users_container">
                        <div class="users_head">
                            <div>სახელი</div>
                            <div>გვარი</div>
                            <div>ტელეფონი</div>
                            <div>თანამდებობა</div>
                            <div>პ/რ ნომერი</div>
                            <div>საპენსიო</div>
                            <div>სოციალური</div>
                        </div>

                        <?php

                            $db->setQuery(" SELECT  *
                                            FROM    users
                                            WHERE   users.actived = 1");
                            $users = $db->getResultArray();


                            foreach($users['result'] AS $user){
                                echo '  <div class="user_wrapper">
                                            <div class="user_div" data-user-id="'.$user['id'].'" data-user-group="'.$user['group_id'].'" data-user-lastname="'.$user['lastname'].'">
                                                
                                                <div class="user_firstname"><span class="triangle"></span>'.$user['firstname'].'</div>
                                                <div class="user_lastname">'.$user['lastname'].'</div>
                                                <div class="user_phone">'.$user['phone'].'</div>
                                                <div class="user_position">'.$user['position'].'</div>
                                                <div class="user_pnum">'.$user['pid'].'</div>
                                                <div class="user_sapensio">კი</div>
                                                <div class="user_socialuri">არა</div>
                
                                            </div>
                                            <div class="calendarContainer" data-user-id="'.$user['id'].'">
                                                <div class="title_wrapper" data-user-id="'.$user['id'].'"></div>
                                            </div>
                                        </div>';



                                /* for($j = 0; $j<19; $j++){

                                    if($j < 10){
                                        $jj = '0'.$j;
                                    }
                                    else{
                                        $jj = $j;
                                    }

                                    $rand_start_hour = rand(9,10);

                                    $rand_start_minute = rand(0,59);


                                    if($rand_start_hour < 10){
                                        $rand_start_hour = '0'.$rand_start_hour;
                                    }

                                    if($rand_start_minute < 10){
                                        $rand_start_minute = '0'.$rand_start_minute;
                                    }


                                    $rand_end_hour = rand(18,19);

                                    $rand_end_minute = rand(0,59);

                                    if($rand_end_minute < 10){
                                        $rand_end_minute = '0'.$rand_end_minute;
                                    }

                                    $db->setQuery("INSERT INTO tbl_facelog SET  userID = '$user[id]',
                                                                                authDateTime = '2023-05-$jj $rand_start_hour:$rand_start_minute',
                                                                                authDate = '2023-05-$jj'");
                                    $db->execQuery();


                                    $db->setQuery("INSERT INTO tbl_facelog SET  userID = '$user[id]',
                                                                                authDateTime = '2023-05-$jj $rand_end_hour:$rand_end_minute',
                                                                                authDate = '2023-05-$jj'");
                                    $db->execQuery();
                                } */
                            }
                        ?>
                        
                    </div>
                    
                    
                </div>
               
               <!-- End Row --> <!-- Row--> 
               

               <!-- End Row --> 
            </div>
         </div>
         <!-- End Main Content--> <!-- Sidebar --> 
         
         <!-- End Sidebar --> <!-- Main Footer--> 
         <div class="main-footer text-center">
            <div class="container">
               <div class="row">
                  <div class="col-md-12"> <span>Copyright © 2023 .</span> </div>
               </div>
            </div>
         </div>
         <!--End Footer--> 
      </div>
      <!-- End Page --> <!-- Back-to-top --> <a href="#top" id="back-to-top"><i class="fe fe-arrow-up"></i></a> <!-- Jquery js--> 
        <script>
            
            function createCalendar(month, year, data_id) {
                var daysInMonth = new Date(year, month, 0).getDate();
                var firstDay = new Date(year, month - 1, 1).getDay();
                var startDay = (firstDay === 0) ? 6 : firstDay - 1; // Коррекция для начала недели с понедельника
                
                var calendar = $('<div>').addClass('calendar');
                
                // Добавляем заголовки дней недели
                var daysOfWeek = ['ორშაბათი', 'სამშაბათი', 'ოთხშაბათი', 'ხუთშაბათი', 'პარასკევი', 'შაბათი', 'კვირა'];
                //calendar.append($('<div>').addClass('title_wrapper'));
                for (var i = 0; i < 7; i++) {
                    

                    if(i == 5 || i == 6){
                        $('.title_wrapper[data-user-id="'+data_id+'"]').append($('<div>').addClass('day_title').addClass('title_red').text(daysOfWeek[i]));
                    }
                    else{
                        $('.title_wrapper[data-user-id="'+data_id+'"]').append($('<div>').addClass('day_title').text(daysOfWeek[i]));
                    }
                }
                
                // Добавляем пустые ячейки перед первым днем месяца
                for (var i = 0; i < startDay; i++) {
                    calendar.append($('<div>').addClass('day'));
                }
                
                // Добавляем дни месяца
                for (var i = 1; i <= daysInMonth; i++) {
                    let day;
                    let day_container = '';



                    if(i<10){
                        day = year+'-'+month+"-0"+i;
                    }
                    else{
                        day = year+'-'+month+'-'+i;
                    }



                    

                    let date_check = new Date(day)
                    if(date_check.getDay() == 0 || date_check.getDay() == 6){
                        day_container += `<span class="day_day title_red">`+i+`</span>`;
                    }
                    else{
                        day_container = `   <span>
                                                <table class="day_data" cellspacing="2">
                                                    <tr>
                                                        <td class="day_data_title">მოსვლა</td>
                                                        <td rowspan="3" class="day_data_hours in total_red">არ მოვიდა</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="day_data_title">წასვლა</td>
                                                        <td class="day_data_hours out"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="day_data_title">ნამუშევარი</td>
                                                        <td class="day_data_hours work_hours"></td>
                                                    </tr>
                                                </table>
                                            </span>`;
                        day_container += `<span class="day_day">`+i+`</span>`;
                    }
                    
                                            
                    
                    
                    calendar.append($('<div>').addClass('day').attr('day',i).append(day_container));
                }
                $('.calendarContainer[data-user-id="'+data_id+'"]').prepend(`   <div class="tabel_filter">
                                                                                    <div style="display: flex;">
                                                                                        <select style="width: 95px;" class="tabel_year_o">
                                                                                        `+$('#tabel_year').html()+`
                                                                                        </select>

                                                                                    <div style="display: flex;">
                                                                                        <select class="tabel_month_o">
                                                                                        `+$('#tabel_month').html()+`
                                                                                        </select>
                                                                                    </div>
                                                                                </div>`);
                $('.calendarContainer[data-user-id="'+data_id+'"]').append(calendar);
                $('.calendarContainer[data-user-id="'+data_id+'"] .tabel_year_o').val($('#tabel_year').val())
                $('.calendarContainer[data-user-id="'+data_id+'"] .tabel_month_o').val($('#tabel_month').val())


                $('.calendarContainer[data-user-id="'+data_id+'"]').append(`<div class="detailed_info">
                                                                                <table>
                                                                                    <tr>
                                                                                        <td class="detailed_left_side">ნამუშევარი საათები</td>
                                                                                        <td class="detailed_right_side total_worked_hours">00:00</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="detailed_left_side">უქმე დღეებში ნამუშევარი საათები</td>
                                                                                        <td class="detailed_right_side total_worked_nonwork_hours">00:00</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="detailed_left_side">გაცდენილი საათები</td>
                                                                                        <td class="detailed_right_side total_lated_hours">00:00</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="detailed_left_side">დამატებითი საათები</td>
                                                                                        <td class="detailed_right_side total_additional_worked_hours">00:00</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="detailed_left_side">დაგვიანებული დღეები</td>
                                                                                        <td class="detailed_right_side total_lated_days">0 დღე</td>
                                                                                    </tr>
                                                                                </table>
                                                                            </div>`);
            }

            $(document).on('change','#user_group,#tabel_year,#tabel_month', function(){
                let group = $('#user_group').val();
                $('#user_lastname').val('')
                $('.calendarContainer').removeClass('tabel_showed')
                $('.triangle').removeClass('rotated')

                $('.calendarContainer').find('.calendar').remove();
                $('.calendarContainer').find('.detailed_info').remove();

                $(".user_div").parent().css('display', 'none');
                if(group != ''){
                    $(".user_div[data-user-group='"+group+"']").parent().css('display', 'block');
                }
                else{
                    $(".user_div").parent().css('display', 'block');
                }

            })

            $(document).on('keyup', '#user_lastname', function(){
                let group = $('#user_group').val();
                let lastname = $('#user_lastname').val();
                $(".user_div").parent().css('display', 'none');
                $('.calendarContainer').removeClass('tabel_showed')
                $('.triangle').removeClass('rotated')

                $('.calendarContainer').find('.calendar').remove();
                $('.calendarContainer').find('.detailed_info').remove();
                let filter ='';
                if(group != ''){
                    filter += "[data-user-group='"+group+"']";
                }


                if(lastname != ''){
                    
                    $(".user_div[data-user-lastname*='"+lastname+"']"+filter+"").parent().css('display', 'block');
                }
                else{
                    $(".user_div").parent().css('display', 'block');
                }
            })

            $(document).on('click', '.user_div', function(){

                $(this).find('.triangle').toggleClass('rotated');

                let user_id = $(this).attr('data-user-id');

                $('.calendarContainer[data-user-id="'+user_id+'"]').toggleClass('tabel_showed');
                if($('.calendarContainer[data-user-id="'+user_id+'"]').hasClass('tabel_showed')){
                    $.ajax({
                        url: "ajax/tabel.ajax.php",
                        type: "POST",
                        data: "act=get_tabel_data&user_id="+user_id,
                        dataType: "json",
                        success: function (data) {
                            //if(typeof data != 'undefined'){
                                var month = 5; // Май
                                var year = 2023;
                                createCalendar(month, year, user_id);

                                let holidays = data.holidays;
                                holidays.forEach(function(i, x){
                                    $('.calendarContainer[data-user-id="'+user_id+'"] .day[day="'+i.day_of_month+'"] .day_day').css('color', 'red').append(`<span class="holiday_title"> `+i.name+`</span>`)
                                })


                                let tabel_data = data.result;
                                tabel_data.forEach(function(i,x){
                                    let day;
                                    if(i.day<10){
                                        day = year+'-'+month+"-0"+i.day;
                                    }
                                    else{
                                        day = year+'-'+month+'-'+i.day;
                                    }



                                    

                                    let date_check = new Date(day)
                                    if(date_check.getDay() == 0 || date_check.getDay() == 6){
                                        $('.calendarContainer[data-user-id="'+user_id+'"] .day[day="'+i.day+'"]').append(`  <span>
                                                                                                                                <table class="day_data" cellspacing="2">
                                                                                                                                    <tr>
                                                                                                                                        <td class="day_data_title">მოსვლა</td>
                                                                                                                                        <td rowspan="3" class="day_data_hours in total_red">არ მოსულა</td>
                                                                                                                                    </tr>
                                                                                                                                    <tr>
                                                                                                                                        <td class="day_data_title">წასვლა</td>
                                                                                                                                        <td class="day_data_hours out"></td>
                                                                                                                                    </tr>
                                                                                                                                    <tr>
                                                                                                                                        <td class="day_data_title">ნამუშევარი</td>
                                                                                                                                        <td class="day_data_hours work_hours"></td>
                                                                                                                                    </tr>
                                                                                                                                </table>
                                                                                                                            </span>`)
                                    }


                                    $('.calendarContainer[data-user-id="'+user_id+'"] .day[day="'+i.day+'"] td.in').removeAttr('rowspan').removeClass('total_red');

                                    $('.calendarContainer[data-user-id="'+user_id+'"] .day[day="'+i.day+'"] td.in').html(i.real_in)
                                    $('.calendarContainer[data-user-id="'+user_id+'"] .day[day="'+i.day+'"] td.out').html(i.real_out)
                                    $('.calendarContainer[data-user-id="'+user_id+'"] .day[day="'+i.day+'"] td.work_hours').html(i.working_hours)
                                });

                                $('.calendarContainer[data-user-id="'+user_id+'"] .detailed_info td.total_worked_hours').html(data.working_hours_total);
                                $('.calendarContainer[data-user-id="'+user_id+'"] .detailed_info td.total_worked_nonwork_hours').html(data.total_worked_nonwork_hours);
                                $('.calendarContainer[data-user-id="'+user_id+'"] .detailed_info td.total_lated_hours').html(data.total_lated_hours);
                                $('.calendarContainer[data-user-id="'+user_id+'"] .detailed_info td.total_additional_worked_hours').html(data.total_additional_worked_hours);
                                $('.calendarContainer[data-user-id="'+user_id+'"] .detailed_info td.total_lated_days').html(data.total_lated_days+' დღე');
                                
                            //}
                        }
                    });
                }
                else{
                    $('.calendarContainer[data-user-id="'+user_id+'"]').html(`<div class="title_wrapper" data-user-id="`+user_id+`"></div>`)
                }
                

            });
            
            // Пример использования
           
        </script>
      <div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div>
      <div class="main-navbar-backdrop"></div>
   </body>
</html>

<?php
function getUserGroups($id){
    GLOBAL $db;
    $data = '';
    $db->setQuery("SELECT   id,
                            name AS 'name'
                    FROM    `groups`
                    WHERE actived = 1 AND id != 1");
    $cats = $db->getResultArray();
	$data .= '<option value="">აირჩიეთ</option>';
    foreach($cats['result'] AS $cat){
        if($cat[id] == $id){
            $data .= '<option value="'.$cat[id].'" selected="selected">'.$cat[name].'</option>';
        }
        else{
            $data .= '<option value="'.$cat[id].'">'.$cat[name].'</option>';
        }
    }
    echo $data;
}

function getYears($year){
    $start = 2021;
    $data = '';
    for(;$start<=2025;$start++){
        if($year == $start){
            $data .= '<option value="'.$start.'" selected="selected">'.$start.'</option>';
        }
        else{
            $data .= '<option value="'.$start.'">'.$start.'</option>';
        }
    }

    echo $data;
}

function getMonth($month){
    $data = '';
    $months = array(1 => 'იანვარი',
                    2 => 'თებერვალი',
                    3 => 'მარტი',
                    4 => 'აპრილი',
                    5 => 'მაისი',
                    6 => 'ივნისი',
                    7 => 'ივლისი',
                    8 => 'აგვისტო',
                    9 => 'სექტემბერი',
                    10 => 'ოქტომბერი',
                    11 => 'ნოემბერი',
                    12 => 'დეკემბერი');

    foreach($months AS $key=>$value){
        if($key == $month){
            $data .= '<option value="'.$key.'" selected="selected">'.$value.'</option>';
        }
        else{
            $data .= '<option value="'.$key.'">'.$value.'</option>';
        }
    }

    echo $data;
}
?>