<script>
    const LabelsPad = [
        'PAD',
        'BELANJA',
        'PEMBIAYAAN',
    ];

    const DataPad = {
        labels: LabelsPad,
        datasets: [{
                label: 'Sebelum Perubahan',
                backgroundColor: '#FF1E00',
                borderColor: '#FF1E00',
                data: [jumlah_pendapatan1, jumlah_belanja1, jumlah_pembiayaan1],
            },
            {
                label: 'Selisih Anggaran',
                backgroundColor: '#3B9AE1',
                borderColor: '#3B9AE1',
                data: [selisih_pendapatan, selisih_belanja, selisih_pembiayaan],
            },
            {
                label: 'Setelah Perubahan',
                backgroundColor: '#3FA796',
                borderColor: '#3FA796',
                data: [jumlah_pendapatan2, jumlah_belanja2, jumlah_pembiayaan2],
            }

        ]
    };

    const config = {
        type: 'bar',
        data: DataPad,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Grafik APBD Prov.NTB ' + tahun_anggaran
                }
            }
        }
    };

    const apbd = new Chart(
        document.getElementById('RealisasiAnggaran-chart'),
        config
    );
</script>
