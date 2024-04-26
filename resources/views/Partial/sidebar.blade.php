@php
    $disturbance = App\Models\DsDisturbance::class;
    $approval = App\Models\ApApproval::class;
    $portodp = App\Models\Master\MrOdpPort::class;
@endphp

<div id="sidebar" class="active position-relative">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="{{ url('') }}">
                        <img src="{{ url('') }}/assets/images/logo/logoapi.png" alt="Logo" srcset="">
                    </a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                @can('admin')
                    <li class="sidebar-title">Administrator</li>
                    <li class="sidebar-item {{ Request::is('books') ? 'active' : '' }}">
                        <a href="{{ url('books') }}" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Books</span>
                        </a>
                    </li>
                @endcan
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
