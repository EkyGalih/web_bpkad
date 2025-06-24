$(document).ready(function () {
    $('#search').on('input', function () {
        let query = $(this).val();

        if (query.length > 2) {
            $.ajax({
                url: window.route_pegawai_search, // gunakan variabel global
                type: 'GET',
                data: { query: query },
                success: function (data) {
                    $('#results').empty().show();

                    if (data.length > 0) {
                        data.forEach(item => {
                            $('#results').append(`
                                <li class="dropdown-item" data-url="${window.route_pegawai_show_base}/${item.id}">
                                    <img src="${item.foto}" alt="${item.name}">
                                    <div class="details">
                                        <span class="name">${item.name}</span>
                                        <span class="nip">NIP: ${item.nip}</span>
                                    </div>
                                </li>
                            `);
                        });

                        $('.dropdown-item').on('click', function () {
                            window.location.href = $(this).data('url');
                            $('#results').hide();
                        });
                    } else {
                        $('#results').append('<li class="dropdown-item">Tidak ditemukan</li>');
                    }
                }
            });
        } else {
            $('#results').hide();
        }
    });

    $(document).on('click', function (e) {
        if (!$(e.target).closest('#search, .dropdown-menu').length) {
            $('#results').hide();
        }
    });
});
