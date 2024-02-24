@extends('template')
@push('styles')
    <link href="{{ asset('assets/css/common.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/backend.css') }}" rel="stylesheet">
@endpush
@section('content')
    <div class="card">
        <div class="card-header mt-3">
            <div class="float-start">
                Addons
            </div>
            <div class="float-end">
            </div>
        </div>
        <div class="card-body">
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
                                                <a href="{{ route('account.index') }}"
                                                    class="btn btn-info btn-sm float-right mt-1 ml-2"> Browse
                                                </a>
                                            @endif
                                        </p>
                                        <div class="oe_module_action" modifiers="{}">
                                            @if ($row->instalation == false)
                                                <a href="{{ route('home.install_addons', $row->model) }}"
                                                    class="btn btn-sm btn-primary float-right" role="button">Install</a>
                                            @else
                                                <a href="{{ route('home.uninstall_addons', $row->model) }}"
                                                    class="btn btn-sm btn-danger float-right" role="button">Uninstall</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <?php
                            $ghost = 30 - count($data);
                            for ($x = 0; $x < $ghost; $x++) {
                                echo "<div class='o_kanban_record o_kanban_ghost'></div>";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="tab-pane" id="notebook_page_521">

                    </div>
                </div>
                <div class="row mx-4">
                    {!! $data->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
