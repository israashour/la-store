@extends('layouts.dashboard')
@section('subtitle', 'Orders')
@section('pagename')
    <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
    <li class="breadcrumb-item active">Orders</li>
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Orders</h1>
                </div>
                <div class="col-sm-6 text-right">
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <div class="input-group input-group" style="width: 250px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Orders #</th>
                                <th>Customer</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Date Purchased</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr>
                                    <td><a href="{{ route('orders.show', $order->id) }}">{{ $order->number }}</a></td>
                                    <td>{{ $order->billingAddress->first_name }}</td>
                                    <td>{{ $order->billingAddress->email }}</td>
                                    <td>{{ $order->billingAddress->phone_number }}</td>
                                    <td>
                                        <span class="badge bg-success">{{ $order->status }}</span>
                                    </td>
                                    <td>{{ $order->getSubtotalFormatted() }}</td>
                                    <td width="150">{{ $order->created_at }}</td>
                                </tr>
                            @empty
                            <tr>
                                <center>
                                <td colspan="7">No Orders yet!</td></center>
                            </tr>
                            @endforelse


                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    {{ $orders->withQueryString()->links() }}
                </div>
            </div>
        </div>
        <!-- /.card -->
    </section>
@endsection
