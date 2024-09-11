<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.0/dist/tailwind.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto mt-10 p-4">
        <h1 class="text-3xl font-bold text-center mb-6">Daftar Mahasiswa</h1>
        <div class="overflow-x-auto">
            <table id="mahasiswaTable" class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
                <thead>
                    <tr class="bg-gray-200 text-gray-700">
                        <th class="py-2 px-4 border-b">NIM</th>
                        <th class="py-2 px-4 border-b">Nama</th>
                        <th class="py-2 px-4 border-b">Fakultas</th>
                        <th class="py-2 px-4 border-b">Prodi</th>
                        <th class="py-2 px-4 border-b">Kelompok</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mahasiswa as $mhs)
                        <tr class="hover:bg-gray-50">
                            <td class="py-2 px-4 border-b">{{ $mhs->nim }}</td>
                            <td class="py-2 px-4 border-b">{{ $mhs->nama }}</td>
                            <td class="py-2 px-4 border-b">{{ $mhs->fakultas }}</td>
                            <td class="py-2 px-4 border-b">{{ $mhs->prodi }}</td>
                            <td class="py-2 px-4 border-b">{{ $mhs->kelompok }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <!-- Tailwind JS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        $(document).ready(function() {
            $('#mahasiswaTable').DataTable({
                // Optional: Customize DataTable options here
                // e.g., pagination, search, etc.
            });
        });
    </script>
</body>

</html>
