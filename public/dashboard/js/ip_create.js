
$(document).ready(function () {
   
    $("#region").change(function () {
        var region = $("#region").val();
        var token = $('meta[name="csrf-token"]').attr("content");
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{url('FilteredCities')}}",
            data: {
                region: region,
                _token: token,
            },
            success: function (response) {
                $("#city").empty(); // Clear existing options
                $("#city").append(
                    "<option value='' selected disabled>Please Select City</option>"
                );
                response.forEach((city) => {
                    var id = city["id"];
                    console.log(id);
                    $("#city").append(
                        "<option value='" +
                            id +
                            "'>" +
                            city["city_name"] +
                            "</option>"
                    );
                });
            },
            error: function (request, status, error) {
                console.log(error);
                alert("Couldn't retrieve cities. Please try again later.");
            },
        });
    });
});
