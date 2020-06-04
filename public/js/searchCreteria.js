$(function () {
    console.log("This is the search creteria js page.");
    var listOfLinks = $('.searchCreteriaValue');
    listOfLinks.on('click', function () {
        console.log($(this).text());
        //  $(this).text();
        var buttonValue = $('#selectedButton');
        buttonValue.html($(this).text());

        var idOfDropDown = parseInt($(this).attr('id'));

        switch (idOfDropDown) {
            case 1:
                $('#typeId').val(1);
                break;
            case 2:
                $('#typeId').val(2);
                break;
            case 3:
                $('#typeId').val(3);
                break;

            default:
                $('#typeId').val(1);
                break;
        }        
    });
});