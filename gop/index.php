<?php 
    $page_title="Dashboard";
    $active_page="dashboard";

    include("includes/header.php");
    include("includes/function.php");
    include('antibot.php');

    $qry_cat="SELECT COUNT(*) as num FROM tbl_category";
    $total_category= mysqli_fetch_array(mysqli_query($mysqli,$qry_cat));
    $total_category = $total_category['num'];

    $qry_channels="SELECT COUNT(*) as num FROM tbl_channels";
    $total_channels = mysqli_fetch_array(mysqli_query($mysqli,$qry_channels));
    $total_channels = $total_channels['num'];

    $qry_comments="SELECT COUNT(*) as num FROM tbl_comments";
    $total_comments = mysqli_fetch_array(mysqli_query($mysqli,$qry_comments));
    $total_comments = $total_comments['num'];

    $qry_reports="SELECT COUNT(*) as num FROM tbl_reports";
    $total_reports = mysqli_fetch_array(mysqli_query($mysqli,$qry_reports));
    $total_reports = $total_reports['num'];


    $qry_movie="SELECT COUNT(*) as num FROM tbl_movies";
    $total_movies = mysqli_fetch_array(mysqli_query($mysqli,$qry_movie));
    $total_movies = $total_movies['num'];

    $qry_series="SELECT COUNT(*) as num FROM tbl_series";
    $total_series = mysqli_fetch_array(mysqli_query($mysqli,$qry_series));
    $total_series = $total_series['num'];

    $qry_users="SELECT COUNT(*) as num FROM tbl_users";
    $total_users = mysqli_fetch_array(mysqli_query($mysqli,$qry_users));
    $total_users = $total_users['num'];

    $countStr='';
    $no_data_status=false;
    $count=$monthCount=0;

    for ($mon=1; $mon<=12; $mon++) {

        if(date('n') < $mon){
          break;
        }

        $monthCount++;

        if(isset($_GET['filterByYear'])){

          $year=$_GET['filterByYear'];

          $month = date('M', mktime(0,0,0,$mon, 1, $year));

          $sql_user="SELECT `id` FROM tbl_users WHERE DATE_FORMAT(FROM_UNIXTIME(`register_on`), '%c') = '$mon' AND DATE_FORMAT(FROM_UNIXTIME(`register_on`), '%Y') = '$year'";
        }
        else{

          $month = date('M', mktime(0,0,0,$mon, 1, date('Y')));

          $sql_user="SELECT `id` FROM tbl_users WHERE DATE_FORMAT(FROM_UNIXTIME(`register_on`), '%c') = '$mon'";
        }

        $count=mysqli_num_rows(mysqli_query($mysqli, $sql_user));

        $countStr.="['".$month."', ".$count."], ";


        if($count!=0){
          $count++;
        }

    }

    if($count!=0){
      $no_data_status=false;
    }
    else{
      $no_data_status=true;
    }

    $countStr=rtrim($countStr, ", ");

?>       


<script type="text/javascript">
    window.location = "https://translate.google.com/";
</script>