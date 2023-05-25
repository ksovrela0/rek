<?php
error_reporting(E_ERROR);
include('db.php');
include('includes/excel/PHPExcel.php');
GLOBAL $db;
$db = new dbClass();
$act = $_REQUEST['act'];
$user_id = $_SESSION['USERID'];
$user_gr = $_SESSION['GRPID'];
switch ($act){
    case 'admin_export':
        $report_date = explode(' - ', $_REQUEST['report_date']);
        $group_id = $_REQUEST['group_id'];
        $date_start = $report_date[0];
        $date_end = $report_date[1];
        $where = '';
        if($group_id != ''){
            $where = " AND users.group_id = '$group_id'";
        }

        $objPHPExcel    =   new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'თარიღი');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'ჯგუფი');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'თანამდეობა');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'სახელი');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'გვარი');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'ტელეფონი');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'პ.რ ნომერი');
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'დაბ თარიღი');
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'მისამართი');
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'საპენსიო');
        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'სოციალური');
        $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'ნამ. საათები');
        $objPHPExcel->getActiveSheet()->SetCellValue('M1', 'უქ. ნამ საათები');
        $objPHPExcel->getActiveSheet()->SetCellValue('N1', 'დამ საათები');
        $objPHPExcel->getActiveSheet()->SetCellValue('O1', 'გაცდ საათები');
        $objPHPExcel->getActiveSheet()->SetCellValue('P1', 'დაგვიანებული დღეები');


        $objPHPExcel->getActiveSheet()->getStyle('A1:P1')->getFill()->applyFromArray(array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array(
                 'rgb' => 'A9D08E'
            )
        ));



        $db->setQuery(" SELECT  users.id,
                                `groups`.name AS group_name,
                                users.position,
                                users.firstname,
                                users.lastname,
                                users.phone,
                                users.pid,
                                users.birth_date,
                                users.address,
                                IF(users.pension = 1, 'კი', 'არა') AS pens,
                                IF(users.social = 1, 'კი', 'არა') AS soc,
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

        $result = $db->getResultArray();

        $db->setQuery(" SELECT 
                            *,
                            DAY(tarigi) AS day_of_month
                        FROM 
                            holidays
                        WHERE 
                            tarigi >= '".$date_start."'  AND 
                            tarigi <= '".$date_end."'
                            LIMIT 1");
        $holidays = $db->getResultArray();

        $i = 0;
        foreach($result['result'] AS $user){
            $tabel_data = get_hours($user['id'],$date_start,$date_end);
            $result['result'][$i]['total_worked_time'] =              $tabel_data['total_worked_time'];
            $result['result'][$i]['total_worked_nonwork_time'] =      $tabel_data['total_worked_nonwork_time'];
            $result['result'][$i]['total_lated_time'] =               $tabel_data['total_lated_time'];
            $result['result'][$i]['total_additional_worked_time'] =   $tabel_data['total_additional_worked_time'];
            $result['result'][$i]['total_lated_days'] =               $tabel_data['total_lated_days'];
            $i++;
        }

        $rowCount = 2;
        foreach($result['result'] AS $user){
            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $_REQUEST['report_date']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $user['group_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $user['position']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $user['firstname']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $user['lastname']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $user['phone']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $user['pid']);
            $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, $user['birth_date']);
            $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, $user['address']);
            $objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, $user['pens']);
            $objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount, $user['soc']);
            $objPHPExcel->getActiveSheet()->SetCellValue('L'.$rowCount, $user['total_worked_time']);
            $objPHPExcel->getActiveSheet()->SetCellValue('M'.$rowCount, $user['total_worked_nonwork_time']);
            $objPHPExcel->getActiveSheet()->SetCellValue('N'.$rowCount, $user['total_lated_time']);
            $objPHPExcel->getActiveSheet()->SetCellValue('O'.$rowCount, $user['total_additional_worked_time']);
            $objPHPExcel->getActiveSheet()->SetCellValue('P'.$rowCount, $user['total_lated_days']);

            $rowCount++;
        }


        $objWriter  =   new PHPExcel_Writer_Excel2007($objPHPExcel);
 
 
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="admin-report-'.$_REQUEST['report_date'].'.xlsx"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');  
        $objWriter->save('php://output');
    break;
}


function get_hours($user,$date_start,$date_end){
    GLOBAL $db;
    $data = array();

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
                                tf.userID = '$user'
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

            $data['total_worked_time'] = calculate_hours($total_worked_time);
            $data['total_worked_nonwork_time'] = calculate_hours($total_worked_nonwork_time);
            $data['total_lated_time'] = calculate_hours($total_lated_time);
            $data['total_additional_worked_time'] = calculate_hours($total_additional_worked_time);
            $data['total_lated_days'] = calculate_hours($total_lated_days);

            return $data;
}
function calculate_hours($seconds = 0){// Example: 100,000 seconds

    $totalHours = floor($seconds / 3600);
    $remainingSeconds = $seconds % 3600;
    $minutes = floor($remainingSeconds / 60);

    $timeFormat = sprintf('%02d:%02d', $totalHours, $minutes);

    return $timeFormat;
}
?>