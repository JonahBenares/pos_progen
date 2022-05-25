<?php $ci=get_instance(); ?>
<script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/vendors/chart.js/Chart.min.js"></script>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-info text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span> Dashboard
            </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>
        <?php
                //$diff = dateDifference($expiration_date, $today);
               // if($diff<=7){ ?>
        <div class="row">
            <div class="col-md-6 stretch-card">
              <a href="<?php echo base_url(); ?>reports/near_expiry/" class="card bg-gradient-danger card-img-holder text-white" style="text-decoration: none;" >
                <div class="card-body">
                    <img src="<?php echo base_url(); ?>assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Near Expiry Products </h4>
                    <i class="mdi mdi-timer float-right" style="position: absolute;font-size: 100px;top: 0;right: 0;margin: 25px;"></i>
                      <h2 class="mb-5"><?php echo $expired ?></h2>
                    <h6 class="card-text">Click to View</h6>
                </div>
              </a>
            </div>
            <?php //}?>
           
            <div class="col-md-6 stretch-card">
                <a href="<?php echo base_url(); ?>sales_backorder/backorder_form/" class="card bg-gradient-success card-img-holder text-white" style="text-decoration: none;" >
                    <div class="card-body">
                        <img src="<?php echo base_url(); ?>assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Sales Back Order </h4>
                        <i class="mdi mdi-replay float-right" style="position: absolute;font-size: 100px;top: 0;right: 0;margin: 25px;"></i>
                        <?php if(!empty($sales_backorder)) { ?>
                        <h2 class="mb-5"><?php echo $sales_backorder ?></h2>
                        <?php }else { ?>
                            <h2 class="mb-5">0</h2>
                        <?php } ?>
                        <h6 class="card-text">Click to View</h6>
                    </div>
                </a>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-12 stretch-card">
                <div class="justify-content">
                    <a href="<?php echo base_url(); ?>masterfile/upload_priceRef" class="mr-3 btn btn-inverse-success btn-rounded"><span class="mdi mdi-upload mr-2"></span>Upload Price Reference</a>
                    <a href="<?php echo base_url(); ?>receive/add_receive" class="mr-3 btn btn-inverse-primary btn-rounded"><span class="mdi mdi-plus mr-2"></span>Add Receive</a>
                    <a href="<?php echo base_url(); ?>sales/add_sales" class="mr-3 btn btn-inverse-primary btn-rounded"><span class="mdi mdi-plus mr-2"></span>Add Sales</a>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6 col-lg-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="clearfix">
                            <h4 class="card-title float-left">Sales Good Statistics</h4>
                            <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>
                        </div>
                        <canvas id="visit-sale-chart" class="mt-4"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="clearfix">
                            <h4 class="card-title float-left">Sales Services Statistics</h4>
                            <div id="visit-service-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>
                        </div>
                        <canvas id="visit-service-chart" class="mt-4"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <canvas id="mybarChart"></canvas>
                        <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url();?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 


<script type="text/javascript">
    if ($("#visit-sale-chart").length) {
        Chart.defaults.global.legend.labels.usePointStyle = true;
        var ctx = document.getElementById('visit-sale-chart').getContext("2d");

        var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 181);
        gradientStroke1.addColorStop(0, 'rgba(218, 140, 255, 1)');
        gradientStroke1.addColorStop(1, 'rgba(154, 85, 255, 1)');
        var gradientLegend1 = 'linear-gradient(to right, rgba(218, 140, 255, 1), rgba(154, 85, 255, 1))';


        var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
        gradientStroke2.addColorStop(0, 'rgba(255, 191, 150, 1)');
        gradientStroke2.addColorStop(1, 'rgba(254, 112, 150, 1)');
        var gradientLegend2 = 'linear-gradient(to right, rgba(255, 191, 150, 1), rgba(254, 112, 150, 1))';

        var gradientStroke3 = ctx.createLinearGradient(0, 0, 0, 360);
        gradientStroke3.addColorStop(0, 'rgba(54, 215, 232, 1)');
        gradientStroke3.addColorStop(1, 'rgba(177, 148, 250, 1)');
        var gradientLegend3 = 'linear-gradient(to right, rgba(54, 215, 232, 1), rgba(177, 148, 250, 1))';
        var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
            datasets: [
                <?php 
                    $color=1;
                    foreach($ci->super_model->select_all("client") AS $c){ 
                ?>
                {
                    label: "<?php echo $c->short_name; ?>",
                    borderColor: gradientStroke<?php echo $color; ?>,
                    backgroundColor: gradientStroke<?php echo $color; ?>,
                    hoverBackgroundColor: gradientStroke<?php echo $color; ?>,
                    legendColor: gradientLegend<?php echo $color; ?>,
                    pointRadius: 0,
                    fill: false,
                    borderWidth: 1,
                    fill: 'origin',
                    data: [
                        <?php
                            for($x=1;$x<=12;$x++){
                                echo $ci->graphic_goods($c->client_id, $x).",";
                            }
                        ?>
                    ]
                },
                <?php $color++; } ?>
            ]
        },
        options: {
            responsive: true,
            legend: false,
            legendCallback: function(chart) {
                var text = []; 
                text.push('<ul>'); 
                for (var i = 0; i < chart.data.datasets.length; i++) { 
                    text.push('<li><span class="legend-dots" style="background:' + chart.data.datasets[i].legendColor + '"></span>'); 
                    if (chart.data.datasets[i].label) { 
                        text.push(chart.data.datasets[i].label); 
                    } 
                    text.push('</li>'); 
                } 
                text.push('</ul>'); 
                return text.join('');
          },
          scales: {
              yAxes: [{
                  ticks: {
                      display: false,
                      min: 0,
                      stepSize: 20,
                      max: 1000000
                  },
                  gridLines: {
                    drawBorder: false,
                    color: 'rgba(235,237,242,1)',
                    zeroLineColor: 'rgba(235,237,242,1)'
                  }
              }],
              xAxes: [{
                  gridLines: {
                    display:false,
                    drawBorder: false,
                    color: 'rgba(0,0,0,1)',
                    zeroLineColor: 'rgba(235,237,242,1)'
                  },
                  ticks: {
                      padding: 20,
                      fontColor: "#9c9fa6",
                      autoSkip: true,
                  },
                  categoryPercentage: 0.5,
                  barPercentage: 0.5
              }]
            }
          },
          elements: {
            point: {
              radius: 0
            }
          }
      })
      $("#visit-sale-chart-legend").html(myChart.generateLegend());
    }

    function showGoodGraph1(){ {
        var loc= document.getElementById("baseurl").value;
        var redirect = loc+"masterfile/graph_display_goods";
        $.post(redirect,function (data){
            var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun","Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
            var start;
            start = 0;
            var year;
            year = parseInt(2022);
            var salesMonths = [],sumSales = [];
            var client_name = [];
            //Setup Block
            /*var count_sales1 = [];
            var sales_date = [];*/
           
            /*for (var i in data) {
                count_sales1.push(parseInt(data[i].count_sales1));
                //count_sales2.push(parseInt(data[i].count_sales2));
                sales_date.push(data[i].sales_date);
                client_name.push(data[i].client_name);
            }*/

            //Display Data
            var Result = [];
            for (var i in data) {
                Result.push({
                    Months:data[i].sales_date,
                    Counts:data[i].count_sales1
                });
                client_name.push(data[i].client_name);
            }

            //Months Label
            for (var i = 0; i < 12; i++) {
                var months = monthNames[start];
                var monthValue = 0;
                salesMonths.push(months);
                start = start + 1;
                if (start == 12) {
                    start = 0;
                    year = year + 1;
                }
                var dataObj = $.grep(Result, function(a) {
                    return a.Months == months
                })[0];

                //Sum Data 
                var monthValue = dataObj !== undefined ? dataObj.Counts : 0;
                sumSales.push(monthValue);
            }

            Chart.defaults.global.legend.labels.usePointStyle = true;
            var ctx = document.getElementById('visit-sale-chart').getContext("2d");
            var gradientStrokeViolet = ctx.createLinearGradient(0, 0, 0, 181);
            gradientStrokeViolet.addColorStop(0, 'rgba(218, 140, 255, 1)');
            gradientStrokeViolet.addColorStop(1, 'rgba(154, 85, 255, 1)');
            var gradientLegendViolet = 'linear-gradient(to right, rgba(218, 140, 255, 1), rgba(154, 85, 255, 1))';

            var gradientStrokeBlue = ctx.createLinearGradient(0, 0, 0, 360);
            gradientStrokeBlue.addColorStop(0, 'rgba(54, 215, 232, 1)');
            gradientStrokeBlue.addColorStop(1, 'rgba(177, 148, 250, 1)');
            var gradientLegendBlue = 'linear-gradient(to right, rgba(54, 215, 232, 1), rgba(177, 148, 250, 1))';

            var gradientStrokeRed = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStrokeRed.addColorStop(0, 'rgba(255, 191, 150, 1)');
            gradientStrokeRed.addColorStop(1, 'rgba(254, 112, 150, 1)');
            var gradientLegendRed = 'linear-gradient(to right, rgba(255, 191, 150, 1), rgba(254, 112, 150, 1))';
            var colors=[gradientStrokeViolet,gradientStrokeBlue,gradientStrokeRed]; 
            var colors_legend=[gradientLegendViolet,gradientLegendBlue,gradientLegendRed]; 

            //Legend / Bar Graph / Design Settings
            var data={
                labels: salesMonths,
                datasets: client_name.map((ds, i) => ({
                    label: client_name[i],
                    borderColor: colors[i],
                    backgroundColor: colors[i],
                    hoverBackgroundColor: colors[i],
                    legendColor: colors_legend[i],
                    pointRadius: 0,
                    fill: false,
                    borderWidth: 1,
                    fill: 'origin',
                    data: sumSales
                })) 

                /*datasets:[
                    {
                        label: "Central Negros Power Reliability, Inc.",
                        borderColor: gradientStrokeViolet,
                        backgroundColor: gradientStrokeViolet,
                        hoverBackgroundColor: gradientStrokeViolet,
                        legendColor: gradientLegendViolet,
                        pointRadius: 0,
                        fill: false,
                        borderWidth: 1,
                        fill: 'origin',
                        data: count_sales1
                    },
                    {
                        label: 'CPGC',
                        borderColor: gradientStrokeBlue,
                        backgroundColor: gradientStrokeBlue,
                        hoverBackgroundColor: gradientStrokeBlue,
                        legendColor: gradientLegendBlue,
                        pointRadius: 0,
                        fill: false,
                        borderWidth: 1,
                        fill: 'origin',
                        data: count_sales2
                    },
                ]*/
            };

            //Config Block / Display Data
            var config = {
                type: 'bar',
                data,
                options: {
                    responsive: true,
                    legend: false,
                    legendCallback: function(chart) {
                        var text = []; 
                        text.push('<ul>'); 
                        for (var i = 0; i < chart.data.datasets.length; i++) { 
                            text.push('<li><span class="legend-dots" style="background:' + chart.data.datasets[i].legendColor + '"></span>'); 
                            if (chart.data.datasets[i].label) { 
                                text.push(chart.data.datasets[i].label); 
                            } 
                            text.push('</li>'); 
                        } 
                        text.push('</ul>'); 
                        return text.join('');
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                display: false,
                                min: 0,
                                stepSize: 20,
                                maxTicksLimit: 1
                                //max: 1000000
                            },
                            gridLines: {
                                drawBorder: false,
                                color: 'rgba(235,237,242,1)',
                                zeroLineColor: 'rgba(235,237,242,1)'
                            }
                        }],
                        xAxes: [{
                            gridLines: {
                                display:false,
                                drawBorder: false,
                                color: 'rgba(0,0,0,1)',
                                zeroLineColor: 'rgba(235,237,242,1)'
                            },
                            ticks: {
                                padding: 20,
                                fontColor: "#9c9fa6",
                                autoSkip: true,
                            },
                            categoryPercentage: 0.7,
                            barPercentage:  0.7,
                             
                        }]
                    }
                },
                elements: {
                    point: {
                        radius: 0
                    }
                }
            };

            //Render Block
            const myChart= new Chart(
                document.getElementById('visit-sale-chart'),
                config
            );
            $("#visit-sale-chart-legend").html(myChart.generateLegend());
        });
        }
    }

    function showServiceGraph(){ {
            var loc= document.getElementById("baseurl").value;
            var redirect = loc+"masterfile/graph_display_services";
            $.post(redirect,function (data){
                //Setup Block
                var count_sales1 = [];
                var count_sales2 = [];
                var sales_date = [];
                var client_name = [];

                for (var i in data) {
                    count_sales1.push(parseInt(data[i].count_sales1));
                    count_sales2.push(parseInt(data[i].count_sales2));
                    sales_date.push(data[i].sales_date);
                    client_name.push(data[i].client_name);
                }

                Chart.defaults.global.legend.labels.usePointStyle = true;
                var ctx = document.getElementById('visit-service-chart').getContext("2d");
                var gradientStrokeViolet = ctx.createLinearGradient(0, 0, 0, 181);
                gradientStrokeViolet.addColorStop(0, 'rgba(218, 140, 255, 1)');
                gradientStrokeViolet.addColorStop(1, 'rgba(154, 85, 255, 1)');
                var gradientLegendViolet = 'linear-gradient(to right, rgba(218, 140, 255, 1), rgba(154, 85, 255, 1))';

                var gradientStrokeBlue = ctx.createLinearGradient(0, 0, 0, 360);
                gradientStrokeBlue.addColorStop(0, 'rgba(54, 215, 232, 1)');
                gradientStrokeBlue.addColorStop(1, 'rgba(177, 148, 250, 1)');
                var gradientLegendBlue = 'linear-gradient(to right, rgba(54, 215, 232, 1), rgba(177, 148, 250, 1))';

                var gradientStrokeRed = ctx.createLinearGradient(0, 0, 0, 300);
                gradientStrokeRed.addColorStop(0, 'rgba(255, 191, 150, 1)');
                gradientStrokeRed.addColorStop(1, 'rgba(254, 112, 150, 1)');
                var gradientLegendRed = 'linear-gradient(to right, rgba(255, 191, 150, 1), rgba(254, 112, 150, 1))';
                var colors=[gradientStrokeViolet,gradientStrokeBlue,gradientStrokeRed]; 
                var colors_legend=[gradientLegendViolet,gradientLegendBlue,gradientLegendRed]; 
                var data={
                    labels: sales_date,
                    /*datasets: client_name.map((ds, i) => ({
                        label: client_name[i],
                        borderColor: colors[i],
                        backgroundColor: colors[i],
                        hoverBackgroundColor: colors[i],
                        legendColor: colors_legend[i],
                        pointRadius: 0,
                        fill: false,
                        borderWidth: 1,
                        fill: 'origin',
                        data: count_sales1
                    })) */

                    datasets:[
                        {
                            label: "Central Negros Power Reliability, Inc.",
                            borderColor: gradientStrokeViolet,
                            backgroundColor: gradientStrokeViolet,
                            hoverBackgroundColor: gradientStrokeViolet,
                            legendColor: gradientLegendViolet,
                            pointRadius: 0,
                            fill: false,
                            borderWidth: 1,
                            fill: 'origin',
                            data: count_sales1
                        },
                        {
                            label: 'CPGC',
                            borderColor: gradientStrokeBlue,
                            backgroundColor: gradientStrokeBlue,
                            hoverBackgroundColor: gradientStrokeBlue,
                            legendColor: gradientLegendBlue,
                            pointRadius: 0,
                            fill: false,
                            borderWidth: 1,
                            fill: 'origin',
                            data: count_sales2
                        },
                    ]
                };

                //Config Block
                var config = {
                    type: 'bar',
                    data,
                    options: {
                        responsive: true,
                        legend: false,
                        legendCallback: function(chart) {
                            var text = []; 
                            text.push('<ul>'); 
                            for (var i = 0; i < chart.data.datasets.length; i++) { 
                                text.push('<li><span class="legend-dots" style="background:' + chart.data.datasets[i].legendColor + '"></span>'); 
                                if (chart.data.datasets[i].label) { 
                                    text.push(chart.data.datasets[i].label); 
                                } 
                                text.push('</li>'); 
                            } 
                            text.push('</ul>'); 
                            return text.join('');
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    display: false,
                                    min: 0,
                                    stepSize: 20,
                                    max: 80
                                },
                                gridLines: {
                                    drawBorder: false,
                                    color: 'rgba(235,237,242,1)',
                                    zeroLineColor: 'rgba(235,237,242,1)'
                                }
                            }],
                            xAxes: [{
                                gridLines: {
                                    display:false,
                                    drawBorder: false,
                                    color: 'rgba(0,0,0,1)',
                                    zeroLineColor: 'rgba(235,237,242,1)'
                                },
                                ticks: {
                                    padding: 20,
                                    fontColor: "#9c9fa6",
                                    autoSkip: true,
                                },
                                categoryPercentage: 0.8,
                                barPercentage:  0.8,
                                 
                            }]
                        }
                    },
                    elements: {
                        point: {
                            radius: 0
                        }
                    }
                };

                //Render Block
                const myChart= new Chart(
                    document.getElementById('visit-service-chart'),
                    config
                );
                $("#visit-service-chart-legend").html(myChart.generateLegend());
            });
        }
    }
</script>
        