<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $_SERVER['REQUEST_URI'] ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
  </head>
  <!--

  This script creates the JSON with all MPs.

  -->
  <body>
    <?php
      $url = $_SERVER['REQUEST_URI'];
      $url = str_replace(array("/", "datan", "scripts", ".php"), "", $url);
      $url_current = substr($url, 0, 2);
      $url_next = $url_current + 1;
    ?>
		<div class="container" style="background-color: #e9ecef;">
			<div class="row">
				<h1>Create table organes_stats</h1>
			</div>
			<div class="row">
				<div class="col-4">
					<a class="btn btn-outline-primary" href="./" role="button">Back</a>
				</div>
				<div class="col-4">
					<a class="btn btn-outline-secondary" href="http://<?php echo $_SERVER['SERVER_NAME']. ''.$_SERVER['REQUEST_URI'] ?>" role="button">Refresh</a>
				</div>
				<div class="col-4">
					<a class="btn btn-outline-success" href="./" role="button">END</a>
				</div>
			</div>
			<div class="row mt-3">
        <div class="col">
          <p>Create deputes_json.json</p>
          <?php
            include 'bdd-connexion.php';

            $bdd->query("DROP TABLE IF EXISTS groupes_stats");

            $bdd->query('CREATE TABLE groupes_stats ( organeRef VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , womenPct DECIMAL(4,2) NULL , womenN INT(3) NULL  , age DECIMAL(4,2) NULL ) ENGINE = MyISAM;');



            $reponse = $bdd->query('
            SELECT *
            FROM organes
            WHERE legislature = 15 AND coteType = "GP"
            ');

            $i = 1;
            $array = array();
            while ($data = $reponse->fetch()) {
              $groupeId = $data['uid'];

              $age_response = $bdd->query('
                SELECT A.organeRef, ROUND(AVG(age), 2) AS age, COUNT(age) as n
                FROM
                (
                  SELECT t1.organeRef, t1.legislature, t1.mpId,
                  YEAR(current_timestamp()) - YEAR(d.birthDate) - CASE WHEN MONTH(current_timestamp()) < MONTH(d.birthDate) OR (MONTH(current_timestamp()) = MONTH(d.birthDate) AND DAY(current_timestamp()) < DAY(d.birthDate)) THEN 1 ELSE 0 END AS age
                  FROM mandat_groupe t1
                  LEFT JOIN deputes d ON d.mpId = t1.mpId
                  WHERE t1.typeOrgane = "GP" AND t1.codeQualite != "Président" AND t1.dateFin IS NULL AND t1.organeRef = "'.$groupeId.'"
                  GROUP BY t1.mpId
                ) A
              ');

              while ($age_data = $age_response->fetch()) {
                $age = $age_data['age'];
                echo $age_data['n']." députés === ";
              }

              if (empty($age)) {
                $age_response = $bdd->query('
                  SELECT ROUND(avg(age), 2) AS age
                  FROM
                  (
                  	SELECT mg.mpId,
                  	YEAR(current_timestamp()) - YEAR(d.birthDate) - CASE WHEN MONTH(current_timestamp()) < MONTH(d.birthDate) OR (MONTH(current_timestamp()) = MONTH(d.birthDate) AND DAY(current_timestamp()) < DAY(d.birthDate)) THEN 1 ELSE 0 END AS age
                  	FROM mandat_groupe mg
                  	LEFT JOIN organes o ON mg.organeRef = o.uid
                  	LEFT JOIN deputes d ON mg.mpId = d.mpId
                  	WHERE mg.organeRef = "'.$groupeId.'" AND mg.dateFin = o.dateFin
                  	GROUP BY mg.mpId
                  ) A
                ');

                while ($age_data = $age_response->fetch()) {
                  $age = $age_data['age'];
                  echo $age;
                }
              }

              $women_response = $bdd->query('
                SELECT A.*,
                ROUND(female / n * 100, 2) AS pct
                FROM
                (
                SELECT groupeId, COUNT(mpId) AS n,
                SUM(if(civ = "Mme", 1, 0)) AS female
                FROM deputes_actifs
                WHERE groupeId = "'.$groupeId.'"
                GROUP BY groupeId
                ) A
              ');

              while ($women_data = $women_response->fetch()) {
                $womenPct = $women_data['pct'];
                $womenN = $women_data['female'];
              }

              echo $groupeId." --- ";
              echo $age." --- ";
              echo $womenPct." --- ";
              echo $womenN." --- ";
              echo "<br>";

              // INSERT INTO DATABSSE //
              $sql = $bdd->prepare('INSERT INTO groupes_stats (organeRef, age, womenN, womenPct) VALUES (:organeRef, :age, :womenN, :womenPct)');
          		$sql -> execute(array('organeRef' => $groupeId, 'age' => $age, 'womenN' => $womenN, 'womenPct' => $womenPct));

            }


          ?>
        </div>
			</div>
		</div>
	</body>
</html>
