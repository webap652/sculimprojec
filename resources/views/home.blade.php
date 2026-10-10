@section('title', 'PPDB SMP NEGERI 1 PIRIME - Penerimaan Peserta Didik Baru')

@section('content')
=======
@extends('layouts.app')

@section('title', 'PPDB SMP NEGERI 1 PIRIME - Penerimaan Peserta Didik Baru')

@section('content')
@php
    $pengumumans = App\Models\Pengumuman::aktif()->terbaru()->take(5)->get();
@endphp
