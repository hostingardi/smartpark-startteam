@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Daftar Transaksi</div>
                    <div class="container">
                        <a href="{{ route('transactions.create') }}" class="btn btn-primary mb-3">Tambah Transaksi</a>
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
                                            <a href="{{ route('transactions.show', $transaksi->idtransaksi) }}" class="btn btn-info btn-sm">Detail</a>
                                            <a href="{{ route('transactions.edit', $transaksi->idtransaksi) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('transactions.destroy', $transaksi->idtransaksi) }}" method="POST" class="d-inline">
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
