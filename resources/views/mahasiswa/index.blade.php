<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa</title>
    <link rel="icon" href="{{ asset('images/logo-masta24.png') }}" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        /* Ensure QR code div is visible on mobile */
        .qrcode-container {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @media (max-width: 768px) {
            .qrcode-container {
                display: block;
            }
        }

        /* Table wrapper styling */
        .table-wrapper {
            border: 1px solid #ddd;
            border-radius: 0.375rem;
            padding: 1em;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
        }

        /* Header styling */
        header {
            background-color: #fff;
            border-bottom: 1px solid #ddd;
        }

        .header-content {
            display: flex;
            align-items: center;
        }

        .header-content img {
            width: 50px;
            height: auto;
            margin-right: 1em;
        }

        .header-content h1 {
            margin: 0;
            font-size: 1.5em;
        }

        .table td,
        .table th {
            text-transform: uppercase;
        }

        /* Footer styling */
        footer {
            background-color: #f8f9fa;
            border-top: 1px solid #ddd;
            padding: 1em;
            text-align: center;
            position: relative;
            bottom: 0;
            width: 100%;
            box-shadow: 0 -4px 6px rgba(0, 0, 0, 0.1);
        }

        footer p {
            margin: 0;
            color: #000000;
        }
    </style>
</head>

<body class="bg-light">
    <header class="py-3">
        <div class="container header-content">
            <img src="{{ asset('images/logo-masta24.png') }}" alt="Mastamaru 2024 Logo">
            <h1>Mastamaru 2024</h1>
        </div>
    </header>

    <div class="container mt-2">
        <div class="table-wrapper">
            <h2 class="text-center mb-4">Daftar Mahasiswa</h2>

            <!-- Form pencarian -->
            <form action="{{ route('mahasiswa.index') }}" method="GET" class="mb-3">
                <div class="d-flex justify-content-end">
                    <div class="input-group" style="max-width: 400px;">
                        <input type="text" name="search" class="form-control" placeholder="Cari mahasiswa..."
                            value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table id="mahasiswaTable" class="table table-striped table-bordered">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>No</th>
                            <th>QRCode</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Fakultas</th>
                            <th>Prodi</th>
                            <th>Kelompok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mahasiswa as $mhs)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="qrcode-container">
                                    <div id="qrcode-{{ $mhs->nim }}" data-nama="{{ $mhs->nama }}"
                                        data-kelompok="{{ $mhs->kelompok }}">
                                        {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(100)->generate($mhs->qr_code) !!}
                                    </div>
                                </td>
                                <td>{{ $mhs->nim }}</td>
                                <td>{{ $mhs->nama }}</td>
                                <td>{{ $mhs->fakultas }}</td>
                                <td>{{ $mhs->prodi }}</td>
                                <td>{{ $mhs->kelompok }}</td>
                                <td>
                                    <button class="btn btn-success mx-1 my-1"
                                        onclick="downloadQRCode('{{ $mhs->nim }}', '{{ $mhs->nama }}', '{{ $mhs->kelompok }}')">
                                        <i class="bi bi-download"></i> Download QR Code
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Data mahasiswa tidak ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- Tampilkan pagination -->
            {{ $mahasiswa->appends(request()->input())->links() }}
        </div>
    </div>


    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DOM-to-Image -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"></script>
    <!-- FileSaver.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

    <script>
        function downloadQRCode(nim, nama, kelompok) {
            const node = document.getElementById(`qrcode-${nim}`);

            domtoimage.toBlob(node)
                .then(function(blob) {
                    const formattedName = nama.replace(/\s+/g, '_').toLowerCase();
                    window.saveAs(blob, `${formattedName}-${nim}-kelompok${kelompok}.png`);
                })
                .catch(function(error) {
                    console.error('oops, something went wrong!', error);
                });
        }
    </script>

    <footer>
        <p>&copy; {{ date('Y') }} Mastamaru 2024. All rights reserved.</p>
    </footer>
</body>

</html>
