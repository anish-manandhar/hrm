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
                            <th width="20px">Action</th>
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
{{--                                @dd(!count($value->checkInCheckOuts))--}}
                                <td>
                                    @if(!count($value->checkInCheckOuts) || !count($value->checkInCheckOuts->whereNull('check_out')))
                                        <div class="btn-group" role="group">
                                            <button title="Check In" wire:click="checkIn({{ $value->user->id }})"
                                                    type="button" class="btn btn-outline-success">
                                                <span class="material-icons-outlined mt-1">check</span></button>
                                        </div>
                                    @else
                                        <div class="btn-group" role="group">
                                            <button title="Check Out" wire:click="checkOut({{ $value->user->id }})"
                                                    type="button" class="btn btn-outline-warning"><span
                                                    class="material-icons-outlined mt-1">exit_to_app</span></button>
                                        </div>
                                    @endif
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
