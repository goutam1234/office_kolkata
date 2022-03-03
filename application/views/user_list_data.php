<!DOCTYPE html>
<html lang="en" class="loading">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">


  <title>User Details</title>
  <link rel="icon" href="#" type="image/x-icon" />



  <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900%7CMontserrat:300,400,500,600,700,800,900" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/fonts/feather/style.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/fonts/simple-line-icons/style.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/fonts/font-awesome/css/font-awesome.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/vendors/css/perfect-scrollbar.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/vendors/css/prism.min.css') ?>">

  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/app.css') ?>">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>
  <style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>

</head>

<body>

<h2>HTML Table</h2>

<table>
<thead>
                                <tr>
                                    <th>#</th>
                                    <th>Analyzer Name</th>
                                    <th>Total Downloads</th>
                                    <th>Efficient Call Analysis</th>
                                    <th>Deficient Call Analysis</th>
                                    <th>Deficient Feedback Analysis</th>
                                    <th>Efficient Feedback Analysis</th>
                                    <th>Total Duration</th>
                                </tr>
                            </thead>
                            <tbody>
  <!-- <tr>
    <th>Company</th>
    <th>Contact</th>
    <th>Country</th>
  </tr>
  <tr>
    <td>Alfreds Futterkiste</td>
    <td>Maria Anders</td>
    <td>Germany</td>
  </tr>
  <tr>
    <td>Centro comercial Moctezuma</td>
    <td>Francisco Chang</td>
    <td>Mexico</td>
  </tr>
  <tr>
    <td>Ernst Handel</td>
    <td>Roland Mendel</td>
    <td>Austria</td>
  </tr>
  <tr>
    <td>Island Trading</td>
    <td>Helen Bennett</td>
    <td>UK</td>
  </tr>
  <tr>
    <td>Laughing Bacchus Winecellars</td>
    <td>Yoshi Tannamuri</td>
    <td>Canada</td>
  </tr>
  <tr>
    <td>Magazzini Alimentari Riuniti</td>
    <td>Giovanni Rovelli</td>
    <td>Italy</td>
  </tr> -->

  <?php $i= 1;foreach($get_tl_wise_download_data as $agent) {
                            ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td>
                                        <?php echo $agent->user_name; ?>
                                    </td>
                                    <td><?php echo $agent->total; ?></td>
                                    <td>
                                        <?php 
                                            echo $agent->call_eff_total;
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                            echo $agent->total - $agent->call_eff_total;
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                           
                                            echo $agent->total - $agent->feedback_eff_total;
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                             echo $agent->feedback_eff_total;
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            $total_talk_time = $agent->totalDuration;
                                            $hours = floor($total_talk_time / 3600);
                                            if($hours<=9){
                                                $hours = "0".$hours;
                                           }
                                       $minutes = floor(($total_talk_time / 60) % 60);
                                           if($minutes<=9){
                                                $minutes = "0".$minutes;
                                           }
                                       $seconds = $total_talk_time % 60;
                                       if($seconds<=9){
                                           $seconds = "0".$seconds;
                                       }
                                       $result_3= "$hours:$minutes:$seconds";
    
    
    
                                                 echo $result_3 ;
                                             //echo $agent->totalDuration; 
                                             //echo $agent->feedback_eff_total;
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>
                                      </tbody>




</table>

</body>

</html>
