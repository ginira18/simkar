<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css'])

    <title>Slip Gaji</title>
    <style>
        .page {
            width: 21cm;
            height: 20.7cm;
            background: white;
            display: block;
            margin: 0 auto;
            margin-bottom: 0.5cm;
            box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
            overflow: hidden;
        }

        .main {
            padding-left: 0.5in;
            padding-right: 0.5in;
        }

        * {
            margin: 0;
            padding: 0;
            line-height: 1.3;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        td,
        th {
            padding: 8px;
            /* border: 1px solid black; */
            text-align: left;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2,
        .header h3 {
            margin: 5px 0;
        }

        .ttd {
            text-align: center;
            margin-top: 50px;
        }

        .ttd td {
            border: none;
            height: 60px;
        }

        .ttd td u {
            display: block;
        }

        .note {
            font-size: 9pt;
            margin-top: 10%;
            text-align: center;
        }

        @media print {
            .btn-container {
                display: none;
            }
        }
    </style>
    <!-- Include Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <div class="page">
        <div class="main">
            <div class="header pt-5">
                <h2 style="font-size: 16pt; font-family:'Times New Roman';"><u><b>Slip Gaji Karyawan</b></u></h2>
                <h3 style="font-size: 10pt; font-family:'Times New Roman';">PT. Abyaz Baby Nature Indonesia</h3>
                <h3 style="font-size: 10pt; font-family:'Times New Roman';">Jl. blablbabla</h3>
            </div>
            <div style="font-size:10pt; font-family:Arial;">
                <table>
                    <tr>
                        <td style="width: 10%">Nama </td>
                        <td style="width: 50%">: {{ $salaryHistory->employee->name }}</td>
                        <td style="width: 10%">NIP</td>
                        <td>: {{ $salaryHistory->employee->NIP }}</td>
                    </tr>
                    <tr>
                        <td>Bagian</td>
                        <td>: {{ $salaryHistory->department }}</td>
                        <td>Jabatan</td>
                        <td>: {{ $salaryHistory->position }}</td>
                    </tr>
                    <tr>
                        <td>Bulan</td>
                        <td>: {{ \Carbon\Carbon::parse($salaryHistory->periode)->locale('id')->translatedFormat('F Y') }}</td>
                    </tr>
                </table>

                <table style="margin-top: 20px; text-align:center; border-collapse: collapse; border: 1px solid black;">
                    <thead>
                        <tr>
                            <th style="border: 1px solid black;" colspan="2">Penghasilan</th>
                            <th style="border: 1px solid black;" colspan="2">Potongan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="border: 1px solid black;">Gaji Pokok</td>
                            <td style="border: 1px solid black;">Rp.
                                {{ number_format($salaryHistory->base_salary, 0, ',', '.') }}</td>
                            <td style="border: 1px solid black;">Asuransi</td>
                            <td style="border: 1px solid black;">Rp.
                                {{ number_format($salaryHistory->cut_insurance, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;">Tunjangan Tetap</td>
                            <td style="border: 1px solid black;">Rp.
                                {{ number_format($salaryHistory->fix_allowance, 0, ',', '.') }}</td>
                            <td style="border: 1px solid black;">Kehadiran</td>
                            <td style="border: 1px solid black;">Rp.
                                {{ number_format($salaryHistory->cut_attendance, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;">Bonus</td>
                            <td style="border: 1px solid black;">Rp.
                                {{ number_format($salaryHistory->bonus, 0, ',', '.') }}</td>
                            <td style="border: 1px solid black;">Potongan Lainnya</td>
                            <td style="border: 1px solid black;">Rp.
                            {{ number_format($salaryHistory->cut_other, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;"><b>Total Penghasilan</b></td>
                            <td style="border: 1px solid black;">Rp.
                                {{ number_format($salaryHistory->base_salary + $salaryHistory->fix_allowance + $salaryHistory->bonus , 0, ',', '.') }}</td>
                            <td style="border: 1px solid black;"><b>Total Potongan</b></td>
                            <td style="border: 1px solid black;">Rp.
                                {{ number_format($salaryHistory->cut_insurance + $salaryHistory->cut_attendance + $salaryHistory->cut_other, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;background-color: lightgray;"><b>Total Gaji Diterima</b>
                            </td>
                            <td style="border: 1px solid black;background-color: lightgray;" colspan="3"><b>Rp.
                                    {{ number_format($salaryHistory->total_salary, 0, ',', '.') }}</b></td>
                        </tr>
                    </tbody>
                </table>

                <table class="ttd">
                    <tr>
                        <td style="width: 70%;"></td>
                        <td>Kediri, {{ \Carbon\Carbon::now()->format('d F Y') }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Mengetahui,<br>Manager</td>
                    </tr>
                    <tr></tr>
                    <tr>
                        <td style="height: 60px;"></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="btn-container">
                                <a class="btn btn-secondary" href="{{ route('gaji-karyawan') }}">Kembali
                                </a>
                                <button class="btn btn-primary" onclick="window.print()">Cetak Slip Gaji</button>
                            </div>
                        </td>
                        <td><u>Melinda Ayu Wardani</u></td>
                    </tr>
                </table>


            </div>
        </div>
    </div>
    <script src="{{ asset('resources/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('resources/js/app.js') }}"></script>
    @yield('scripts')
</body>

</html>
