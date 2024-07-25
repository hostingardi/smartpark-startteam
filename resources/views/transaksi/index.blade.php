@extends('layouts.master')


@section('page-title', 'Data Transaksi')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Daftar Transaksi</div>
                    <div class="container">
                    <a href="{{ route('transaksi.create') }}" class="btn btn-primary mb-3">Tambah Transaksi</a>
                    <table class="table"></table>
                            <table class="table">
                                <thead>
                                <tr>
                                <th>ID</th>
                                <th>ID User</th>
                                <th>ID Kendaraan</th>
                                <th>Harga Parkir</th>
                                <th>Waktu Pembayaran</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksis as $transaksi)
                                    <tr>
                                        <td>{{ $transaksi->idtransaksi }}</td>
                                        <td>{{ $transaksi->iduser }}</td>
                                        <td>{{ $transaksi->idkendaraan }}</td>
                                        <td>{{ $transaksi->hargaparkir }}</td>
                                        <td>{{ $transaksi->waktupembayaran }}</td>
                                        <td>
                                        <a href="{{ route('transaksi.show', $transaksi->idtransaksi) }}" class="btn btn-info btn-sm">Detail</a>
                                            <a href="{{ route('transaksi.edit', $transaksi->idtransaksi) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('transaksi.destroy', $transaksi->idtransaksi) }}" method="POST" class="d-inline"></form>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
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
@endsection


