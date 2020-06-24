@extends('adminlte::page')

@section('title', 'AdminLTE')


@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				{{ $page_title or "Page Title" }}
			</div>

			<div class="panel-body">
				<!-- Small boxes (Stat box) -->
				<div class="row">
					<div class="col-lg-3 col-xs-6">
						<!-- small box -->
						<div class="small-box bg-aqua">
							<div class="inner">
								<h3>{{$projeler}}</h3>
								<p>Projeler</p>
							</div>
							<div class="icon">
								<i class="fa fa-fw fa-plus-square "></i>
							</div>
							<a href="/projeler" class="small-box-footer">Daha Fazla <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
					<!-- ./col -->
					<div class="col-lg-3 col-xs-6">
						<!-- small box -->
						<div class="small-box bg-green">
							<div class="inner">
								<h3>{{$gant}}</h3>
								<p>Gant</p>
							</div>
							<div class="icon">
								<i class="ion ion-stats-bars"></i>
							</div>
							<a href="/gantt" class="small-box-footer">Daha Fazla <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
					<!-- ./col -->
					<div class="col-lg-3 col-xs-6">
						<!-- small box -->
						<div class="small-box bg-yellow">
							<div class="inner">
								<h3>{{$gorusmeler}}</h3>
								<p>Görüşmeler</p>
							</div>
							<div class="icon">
								<i class="ion ion-person-add"></i>
							</div>
							<a href="/gorusmeler" class="small-box-footer">Daha Fazla <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
					<!-- ./col -->
					<div class="col-lg-3 col-xs-6">
						<!-- small box -->
						<div class="small-box bg-red">
							<div class="inner">
								<h3>{{$firmalar}}</h3>
								<p>Firmalar</p>
							</div>
							<div class="icon">
								<i class="ion ion-pie-graph"></i>
							</div>
							<a href="/firmalar" class="small-box-footer">Daha Fazla <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
					<!-- ./col -->
				</div>
				<!-- /.row -->
				<div class="row">
					<div class="col-md-12">
						<div class="col-md-6">
							<div class="box box-primary">
								<div class="box-header with-border">
									<h3 class="box-title">Yaklaşan Etkinlikler</h3>
								</div>
								<!-- /.box-header -->
								<div class="box-body">
									<ul class="products-list product-list-in-box">
										Kalan Gün Sayısı
										<li class="item">
											@foreach($tasks as $task)
											<div class="product-img">
												<i class="fa fa-calendar-minus-o">
													@if($task->sonuc<=0)
													{{$task->sonuc*-1}}
													@else
													Bitti
													@endif
												</i>
											</div>

											<div class="product-info">
												<a href="javascript:void(0)" class="product-title">{{$task->name}}
													<span class="label label-warning pull-right"><i class="fa fa-calendar"></i>
														{{$task->start_date}}</span></a>
														<span class="product-description">
														</span>
													</div>
													@endforeach
												</li>
											</ul>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<!-- DONUT CHART -->
									<div class="box box-danger">
										<div class="box-header with-border">
											<h3 class="box-title">Donut Chart</h3>

											<div class="box-tools pull-right">
												<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
												</button>
												<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
											</div>
										</div>
										<div class="box-body">
											<canvas id="pieChart" style="height:250px"></canvas>
										</div>
										<!-- /.box-body -->
									</div>
									<!-- /.box -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		@stop

		@section('js')
<script src="{{asset('assets/js/donutchart.js')}}"></script>

		@stop