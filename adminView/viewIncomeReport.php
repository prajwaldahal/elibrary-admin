<div id="incomeReportPage" class="row mb-4">
    <div class="col-sm-6">
        <form method="POST" class="form-inline">
            <label class="mr-2" for="year">Select Year:</label>
            <select id="year" name="year" class="form-control">
                <?php
                for ($y=date('Y'); $y>=2022; $y--) {
                    echo "<option value='$y'" . ($selectedYear == $y ? "selected" : "") . ">$y</option>";
                }
                ?>
            </select>
        </form>
    </div>
    <div class="col-sm-6 mb-4">
        <form method="POST" class="form-inline">
            <label class="mr-2" for="chartType">Select Chart Type:</label>
            <select id="chartType" class="form-control">
                <option value="LineChart">Line Chart</option>
                <option value="PieChart">Pie Chart</option>
                <option value="BarChart">Bar Chart</option>
                <option value="ColumnChart">Column Chart</option>
            </select>
        </form>
    </div>
</div>
<div class="col-md-12 mb-4">
    <div id="income_chart" style="width: 100%; height: 500px;"></div>
</div>
<div class="row">
    <!-- Total Income -->
    <div class="col-sm-3 mb-4">
        <div class="card bg-dark text-white text-center shadow">
            <div class="card-body">
                <i class="fa fa-dollar mb-2" style="font-size: 70px;"></i>
                <h4>Total Income</h4>
                <h5 id="totalIncomeValue">Rs. 0.00</h5>
            </div>
        </div>
    </div>

    <!-- Total Active Income -->
    <div class="col-sm-3 mb-4">
        <div class="card bg-success text-white text-center shadow">
            <div class="card-body">
                <i class="fa fa-money mb-2" style="font-size: 70px;"></i>
                <h4>Total Active Income</h4>
                <h5 id="activeIncomeValue">Rs. 0.00</h5>
            </div>
        </div>
    </div>

    <!-- Total History Income -->
    <div class="col-sm-3 mb-4">
        <div class="card bg-warning text-white text-center shadow">
            <div class="card-body">
                <i class="fa fa-history mb-2" style="font-size: 70px;"></i>
                <h4>Total History Income</h4>
                <h5 id="historyIncomeValue">Rs. 0.00</h5>
            </div>
        </div>
    </div>

    <!-- Income This Month -->
    <div class="col-sm-3 mb-4">
        <div class="card bg-primary text-white text-center shadow">
            <div class="card-body">
                <i class="fa fa-calendar mb-2" style="font-size: 70px;"></i>
                <h4>Income This Month</h4>
                <h5 id="monthIncomeValue">Rs. 0.00</h5>
            </div>
        </div>
    </div>
</div>
<script>
    google.charts.load('current', { 'packages': ['corechart'] });

    google.charts.setOnLoadCallback(initPage);

    function initPage() {
        loadIncomeData();     
    }
    $('#year').on('change', function() {
        loadMonthlyIncomeChart();  
    });
    $('#chartType').on('change', function() {
        loadMonthlyIncomeChart();
    });

</script>
