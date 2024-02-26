@extends('template')
@push('styles')
    <link href="{{ asset('assets/css/common.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/backend.css') }}" rel="stylesheet">
@endpush
@section('content')
    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="float-start">
                Addons
            </div>
            <div class="float-end">
                <form name="search_addons" class="form" method="POST" action="{{ route('home.addons') }}">
                    @csrf
                    <div class="d-flex align-items-center position-relative my-1 ">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                        <span class="svg-icon svg-icon-1 position-absolute ms-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                    transform="rotate(45 17.0365 15.1223)" fill="black"></rect>
                                <path
                                    d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                    fill="black"></path>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <input type="text" data-kt-user-table-filter="search"
                            class="form-control form-control-solid w-250px ps-14" placeholder="Search Addons" name="filter"
                            value="{{ empty($filter) ? '' : $filter }}">
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body">

            @if (count($data) > 0)
                <div class="app-page-title bg-white">
                    <div class="tab-content">
                        <div class="tab-pane active" id="notebook_page_511">
                            <div class="o_kanban_view o_kanban_ungrouped">
                                @foreach ($data as $row)
                                    <div class="oe_module_vignette o_kanban_record" modifiers="{}" tabindex="0"
                                        role="article">

                                        <img src="{{ asset('assets/media/svg/' . $row->icon) }}" class="oe_module_icon"
                                            alt="Icon" modifiers="{}">
                                        <div class="oe_module_desc" title="{{ $row->name }}" modifiers="{}">
                                            <h3 class="o_kanban_record_title" modifiers="{}">
                                                <span>{{ $row->name }}</span>&nbsp;
                                            </h3>
                                            <p class="oe_module_name" modifiers="{}">
                                                <span><small>{{ $row->info }}</small></span>
                                                @if ($row->instalation == false)
                                                    <span class="text-muted" modifiers="{}">Install</span>
                                                @else
                                                    <span class="text-muted" modifiers="{}">Installed</span>

                                                    @if ($row->model == 'pointofsale')
                                                        <a href="{{ route('dashboard') }}"
                                                            class="btn btn-info btn-sm float-right mt-1 ml-2"> Browse
                                                        </a>
                                                    @else
                                                        <a href="{{ route($row->model . '.index') }}"
                                                            class="btn btn-info btn-sm float-right mt-1 ml-2"> Browse
                                                        </a>
                                                    @endif
                                                @endif
                                            </p>
                                            <div class="oe_module_action" modifiers="{}">
                                                @if ($row->instalation == false)
                                                    <a href="{{ route('home.install_addons', $row->model) }}"
                                                        class="btn btn-sm btn-primary float-right"
                                                        role="button">Install</a>
                                                @else
                                                    <a href="{{ route('home.uninstall_addons', $row->model) }}"
                                                        class="btn btn-sm btn-danger float-right"
                                                        role="button">Uninstall</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="row mx-4">
                        {!! $data->render() !!}
                    </div>
                </div>
            @else
                <div class="alert alert-danger d-flex align-items-center p-5 mb-10">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen048.svg-->
                    <span class="svg-icon svg-icon-2hx svg-icon-danger me-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <path opacity="0.3"
                                d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z"
                                fill="black"></path>
                            <path
                                d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z"
                                fill="black"></path>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <div class="d-flex flex-column">
                        <h4 class="mb-1 text-danger">This is an alert</h4>
                        <span>Addons Not Found .</span>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
