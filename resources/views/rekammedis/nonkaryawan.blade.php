@extends('layouts.main')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Rekam Medis Non Karyawan</h6>
                        </div>
                    </div>
                    <div class="card-body p-3 pb-2">
                        <form action="{{ route('rekammedis.store') }}" method="POST" class="row">
                            @csrf
                            <div class="row">
                                <div class="col-auto mb-3">
                                    <label for="search_user" class="form-label">Cari Nama </label>
                                    <input type="text" class="form-control form-control-sm" name="search_user" id="search_user" list="userList" placeholder="Masukkan nama user..." value="{{ $searchQuery ?? '' }}">
                                    <datalist id="userList">
                                        {{-- @foreach ($users as $user)
                                            <option value="{{ $user->name }}">
                                        @endforeach --}}
                                    </datalist>
                                </div>
                                {{-- <div class="col-auto mb-3">
                                    <label for="id_user" class="form-label">Nama User</label>
                                    <select class="form-select" name="id_user" id="id_user" required>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div> --}}
                            </div>
                            <h5 class="mb-3">Pemeriksaan Fisik</h5>
                            <div class="row gx-3">
                                <!-- Bagian Kiri -->
                                
                                <div class="col-md-5">
                                    <div class="col mb-3">
                                        <label for="nama_dokter" class="form-label">Nama Dokter</label>
                                        <input type="text" class="form-control custom-input form-control-sm"
                                            name="nama_dokter" id="nama_dokter" required>
                                    </div>
                                    <div class="col mb-3">
                                        <label for="tekanan_darah" class="form-label">Tekanan Darah</label>
                                        <input type="text" class="form-control custom-input form-control-sm"
                                            name="tekanan_darah" id="tekanan_darah" required>
                                    </div>
                                    <div class="col mb-3">
                                        <label for="nadi" class="form-label">Nadi</label>
                                        <input type="text" class="form-control custom-input form-control-sm"
                                            name="nadi" id="nadi" required>
                                    </div>
                                    <div class="col mb-3">
                                        <label for="pernafasan" class="form-label">Pernafasan</label>
                                        <input type="text" class="form-control custom-input form-control-sm"
                                            name="pernafasan" id="pernafasan" required>
                                    </div>
                                    <div class="col mb-3">
                                        <label for="vas" class="form-label">VAS</label>
                                        <input type="text" class="form-control custom-input form-control-sm"
                                            name="vas" id="vas" required>
                                    </div>
                                    <div class="col mb-3">
                                        <label for="suhu" class="form-label">Suhu</label>
                                        <input type="text" class="form-control custom-input form-control-sm"
                                            name="suhu" id="suhu" required>
                                    </div>

                                   

                                    <div class="col mb-3">
                                        <label for="diagnosis" class="form-label">Diagnosis</label>
                                        <input type="text" class="form-control custom-input form-control-sm"
                                            name="diagnosis" id="diagnosis" required>
                                    </div>
                                </div>

                                <!-- Bagian Kanan -->
                                <div class="col-md-5">
                                    <div class="col mb-3">
                                        <label for="tanggal" class="form-label">Tanggal </label>
                                        <input type="date" class="form-control custom-input form-control-sm"
                                            name="tanggal" id="tanggal" required>
                                    </div>

                                    <div class="col mb-3">
                                        <div class="row">
                                            <div class="col mb-3">
                                                <label for="saturasi_oksigen" class="form-label">Saturasi Oksigen</label>
                                                <input type="text" class="form-control custom-input form-control-sm"
                                                    name="saturasi_oksigen" id="saturasi_oksigen" required>
                                            </div>

                                            <div class="col mb-3">
                                                <label for="head_to_toe" class="form-label">Head To Toe</label>
                                                <textarea class="form-control custom-input form-control-sm" name="head_to_toe" id="head_to_toe" rows="3" required></textarea>
                                            </div>

                                           

                                        </div>
                                    </div>



                                    <div class="col mb-3">
                                        <label for="pengobatan" class="form-label">Pengobatan</label>
                                        <textarea class="form-control custom-input form-control-sm" name="pengobatan" id="pengobatan" rows="3"
                                            required></textarea>
                                    </div>
                                    <div class="col mb-3">
                                        <label for="anamesis" class="form-label">Anamnesis dan Riwayat Penyakit
                                            Dahulu</label>
                                        <textarea class="form-control custom-input form-control-sm" name="anamesis" id="anamesis" rows="3" required></textarea>
                                    </div>

                                    
                                </div>

                                <!-- Tombol Submit -->
                                <div class="col-12 mt-3">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
         $(document).ready(function() {
        $('#search_user').on('input', function() {
            var searchQuery = $(this).val().toLowerCase();

            // Saring opsi datalist berdasarkan kueri pencarian
            $('#userList option').each(function() {
                var optionText = $(this).val().toLowerCase();
                var isMatch = optionText.includes(searchQuery);
                $(this).toggle(isMatch);
            });
        });
    });
    </script>
@endsection
