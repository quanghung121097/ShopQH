@extends('admins.layouts.master')
@section('css')
@endsection
@section('content')
<div class="content container ">
    <h2 class="page-title">Dashboard <small>Statistics and more</small></h2>
    <div class="row">
        <div class="col-lg-8">
            <section class="widget">
                <header>
                    <h4>
                        Visits
                        <small>
                            Based on a three months data
                        </small>
                    </h4>
                    <div class="widget-controls">
                        <a title="Options" href="#"><i class="glyphicon glyphicon-cog"></i></a>
                        <a data-widgster="expand" title="Expand" href="#"><i class="glyphicon glyphicon-chevron-up"></i></a>
                        <a data-widgster="collapse" title="Collapse" href="#"><i class="glyphicon glyphicon-chevron-down"></i></a>
                        <a data-widgster="close" title="Close" href="#"><i class="glyphicon glyphicon-remove"></i></a>
                    </div>
                </header>
                <div class="body no-margin">
                    <div id="visits-chart" class="chart visits-chart">
                        <svg></svg>
                    </div>
                    <div class="visits-info well well-sm">
                        <div class="row">
                            <div class="col-sm-3 col-xs-6">
                                <div class="key"><i class="fa fa-users"></i> Total Traffic</div>
                                <div class="value">24 541 <i class="fa fa-caret-up color-green"></i></div>
                            </div>
                            <div class="col-sm-3 col-xs-6">
                                <div class="key"><i class="fa fa-bolt"></i> Unique Visits</div>
                                <div class="value">14 778 <i class="fa fa-caret-down color-red"></i></div>
                            </div>
                            <div class="col-sm-3 col-xs-6">
                                <div class="key"><i class="fa fa-plus-square"></i> Revenue</div>
                                <div class="value">$3 583.18 <i class="fa fa-caret-up color-green"></i></div>
                            </div>
                            <div class="col-sm-3 col-xs-6">
                                <div class="key"><i class="fa fa-user"></i> Total Sales</div>
                                <div class="value">$59 871.12 <i class="fa fa-caret-down color-red"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
@section('js')
@endsection