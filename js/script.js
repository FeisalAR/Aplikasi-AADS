$(document).ready(function() {

    //ADS Listing function
    $("#user-list-search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".list-group-item").filter(function() {
            $(this).toggle($(this).find('.namaads, .kodeads').text().toLowerCase().indexOf(value) > -1)
        });
    });


    // Program Listing Function

    $("#program-list-search-listing").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".list-group-item").filter(function() {
            $(this).toggle($(this).find('.namaads, .kodeprogram').text().toLowerCase().indexOf(value) > -1)
        });
    });

    //-------------------------------------


    // ,,MY'' Program Listing Function

    $("#program-list-search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".list-group-item").filter(function() {
            $(this).not("#profilbox").toggle($(this).find('.namaprogram, .kodeprogram').text().toLowerCase().indexOf(value) > -1)
        });
    });







    //----Edit Program toggle tanggal selesai radio
    $(function() {
        $('input[name=radiostatus]').change(function() {
            $('.tanggalselesaitoggle').slideToggle();
        });
    });

    //-------------------------------------


    //Program status toggle radio button
    $(function() {
        $('input[name=radiofilterstatus]').change(function() {
            var value = $(this).val();
            if ($(this).val() != "Semua") {
                $(".list-group-item").filter(function() {
                    $(this).toggle($(this).find('.status').text().indexOf(value) > -1)
                });
            } else {
                $(".list-group-item").show();
            }
        });
    });
    //--------------------------------------



    //--------------Month translate

    $('.catatantanggal, .targetdate, .bdads, .selesaicapaian, .tanggalcapaian, .tanggalselesai, .tanggaltarget, #tanggalartikel').each(function() {
        var text = $(this).text();
        $(this).text(text.replace('January', 'Januari'));
    });

    $('.catatantanggal, .targetdate, .bdads, .selesaicapaian, .tanggalcapaian, .tanggalselesai, .tanggaltarget, #tanggalartikel').each(function() {
        var text = $(this).text();
        $(this).text(text.replace('February', 'Februari'));
    });

    $('.catatantanggal, .targetdate, .bdads, .selesaicapaian, .tanggalcapaian, .tanggalselesai, .tanggaltarget, #tanggalartikel').each(function() {
        var text = $(this).text();
        $(this).text(text.replace('March', 'Maret'));
    });

    $('.catatantanggal, .targetdate, .bdads, .selesaicapaian, .tanggalcapaian, .tanggalselesai, .tanggaltarget, #tanggalartikel').each(function() {
        var text = $(this).text();
        $(this).text(text.replace('May', 'Mei'));
    });

    $('.catatantanggal, .targetdate, .bdads, .selesaicapaian, .tanggalcapaian, .tanggalselesai, .tanggaltarget, #tanggalartikel').each(function() {
        var text = $(this).text();
        $(this).text(text.replace('June', 'Juni'));
    });

    $('.catatantanggal, .targetdate, .bdads, .selesaicapaian, .tanggalcapaian, .tanggalselesai, .tanggaltarget, #tanggalartikel').each(function() {
        var text = $(this).text();
        $(this).text(text.replace('July', 'Juli'));
    });

    $('.catatantanggal, .targetdate, .bdads, .selesaicapaian, .tanggalcapaian, .tanggalselesai, .tanggaltarget, #tanggalartikel').each(function() {
        var text = $(this).text();
        $(this).text(text.replace('August', 'Agustus'));
    });

    $('.catatantanggal, .targetdate, .bdads, .selesaicapaian, .tanggalcapaian, .tanggalselesai, .tanggaltarget, #tanggalartikel').each(function() {
        var text = $(this).text();
        $(this).text(text.replace('October', 'Oktober'));
    });

    $('.catatantanggal, .targetdate, .bdads, .selesaicapaian, .tanggalcapaian, .tanggalselesai, .tanggaltarget, #tanggalartikel').each(function() {
        var text = $(this).text();
        $(this).text(text.replace('December', 'Desember'));
    });




}); //---jQuery END -----