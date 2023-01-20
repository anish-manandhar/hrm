<x-app-layout>
    @section('page_title', @$page_title)
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header row">
                        <div class="col-lg-10">
                            <h5 class="card-title">{{ @$page_title }}</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table" style="width:100%">
                            <thead>
                            <tr>
                                <th width="10px">S.No.</th>
                                <th>Employee Id</th>
                                <th>Employee Name</th>
                                <th>Check In</th>
                                <th>Check Out</th>
                                <th>Stay</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $key => $value)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ @$value->user->prefix_id }}</td>
                                    <td>{{ @$value->user->name }}</td>
                                    <td>
                                        @forelse($value->checkInCheckOuts as $checkIn)
                                            {{ readableDate($checkIn->check_in,'time') }}<br>
                                        @empty
                                        @endforelse
                                    </td>
                                    <td>
                                        @forelse($value->checkInCheckOuts as $checkOut)
                                            {{ readableDate($checkOut->check_out,'time') }}<br>
                                        @empty
                                        @endforelse
                                    </td>
                                    <td>
                                        @php
                                            $stay = 0;
                                            foreach ($value->checkInCheckOuts as $stayInSecond){
                                                $stay = $stay + $stayInSecond->stay_in_seconds;
                                            }
                                        @endphp
                                        {{ getTimeFromSeconds($stay) }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
