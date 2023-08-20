<x-admin-layout :title="__('Settings')">

    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        @lang('Overview')
                    </div>
                    <h2 class="page-title">
                        @lang('Settings')
                    </h2>
                </div>

            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="row g-0">
                    <div class="col-3 d-none d-md-block border-end">
                        <div class="card-body">
                            <h4 class="subheader">@lang('Profile')</h4>

                            <div class="list-group list-group-transparent" data-bs-toggle="tabs" role="tablist">
                                <a href="#tabs-general" data-bs-toggle="tab" aria-selected="true" role="tab"
                                    class="list-group-item list-group-item-action d-flex align-items-center active"
                                    data-bs-toggle="tab">@lang('General')</a>


                            </div>
                        </div>


                    </div>
                    <div class="col d-flex flex-column">

                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active show" id="tabs-general">
                                    <h2 class="mb-4">@lang('General')</h2>

                                    @livewire('admin.settings.general-setting')


                                </div>

                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>




</x-admin-layout>
