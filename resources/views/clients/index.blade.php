@extends('layouts.app')

@section('content')
    <div class="container">
        @include('includes.flash_notification')
        <div class="filter-form"
            style="background-color: whitesmoke; border: 1px solid rgb(236, 235, 233); margin: 3rem 0px; padding: 1rem;">
            <form action="{{ route('clients.index')}}" method="GET">
                @include('clients.includes.index_filter_form')
                <button type="submit" class="btn btn-primary">Filter</button>
              </form>
        </div>
        <a href="{{ route('clients.create') }}" class="btn btn-primary">
            Add Client
        </a>
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col" style="width: 200px !important;">Client Name</th>
                <th scope="col">Email</th>
                <th scope="col">Contact No.</th>
                <th scope="col">Address</th>
                <th scope="col">Service Type</th>
                <th scope="col">Domain Name</th>
                <th scope="col">Domain Renewal</th>
                <th scope="col">Plan</th>
                <th scope="col">Hosting Renewal</th>
                <th scope="col" title="Annual Maintenace Cost Type">A.M.C.T</th>
                <th scope="col" title="Annual Maintenace Cost">A.M.C</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @forelse($clients as $key => $client)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $client->first_name.' '. $client->last_name }}</td>
                        <td>{{ $client->email }}</td>
                        <td>{{ $client->contact_number }}</td>
                        <td>{{ $client->address }}</td>
                        <td>{{ $client->service_type }}</td>
                        <td>{{ $client->domain_name }}</td>
                        <td>{{ isset($client->domain_renewal) ? $client->domain_renewal.' '.$client->domain_renewal_type : '' }}</td>
                        <td>{{ $client->title }}</td>
                        <td>{{ isset($client->hosting_renewal) ? $client->hosting_renewal.' '.$client->hosting_renewal_type : '' }}</td>
                        <td>{{ $client->annual_maintenance_cost_type }}</td>
                        <td>{{ $client->annual_maintenance_cost }}</td>
                        <td>
                            <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-success">Edit</a>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10">No records found!</td>
                    </tr>
                @endforelse
            </tbody>
          </table>
            {{ $clients->links() }}
    </div>
@endsection
