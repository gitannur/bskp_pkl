@extends('layouts.main')

@section('content')

    <head>
        <script>
            function confirmSave() {
                return confirm("Simpan Data ?");
            }
        </script>

    </head>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Input Data Pemeriksaan</h6>
                        </div>
                    </div>

                    <div class="card-body p-3 pb-2">
                        <div class="mb-2">
                            {{-- <h5 class="mb-3">Filter</h5> --}}
                            <div class="row gx-3">
                                <div class="col-md-2 mb-2 ">
                                    <label for="statusFilter" class="form-label">-Status-</label>
                                    <select id="statusFilter" class="form-select">
                                        <option value=""></option>
                                        <option value="Assistant trainee">Assistant trainee</option>
                                        <option value="Contract">Contract</option>
                                        <option value="Manager">Manager</option>
                                        <option value="Monthly">Monthly</option>
                                        <option value="Regular">Regular</option>
                                        <option value="Staff">Staff</option>

                                    </select>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label for="deptFilter" class="form-label">-Departement-</label>
                                    <select id="deptFilter" class="form-select">
                                        <option value=""></option>
                                        {{-- <option value="" disabled selected hidden>Departemen</option> --}}
                                        <option value="Acc & Fin">Acc & Fin</option>
                                        <option value="BSKP">BSKP</option>
                                        <option value="Factory">Factory</option>
                                        <option value="Field">Field</option>
                                        <option value="FSD">FSD</option>
                                        <option value="HR & Legal">HR & Legal</option>
                                        <option value="HR Legal">HR Legal</option>
                                        <option value="HSE & DP">HSE & DP</option>
                                        <option value="I/A">I/A</option>
                                        <option value="I/B">I/B</option>
                                        <option value="I/C">I/C</option>
                                        <option value="II/D">II/D</option>
                                        <option value="II/E">II/E</option>
                                        <option value="II/F">II/F</option>
                                        <option value="IT">IT</option>
                                        <option value="QA">QA</option>
                                        <option value="QM">QM</option>
                                        <option value="Security">Security</option>
                                        <option value="Workshop">Workshop</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('mcu.store') }}" method="POST" onsubmit="return confirmSave()">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-info">Simpan</button>
                            <table id="example_input"
                                class="table table-striped table-hover align-items-center small-ttb compact"
                                style="width:100%">
                                <thead>
                                    {{-- <th>ID</th> --}}
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Status</th>
                                    <th>Dept</th>
                                    {{-- input --}}
                                    <th>Tgl MCU</th>
                                    <th>Berat Badan</th>
                                    <th>Tinggi Badan</th>
                                    <th>Anggota Gerak</th>
                                    <th>Tekanan Darah</th>
                                    <th>Nadi</th>
                                    <th>IMT</th>
                                    <th>Telinga</th>
                                    <th>Hidung</th>
                                    <th>Tenggorokan</th>
                                    <th>Mata</th>
                                    <th>Cardiovaskuler</th>
                                    <th>Pernafasan</th>
                                    <th>Abdomen</th>
                                    {{-- <th>Urine</th>
                                    <th>Hematologi</th> --}}
                                    <th>Audiometri</th>
                                    <th>Spirometri</th>
                                    <th>Riwayat Penyakit</th>
                                    <th>Diagnosa</th>
                                    <th>Saran</th>
                                    <th>Hasil Akhir</th>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            {{-- <td>
                                                {{ $user->id }}
                                            </td> --}}
                                            <td>
                                                {{ $user->nik }}
                                            </td>
                                            <td>
                                                {{ $user->name }}
                                            </td>
                                            <td>
                                                {{ $user->status }}
                                            </td>
                                            <td>
                                                {{ $user->dept }}
                                            </td>
                                            <td>
                                                <input type="date"
                                                    name="medical_check_up[{{ $user->id }}][tanggal_pemeriksaan]"
                                                    placeholder="Tanggal Check Up">
                                            </td>

                                            <td>
                                                <input type="text"
                                                    name="medical_check_up[{{ $user->id }}][berat_badan]"
                                                    placeholder="Berat Badan">
                                            </td>
                                            <td>
                                                <input type="text"
                                                    name="medical_check_up[{{ $user->id }}][tinggi_badan]"
                                                    placeholder="Tinggi Badan ">
                                            </td>
                                            <td>
                                                <select name="medical_check_up[{{ $user->id }}][anggota_gerak]"
                                                    placeholder="Anggota Gerak">
                                                    <option value=""></option>
                                                    <option value="normal">Normal</option>
                                                    <option value="normal">Dalam Batas Normal</option>
                                                    <option value="tidak_normal">Tidak Normal</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text"
                                                    name="medical_check_up[{{ $user->id }}][tekanan_darah]"
                                                    placeholder="Tekanan Darah ">
                                            </td>
                                            <td>
                                                <input type="text" id="nadi"
                                                    name="medical_check_up[{{ $user->id }}][nadi]" placeholder="Nadi ">
                                            </td>
                                            <td>
                                                <input type="text" id="imt"
                                                    name="medical_check_up[{{ $user->id }}][imt]" placeholder="IMT ">
                                            </td>
                                            <td>
                                                <select id="telinga"
                                                    name="medical_check_up[{{ $user->id }}][telinga]">
                                                    <option value=""></option>
                                                    <option value="normal">Normal</option>
                                                    <option value="normal">Dalam Batas Normal</option>
                                                    <option value="tidak_normal">Tidak Normal</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select id="hidung"
                                                    name="medical_check_up[{{ $user->id }}][hidung]">
                                                    <option value=""></option>
                                                    <option value="normal">Normal</option>
                                                    <option value="normal">Dalam Batas Normal</option>
                                                    <option value="tidak_normal">Tidak Normal</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select id="tenggorokan"
                                                    name="medical_check_up[{{ $user->id }}][tenggorokan]">
                                                    <option value=""></option>
                                                    <option value="normal">Normal</option>
                                                    <option value="normal">Dalam Batas Normal</option>
                                                    <option value="tidak_normal">Tidak Normal</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select id="mata" name="medical_check_up[{{ $user->id }}][mata]">
                                                    <option value=""></option>
                                                    <option value="normal">Normal</option>
                                                    <option value="normal">Dalam Batas Normal</option>
                                                    <option value="tidak_normal">Tidak Normal</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select id="cardiovaskuler"
                                                    name="medical_check_up[{{ $user->id }}][cardiovaskuler]">
                                                    <option value=""></option>
                                                    <option value="normal">Normal</option>
                                                    <option value="normal">Dalam Batas Normal</option>
                                                    <option value="tidak_normal">Tidak Normal</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select id="pernafasan"
                                                    name="medical_check_up[{{ $user->id }}][pernafasan]">
                                                    <option value=""></option>
                                                    <option value="normal">Normal</option>
                                                    <option value="normal">Dalam Batas Normal</option>
                                                    <option value="tidak_normal">Tidak Normal</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select id="abdomen"
                                                    name="medical_check_up[{{ $user->id }}][abdomen]">
                                                    <option value=""></option>
                                                    <option value="normal">Normal</option>
                                                    <option value="normal">Dalam Batas Normal</option>
                                                    <option value="tidak_normal">Tidak Normal</option>
                                                </select>
                                            </td>
                                            {{-- <td>
                                                <select id="urine"
                                                    name="medical_check_up[{{ $user->id }}][urine]">
                                                    <option value=""></option>
                                                    <option value="normal">Normal</option>
                                                    <option value="normal">Dalam Batas Normal</option>
                                                    <option value="tidak_normal">Tidak Normal</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select id="hematologi"
                                                    name="medical_check_up[{{ $user->id }}][hematologi]">
                                                    <option value=""></option>
                                                    <option value="normal">Normal</option>
                                                    <option value="normal">Dalam Batas Normal</option>
                                                    <option value="tidak_normal">Tidak Normal</option>
                                                </select>
                                            </td> --}}
                                            <td>
                                                <select id="audiometri"
                                                    name="medical_check_up[{{ $user->id }}][audiometri]">
                                                    <option value=""></option>
                                                    <option value="normal">Normal</option>
                                                    <option value="normal">Dalam Batas Normal</option>
                                                    <option value="tidak_normal">Tidak Normal</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select id="spirometri"
                                                    name="medical_check_up[{{ $user->id }}][spirometri]">
                                                    <option value=""></option>
                                                    <option value="normal">Normal</option>

                                                    <option value="dalam_batas_normal">Dalam Batas Normal</option>
                                                    <option value="tidak_normal">Tidak Normal</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" id="riwayat_penyakit"
                                                    name="medical_check_up[{{ $user->id }}][riwayat_penyakit]"
                                                    placeholder="Riwayat Penyakit">
                                            </td>
                                            <td>
                                                <input type="text" id="diagnosa"
                                                    name="medical_check_up[{{ $user->id }}][diagnosa]"
                                                    placeholder="Diagnosa">
                                            </td>
                                            <td>
                                                <input type="text" id="saran"
                                                    name="medical_check_up[{{ $user->id }}][saran]"
                                                    placeholder="Saran ">
                                            </td>
                                            <td>
                                                <input type="text" id="hasil_akhir"
                                                    name="medical_check_up[{{ $user->id }}][hasil_akhir]"
                                                    placeholder="Hasil Akhir ">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
