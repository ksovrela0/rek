<?php
error_reporting(E_ERROR);
include('../db.php');
GLOBAL $db;
$db = new dbClass();
$act = $_REQUEST['act'];
$user_id = $_SESSION['USERID'];

$data = array();
switch ($act){
    case 'get_tabel_data':
        $person_id = $_REQUEST['user_id'];
        $year = $_REQUEST['year'];
        $month = $_REQUEST['month'];

        $month = $month;
        $year = $year;

        $holi_dates = array();

        $targetMonth = $year.'-'.$month;

        $filteredDate = date("Y-m", strtotime($targetMonth));
        $lastDate = date("Y-m-t", strtotime($targetMonth));
        $where2 = ' AND tf.userID = '.$person_id;

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
                            tf.authDate >= '".$filteredDate."-01'  AND 
                            tf.authDate <= '$lastDate' $where2
                        GROUP BY
                            tf.userID ,
                            tf.authDate
                        ORDER BY 
                            tf.userID DESC,
                            tf.authDate");
                
        $attendance = $db->getResultArray()['result'];

        $db->setQuery(" SELECT 
                            *,
                            DAY(tarigi) AS day_of_month
                        FROM 
                            holidays
                        WHERE 
                            tarigi >= '".$filteredDate."-01'  AND 
                            tarigi <= '".$lastDate."'");
        $holidays = $db->getResultArray();


        foreach($holidays['result'] AS $holiday){
            array_push($holi_dates, $holiday['tarigi']);
        }
        //var_dump($holi_dates);
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


        $data['result'] = $attendance;


        
        $data['holidays'] = $holidays['result'] == '' ? array() :  $holidays['result'];



        $data['working_hours_total'] = calculate_hours($total_worked_time);
        $data['total_worked_nonwork_hours'] = calculate_hours($total_worked_nonwork_time);
        $data['total_lated_hours'] = calculate_hours($total_lated_time);
        $data['total_additional_worked_hours'] = calculate_hours($total_additional_worked_time);
        $data['total_lated_days'] = $total_lated_days;
        break;
}

echo json_encode($data);

function calculate_hours($seconds = 0){// Example: 100,000 seconds

    $totalHours = floor($seconds / 3600);
    $remainingSeconds = $seconds % 3600;
    $minutes = floor($remainingSeconds / 60);

    $timeFormat = sprintf('%02d:%02d', $totalHours, $minutes);

    return $timeFormat;
}

?>