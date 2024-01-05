<!-- mcu/edit.blade.php -->

@extends('layouts.main')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Edit Hasil Laboratorium</h6>
                        </div>
                    </div>
                    <div class="card-body p-3 pb-2">
                        <form action="{{ route('mcudokter.update', ['user' => $user]) }}" method="post">
                            @csrf
                            @method('PUT')

                            <!-- Menampilkan informasi pengguna -->
                            <div class="mb-3 row">
                                <div class="col-lg-4">
                                    <strong>Nama:</strong> {{ $user->name }}
                                </div>
                                <div class="col-lg-4">
                                    <strong>Status:</strong> {{ $user->status }}
                                </div>
                                <div class="col-lg-4">
                                    <strong>Departemen:</strong> {{ $user->dept }}
                                </div>
                            </div>


                           
                            {{-- <h5>Informasi Hasil Laboratorium:</h5> --}}
                            <div class="row">
                                <div class="col-lg-6">
                                    <h6>Hematologi</h6>
                                    <!-- Bagian Kiri -->
                                    <label for="hemoglobin">Hemoglobin</label>
                                    <input type="text" name="laboratorium[{{ $user->id }}][hemoglobin]"
                                        value="{{ $laboratorium->hemoglobin ?? '' }}" class="form-control form-control-sm">

                                    <label for="eritrosit">Eritrosit</label>
                                    <input type="text" name="laboratorium[{{ $user->id }}][eritrosit]"
                                        value="{{ $laboratorium->eritrosit ?? '' }}" class="form-control form-control-sm">
                                    <label for="luekosit">Luekosit</label>
                                    <input type="text" name="laboratorium[{{ $user->id }}][luekosit]"
                                        value="{{ $laboratorium->luekosit ?? '' }}" class="form-control form-control-sm">
                                    <label for="hematokrit">Hematokrit</label>
                                    <input type="text" name="laboratorium[{{ $user->id }}][hematokrit]"
                                        value="{{ $laboratorium->hematokrit ?? '' }}" class="form-control form-control-sm">

                                    <label for="trombosit">Trombosit</label>
                                    <input type="text" name="laboratorium[{{ $user->id }}][trombosit]"
                                        value="{{ $laboratorium->trombosit ?? '' }}"
                                        class="form-control form-control-sm"><br>

                                    <h6>Urinalisis Makroskopis</h6>

                                    <label for="warna">Warna</label>
                                    <input type="text" name="laboratorium[{{ $user->id }}][warna]"
                                        value="{{ $laboratorium->warna ?? '' }}" class="form-control form-control-sm">
                                    <label for="kejernihan">Kejernihan:</label>
                                    <input type="text" name="laboratorium[{{ $user->id }}][kejernihan]"
                                        value="{{ $laboratorium->kejernihan ?? '' }}"
                                        class="form-control form-control-sm"><br>

                                    <h6>Kimia Urine</h6>
                                    <label for="bj">B.J:</label>
                                    <input type="text" name="laboratorium[{{ $user->id }}][bj]"
                                        value="{{ $laboratorium->bj ?? '' }}" class="form-control form-control-sm"><br>



                                </div>
                                <div class="col-lg-6">
                                    <!-- Bagian Kanan -->
                                    <h6>Kimia Urine</h6>

                                   
                                    <label for="ph">ph</label>
                                    <input type="text" name="laboratorium[{{ $user->id }}][ph]"
                                        value="{{ $laboratorium->ph ?? '' }}" class="form-control form-control-sm"><br>
                                    <label for="leuko">Leuko</label>
                                    <input type="text" name="laboratorium[{{ $user->id }}][leuko]"
                                        value="{{ $laboratorium->leuko ?? '' }}" class="form-control form-control-sm">
                                    <label for="nitrit">Nitrit</label>
                                    <input type="text" name="laboratorium[{{ $user->id }}][nitrit]"
                                        value="{{ $laboratorium->nitrit ?? '' }}" class="form-control form-control-sm">
                                    <label for="protein">Protein</label>
                                    <input type="text" name="laboratorium[{{ $user->id }}][protein]"
                                        value="{{ $laboratorium->protein ?? '' }}" class="form-control form-control-sm">
                                    <label for="glukosa">Glukosa</label>
                                    <input type="text" name="laboratorium[{{ $user->id }}][glukosa]"
                                        value="{{ $laboratorium->glukosa ?? '' }}" class="form-control form-control-sm">
                                    <label for="keton">Keton</label>
                                    <input type="text" name="laboratorium[{{ $user->id }}][keton]"
                                        value="{{ $laboratorium->keton ?? '' }}" class="form-control form-control-sm">
                                    <label for="urobil">Urobil</label>
                                    <input type="text" name="laboratorium[{{ $user->id }}][urobil]"
                                        value="{{ $laboratorium->urobil ?? '' }}" class="form-control form-control-sm">
                                    <label for="bili">Bili</label>
                                    <input type="text" name="laboratorium[{{ $user->id }}][bili]"
                                        value="{{ $laboratorium->bili ?? '' }}" class="form-control form-control-sm">
                                    <label for="blood">Blood</label>
                                    <input type="text" name="laboratorium[{{ $user->id }}][blood]"
                                        value="{{ $laboratorium->blood ?? '' }}" class="form-control form-control-sm">


                                    {{-- <label for="tahun">Tahun:</label>
                                    <select id="tahun" name="laboratorium[{{ $user->id }}][tahun]"
                                        class="form-select form-select-sm">
                                        @foreach ($years as $year)
                                            <option value="{{ $year }}"
                                                @if ($tahun == $year) selected @endif>{{ $year }}
                                            </option>
                                        @endforeach
                                    </select><br> --}}
                                </div>
                            </div>




                            <input type="hidden" name="laboratorium[{{ $user->id }}][id_user]"
                                value="{{ $user->id }}">

                            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
