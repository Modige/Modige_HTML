/*zip code filler*/
$(document).ready(function() {
    $("#zip").keyup(function() {
        var el = $(this);

        if (el.val().length === 5) {
            $.ajax({
                url: "http://zip.elevenbasetwo.com",
                cache: false,
                dataType: "json",
                type: "GET",
                data: "zip=" + el.val(),
                success: function(result, success) {
                    $("#city").val(result.city);
                    $("#state").val(result.state);
                }
            });
        }
    });
});