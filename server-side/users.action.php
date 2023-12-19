<?php
error_reporting(E_ERROR);
include('../db.php');
GLOBAL $db;
$db = new dbClass();
$act = $_REQUEST['act'];
$user_id = $_SESSION['USERID'];
$user_gr = $_SESSION['GRPID'];
switch ($act){
    case 'get_add_page_h':
        $id = $_REQUEST['id'];
        $data = array('page' => getPageH());
    break;
    case 'get_add_page':
        $id = $_REQUEST['id'];
        $data = array('page' => getPage());
    break;
    case 'get_edit_page_h':
        $id = $_REQUEST['id'];
        $data = array('page' => getPageH(getHoliday($id)));
    break;
    case 'get_edit_page':
        $id = $_REQUEST['id'];
        $data = array('page' => getPage(getObject($id)));
    break;

    case 'get_grafik_page':
        $id = $_REQUEST['id'];
        $data = array('page' => getPageGrafik(getGrafik($id)));
    break;
        
    case 'get_dayoff_page':
        $id = $_REQUEST['id'];
        $data = array('page' => getPageDayoff(getDayoff($id)));
    break;

    case 'save_holiday':
        $id = $_REQUEST['id'];


        $tarigi = $_REQUEST['tarigi'];
        $h_name = $_REQUEST['h_name'];
        
        
        if($id == ''){
            $db->setQuery(" INSERT INTO holidays SET tarigi = '$tarigi',
                                                    name = '$h_name'");
            $db->execQuery();
        }
        else{
            $db->setQuery(" UPDATE  holidays 
                            SET    tarigi = '$tarigi',
                                    name = '$h_name'
                            WHERE   id = '$id'");
            $db->execQuery();
        }
    break;
    case 'save_dayoff':

        $id = $_REQUEST['id'];

        $vacation_type = $_REQUEST['vacation_type'];
        $user_id = $_REQUEST['user_id'];
        $start_date = $_REQUEST['start_date'];
        $end_date = $_REQUEST['end_date'];
        
        
        
        if($id == ''){
            $db->setQuery(" INSERT INTO vacations SET type_id = '$vacation_type',
                                                    user_id = '$user_id',
                                                    `start_date` = '$start_date',
                                                    end_date = '$end_date',
                                                    `create_date` = NOW()");
            $db->execQuery();
        }
        else{
            $db->setQuery(" UPDATE  vacations 
                            SET    type_id = '$vacation_type',
                                                    user_id = '$user_id',
                                                    `start_date` = '$start_date',
                                                    end_date = '$end_date'
                            WHERE   id = '$id'");
            $db->execQuery();
        }
        break;
    case 'save_grafik':
        $id = $_REQUEST['id'];

        $grafik_name = $_REQUEST['grafik_name'];
        $location_addr = $_REQUEST['location_addr'];
        $plan_in = $_REQUEST['plan_in'];
        $min_working_minutes = $_REQUEST['min_working_minutes'];
        $latecome = $_REQUEST['latecome'];
        $working_minutes = $_REQUEST['working_minutes'];
        $vacation_days = $_REQUEST['vacation_days'];

        $plan_out = date("H:i", strtotime('+'.$working_minutes.' minutes', strtotime($plan_in)));
        
        
        if($id == ''){
            $db->setQuery(" INSERT INTO tbl_schedule_types SET name = '$grafik_name',
                                                    location_addr = '$location_addr',
                                                    plan_in = '$plan_in',
                                                    plan_out = '$plan_out',
                                                    `min_working_minutes` = '$min_working_minutes',
                                                    working_minutes = '$working_minutes',
                                                    latecome = '$latecome',
                                                    vacation_days = '$vacation_days'");
            $db->execQuery();
        }
        else{
            $db->setQuery(" UPDATE  tbl_schedule_types 
                            SET    name = '$grafik_name',
                            location_addr = '$location_addr',
                                                    plan_in = '$plan_in',
                                                    plan_out = '$plan_out',
                                                    `min_working_minutes` = '$min_working_minutes',
                                                    working_minutes = '$working_minutes',
                                                    latecome = '$latecome',
                                                    vacation_days = '$vacation_days'
                            WHERE   id = '$id'");
            $db->execQuery();
        }
    break;
    case 'save_user':
        $id = $_REQUEST['id'];

        $uid = intval($_REQUEST['uid']);
        $firstname = $_REQUEST['firstname'];
        $lastname = $_REQUEST['lastname'];
        $pid = intval($_REQUEST['pid']);
        $phone = $_REQUEST['phone'];
        $group_id = $_REQUEST['user_group'];
        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];


        $position = $_REQUEST['position'];
        $birth_date = $_REQUEST['birth_date'];
        $address = $_REQUEST['address'];
        $user_pension = $_REQUEST['user_pension'];
        $user_social = $_REQUEST['user_social'];



        $tbl_shecdule_type_id = $_REQUEST['tbl_shecdule_type_id'];
        $order_number = $_REQUEST['order_number'];
        $register_number = $_REQUEST['register_number'];

        $anketa_checkbox = $_REQUEST['anketa_checkbox'];
        $instructions_checkbox = $_REQUEST['instructions_checkbox'];
        $orderTaken_checkbox = $_REQUEST['orderTaken_checkbox'];



        if($orderTaken_checkbox == 'true'){
            $orderTaken_checkbox = 1;
        }
        else{
            $orderTaken_checkbox = 0;
        }

        if($instructions_checkbox == 'true'){
            $instructions_checkbox = 1;
        }
        else{
            $instructions_checkbox = 0;
        }

        if($anketa_checkbox == 'true'){
            $anketa_checkbox = 1;
        }
        else{
            $anketa_checkbox = 0;
        }
        
        if($id == ''){
            $db->setQuery(" INSERT INTO users SET firstname = '$firstname',
                                                    lastname = '$lastname',
                                                    pid = '$pid',
                                                    phone = '$phone',
                                                    `group_id` = '$group_id',
                                                    username = '$username',
                                                    password = '$password',
                                                    position = '$position',
                                                    birth_date = '$birth_date',
                                                    `address` = '$address',
                                                    pension = '$user_pension',
                                                    social = '$user_social',

                                                    tbl_schedule_type_id = '$tbl_shecdule_type_id',
                                                    order_number = '$order_number',
                                                    register_number = '$register_number',
                                                    anketa_checkbox = '$anketa_checkbox',
                                                    instructions_checkbox = '$instructions_checkbox',
                                                    orderTaken_checkbox = '$orderTaken_checkbox',

                                                    id = '$uid'");
            $db->execQuery();
        }
        else{
            $db->setQuery(" UPDATE  users 
                            SET    firstname = '$firstname',
                                                lastname = '$lastname',
                                                pid = '$pid',
                                                phone = '$phone',
                                                `group_id` = '$group_id',
                                                username = '$username',
                                                password = '$password',
                                                    position = '$position',
                                                    birth_date = '$birth_date',
                                                    `address` = '$address',
                                                    pension = '$user_pension',
                                                    social = '$user_social',
                                                    tbl_schedule_type_id = '$tbl_shecdule_type_id',
                                                    order_number = '$order_number',
                                                    register_number = '$register_number',
                                                    anketa_checkbox = '$anketa_checkbox',
                                                    instructions_checkbox = '$instructions_checkbox',
                                                    orderTaken_checkbox = '$orderTaken_checkbox',
                                                    id = '$uid'
                            WHERE   id = '$id'");
            $db->execQuery();
        }
    break;
    case 'disable_d':
        $ids = $_REQUEST['id'];
        $ids = explode(',',$ids);

        foreach($ids AS $id){
            $db->setQuery("UPDATE vacations SET actived = 0 WHERE id = '$id'");
            $db->execQuery();
        }
        break;
    case 'disable_g':
        $ids = $_REQUEST['id'];
        $ids = explode(',',$ids);

        foreach($ids AS $id){
            $db->setQuery("UPDATE tbl_schedule_types SET deleted = 2 WHERE id = '$id'");
            $db->execQuery();
        }
    break;
    case 'disable_h':
        $ids = $_REQUEST['id'];
        $ids = explode(',',$ids);

        foreach($ids AS $id){
            $db->setQuery("DELETE FROM holidays WHERE id = '$id'");
            $db->execQuery();
        }
    break;
    case 'disable':
        $ids = $_REQUEST['id'];
        $ids = explode(',',$ids);

        foreach($ids AS $id){
            $db->setQuery("UPDATE users SET actived = 0 WHERE id = '$id'");
            $db->execQuery();
        }
    break;
    case 'get_columns':
        $columnCount = 		$_REQUEST['count'];
        $cols[] =           $_REQUEST['cols'];
        $columnNames[] = 	$_REQUEST['names'];
        $operators[] = 		$_REQUEST['operators'];
        $selectors[] = 		$_REQUEST['selectors'];
        //$query = "SHOW COLUMNS FROM $tableName";
        //$db->setQuery($query,$tableName);
        //$res = $db->getResultArray();
        $f=0;
        foreach($cols[0] AS $col)
        {
            $column = explode(':',$col);

            $res[$f]['Field'] = $column[0];
            $res[$f]['type'] = $column[1];
            $f++;
        }
        $i = 0;
        $columns = array();
        foreach($res AS $item)
        {
            $columns[$i] = $item['Field'];
            $i++;
        }
        
        $dat = array();
        $a = 0;
        for($j = 0;$j<$columnCount;$j++)
        {
            if(1==2)
			{
				continue;
            }
            else{
                
                if($operators[0][$a] == 1) $op = true; else $op = false; //  TRANSFORMS 0 OR 1 TO True or False FOR OPERATORS
                //$op = false;
                if($res['data_type'][$j] == 'date')
                {
                    $g = array('field'=>$columns[$j],'encoded'=>false,'title'=>$columnNames[0][$a],'format'=>"{0:yyyy-MM-dd hh:mm:ss}",'parseFormats' =>["MM/dd/yyyy h:mm:ss"]);
                }
                else if($selectors[0][$a] != '0') // GETTING SELECTORS WHERE VALUES ARE TABLE NAMES
                {
                    $g = array('field'=>$columns[$j],'encoded'=>false,'title'=>$columnNames[0][$a],'values'=>getSelectors($selectors[0][$a]));
                }
                else
                {
					if($columns[$j] == "inc_status"){
						$g = array('field'=>$columns[$j],'encoded'=>false,'title'=>$columnNames[0][$a],'filterable'=>array('multi'=>true,'search' => true), 'width' => 153);
					}elseif($columns[$j] == "audio_file"){
						$g = array('field'=>$columns[$j],'encoded'=>false,'title'=>$columnNames[0][$a],'filterable'=>array('multi'=>true,'search' => true), 'width' => 150);
					}elseif($columns[$j] == "action_given"){
						$g = array('field'=>$columns[$j],'encoded'=>false,'title'=>$columnNames[0][$a],'filterable'=>array('multi'=>true,'search' => true), 'width' => '5%');
					}elseif($columns[$j] == "id"){
						$g = array('field'=>$columns[$j], 'hidden' => false,'encoded'=>false,'title'=>$columnNames[0][$a],'filterable'=>array('multi'=>true,'search' => true), 'width' => 100);
					}elseif($columns[$j] == "inc_date"){
						$g = array('field'=>$columns[$j],'encoded'=>false,'title'=>$columnNames[0][$a],'filterable'=>array('multi'=>true,'search' => true), 'width' => 130);
					}else{
                    	$g = array('field'=>$columns[$j],'encoded'=>false,'title'=>$columnNames[0][$a],'filterable'=>array('multi'=>true,'search' => true));
					}
                }
                $a++;
            }
            array_push($dat,$g);
            
        }
        
        // array_push($dat,array('command'=>["edit","destroy"],'title'=>'&nbsp;','width'=>'250px'));
        
        $new_data = array();
        //{"id":"id","fields":[{"id":{"editable":true,"type":"number"}},{"reg_date":{"editable":true,"type":"number"}},{"name":{"editable":true,"type":"number"}},{"surname":{"editable":true,"type":"number"}},{"age":{"editable":true,"type":"number"}}]}
        for($j=0;$j<$columnCount;$j++)
        {
            if($res['data_type'][$j] == 'date')
            {
                $new_data[$columns[$j]] = array('editable'=>false,'type'=>'string');
            }
            else
            {
                $new_data[$columns[$j]] = array('editable' => true, 'type' => 'string');
            }
        }
        
        $filtArr = array('fields'=>$new_data);
        $kendoData = array('columnss'=>$dat,'modelss'=>$filtArr);
        
        //$dat = array('command'=>["edit","destroy"],'title'=>'&nbsp;','width'=>'250px');
        
        $data = $kendoData;
        //$data = '[{"gg":"sd","ads":"213123"}]';
        
    break;
    case 'get_list_holidays':
        $id          =      $_REQUEST['hidden'];
        
        $columnCount = 		$_REQUEST['count'];
		$cols[]      =      $_REQUEST['cols'];
        $db->setQuery(" SELECT  id,
                                tarigi,
                                name
                        FROM     holidays
                        ORDER BY tarigi DESC");

        $result = $db->getKendoList($columnCount, $cols);

        $data = $result;
        break;
    case 'get_list_admins':
        $id          =      $_REQUEST['hidden'];
        $report_date = explode(' - ', $_REQUEST['report_date']);

        $group_id = $_REQUEST['group_id'];
        $date_start = $report_date[0];
        $date_end = $report_date[1];
        $where = '';
        if($group_id != ''){
            $where = " AND users.group_id = '$group_id'";
        }
        
        $columnCount = 		$_REQUEST['count'];
		$cols[]      =      $_REQUEST['cols'];
            $db->setQuery(" SELECT  users.id,
                                    `groups`.name AS group_name,
                                    users.position,
                                    users.firstname,
                                    users.lastname,
                                    users.phone,
                                    users.pid,
                                    users.birth_date,
                                    users.address,
                                    IF(users.pension = 1, 'კი', 'არა'),
                                    IF(users.social = 1, 'კი', 'არა'),
                                    '' AS photo,
                                    '' AS total_worked_time,
                                    '' AS total_worked_nonwork_time,
                                    '' AS total_additional_worked_time,
                                    '' AS total_lated_time,
                                    '' AS total_lated_days
                                    
                            FROM    users
                            JOIN    `groups` ON `groups`.id = users.group_id
                            WHERE   users.actived = 1 AND users.group_id != 1 $where
                            GROUP BY users.id
                            ORDER BY users.id");

        $result = $db->getKendoList($columnCount, $cols);
        //var_dump($result);

        $db->setQuery(" SELECT 
                            *,
                            DAY(tarigi) AS day_of_month
                        FROM 
                            holidays
                        WHERE 
                            tarigi >= '".$date_start."'  AND 
                            tarigi <= '".$date_end."'");
        $holidays = $db->getResultArray();

        $i = 0;
        foreach($result['data'] AS $user){
            $db->setQuery(" SELECT  tf.userID AS UserID,
                                    p.tbl_schedule_type_id as schedule_type,
                                    tst.name as schedule_name,
                                    DAY(tf.authDate) as day, 
                                    tf.authDate,
                                    DATE_FORMAT(MIN(tf.authDateTime),'%H:%i') as real_in,
                                    DATE_FORMAT(MAX(tf.authDateTime),'%H:%i') as real_out,
                                    TIME_FORMAT(ADDTIME(tst.plan_in, '00:15'), '%H:%i') AS plan_in,
                                    tst.plan_out,
                                    tst.working_minutes * 60 AS working_seconds,
                                    tst.check_in,
                                    tst.check_out,
                                    tst.check_wm,
                                    tst.latecome,
                                    tst.earlygo,
                                    TIME_FORMAT(TIMEDIFF(MAX(tf.authDateTime) ,MIN(tf.authDateTime)), '%H:%i') as working_hours,
                                    TIMESTAMPDIFF(second, MIN(tf.authDateTime) ,MAX(tf.authDateTime)) as working_hours_seconds,
                                    tst.break
                                                
                                                

                            FROM 
                                tbl_facelog as tf
                            LEFT JOIN
                                users as p
                                    ON
                                        p.id = tf.userID 
                            LEFT JOIN
                                tbl_schedule_types as tst
                                    ON
                                        tst.id = p.tbl_schedule_type_id AND tst.deleted = 1 
                            WHERE 
                                tf.authDate >= '".$date_start."'  AND 
                                tf.authDate <= '$date_end' AND
                                tf.userID = '$user[user_id]'
                            GROUP BY
                                tf.userID ,
                                tf.authDate
                            ORDER BY 
                                tf.userID DESC,
                                tf.authDate");

            $attendance = $db->getResultArray()['result'];

            $total_worked_time = 0;
            $total_worked_nonwork_time = 0;
            $total_lated_time = 0;
            $total_additional_worked_time = 0;
            $total_lated_days = 0;

            foreach($attendance AS $times){
                $total_worked_time += $times['working_hours_seconds'];
    
                if(date("l", strtotime($times['authDate'])) == 'Saturday' || date("l", strtotime($times['authDate'])) == 'sunday' || in_array($times['authDate'], $holi_dates)){
                    $total_worked_nonwork_time += $times['working_hours_seconds'];
                }
    
                if($times['real_in'] > $times['plan_in']){
                    $start_time = strtotime($times['plan_in'].':00');
                    $end_time = strtotime($times['real_in'].':00');
    
                    $total_lated_time += $end_time - $start_time;
    
                    $total_lated_days++;
                }
    
                if($times['real_out'] < $times['plan_out']){
                    $start_time = strtotime($times['plan_out'].':00');
                    $end_time = strtotime($times['real_out'].':00');
    
                    $total_lated_time += $start_time - $end_time;
                }
    
    
                $real_in = strtotime($times['real_in'].':00');
                $real_out = strtotime($times['real_out'].':00');
    
                $check_additional_worked = $real_out - $real_in;
    
                if($check_additional_worked > $times['working_seconds']){
                    $total_additional_worked_time += $check_additional_worked - $times['working_seconds'];
                }
    
    
    
            }

            $result['data'][$i]['total_worked_time'] = calculate_hours($total_worked_time);
            $result['data'][$i]['total_worked_nonwork_time'] = calculate_hours($total_worked_nonwork_time);
            $result['data'][$i]['total_lated_time'] = calculate_hours($total_lated_time);
            $result['data'][$i]['total_additional_worked_time'] = calculate_hours($total_additional_worked_time);
            $result['data'][$i]['total_lated_days'] = calculate_hours($total_lated_days);
            $i++;
        }
        $data = $result;
    break;
    case 'get_list_dayoff':
        $id          =      $_REQUEST['hidden'];
		
        $columnCount = 		$_REQUEST['count'];
		$cols[]      =      $_REQUEST['cols'];
        $db->setQuery(" SELECT  vacations.id,
                                vacations_type.name,
                                CONCAT(users.firstname, ' ', users.lastname),
                                vacations.start_date,
                                vacations.end_date

                        FROM    vacations
                        JOIN    vacations_type ON vacations_type.id = vacations.type_id
                        JOIN    users ON users.id = vacations.user_id
                        WHERE   vacations.actived = 1");

        $result = $db->getKendoList($columnCount, $cols);
        $data = $result;
    break;
    case 'get_list_sch':
        $id          =      $_REQUEST['hidden'];
		
        $columnCount = 		$_REQUEST['count'];
		$cols[]      =      $_REQUEST['cols'];
        $db->setQuery(" SELECT  id,
                                name,
                                location_addr,
                                plan_in,
                                latecome,
                                ROUND(min_working_minutes/60,2) AS min_working_hours,
                                ROUND(working_minutes/60,2) AS working_hours,
                                vacation_days
                        FROM    tbl_schedule_types
                        WHERE   deleted = 1");

        $result = $db->getKendoList($columnCount, $cols);
        $data = $result;
    break;
    case 'get_list':
        $id          =      $_REQUEST['hidden'];
		
        $columnCount = 		$_REQUEST['count'];
		$cols[]      =      $_REQUEST['cols'];
        if($user_gr == 11){
            $where = "AND `groups`.id NOT IN (1,10,11,12,13,14,15)";
        }
            $db->setQuery("SELECT   users.id,
                                    `groups`.name,
                                    CONCAT(users.firstname,' ', users.lastname),
                                    users.position,
                                    users.pid,
                                    users.phone,
                                    users.birth_date,
                                    users.address,
                                    IF(users.pension = 1, 'კი', 'არა'),
                                    IF(users.social = 1, 'კი', 'არა')
                                    
                            FROM users
                            JOIN `groups` ON `groups`.id = users.group_id
                            WHERE users.actived = 1");

        $result = $db->getKendoList($columnCount, $cols);
        $data = $result;
    break;
    case 'get_list_branches':
        $id          =      $_REQUEST['hidden'];
		$obj_id      =      $_REQUEST['obj_id'];
        $columnCount = 		$_REQUEST['count'];
		$cols[]      =      $_REQUEST['cols'];

            $db->setQuery(" SELECT  object_branches.id,
                                    object_branches.name_geo,
                                    object_branches.name_rus,
                                    object_branches.name_eng,
                                    CONCAT(object_branches.start_work,' - ',object_branches.end_work) AS 'work_h',
                                    object_branches.phone,
                                    object_branches.address,
                                    CASE
                                        WHEN object_branches.size = 1 THEN 'პატარა'
                                        WHEN object_branches.size = 2 THEN 'საშუალო'
                                        WHEN object_branches.size = 3 THEN 'დიდი'
                                    END AS 'size',
                                    IF(object_branches.free_delivery = 1,'კი','არა')
                        FROM        object_branches
                        LEFT JOIN   objects ON object_branches.object_id = objects.id
                        WHERE       object_branches.object_id = '$obj_id'
                        ORDER BY    objects.id DESC");

        $result = $db->getKendoList($columnCount, $cols);
        $data = $result;
    break;
}


echo json_encode($data);
function getPageH($res = ''){
    GLOBAL $user_gr;

    $data .= '
    
    
    <fieldset class="fieldset">
        <legend>ინფორმაცია</legend>
        <div class="row">
            <div class="col-sm-6">
                <label>თარიღი</label>
                <input value="'.$res['tarigi'].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="tarigi" class="idle" autocomplete="off">
            </div>
            <div class="col-sm-6">
                <label>დასახელება</label>
                <input value="'.$res['name'].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="h_name" class="idle" autocomplete="off">
            </div>
            
        </div>
    </fieldset>
    
    <input type="hidden" id="holiday_id" value="'.$res['id'].'">
    ';

    return $data;
}
function getPageDayoff($res = ''){
    $data .= '
    
    
    <fieldset class="fieldset">
        <legend>ინფორმაცია</legend>
        <div class="row">
            <div class="col-sm-4" >
                <label>ტიპი</label>
                <select id="vacation_type">'.get_vac_type($res['type_id']).'</select>
            </div>
            <div class="col-sm-4" >
                <label>თანამშრომელი</label>
                <select id="user_id">'.get_users($res['user_id']).'</select>
            </div>
            <div class="col-sm-6" >
                <label>დასაწყისი</label>
                <input value="'.$res['start_date'].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="start_date" class="idle" autocomplete="off">
            </div>
            <div class="col-sm-6" >
                <label>დასასრული</label>
                <input value="'.$res['end_date'].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="end_date" class="idle" autocomplete="off">
            </div>
            

            
        </div>
    </fieldset>
    
    <input type="hidden" id="vacation_id" value="'.$res['id'].'">
    ';

    return $data;
}
function getPageGrafik($res = ''){
    $data .= '
    
    
    <fieldset class="fieldset">
        <legend>ინფორმაცია</legend>
        <div class="row">
            <div class="col-sm-4" >
                <label>სახელი</label>
                <input value="'.$res['name'].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="grafik_name" class="idle" autocomplete="off">
            </div>
            <div class="col-sm-4" >
                <label>მდებარეობა</label>
                <input value="'.$res['location_addr'].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="location_addr" class="idle" autocomplete="off">
            </div>
            <div class="col-sm-4" >
                <label>დაწყების დრო</label>
                <input value="'.$res['plan_in'].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="plan_in" class="idle" autocomplete="off">
            </div>
            <div class="col-sm-4" >
                <label>დაგვიანების ათვლა წუთებში</label>
                <input value="'.$res['latecome'].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="latecome" class="idle" autocomplete="off">
            </div>
            <div class="col-sm-4" >
                <label>მინ სამუშაო საათები (წუთებში)</label>
                <input value="'.$res['min_working_minutes'].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="min_working_minutes" class="idle" autocomplete="off">
            </div>
            <div class="col-sm-4" >
                <label>სავალდებულო სამუშაო საათები</label>
                <input value="'.$res['working_minutes'].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="working_minutes" class="idle" autocomplete="off">
            </div>
            <div class="col-sm-4" >
                <label>შვებულებები</label>
                <input value="'.$res['vacation_days'].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="vacation_days" class="idle" autocomplete="off">
            </div>

            
        </div>
    </fieldset>
    
    <input type="hidden" id="grafik_id" value="'.$res['id'].'">
    ';

    return $data;
}
function getPage($res = ''){
    GLOBAL $user_gr;
    if($user_gr == 11){
        $hide = 'style="display:none;"';
    }

    $data .= '
    
    
    <fieldset class="fieldset">
        <legend>ინფორმაცია</legend>
        <div class="row">
            <div class="col-sm-4">
                <label>ID</label>
                <input value="'.$res['id'].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="u_id" class="idle" autocomplete="off">
            </div>
            <div class="col-sm-4" '.$hide.'>
                <label>სახელი</label>
                <input value="'.$res['firstname'].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="firstname" class="idle" autocomplete="off">
            </div>
            <div class="col-sm-4" '.$hide.'>
                <label>გვარი</label>
                <input value="'.$res['lastname'].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="lastname" class="idle" autocomplete="off">
            </div>
            <div class="col-sm-4" '.$hide.'>
                <label>ტელეფონი</label>
                <input value="'.$res['phone'].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="phone" class="idle" autocomplete="off">
            </div>
            <div class="col-sm-4" '.$hide.'>
                <label>დაბადების თარიღი</label>
                <input value="'.$res['birth_date'].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="birth_date" class="idle" autocomplete="off">
            </div>
            <div class="col-sm-4" '.$hide.'>
                <label>პირადი ნომერი</label>
                <input value="'.$res['pid'].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="pid" class="idle" autocomplete="off">
            </div>
            <div class="col-sm-4" '.$hide.'>
                <label>პოზიცია</label>
                <input value="'.$res['position'].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="position" class="idle" autocomplete="off">
            </div>
            <div class="col-sm-4" '.$hide.'>
                <label>მისამართი</label>
                <input value="'.$res['address'].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="address" class="idle" autocomplete="off">
            </div>
            <div class="col-sm-4">
                <label>ჯგუფი</label>
                <select id="user_group">'.get_cat_1($res['group_id']).'</select>
            </div>
            <div class="col-sm-4">
                <label>საპენსიო</label>
                <select id="user_pension">'.get_yes_no($res['pension']).'</select>
            </div>
            <div class="col-sm-4">
                <label>სოციალური</label>
                <select id="user_social">'.get_yes_no($res['social']).'</select>
            </div>
            <div class="col-sm-4">
                <label>სამუშაო გრაფიკი</label>
                <select id="user_work_grafik">'.get_grafik_types($res['tbl_schedule_type_id']).'</select>
            </div>
            <div class="col-sm-4">
                <label>სურათი</label>
                <img id="upProdImg" src="'.$res['avatar'].'" style="width:100px; cursor: pointer;" >
                <input style="display:none;" type="file" id="product_file">
            </div>
            <div class="col-sm-4">
                <label>ხელშეკრულების ნომერი</label>
                <input value="'.$res['order_number'].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="order_number" class="idle" autocomplete="off">
            </div>

            <div class="col-sm-4">
                <label>ხელშეკრულების ფაილი</label>
                <input style="height: 48px!important;" type="file" id="order_file" class="upload_new_file">
                <a id="order_file_file" href="'.$res['order_file'].'" target="_blank"><img style="width:16px;" src="assets/img/file.png"> ნახვა</a>
            </div>


            <div class="col-sm-6">
                <label>რეესტრის ნომერი</label>
                <input value="'.$res['register_number'].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="register_number" class="idle" autocomplete="off">
            </div>

            <div class="col-sm-6">
                <label>რეესტრის ფაილი</label>
                <input style="height: 48px!important;" type="file" id="register_file" class="upload_new_file">
                <a id="register_file_file" href="'.$res['register_file'].'" target="_blank"><img style="width:16px;" src="assets/img/file.png"> ნახვა</a>
            </div>';

            $anketa_file = 'display:none;';
            $instructions_file = 'display:none;';
            $orderTaken_file = 'display:none;';

            if($res['anketa_checkbox'] == 1){
                $anket_checkbox = 'checked';
                $anketa_file = '';
                if($res['anket_file'] != ''){
                    $anketa_file_link = $res['anketa_file'];
                }
                else{
                    $anketa_file_link = '#';
                }
            }
            if($res['instructions_checkbox'] == 1){
                $instructions_checkbox = 'checked';
                $instructions_file = '';

                if($res['instructions_file'] != ''){
                    $instructions_file_link = $res['instructions_file'];
                }
                else{
                    $instructions_file_link = '#';
                }
            }
            if($res['orderTaken_checkbox'] == 1){
                $orderTaken_checkbox = 'checked';
                $orderTaken_file = '';

                if($res['orderTaken_file'] != ''){
                    $orderTaken_file_link = $res['orderTaken_file'];
                }
                else{
                    $orderTaken_file_link = '#';
                }
            }

            $data .= '            <div class="col-sm-6">
                <label>ანკეტა <input type="checkbox" id="anketa_checkbox" style="position: absolute;left: 68px;" '.$anket_checkbox.'></label><br>
                

                <input style="height: 48px!important;'.$anketa_file.'" type="file" id="anketa_file" class="upload_new_file">


                <a id="anketa_file_file" href="'.$anketa_file_link.'" style="'.$anketa_file.'" target="_blank"><img style="width:16px;" src="assets/img/file.png"> ნახვა</a>
            </div>

            <div class="col-sm-6">
                <label>თანამდებობრივი ინსტრუქცია <input type="checkbox" id="instructions_checkbox" style="position: absolute;left: 240px;" '.$instructions_checkbox.'></label><br>
                

                <input style="height: 48px!important;'.$instructions_file.'" type="file" id="instructions_file" class="upload_new_file">

                <a id="instructions_file_file" href="'.$instructions_file_link.'" style="'.$instructions_file.'" target="_blank"><img style="width:16px;" src="assets/img/file.png"> ნახვა</a>
            </div>
            <div class="col-sm-6">
                <label>მიღების ბრძანება<input type="checkbox" id="orderTaken_checkbox" style="position: absolute;left: 145px;" '.$orderTaken_checkbox.'></label><br>
                

                <input style="height: 48px!important;'.$orderTaken_file.'" type="file" id="orderTaken_file" class="upload_new_file">

                <a id="orderTaken_file_file" href="'.$orderTaken_file_link.'" style="'.$orderTaken_file.'" target="_blank"><img style="width:16px;" src="assets/img/file.png"> ნახვა</a>
            </div>



            
        </div>
    </fieldset>
    
    <input type="hidden" id="user_id" value="'.$res['id'].'">
    ';

    return $data;
}
function get_yes_no($id){
    $data = '';
    $checked_1 = '';
    $checked_2 = '';
    if($id == 1){
        $checked_1 = 'selected';
    }
    else{
        $checked_2 = 'selected';
    }


    $data .= '<option '.$checked_2.' value="0">არა</option>';
    $data .= '<option '.$checked_1.' value="1">კი</option>';
    

    return $data;
}
function get_users($id){
    GLOBAL $db,$user_gr;


    $data = '';
    $db->setQuery("SELECT   id,
                            CONCAT(firstname,' ', lastname) AS 'name'
                    FROM    `users`
                    WHERE   actived = 1");
    $cats = $db->getResultArray();
    $data .= '<option value="0" selected="selected">აირჩიეთ</option>';
    foreach($cats['result'] AS $cat){
        if($cat[id] == $id){
            $data .= '<option value="'.$cat[id].'" selected="selected">'.$cat[name].'</option>';
        }
        else{
            $data .= '<option value="'.$cat[id].'">'.$cat[name].'</option>';
        }
        
    }

    return $data;
}
function get_vac_type($id){
    GLOBAL $db,$user_gr;


    $data = '';
    $db->setQuery("SELECT   id,
                            name AS 'name'
                    FROM    `vacations_type`
                    WHERE   actived = 1");
    $cats = $db->getResultArray();
    $data .= '<option value="0" selected="selected">აირჩიეთ</option>';
    foreach($cats['result'] AS $cat){
        if($cat[id] == $id){
            $data .= '<option value="'.$cat[id].'" selected="selected">'.$cat[name].'</option>';
        }
        else{
            $data .= '<option value="'.$cat[id].'">'.$cat[name].'</option>';
        }
        
    }

    return $data;
}
function get_grafik_types($id){
    GLOBAL $db,$user_gr;


    $data = '';
    $db->setQuery("SELECT   id,
                            name AS 'name'
                    FROM    `tbl_schedule_types`
                    WHERE   deleted = 1");
    $cats = $db->getResultArray();
    $data .= '<option value="0" selected="selected">აირჩიეთ</option>';
    foreach($cats['result'] AS $cat){
        if($cat[id] == $id){
            $data .= '<option value="'.$cat[id].'" selected="selected">'.$cat[name].'</option>';
        }
        else{
            $data .= '<option value="'.$cat[id].'">'.$cat[name].'</option>';
        }
        
    }

    return $data;
}
function get_cat_1($id){
    GLOBAL $db,$user_gr;
    $data = '';

    if($user_gr == 11){
        $where = "AND id NOT IN (1,10,11,12,13,14,15)";
    }
    $db->setQuery("SELECT   id,
                            name AS 'name'
                    FROM    `groups`
                    WHERE   actived = 1 $where");
    $cats = $db->getResultArray();
    $data .= '<option value="0" selected="selected">აირჩიეთ</option>';
    foreach($cats['result'] AS $cat){
        if($cat[id] == $id){
            $data .= '<option value="'.$cat[id].'" selected="selected">'.$cat[name].'</option>';
        }
        else{
            $data .= '<option value="'.$cat[id].'">'.$cat[name].'</option>';
        }
        
    }

    return $data;
}

function getHoliday($id){
    GLOBAL $db;

    $db->setQuery(" SELECT      holidays.id,
                                holidays.name,
                                holidays.tarigi

                    FROM        holidays
                    WHERE       holidays.id = '$id'");
    $result = $db->getResultArray();

    return $result['result'][0];
}
function getDayoff($id){
    GLOBAL $db;
    $db->setQuery(" SELECT      *

                    FROM        vacations
                    WHERE       vacations.id = '$id'");
    $result = $db->getResultArray();

    return $result['result'][0];
}
function getGrafik($id){
    GLOBAL $db;
    $db->setQuery(" SELECT      *

                    FROM        tbl_schedule_types
                    WHERE       tbl_schedule_types.id = '$id'");
    $result = $db->getResultArray();

    return $result['result'][0];
}
function getObject($id){
    GLOBAL $db;

    $db->setQuery(" SELECT      users.id,
                                users.firstname,
                                users.lastname,
                                users.pid,
                                users.phone,
                                users.group_id,
                                users.username,
                                users.password,
                                users.position,
                                users.birth_date,
                                users.address,
                                users.social,
                                users.pension,
                                users.avatar,
                                users.order_number,
                                users.order_file,
                                users.register_number,
                                users.register_file,

                                users.anketa_checkbox,
                                users.anketa_file,
                                users.instructions_checkbox,
                                users.instructions_file,
                                users.orderTaken_checkbox,
                                users.orderTaken_file,
                                users.tbl_schedule_type_id

                    FROM        users
                    WHERE       users.id = '$id'");
    $result = $db->getResultArray();

    return $result['result'][0];
}
function calculate_hours($seconds = 0){// Example: 100,000 seconds

    $totalHours = floor($seconds / 3600);
    $remainingSeconds = $seconds % 3600;
    $minutes = floor($remainingSeconds / 60);

    $timeFormat = sprintf('%02d:%02d', $totalHours, $minutes);

    return $timeFormat;
}
?>