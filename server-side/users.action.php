<?php
error_reporting(E_ERROR);
include('../db.php');
GLOBAL $db;
$db = new dbClass();
$act = $_REQUEST['act'];
$user_id = $_SESSION['USERID'];
$user_gr = $_SESSION['GRPID'];
switch ($act){
    case 'get_add_page':
        $id = $_REQUEST['id'];
        $data = array('page' => getPage());
    break;
    case 'get_edit_page':
        $id = $_REQUEST['id'];
        $data = array('page' => getPage(getObject($id)));
    break;
    case 'save_user':
        $id = $_REQUEST['id'];


        $firstname = $_REQUEST['firstname'];
        $lastname = $_REQUEST['lastname'];
        $pid = intval($_REQUEST['pid']);
        $phone = $_REQUEST['phone'];
        $group_id = $_REQUEST['user_group'];
        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];
        
        if($id == ''){
            $db->setQuery(" INSERT INTO users SET firstname = '$firstname',
                                                    lastname = '$lastname',
                                                    pid = '$pid',
                                                    phone = '$phone',
                                                    group_id = '$group_id',
                                                    username = '$username',
                                                    password = '$password'");
            $db->execQuery();
        }
        else{
            $db->setQuery(" UPDATE  users 
                            SET    firstname = '$firstname',
                                                lastname = '$lastname',
                                                pid = '$pid',
                                                phone = '$phone',
                                                group_id = '$group_id',
                                                username = '$username',
                                                password = '$password'
                            WHERE   id = '$id'");
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
    case 'get_list_admins':
        $id          =      $_REQUEST['hidden'];
        $report_date = explode(' - ', $_REQUEST['report_date']);
        $date_start = $report_date[0];
        $date_end = $report_date[1];


        
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
                            WHERE   users.actived = 1 AND users.group_id != 1
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

function getPage($res = ''){
    GLOBAL $user_gr;
    if($user_gr == 11){
        $hide = 'style="display:none;"';
    }

    $data .= '
    
    
    <fieldset class="fieldset">
        <legend>ინფორმაცია</legend>
        <div class="row">
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
                <label>პირადი ნომერი</label>
                <input value="'.$res['pid'].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="pid" class="idle" autocomplete="off">
            </div>
            <div class="col-sm-4">
                <label>ჯგუფი</label>
                <select id="user_group">'.get_cat_1($res['group_id']).'</select>
            </div>
            

            <div class="col-sm-4" '.$hide.'>
                <label>username</label>
                <input value="'.$res['username'].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="username" class="idle" autocomplete="off">
            </div>
            <div class="col-sm-4" '.$hide.'>
                <label>პაროლი</label>
                <input value="'.$res['password'].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="password" class="idle" autocomplete="off">
            </div>
        </div>
    </fieldset>
    
    <input type="hidden" id="user_id" value="'.$res['id'].'">
    ';

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
function getObject($id){
    GLOBAL $db;

    $db->setQuery(" SELECT      users.id,
                                users.firstname,
                                users.lastname,
                                users.pid,
                                users.phone,
                                users.group_id,
                                users.username,
                                users.password

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