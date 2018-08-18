@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('section')

    <!-- /.row -->
    <div class="col-sm-12">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-aqua"><i class="fas fa-unlink"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Unassigned</span>
                <span class="info-box-number">{{ $unassigned }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-red"><i class="fas fa-exchange-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Converted</span>
                <span class="info-box-number">{{ $converted }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix visible-sm-block"></div>

          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-green"><i class="fas fa-thumbs-up"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Highly Interested</span>
                <span class="info-box-number">{{ $highly_interested }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-yellow"><i class="fas fa-balance-scale"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Not Interested</span>
                <span class="info-box-number">{{ $not_interested }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->


        <div class="row">
          <div class="col-md-12">
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Monthly Sales Report</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div class="col-md-8">
                    <p class="text-center">
                      <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
                    </p>

                    <div class="chart">
                      <!-- Sales Chart Canvas -->
                      <canvas id="salesChart" style="height: 180px; width: 677px;" width="677" height="180"></canvas>
                    </div>
                    <!-- /.chart-responsive -->
                    <div class="row" style="padding-bottom: 7px;">
                      <div class="col-sm-3">
                        <div class="pull-left " style="height: 25px;width: 25px; border:1px solid #c1c7d1; background-color:#c1c7d1;"></div>
                        <div class="pull-left" style="padding-left: 10px;font-size: 14px;text-transform: uppercase;">
                          <span class="">Total Lead</span>
                        </div>
                      </div>
                    </div>

                    <div class="row" style="padding-bottom: 7px;">
                      <div class="col-sm-4">
                        <div class="pull-left" style="height: 25px;width: 25px; border:1px solid #3b8bba; background-color:#3b8bba;"></div>
                        <div class="pull-left" style="padding-left: 10px;font-size: 14px;text-transform: uppercase;">
                          <span class="">Not Interested</span>
                        </div>
                      </div>
                    </div>

                    <div class="row" style="padding-bottom: 7px;">
                      <div class="col-sm-4">
                        <div class="pull-left" style="height: 25px;width: 25px; border:1px solid #0fe0ba; background-color:#0fe0ba;"></div>
                        <div class="pull-left" style="padding-left: 10px;font-size: 14px;text-transform: uppercase;">
                          <span class="">Highly Interested</span>
                        </div>
                      </div>
                    </div>

                    <div class="row" style="padding-bottom: 7px;">
                      <div class="col-sm-4">
                        <div class="pull-left" style="height: 25px;width: 25px; border:1px solid #a839a8; background-color:#a839a8;"></div>
                        <div class="pull-left" style="padding-left: 10px;font-size: 14px;text-transform: uppercase;">
                          <span class="">Might Invest</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.col -->
                  <div class="col-md-4">
                    <p class="text-center">
                      <strong>Goal Completion</strong>
                    </p>

                    <div class="progress-group">
                      <span class="progress-text">Unassigned</span>
                      <span class="progress-number"><b>{{ $unassigned }}</b>/{{ $totalLeadValue }}</span>

                      <div class="progress sm">
                        <div class="progress-bar progress-bar-aqua" style="width: 80%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      <span class="progress-text">Converted </span>
                      <span class="progress-number"><b>{{ $converted }}</b>/{{ $totalLeadValue }}</span>

                      <div class="progress sm">
                        <div class="progress-bar progress-bar-red" style="width: 80%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->
                    <div class="progress-group">
                      <span class="progress-text">Highly Intrested</span>
                      <span class="progress-number"><b>{{ $highly_interested }}</b>/{{ $totalLeadValue }}</span>

                      <div class="progress sm">
                        <div class="progress-bar progress-bar-green" style="width: 80%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      <span class="progress-text">Not Interested</span>
                      <span class="progress-number"><b>{{ $not_interested }}</b>/{{ $totalLeadValue }}</span>

                      <div class="progress sm">
                        <div class="progress-bar progress-bar-yellow" style="width: 80%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- ./box-body -->
            </div>
          </div>
        </div>
        <?php 
          $object = new App\Http\Controllers\Dashboard\MonthlyReportController();

          $lead = $object->totalLeadbyMonthCount();
          $highly_interested = $object->highlyInterestedbyMonthCount();
          $not_interested = $object->notInterestedbyMonthCount();
          $might_invest = $object->mightInvestbyMonthCount();
        ?>

    <script type="text/javascript">
      var lead = <?php echo json_encode($lead) ;?> ;
      var highly_interested = <?php echo json_encode($highly_interested) ;?> ;
      var not_interested = <?php echo json_encode($not_interested) ;?> ;
      var might_invest = <?php echo json_encode($might_invest) ;?> ;
    </script>
@stop
