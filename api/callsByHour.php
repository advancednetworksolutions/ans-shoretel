<?php

include('../../../config/shoretel_config.php');

if(isset($_GET['avg']) && $_GET['avg'] == 'true'){
  if(isset($_GET['filter'])){
    $f = $_GET['filter'];
    $g = $_GET['grouping'];
    $grouping = '';

    switch($g){
      case 'day':
          $grouping = 'DATE(shorewarecdr.queueCall.StartTime)';
        break;
      case 'week':
          $grouping = 'WEEKOFYEAR(DATE(shorewarecdr.queueCall.StartTime))';
        break;
      case 'month':
          $grouping = 'MONTH(DATE(shorewarecdr.queueCall.StartTime))';
        break;
      case 'quarter':
          $grouping = 'QUARTER(DATE(shorewarecdr.queueCall.StartTime))';
        break;
      default:
          $grouping = 'DATE(shorewarecdr.queueCall.StartTime)';
        break;
    }

    switch ($f) {
      case 'today':
      $query = 'SELECT HOUR(shorewarecdr.queueCall.StartTime) as hour,COUNT(*) as calls,'.$grouping.' as grouping FROM shorewarecdr.queueCall WHERE  (Extension = 405 OR Extension = 505)  AND DATE(shorewarecdr.queueCall.StartTime) = curdate() group by HOUR(shorewarecdr.queueCall.StartTime),'.$grouping.';';
        break;
      case 'yesterday':
      $query = 'SELECT HOUR(shorewarecdr.queueCall.StartTime) as hour,COUNT(*) as calls,'.$grouping.' as grouping FROM shorewarecdr.queueCall WHERE  (Extension = 405 OR Extension = 505)  AND DATE(shorewarecdr.queueCall.StartTime) = curdate() -1 group by HOUR(shorewarecdr.queueCall.StartTime),'.$grouping.';';
        break;
      case 'this week':
        $query = 'SELECT hour,
                        AVG(calls) as calls
                        FROM(SELECT
        HOUR(shorewarecdr.queueCall.StartTime) as hour,
        COUNT(*) as calls,'.$grouping.' as grouping
        FROM shorewarecdr.queueCall
        WHERE TargetType = 1
        AND (QueueDN = 405 OR QueueDN = 505)
        AND WEEKOFYEAR(DATE(shorewarecdr.queueCall.StartTime))=WEEKOFYEAR(NOW())
        group by HOUR(shorewarecdr.queueCall.StartTime),'.$grouping.') temp
        GROUP BY hour';
        break;
      case 'this month':
      $query = 'SELECT hour,
                      AVG(calls) as calls
                      FROM(SELECT
      HOUR(shorewarecdr.queueCall.StartTime) as hour,
      COUNT(*) as calls,'.$grouping.' as grouping
      FROM shorewarecdr.queueCall
      WHERE TargetType = 1
      AND (QueueDN = 405 OR QueueDN = 505)
      AND MONTH(DATE(shorewarecdr.queueCall.StartTime))=MONTH(NOW())
      group by HOUR(shorewarecdr.queueCall.StartTime),'.$grouping.') temp
      GROUP BY hour';
        break;
      case 'this quarter':
      $query = 'SELECT hour,
                      AVG(calls) as calls
                      FROM(SELECT
      HOUR(shorewarecdr.queueCall.StartTime) as hour,
      COUNT(*) as calls,'.$grouping.' as grouping
      FROM shorewarecdr.queueCall
      WHERE TargetType = 1
      AND (QueueDN = 405 OR QueueDN = 505)
      AND QUARTER(DATE(shorewarecdr.queueCall.StartTime))=QUARTER(CURDATE())
      group by HOUR(shorewarecdr.queueCall.StartTime),'.$grouping.') temp
      GROUP BY hour';
      break;
      case 'last quarter':
      $query = 'SELECT hour,
                      AVG(calls) as calls
                      FROM(SELECT
      HOUR(shorewarecdr.queueCall.StartTime) as hour,
      COUNT(*) as calls,'.$grouping.' as grouping
      FROM shorewarecdr.queueCall
      WHERE TargetType = 1
      AND (QueueDN = 405 OR QueueDN = 505)
      AND QUARTER(DATE(shorewarecdr.queueCall.StartTime))=QUARTER(CURDATE()) -1
      group by HOUR(shorewarecdr.queueCall.StartTime),'.$grouping.') temp
      GROUP BY hour';
      break;
      case 'last month':
      $query = 'SELECT hour,
                      AVG(calls) as calls
                      FROM(SELECT
      HOUR(shorewarecdr.queueCall.StartTime) as hour,
      COUNT(*) as calls,'.$grouping.' as grouping
      FROM shorewarecdr.queueCall
      WHERE TargetType = 1
      AND (QueueDN = 405 OR QueueDN = 505)
      AND MONTH(DATE(shorewarecdr.queueCall.StartTime))=MONTH(NOW())-1
      group by HOUR(shorewarecdr.queueCall.StartTime),'.$grouping.') temp
      GROUP BY hour';
        break;
      default:
      $query = 'SELECT HOUR(shorewarecdr.queueCall.StartTime) as hour,COUNT(*) as calls,'.$grouping.' as grouping FROM shorewarecdr.queueCall WHERE  (QueueDN = 405 OR QueueDN = 505)  AND DATE(shorewarecdr.queueCall.StartTime) = curdate() group by HOUR(shorewarecdr.queueCall.StartTime),'.$grouping.';';
        break;
    }
  }
}else{
  if(isset($_GET['filter'])){
    $f = $_GET['filter'];
    $g = $_GET['grouping'];
    $grouping = '';

    switch($g){
      case 'day':
          $grouping = 'DATE(shorewarecdr.queueCall.StartTime)';
        break;
      case 'week':
          $grouping = 'WEEKOFYEAR(DATE(shorewarecdr.queueCall.StartTime))';
        break;
      case 'month':
          $grouping = 'MONTH(DATE(shorewarecdr.queueCall.StartTime))';
        break;
      case 'quarter':
          $grouping = 'QUARTER(DATE(shorewarecdr.queueCall.StartTime))';
        break;
      default:
          $grouping = 'DATE(shorewarecdr.queueCall.StartTime)';
        break;
    }

    switch ($f) {
      case 'today':
      $query = 'SELECT HOUR(shorewarecdr.queueCall.StartTime) as hour,COUNT(*) as calls,'.$grouping.' as grouping FROM shorewarecdr.queueCall WHERE (QueueDN = 405 OR QueueDN = 505)  AND DATE(shorewarecdr.queueCall.StartTime) = curdate() group by HOUR(shorewarecdr.queueCall.StartTime),'.$grouping.';';
        break;
      case 'yesterday':
      $query = 'SELECT HOUR(shorewarecdr.queueCall.StartTime) as hour,COUNT(*) as calls,'.$grouping.' as grouping FROM shorewarecdr.queueCall WHERE (QueueDN = 405 OR QueueDN = 505)  AND DATE(shorewarecdr.queueCall.StartTime) = curdate() -1 group by HOUR(shorewarecdr.queueCall.StartTime),'.$grouping.';';
        break;
      case 'this week':
        $query = 'SELECT HOUR(shorewarecdr.queueCall.StartTime) as hour,COUNT(*) as calls,'.$grouping.' as grouping FROM shorewarecdr.queueCall WHERE  (QueueDN = 405 OR QueueDN = 505)  AND WEEKOFYEAR(DATE(shorewarecdr.queueCall.StartTime))=WEEKOFYEAR(NOW()) group by HOUR(shorewarecdr.queueCall.StartTime),'.$grouping.';';
        break;
      case 'this month':
        $query = 'SELECT HOUR(shorewarecdr.queueCall.StartTime) as hour,COUNT(*) as calls,'.$grouping.' as grouping FROM shorewarecdr.queueCall WHERE  (QueueDN = 405 OR QueueDN = 505)  AND MONTH(DATE(shorewarecdr.queueCall.StartTime))=MONTH(curdate()) group by HOUR(shorewarecdr.queueCall.StartTime),'.$grouping.';';
        break;
      case 'this quarter':
        $query = 'SELECT HOUR(shorewarecdr.queueCall.StartTime) as hour,COUNT(*) as calls,'.$grouping.' as grouping FROM shorewarecdr.queueCall WHERE  (QueueDN = 405 OR QueueDN = 505)  AND QUARTER(DATE(shorewarecdr.queueCall.StartTime))=QUARTER(curdate()) group by HOUR(shorewarecdr.queueCall.StartTime),'.$grouping.';';
        break;
      case 'last quarter':
          $query = 'SELECT HOUR(shorewarecdr.queueCall.StartTime) as hour,COUNT(*) as calls,'.$grouping.' as grouping FROM shorewarecdr.queueCall WHERE  (QueueDN = 405 OR QueueDN = 505)  AND QUARTER(DATE(shorewarecdr.queueCall.StartTime))=QUARTER(curdate())-1 group by HOUR(shorewarecdr.queueCall.StartTime),'.$grouping.';';
        break;
        case 'last month':
          $query = 'SELECT HOUR(shorewarecdr.queueCall.StartTime) as hour,COUNT(*) as calls,'.$grouping.' as grouping FROM shorewarecdr.queueCall WHERE  (QueueDN = 405 OR QueueDN = 505)  AND MONTH(DATE(shorewarecdr.queueCall.StartTime))=MONTH(curdate())-1 group by HOUR(shorewarecdr.queueCall.StartTime),'.$grouping.';';
          break;
      default:
      $query = 'SELECT HOUR(shorewarecdr.queueCall.StartTime) as hour,COUNT(*) as calls,'.$grouping.' as grouping FROM shorewarecdr.queueCall WHERE  (QueueDN = 405 OR QueueDN = 505)  AND DATE(shorewarecdr.queueCall.StartTime) = curdate() group by HOUR(shorewarecdr.queueCall.StartTime),'.$grouping.';';
        break;
    }
  }
}


$results=mysqli_query($con,$query);
$all_rows = array();

while($row = mysqli_fetch_assoc($results)){
  $all_rows [] = $row;
}

header("Content-Type: application/json");
echo json_encode($all_rows);
mysqli_close($con);

?>
