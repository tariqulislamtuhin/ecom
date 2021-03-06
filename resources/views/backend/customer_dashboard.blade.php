@extends('backend.master')

@section('dashboardactive')
active
@endsection
@section('title')
Dashboard
@endsection


@section('content')
<div class="content-wrapper" style="min-height: 266px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h3 class="text-center">Payment Info</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="paymentChart" width="400" height="400"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h3 class="text-center">Payment Info</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart" width="400" height="400"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div>
                <div class="card">
                    <div class="card-header bg-primary">
                        <h2 class="text-center"> Your Past Order</h2>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr class="bg-success">
                            <th class="text-center">Name </th>
                            <th class="text-center">County</th>
                            <th class="text-center">Address</th>
                            <th class="text-center">Invoice</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($billing_details as $billing_detail)
                        <tr>
                            <td class="text-center" scope="row">{{ $billing_detail->billing_name }}</td>
                            <td class="text-center">{{ $billing_detail->country }}</td>
                            <td>
                                {{ $billing_detail->billing_address.', ' }}<strong>{{ getGeoName($billing_detail->thana)}}
                                    <br>
                                    {{ getGeoName($billing_detail->district). ' ,'.getGeoName($billing_detail->city).'.' }}</strong>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('view.Customer.Invoice',$billing_detail) }}">
                                    <button class="btn btn-success"><i class="fas fa-eye"></i> View</button>
                                </a>
                                <a href="{{ route('download.Customer.Invoice',$billing_detail) }}">
                                    <button class="btn btn-primary"><i class="fas fa-download"> pdf</i></button>
                                </a>
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="10" class="text-center">No Data Avilable</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection

@section('toastr_js')
<script>
    var ctx = document.getElementById('paymentChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Cash on delivary', 'Paid Online'],
        datasets: [{
            label: '# of Votes',
            data: [ {{ $billing_details->where('payment_method','cash on delivary')->count() }},
                    {{ $billing_details->where('payment_method','sslcommerz')->count() }} ],
            backgroundColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(255, 255, 0, 0.5)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)'

            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>
@endsection
