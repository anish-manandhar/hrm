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
                        <livewire:salary-setup-form />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
