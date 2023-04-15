<?php
session_start();
include("Db.php");

$collectionU = $db->users;
$collectionP = $db->projects;
$collectionF = $db->files;

if (!(isset($_SESSION["Role"])) || $_SESSION["Role"] != "User")
    echo '<script>window.location="index.php";</script>';

$username = $_SESSION["username"];
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$projects = $collectionP->find(['username' => $username]);
$name = $_GET['name'];
$numberOfProjcts = 0;
$projects = $projects->toArray();
foreach ($projects as $proInfo)
    $numberOfProjcts++;

$files = $collectionF->find(['username' => $username]);
$files = $files->toArray();

$numberofEfiles = 0;
$numberofAfiles = 0;

foreach ($files as $fileInfo)
    if ($fileInfo['Languages'] == 'Arabic')
        $numberofAfiles++;
    else
        $numberofEfiles++;

$projects = $collectionP->find(['username' => $username]);
$projects = $projects->toArray();
foreach ($projects as $project) {
    $project = $collectionP->findOne(['username' => $username, 'ProjectName' => $project['ProjectName']]);
    if ($project['NumberOfEnglishFiles'] == 0 && $project['NumberOfArabicFiles'] == 0) {
        $zero = 0;
        $projectStatus = $collectionP->updateOne(
            ['ProjectName' => $project['ProjectName'], 'username' => $username],
            ['$set' => ['ProjectStatus' => 'not started', 'OverallToxicity' => $zero]]
        );
    }
}

$notStarted = 0;
$inProgress = 0;
$completed = 0;
foreach ($projects as $proInfo) {
    if ($proInfo['ProjectStatus'] == 'not started')
        $notStarted++;
    else if ($proInfo['ProjectStatus'] == 'In Progress')
        $inProgress++;
    else if ($proInfo['ProjectStatus'] == 'Completed')
        $completed++;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Favicons -->
    <link href="assets/img/logo.png" rel="icon">
    <link href="assets/img/logo.png" rel="apple-touch-icon">
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Toxicity Inspector - <?php echo '@' . $_SESSION['username']; ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <a href="userHome.php?name=<?php echo $name; ?>" accesskey="h"></a>

    <!-- Favicons -->
    <link href="assets/img/logo.png" rel="icon">
    <link href="assets/img/logo.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">


    <!-- Template Main CSS File -->
    <link href="assets/css/userHome.css" rel="stylesheet">
    <script type="text/javascript" src="https://cdn.weglot.com/weglot.min.js"></script>
    <script>
        Weglot.initialize({
            api_key: 'wg_7971b0c8d0752818fdd77c7810fb22808'
        });
    </script>
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="userHome.php?name=<?php echo $name; ?>" class="logo d-flex align-items-center">
                <img src="assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">Toxicity Inspector</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle"></i>
                        <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $name . ' ' . $_SESSION['LastName']; ?></span> <!-- php -->
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="SignOut.php">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link " href="userHome.php?name=<?php echo $name; ?>">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="uploadFiles.php?name=<?php echo $name; ?>">
                    <i class="bi bi-file-earmark"></i>
                    <span>Upload Your Files</span>
                </a>
            </li><!-- End upload Page Nav -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="UserProjects.php?name=<?php echo $name; ?>">
                    <i class="bi bi-menu-button-wide"></i>
                    <span>Projects</span>
                </a>
            </li><!-- End projects Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="SignOut.php">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Sign Out</span>
                </a>
            </li><!-- End Sign Out Page Nav -->

        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>

            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="userHome.php?name=<?php echo $name; ?>">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">


                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Overall Toxicity</h5>

                            <!-- Column Chart -->
                            <div id="columnChart"></div>

                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    new ApexCharts(document.querySelector("#columnChart"), {

                                        chart: {
                                            type: 'bar',
                                            height: 337
                                        },
                                        plotOptions: {
                                            bar: {
                                                horizontal: false,
                                                columnWidth: '25%',
                                                endingShape: 'rounded'
                                            },
                                        },
                                        dataLabels: {
                                            enabled: false
                                        },
                                        stroke: {
                                            show: true,
                                            width: 2,
                                            colors: ['transparent']
                                        },

                                        series: [{
                                            name: 'Project Toxicity',
                                            data: [<?php
                                                    $projects = $collectionP->find(['username' => $username]);
                                                    foreach ($projects as $proInfo)
                                                        if (is_nan($proInfo['OverallToxicity']))
                                                            echo 0 . ",";
                                                        else
                                                            echo $proInfo['OverallToxicity'] . ","; ?>]
                                        }],
                                        xaxis: {

                                            categories: [<?php
                                                            $projects = $collectionP->find(['username' => $username]);
                                                            foreach ($projects as $proInfo)
                                                                echo "'" . $proInfo['ProjectName'] . "',"; ?>]
                                        },

                                        yaxis: {
                                            title: {
                                                text: 'Toxicity Level'
                                            }
                                        },
                                        fill: {
                                            opacity: 1
                                        },
                                        tooltip: {
                                            y: {
                                                formatter: function(val) {
                                                    return val
                                                }
                                            }
                                        }
                                    }).render();
                                });
                            </script>
                            <!-- End Column Chart -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Projects</h5>

                            <!-- Donut Chart -->
                            <div id="donutChart"></div>

                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    new ApexCharts(document.querySelector("#donutChart"), {
                                        series: [<?php echo $notStarted; ?>, <?php echo $inProgress; ?>, <?php echo $completed; ?>],
                                        chart: {
                                            height: 350,
                                            type: 'donut',
                                            toolbar: {
                                                show: true
                                            }
                                        },
                                        labels: ['Not Started', 'In Progress', 'Completed'],
                                    }).render();
                                });
                            </script>
                            <!-- End Donut Chart -->
                            <br>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Number Of Files</h5>

                            <!-- Bar Chart -->
                            <div id="barChart"></div>

                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    new ApexCharts(document.querySelector("#barChart"), {
                                        series: [{
                                            data: ['<?php echo $numberofEfiles; ?>', '<?php echo $numberofAfiles; ?>']
                                        }],
                                        chart: {
                                            type: 'bar',
                                            height: 150
                                        },
                                        plotOptions: {
                                            bar: {
                                                borderRadius: 4,
                                                horizontal: true,
                                            }
                                        },
                                        dataLabels: {
                                            enabled: true,

                                            title: {
                                                text: 'number of files'
                                            }

                                        },
                                        xaxis: {
                                            categories: ['English Files', 'Arabic Files'],
                                        }
                                    }).render();
                                });
                            </script>
                            <!-- End Bar Chart -->

                        </div>
                    </div>
                </div>

                <!-- Sales Card -->

                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Number Of Projects</span></h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                </div>
                                <div class="ps-3">
                                    <h2><?php echo $numberOfProjcts; ?></h2>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- End Sales Card -->

                </div>
        </section>

    </main><!-- End #main -->
  <!-- ======= Footer ======= -->
  <div class="container position-absolute bottom-1 start-50 translate-middle-x">
  <footer id="footer" class="footer">
    <div class="credits">
      <div>Contact Us
        <div class="social-links mt-3">
          <a href="mailto: toxicityinspector@gmail.com"><i class="bi bi-envelope-fill"></i></a>
          <a href="https://twitter.com/" target="_blank" class="twitter"><i class="bi bi-twitter"></i></a>
          <a href="https://facebook.com/" target="_blank" class="facebook"><i class="bi bi-facebook"></i></a>
          <a href="https://instagram.com/" target="_blank" class="instagram"><i class="bi bi-instagram"></i></a>
          <a href="https://linkedin.com/" target="_blank" class="linkedin"><i class="bi bi-linkedin"></i></a>
        </div>
        Phone: +966 555555555<br>
        King Saud University, Riyadh
    </div>
    <div class="copyright">
      <br>
      &copy; Copyright <strong><span>Toxicity Inspector</span></strong>. All Rights Reserved
    </div>
  </footer><!-- End Footer -->
</div>

  <style>

    /*--------------------------------------------------------------
# Footer
--------------------------------------------------------------*/
.footer {
  padding: 20px 0;
  font-size: 14px;
  transition: all 0.3s;
  border-top: 1px solid #cddfff;
}

.footer .copyright {
  text-align: center;
  color: #012970;
}

.footer .credits {
  padding-top: 5px;
  text-align: center;
  font-size: 13px;
  color: #012970;
}


  </style>
    <!-- Vendor JS Files -->
    <!-- <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="" class="purecounter"></span> -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/chart.js/chart.min.js"></script>


    <!-- Template Main JS File -->
    <script src="assets/js/UserHome.js"></script>
    <script src="assets/js/main.js"></script>

</body>

</html>