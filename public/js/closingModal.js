
$(function () {
    //! this javascript file is used to close the previous modal that is under the one that has 
    //! been clicked.
    console.log("this is the section that will be used to close the previous modal.");
    $(".checkInButtonClicked").on('click', function () {
        console.log("close the previous modal.");
        var detailsModal = $(this).attr("data-id");
        console.log(detailsModal);
        $("#details" + detailsModal).modal("hide");

    });
});
