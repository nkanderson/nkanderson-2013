<?php

    include '../../zxcv.php';
    header('Content-Type: application/json');

    $endorsers = array();
    $zip = $_POST['zip'];

    foreach($_POST as $k => $v) {
      if($v == 'on') {
        $endorsers[] = htmlspecialchars($k);
      }
    }

    //$endorser = $endorsers[0];
    //$endorser = "olcv";
    //settype($endorser, "string");
    $returnData = array();

    foreach($endorsers as $endorser => $abbrev) {
      try {

        $connection = new PDO('mysql:host=localhost;dbname=nkanders_vote;charset=utf8', $username, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $statement = $connection->prepare('SELECT DISTINCT c.name AS cand_name, e.name AS end_name, house, district, Federal FROM candidates c JOIN end_cand ec ON (ec.cand_id = c.id) JOIN endorsements e ON (ec.end_id = e.id) AND (e.abbrev = :endorser) ORDER BY district');
        $statement->execute(array(':endorser' => $abbrev));

        $results = $statement->fetchAll();

        $parsedData = array();
        //$i = 0;
        foreach($results as $mysqlResult => $cand_end) {
          // Want to return data by seat - so first need to parse data into seat name keys
          $parsedSeat = '';
          if (!$cand_end['Federal']) {
            $parsedSeat = 'OR State ';
          }
          // may consolidate Senate into else statement...
          if ($cand_end['house'] == 'Senate') {
            $parsedSeat = $parsedSeat . $cand_end['house'];
          } else if ($cand_end['house'] == 'Representative') {
            $parsedSeat = $parsedSeat . 'House of Rep.';
          } else {
            $parsedSeat = $parsedSeat . $cand_end['house'];
          }
          if ($cand_end['district']) {
            $parsedSeat = $parsedSeat . ', District ' . $cand_end['district'];
          }

          $returnData[$parsedSeat][$cand_end['cand_name']][] = $cand_end['end_name'];
          //$i++;
        };

        if (isset($returnData)) {
          continue;
        } else {
          $error = array('error_message' => 'Sorry, Charlie');
        }
      } catch(PDOException $e) {
          echo 'ERROR: ' . $e->getMessage();
      }
    }

    if (isset($returnData)) {
      echo json_encode($returnData);
    } else {
      echo json_encode($error);
    }

?>
