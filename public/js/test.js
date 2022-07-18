$(window).on("load", function () {
    /* === Date Time Picker == */
    jQuery(".new-datepicker").datetimepicker({
        validateOnBlur: false,
        timepicker: false,
        //format:'D, M d,Y',
        format: "d/m/Y",
        value: new Date(),
        defaultDate: false,
        onSelectDate: function (dp, $input) {},
    });

    jQuery(".datetimepicker").datetimepicker({
        validateOnBlur: false,
        format: "d/m/Y",
        value: new Date(),
    });

    jQuery(".timepicker").datetimepicker({
        validateOnBlur: false,
        datepicker: false,
        format: "d/m/Y",
        value: new Date(),
    });

    var month = new Array();
    month[0] = "01";
    month[1] = "02";
    month[2] = "03";
    month[3] = "04";
    month[4] = "05";
    month[5] = "06";
    month[6] = "07";
    month[7] = "08";
    month[8] = "09";
    month[9] = "10";
    month[10] = "11";
    month[11] = "12";

    // $(".nextDate").on("click", function () {
    //     let a = $(".new-datepicker").val();
    //     let newDate = new Date(new Date(a).getTime() + 1 * 24 * 60 * 60 * 1000);
    //     let date = newDate.getDate();
    //     let tempMonth = month[newDate.getMonth()];
    //     let year = newDate.getFullYear();
    //     console.log(newDate);
    //     $(".new-datepicker").val(tempMonth + "-" + date + "-" + year);
    //     return false;
    // });

    // $(".prevDate").on("click", function () {
    //     let a = $(".new-datepicker").val();
    //     let newDate = new Date(new Date(a).getTime() - 1 * 24 * 60 * 60 * 1000);
    //     let date = newDate.getDate();
    //     let tempMonth = month[newDate.getMonth()];
    //     let year = newDate.getFullYear();
    //     console.log(newDate);
    //     $(".new-datepicker").val(tempMonth + "-" + date + "-" + year);
    //     return false;
    // });

    customScroll();
});

function customScroll() {
    $(".scrolly").mCustomScrollbar({
        axis: "y",
        theme: "light-3",
        scrollbarPosition: "outside",
    });
}
