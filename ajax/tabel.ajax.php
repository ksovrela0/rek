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

        $month = '05';
        $year = 2023;

        $targetMonth = $year.'-'.$month;

        $filteredDate = date("Y-m", strtotime($targetMonth));
        $lastDate = date("Y-m-t", strtotime($targetMonth));
        $where2 = ' AND tf.userID = '.$person_id;

        $db->setQuery(" SELECT  tf.userID AS UserID,
                                p.tbl_schedule_type_id as schedule_type,
                                tst.name as schedule_name,
                                DAY(tf.authDate) as day, 
                                DATE_FORMAT(MIN(tf.authDateTime),'%H:%i') as real_in,
                                DATE_FORMAT(MAX(tf.authDateTime),'%H:%i') as real_out,
                                tst.plan_in,
                                tst.plan_out,
                                tst.working_minutes,
                                tst.check_in,
                                tst.check_out,
                                tst.check_wm,
                                tst.latecome,
                                tst.earlygo,
                                TIME_FORMAT(TIMEDIFF(MAX(tf.authDateTime) ,MIN(tf.authDateTime)), '%H:%i') as working_hours,
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


        $data['result'] = $attendance;
        break;
}

echo json_encode($data);

?>