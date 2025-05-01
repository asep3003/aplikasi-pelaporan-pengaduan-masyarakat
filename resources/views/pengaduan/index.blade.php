@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-header d-flex">
            <h4 class="card-title">Data Pengaduan</h4>
            <a href="{{ route('pengaduan.create') }}" class="btn btn-success ms-auto">
                <img src="{{ asset('assets/icons/plus-lg.svg') }}" width="20px" alt="">
                Tambah Pengaduan
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session ('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session ('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <table class="table table-striped table-dark mb-2">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Pengaduan</th>
                            <th>Isi Laporan</th>
                            <th>Foto</th>
                            <th>Status</th>
                            <th style="width: 100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengaduans as $pengaduan)
                            <tr>
                                <td>{{ $pengaduans->firstItem() + $loop->index }}</td>
                                <td>{{ $pengaduan->tgl_pengaduan }}</td>
                                <td>{{ $pengaduan->isi_laporan }}</td>
                                <td>
                                    @if ($pengaduan->foto != "-")
                                        <img src="{{ asset($pengaduan->foto) }}" alt="foto aduan" width="100px">
                                    @else
                                        {{ $pengaduan->foto }}
                                    @endif
                                </td>
                                <td>
                                    {!!
                                        $pengaduan->status == "0" ? '<span class="badge text-bg-secondary">Pending</span>' :
                                        ($pengaduan->status == "Proses" ? '<span class="badge text-bg-warning">Proses</span>' : '<span class="badge text-bg-success">Selesai</span>')
                                    !!}
                                </td>
                                <td>
                                    <a class="text-decoration-none" >
                                        <button type="button" class="btn btn-primary btn-sm"  data-bs-toggle="modal" data-bs-target="#modal{{ $loop->index }}">
                                            <img src="{{ asset('assets/bootstrap-icons/eye.svg') }}" width="20px" alt="">
                                        </button>
                                    </a>
                                    <a class="text-decoration-none" href="/pengaduan/edit/{{ $pengaduan->id }}">
                                        <button type="button" class="btn btn-warning btn-sm">
                                            <img src="{{ asset('assets/bootstrap-icons/pencil-square.svg') }}" width="20px" alt="">
                                        </button>
                                    </a>
                                    <a class="text-decoration-none" href="{{ route('pengaduan.delete', $pengaduan->id) }}" onclick="return confirm('Are you sure to delete?')">
                                        <button type="button" class="btn btn-danger btn-sm">
                                            <img src="{{ asset('assets/bootstrap-icons/trash.svg') }}" width="20px" alt="">
                                        </button>
                                    </a>
                                </td>
                            </tr>

                            {{-- Modal --}}
                            <div class="modal fade" id="modal{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                                    role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalCenterTitle">Detail Pengaduan</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="{{ asset($pengaduan->foto) }}" alt="" class="w-100 mb-2">
                                            <p>Tanggal Ditanggapi : {{ $pengaduan->getDataTanggapan?->tgl_tanggapan }}</p>
                                            <p>Tanggapan : {{ $pengaduan->getDataTanggapan?->tanggapan }}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-secondary"
                                                data-bs-dismiss="modal">
                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Close</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
                {{ $pengaduans->links() }}
            </div>
        </div>
    </div>
@endsection
