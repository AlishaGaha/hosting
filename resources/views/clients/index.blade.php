@extends('layouts.app')

@section('content')
    <div class="container">
        @include('includes.flash_notification')
        <a href="{{ route('clients.create') }}" class="btn btn-primary">
            Add Client
        </a>
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col" style="width: 200px!important;">Client Name</th>
                <th scope="col">Email</th>
                <th scope="col">Contact No.</th>
                <th scope="col">Address</th>
                <th scope="col">Domain Name</th>
                <th scope="col">Expiry Date</th>
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
                        <td>{{ $client->domain_name }}</td>
                        <td>{{ $client->expiry_date }}</td>
                        <td>{{ $client->domain_renewal }}</td>
                        <td>{{ $client->plan_id }}</td>
                        <td>{{ $client->hosting_renewal }}</td>
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