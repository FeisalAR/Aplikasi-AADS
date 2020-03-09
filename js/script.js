$(document).ready(function () {

    //ADS Listing function
    $("#user-list-search").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $(".list-group-item").filter(function () {
            $(this).toggle($(this).find('.namaads, .kodeads').text().toLowerCase().indexOf(value) > -1)
        });
    });



    // Program Listing Function

    $("#program-list-search").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $(".list-group-item").filter(function () {
            $(this).toggle($(this).find('.namaads, .kodeprogram').text().toLowerCase().indexOf(value) > -1)
        });
    });

    //-------------------------------------

    // ,,MY'' Program Listing Function

    $("#program-list-search").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $(".list-group-item").filter(function () {
            $(this).toggle($(this).find('.namaprogram, .kodeprogram').text().toLowerCase().indexOf(value) > -1)
        });
    });


    //----Edit Program toggle tanggal selesai radio
    $(function () {
        $('input[name=radiostatus]').change(function () {
            $('.tanggalselesaitoggle').slideToggle();
        });
    });

    //-------------------------------------


    //Program status toggle radio button
    $(function () {
        $('input[name=radiofilterstatus]').change(function () {
            var value = $(this).val();
            if ($(this).val() != "Semua") {
                $(".list-group-item").filter(function () {
                    $(this).toggle($(this).find('.status').text().indexOf(value) > -1)
                });
            }
            else {
                $(".list-group-item").show();
            }
        });
    });
    //--------------------------------------


    //File upload profile pic
    // const input = document.querySelector('#image_uploads');
    // const preview = document.querySelector('.preview');

    // input.style.opacity = 0;

    // input.addEventListener('change', updateImageDisplay);

    // function updateImageDisplay() {
    //     while (preview.firstChild) {
    //         preview.removeChild(preview.firstChild);
    //     }

    //     const curFiles = input.files;
    //     if (curFiles.length === 0) {
    //         const para = document.createElement('p');
    //         para.textContent = 'File belum dipilih';
    //         preview.appendChild(para);
    //     } else {
    //         const list = document.createElement('ol');
    //         preview.appendChild(list);

    //         for (const file of curFiles) {
    //             const listItem = document.createElement('li');
    //             const para = document.createElement('p');

    //             if (validFileType(file)) {
    //                 para.textContent = `Nama file : ${file.name}, Ukuran file : ${returnFileSize(file.size)}.`;
    //                 const image = document.createElement('img');
    //                 image.src = URL.createObjectURL(file);

    //                 listItem.appendChild(image);
    //                 listItem.appendChild(para);
    //             } else {
    //                 para.textContent = `File name ${file.name}: Not a valid file type. Update your selection.`;
    //                 listItem.appendChild(para);
    //             }

    //             list.appendChild(listItem);
    //         }
    //     }
    // }

    // const fileTypes = [
    //     'image/jpeg',
    //     'image/pjpeg',
    //     'image/png'
    // ];

    // function validFileType(file) {
    //     return fileTypes.includes(file.type);
    // }

    // function returnFileSize(number) {
    //     if (number < 1024) {
    //         return number + 'bytes';
    //     } else if (number > 1024 && number < 1048576) {
    //         return (number / 1024).toFixed(1) + 'KB';
    //     } else if (number > 1048576) {
    //         return (number / 1048576).toFixed(1) + 'MB';
    //     }
    // }
    //-----------------------------------------

    $(".detailcollapser").click(function () {
        $(this).find(".rotate").toggleClass(".rotate.down");
    })







}); //---jQuery END -----

