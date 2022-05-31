const maxPhotos = 15;
const columns = 3;

$(function() {
    setModal();
});

function setModal() {
    $(".popupable").click(function() { setImage(this) });
    $("#modal-close").click(function() {
        $("#modal-main").hide();
    });
}

function setImage(img) {
    $("#modal-main").show();
    var id = photoLinks.indexOf(img.src);
    $("#modal-image").attr("src", photoLinks[id]);
    $("#modal-caption").text(photoTitles[id]);
}

function slideImage(direction) {
    var id = photoLinks.indexOf($("#modal-image").attr("src"));
    id = (id + direction + photoLinks.length) % photoLinks.length;
    $("#modal-left, #modal-right").hide();
    $("#modal-image").fadeOut(200, function() {
            $("#modal-image").attr('src', photoLinks[id]);
            $("#modal-left, #modal-right").show();
        })
        .fadeIn(100);
    $("#modal-caption").fadeOut(200, function() {
            $("#modal-caption").text(photoTitles[id]);
        })
        .fadeIn(100);
}