$(document).ready(function() {

    $('#selectAllBoxes').click(function(event) {

        if (this.checked) {

            $('.checkBoxes').each(function() {

                this.checked = true;

            });

        } else {


            $('.checkBoxes').each(function() {

                this.checked = false;

            });


        }
    });

    // preloader
    // var div_box = "<div id='load-screen'><div id='loading'></div></div>";

    // $("body").prepend(div_box);

    // $('#load-screen').delay(700).fadeOut(600, function() {
    //     $(this).remove();
    // });
    // end of preloader




    // function for the online users
    function loadUsersOnline() {
        $.get("functions.php?onlineusers=result", function(data) {
            $(".usersonline").text(data)
        });
    }

    setInterval(function() {
        loadUsersOnline();
    }, 500);

    // end of function for online users


});