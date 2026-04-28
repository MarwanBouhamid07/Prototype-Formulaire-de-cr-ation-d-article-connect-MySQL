<?php
session_start();
require_once "../../includes/function-articles.php";
$id = $_COOKIE["user_id"];
$total_veiws = Totalveiws($id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistics</title>
    <link rel="stylesheet" href="../../assets/styles/sidebare.css">
    <link rel="stylesheet" href="../../assets/styles/dashboard.css">
    <script src="https://kit.fontawesome.com/8f8b4a4f39.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <main>
        <?php include "../../includes/sidebareAdmin.php" ?>
        <header>
            <div class="group">
                <h2>Analytics & Statistics</h3>
                    <p>Monitor your blog's performance and audience engagement.</p>
            </div>
        </header>
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-info">
                    <span class="stat-label">Total Views</span>
                    <div class="stat-value-row">
                        <span class="stat-number"><?php echo $total_veiws ?></span>
                    </div>
                </div>
                <div class="stat-icon icon-blue">
                    <i class="fa-regular fa-eye"></i>
                </div>
            </div>


            <div class="stat-card">
                <div class="stat-info">
                    <span class="stat-label">Avg. Time on Page</span>
                    <div class="stat-value-row">
                        <span class="stat-number">8568757</span>

                    </div>
                </div>
                <div class="stat-icon icon-purple">
                    <i class="fa-regular fa-clock"></i>
                </div>
            </div>
        </div>
        <div class="chart-container"
            style=" margin-top:50px; margin-bottom:100px; position: relative; height:300px; width:100%">
            <div class="chart-header"
                style="display: flex; justify-content: space-between; align-items: center; padding: 20px;">
                <h3 style="margin: 0; color: #000000; font-weight: 700;">Page Views (Last 30 Days)</h3>

                <select id="timeFilter"
                    style="padding: 8px 15px; border-radius: 8px; border: 1px solid #e2e8f0; color: #64748b; outline: none;">
                    <option value="this-month">This Month</option>
                    <option value="last-month">Last Month</option>
                    <option value="this-year">This Year</option>
                </select>
            </div>

            <canvas id="pageViewsChart"></canvas>

        </div>
    </main>
    <script src="../../assets/scripts/charts.js"></script>
</body>

</html>