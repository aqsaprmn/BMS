@if (in_array($customer->status, $status))
    @foreach ($status as $item)
        @if ($item == 'O')
            <div class="card mb-3">
                <div class="card-header pb-0 row mx-0">
                    <div class="col-md-6">
                        <h4 class="card-title mb-0">Penjadwalan</h4>
                        <div>
                            <span><small class=" fw-bold">{{ $customer->installation->user->name }}</small>
                                -
                                <small>
                                    {{ date('d-m-Y H:i:s', strtotime($customer->installation->created_at)) }}</small></span>
                        </div>
                    </div>
                    {{-- @can('update', $customer)
                                        <div class="col-md-6 text-end">
                                            <a href="{{ url('customer') }}/{{ $customer->customer_id }}/edit"
                                                class="btn btn-primary me-1">
                                                <span class="d-flex align-items-center">
                                                    <i class="bi bi-pencil-square me-2"></i>
                                                    Edit Data
                                                </span>
                                            </a>
                                        </div>
                                    @endcan --}}
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="row mx-0">
                            <div class="col-lg-6">
                                <p>Penjadwalan</p>
                                <table class="table table-striped table-hover table-bordered">
                                    <tr>
                                        <th>Tanggal Pemasangan</th>
                                        <td class="text-center">:</td>
                                        <td>
                                            {{ date('d-m-Y', strtotime($customer->installation->pairing_date)) }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-lg-6">
                                <p>Vendor</p>
                                <table class="table table-striped table-hover table-bordered">
                                    <tr>
                                        <th>Nama</th>
                                        <td class="text-center">:</td>
                                        <td>
                                            {{ $customer->installation->vendor->desc }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <p>Catatan - Penjadwalan Dispatcher</p>
                                    <textarea disabled class="form-control" rows="3">{{ $customer->installation->note }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if ($item == 'M')
            <div class="card mb-3">
                <div class="card-header pb-0 row mx-0">
                    <div class="col-md-6">
                        <h4 class="card-title mb-0">Peralatan</h4>
                        <div>
                            <span><small class=" fw-bold">{{ $customer->tool->user->name }}</small>
                                -
                                <small>
                                    {{ date('d-m-Y H:i:s', strtotime($customer->tool->created_at)) }}</small></span>
                        </div>
                    </div>
                    @can('updateTools', $customer)
                        <div class="col-md-6 text-end">
                            <a href="{{ url('customer/tools') }}/{{ $customer->customer_id }}/edit"
                                class="btn btn-primary me-1">
                                <span class="d-flex align-items-center">
                                    <i class="bi bi-pencil-square me-2"></i>
                                    Edit Alat
                                </span>
                            </a>
                        </div>
                    @endcan
                </div>

                <div class="card-content">
                    <div class="card-body">
                        <div class="row mx-0">
                            <div class="col-md-6">
                                <p>ODP</p>
                                <table class="table table-striped table-hover table-bordered">
                                    <tr>
                                        <th>Deskripsi</th>
                                        <td class="text-center">:</td>
                                        <td>
                                            {{ $customer->tool->odp->desc ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class=" vertical-align-middle">Gambar</th>
                                        <td class="text-center">:</td>
                                        <td>
                                            <div class="position-relative w-100">
                                                <img class="w-100 rounded-2"
                                                    src="{{ url('public/storage/uploads/customer/imgOdp/' . $customer->tool->img_odp) }}
                                                                    "
                                                    alt="">
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-md-6">
                                <p>Port ODP</p>
                                <table class="table table-striped table-hover table-bordered">
                                    <tr>
                                        <th>Deskripsi</th>
                                        <td class="text-center">:</td>
                                        <td>
                                            {{ $customer->tool->port_odp }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class=" vertical-align-middle">Gambar</th>
                                        <td class="text-center">:</td>
                                        <td>
                                            <div class="position-relative w-100">
                                                <img class="w-100 rounded-2"
                                                    src="{{ url('public/storage/uploads/customer/imgPortOdp/' . $customer->tool->img_port_odp) }}
                                                                    "
                                                    alt="">
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-md-6">
                                <p>Kabel</p>
                                <table class="table table-striped table-hover table-bordered">
                                    <tr>
                                        <th>Deskripsi</th>
                                        <td class="text-center">:</td>
                                        <td>
                                            {{ $customer->tool->cable_length }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class=" vertical-align-middle">Gambar</th>
                                        <td class="text-center">:</td>
                                        <td>
                                            <div class="position-relative w-100">
                                                <img class="w-100 rounded-2"
                                                    src="{{ url('public/storage/uploads/customer/imgCableLength/' . $customer->tool->img_cable_length) }}
                                                                    "
                                                    alt="">
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-md-6">
                                <p>Modem</p>
                                <table class="table table-striped table-hover table-bordered">
                                    <tr>
                                        <th>Deskripsi</th>
                                        <td class="text-center">:</td>
                                        <td>
                                            -
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class=" vertical-align-middle">Gambar</th>
                                        <td class="text-center">:</td>
                                        <td>
                                            <div class="position-relative w-100">
                                                <img class="w-100 rounded-2"
                                                    src="{{ url('public/storage/uploads/customer/imgModem/' . $customer->tool->img_modem) }}
                                                                    "
                                                    alt="">
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <p>Catatan - Peralatan OM</p>
                                    <textarea disabled class="form-control" rows="3">{{ $customer->tool->note }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if ($item == 'A')
            <div class="card mb-3">
                <div class="card-header pb-0 row mx-0">
                    <div class="col-md-6">
                        <h4 class="card-title mb-0">Aktivasi</h4>
                        <div>
                            <span><small class=" fw-bold">{{ $customer->activation->user->name }}</small>
                                -
                                <small>
                                    {{ date('d-m-Y H:i:s', strtotime($customer->activation->created_at)) }}</small></span>
                        </div>
                    </div>
                    {{-- @can('update', $customer)
                                        <div class="col-md-6 text-end">
                                            <a href="{{ url('customer') }}/{{ $customer->customer_id }}/edit"
                                                class="btn btn-primary me-1">
                                                <span class="d-flex align-items-center">
                                                    <i class="bi bi-pencil-square me-2"></i>
                                                    Edit Data
                                                </span>
                                            </a>
                                        </div>
                                    @endcan --}}
                </div>

                <div class="card-content">
                    <div class="card-body">
                        <div class="row mx-0">
                            <div class="col-md-6">
                                <p>Internet</p>
                                <table class="table table-striped table-hover table-bordered">
                                    <tr>
                                        <th>No. Internet</th>
                                        <td class="text-center">:</td>
                                        <td>
                                            {{ $customer->activation->internet_no }}
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-md-6">
                                <p>Tanggal</p>
                                <table class="table table-striped table-hover table-bordered">
                                    <tr>
                                        <th>Tanggal Aktivasi</th>
                                        <td class="text-center">:</td>
                                        <td>
                                            {{ $customer->activation->activation_date }}
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <p>Catatan - Aktivasi</p>
                                    <textarea disabled class="form-control" rows="3">{{ $customer->activation->note }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @break($item == $customer->status)
    @endforeach
@endif
