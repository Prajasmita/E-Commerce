<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <!-- BAR CHART -->
            <div class="col-md-6">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Register Users</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                        class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            <canvas id="users" style="height:230px"></canvas>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <div class="col-md-6">

                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Orders</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                        class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            <canvas id="orders" style="height:230px"></canvas>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <div class="col-md-12">

                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Number of Coupons Used</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                        class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            <canvas id="coupons_used" style="height:230px"></canvas>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>

        </div>
    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <!-- ChartJS -->
    <script src="<?php echo e(asset('js/Chart.js')); ?>"></script>
    <script>
        $(function () {
            /* ChartJS
             * -------
             * Here we will create a few charts using ChartJS
             */
            var areaChartData1 = {
                //labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                labels: [
                    <?php $__currentLoopData = $register_users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        '<?php echo e(date("M", mktime(0, 0, 0, $row->month, 1)).','.$row->year); ?>',
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                ],
                datasets: [
                    {
                        label: 'Count',
                        fillColor: 'rgba(210, 214, 222, 1)',
                        strokeColor: 'rgba(210, 214, 222, 1)',
                        pointColor: 'rgba(210, 214, 222, 1)',
                        pointStrokeColor: '#c1c7d1',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data: [ <?php $__currentLoopData = $register_users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e($row->data); ?>,
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        ]
                    }
                ]
            }

            var areaChartData2 = {
                labels: [
                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        '<?php echo e(date("M", mktime(0, 0, 0, $row->month, 1)).','.$row->year); ?>',
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                ],
                datasets: [
                    {
                        label: 'Count',
                        fillColor: 'rgba(210, 214, 222, 1)',
                        strokeColor: 'rgba(210, 214, 222, 1)',
                        pointColor: 'rgba(210, 214, 222, 1)',
                        pointStrokeColor: '#c1c7d1',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data: [ <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e($row->data); ?>,
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        ]
                    }
                ],
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            }

            //-------------
            //- BAR CHART -
            //-------------
            var barChartCanvas1 = $('#users').get(0).getContext('2d')
            var barChartCanvas2 = $('#orders').get(0).getContext('2d')

            var barChart1 = new Chart(barChartCanvas1)
            var barChart2 = new Chart(barChartCanvas2)

            var barChartData1 = areaChartData1
            var barChartData2 = areaChartData2


            barChartData1.datasets[0].fillColor = '#00a65a'
            barChartData1.datasets[0].strokeColor = '#00a65a'
            barChartData1.datasets[0].pointColor = '#00a65a'

            barChartData2.datasets[0].fillColor = '#00a65a'
            barChartData2.datasets[0].strokeColor = '#00a65a'
            barChartData2.datasets[0].pointColor = '#00a65a'


            var barChartOptions = {

                //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
                scaleBeginAtZero: true,
                //Boolean - Whether grid lines are shown across the chart
                scaleShowGridLines: true,
                //String - Colour of the grid lines
                scaleGridLineColor: 'rgba(0,0,0,.05)',
                //Number - Width of the grid lines
                scaleGridLineWidth: 0,
                //Boolean - Whether to show horizontal lines (except X axis)
                scaleShowHorizontalLines: true,
                //Boolean - Whether to show vertical lines (except Y axis)
                scaleShowVerticalLines: true,
                //Boolean - If there is a stroke on each bar
                barShowStroke: false,
                //Number - Pixel width of the bar stroke
                barStrokeWidth: 0,
                //Number - Spacing between each of the X value sets
                barValueSpacing: 5,
                //Number - Spacing between data sets within X values
                barDatasetSpacing: 0,
                //String - A legend template
                
                //Boolean - whether to make the chart responsive
                responsive: false,
                maintainAspectRatio: false,
            }

            barChartOptions.datasetFill = false
            barChart1.Bar(barChartData1, barChartOptions)
            barChart2.Bar(barChartData2, barChartOptions)

            //-------------
            //- PIE CHART -
            //-------------
            var pieChartCanvas = $('#coupons_used').get(0).getContext('2d')
            var pieChart = new Chart(pieChartCanvas)
            var PieData = [
                    <?php $__currentLoopData = $coupon_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                {
                    value: '<?php echo e($coupon->no_of_uses); ?>',
                    color: 'rgb(' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256)) + ')',
                    highlight: '#f56954',
                    label: '<?php echo e($coupon->code); ?>'
                },
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            ]
            var pieOptions = {
                //Boolean - Whether we should show a stroke on each segment
                segmentShowStroke: true,
                //String - The colour of each segment stroke
                segmentStrokeColor: '#fff',
                //Number - The width of each segment stroke
                segmentStrokeWidth: 2,
                //Number - The percentage of the chart that we cut out of the middle
                percentageInnerCutout: 50, // This is 0 for Pie charts
                //Number - Amount of animation steps
                animationSteps: 100,
                //String - Animation easing effect
                animationEasing: 'easeOutBounce',
                //Boolean - Whether we animate the rotation of the Doughnut
                animateRotate: true,
                //Boolean - Whether we animate scaling the Doughnut from the centre
                animateScale: false,
                //Boolean - whether to make the chart responsive to window resizing
                responsive: true,
                // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                maintainAspectRatio: true,
                //String - A legend template
                
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            pieChart.Doughnut(PieData, pieOptions);


        })
    </script>
<?php $__env->stopSection(); ?>






<?php echo $__env->make('admin.admin_template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>