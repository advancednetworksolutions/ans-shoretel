<?php

error_reporting(-1);
ini_set('display_errors', 'On');
require('../../../config/config.php');

if(isset($_GET['type'])){
  $type = $_GET['type'];
  if($type == 'hours'){
    $query ="SELECT company_name,
    sum(hours_actual)/3 as avg,
    sum(case when DATEPART(m, t1.date_start) = DATEPART(m, DATEADD(m, -1, getdate()))  then t1.hours_actual else 0 end) as lastMonth,
    sum(case when DATEPART(m, t1.date_start) = DATEPART(m, DATEADD(m, -1, getdate()))  then t1.hours_actual else 0 end) - sum(hours_actual)/3 as increase_decrease
    FROM time_entry t1
    left outer join company on t1.company_RecID = company.company_RecID
    where company_name != 'Catchall (from email connector)' and t1.pm_project_recid is null and t1.date_start >= dateadd(mm,datediff(mm,0,getdate())-3,0)  and t1.date_start < DATEADD(MONTH, DATEDIFF(MONTH, 0, GETDATE()), 0)
    AND t1.date_start <= DATEADD(dd,-(DAY(getdate())),getdate()) and company_name!='Advanced Network Solutions'   group by company_name";
  }else if($type == 'tickets'){
    $query="SELECT company_name,
    count(sr_service_recid)/3 as avg,
    count( distinct(case when DATEPART(m, t1.date_entered) = DATEPART(m, DATEADD(m, -1, getdate()))  then t1.sr_service_recid else 0 end)) as lastMonth,
    count(distinct(case when DATEPART(m, t1.date_entered) = DATEPART(m, DATEADD(m, -1, getdate()))  then t1.sr_service_recid else 0 end)) - case when count(case when month(t1.date_entered) != month(getdate())  then t1.sr_service_recid else 0 end) > 0 then count(case when month(t1.date_entered) != month(getdate())  then t1.sr_service_recid else 0 end)/3 else 0 end as increase_decrease
      FROM v_rpt_service t1
      where company_name !='Advanced Network Solutions' and company_name != 'Catchall (from email connector)' and parent is null and date_entered >= dateadd(mm,datediff(mm,0,getdate())-3,0)  and date_entered < DATEADD(MONTH, DATEDIFF(MONTH, 0, GETDATE()), 0)
      AND board_name !='Alerts - ANS' AND board_name != 'Alerts - Service Delivery' and board_name != 'BackOffice' and board_name !='Internal Support' and board_name !='LogicMonitor' and board_name != 'Managed Services - Initiatives' and board_name != 'Managed Services - Requests' and board_name != 'Results - Initiatives' group by company_name";
  }
}

$hours = mssql_query($query);
$query1 = str_replace('"',"",$query);

$all_rows = array();
while($row = mssql_fetch_assoc($hours)) {
    $all_rows []= $row;
}

header("Content-Type: application/json");
echo json_encode($all_rows);

?>
