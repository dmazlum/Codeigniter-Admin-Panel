/**
 * Created by ADMAZLUM on 26.08.2016.
 */

// Blueimp Gallery
document.getElementsByClassName('gallery-item').onclick = function (event) {
    event = event || window.event;
    var target = event.target || event.srcElement;
    var link = target.src ? target.parentNode : target;
    var options = {
        index: link, event: event, onclosed: function () {
            setTimeout(function () {
                $("body").css("overflow", "");
            }, 200);
        }
    };
    var links = this.getElementsByTagName('a');
    blueimp.Gallery(links, options);
};

// Gallery Actions
var getUrl = window.location;
var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

//** edit **/
$('.edit').on('click', function (e) {

    e.preventDefault();
    
    if ($('.icheckbox').is(':checked')) {

        var val = [];
        $(':checkbox:checked').each(function (i) {
            val[i] = $(this).val();
        });

        if (val.length < 2) {
            $(location).attr('href', baseUrl + '/admin/co_gallery/sections/' + val);
        }

    } else {
        alert('Lütfen bir kayıt seçiniz');
    }

});

//** editSlider **/
$('.editSlider').on('click', function (e) {

    e.preventDefault();

    if ($('.icheckbox').is(':checked')) {

        var val = [];
        $(':checkbox:checked').each(function (i) {
            val[i] = $(this).val();
        });

        if (val.length < 2) {
            $(location).attr('href', baseUrl + '/admin/co_gallery/slider/' + val);
        }

    } else {
        alert('Lütfen bir kayıt seçiniz');
    }

});

//** delete **/
$('.delete').on('click', function (e) {

    e.preventDefault();

    if ($('.icheckbox').is(':checked')) {

        var val = [];
        $(':checkbox:checked').each(function () {
            val.push({id: $(this).val()});
        });

        // Delete
        $.ajax({
            method: "POST",
            url: "deleteSectionData/bulk",
            data: {DeleteData: val},
            success: function (data) {
                if (data == 'redirect') {
                    location.reload();
                } else {
                   $(location).attr('href', data);
                }
            }
        });

    } else {
        alert('Lütfen bir kayıt seçiniz');
    }

});

//** deleteSlider **/
$('.deleteSlider').on('click', function (e) {

    e.preventDefault();

    if ($('.icheckbox').is(':checked')) {

        var val = [];
        $(':checkbox:checked').each(function () {
            val.push({id: $(this).val()});
        });

        // Delete
        $.ajax({
            method: "POST",
            url: "deleteSliderData/bulk",
            data: {DeleteData: val},
            success: function (data) {
                if (data == 'redirect') {
                    location.reload();
                } else {
                    $(location).attr('href', data);
                }
            }
        });

    } else {
        alert('Lütfen bir kayıt seçiniz');
    }

});

//** delete gallery **/
$('.deleteGallery').on('click', function (e) {

    e.preventDefault();

    if ($('.icheckbox').is(':checked')) {

        var val = [];
        $(':checkbox:checked').each(function () {
            val.push({id: $(this).val()});
        });

        // Delete
        $.ajax({
            method: "POST",
            url: baseUrl + '/admin/co_gallery/deletePhotos',
            data: {DeleteData: val},
            success: function (data) {
                if (data == 'redirect') {
                    location.reload();
                }
            }
        });

    } else {
        alert('Lütfen bir kayıt seçiniz');
    }

});

// Dropzone
Dropzone.autoDiscover = false;

$(".dropzone").dropzone({
    maxFileSize: 2,
    parallelUploads: 10,
    maxFiles: 20,
    uploadMultiple: true,
    autoProcessQueue: false,
    acceptedFiles: '.jpg,.jpeg,.JPEG,.JPG,.png,.PNG',
    dictFileTooBig: "Maksimum resim boyutu 2MB'dır.",
    dictMaxFilesExceeded: "Tek seferde sadece 20 resim yükleyebilirsiniz.",
    addRemoveLinks: true,
    init: function () {
        var submitButton = document.querySelector("#act-on-upload");
        myDropzone = this;
        submitButton.addEventListener("click", function () {
            myDropzone.processQueue();
        });
        myDropzone.on("complete", function (file) {
            myDropzone.removeFile(file);
        });
        myDropzone.on("successmultiple", function (file) {
            alert(file.length + " adet fotoğraf başarıyla gönderilmiştir");
            location.reload();
        });
    }
});

// File upload
$(".file-simple").fileinput({
    showUpload: false,
    showCaption: false,
    browseClass: "btn btn-danger",
    maxFileCount: 1
});

$(".file-multiple").fileinput({
    showUpload: false,
    showCaption: false,
    browseClass: "btn btn-danger"
});

// File upload for News
$("#file-simple-news").fileinput({
    showUpload: false,
    showCaption: false,
    browseClass: "btn btn-danger",
    maxFileCount: 4
});