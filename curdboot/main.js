$("#exampleModal").on("show.bs.modal", function(event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var recipient = button.data("whatever"); // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this);
    modal.find(".modal-title").text("New message to " + recipient);
    modal.find(".modal-body input").val(recipient);
});








  // $(document).ready(function() {
    //     //input text fields
    //     var varmax = parseFloat($('#maxsalary').val());
    //     var varmin = parseFloat($('#minsalary').val());
    //     console.log(varmax, varmin);

    //     $('#salarymax').on("keyup", function() {
    //         var maxSalary = parseFloat($("#salarymax").val());
    //         if ((maxSalary >= varmin) && (maxSalary <= varmax)) {
    //             $("#maxerror").text("success");
    //             console.log(maxSalary);
    //         } else {
    //             $("#maxerror").text("error");
    //         }

    //     });
    //     $('#salarymin').on("keyup", function() {
    //         var minSalary = parseFloat($("#salarymin").val());
    //         console.log(minSalary);
    //     });




    //     var minSalary = parseFloat($("#salarymin").val());


    //     // $("#mysalaryForm").validate({
    //     //     rules: {

    //     //         salarymax: {
    //     //             required: true,
    //     //             number: true,
    //     //             // min: varmin,
    //     //             range: [varmin, varmax]

    //     //         },
    //     //         salarymin: {
    //     //             required: {
    //     //                 depends: function(elem) {
    //     //                     return $("#salarymax").val() >= varmin
    //     //                 }
    //     //             },
    //     //             number: true,
    //     //             // min: varmin
    //     //             range: [varmin, varmax]

    //     //         },
    //     //         // age: {
    //     //         //     required: true,
    //     //         //     number: true,
    //     //         //     min: 18
    //     //         // },
    //     //         // email: {
    //     //         //     required: true,
    //     //         //     email: true
    //     //         // },
    //     //         // weight: {
    //     //         //     required: {
    //     //         //         depends: function(elem) {
    //     //         //             return $("#age").val() > 50
    //     //         //         }
    //     //         //     },
    //     //         //     number: true,
    //     //         //     min: 0
    //     //         // }
    //     //     },

    //     // })
    // });




    // 0000000000000000000000000=========================================

    $(document).ready(function() {

        //     //input text fields
        var varmax = parseFloat($('#maxsalaryinput').val());
        var varmin = parseFloat($('#minsalaryinput').val());
        console.log(varmax, varmin);


        $("#maxerror").hide();
        $("#minerror").hide();

        var error_max = false;
        var error_min = false;

        $("#salarymax").focusout(function() {
            check_max();
        });
        $("#salarymin").focusout(function() {
            check_min();
        });



        function check_max() {
            // var pattern = /^[0-9\.]*$/;
            // var maxSalary = $("#salarymax").val();
            $('#salarymax').on("keyup", function() {
                // var maxSalary = parseFloat($("#salarymax").val());
                var maxSalary = $("#salarymax").val();
                if ((maxSalary >= varmin) && (maxSalary <= varmax)) {
                    $("#maxerror").hide();
                    $("#salarymax").css("border-bottom", "2px solid #34F458");
                    console.log(maxSalary);
                } else {
                    $("#maxerror").html("Should contain only number");
                    $("#maxerror").show();
                    $("#salarymax").css("border-bottom", "2px solid #F90A0A");

                    error_max = true;
                }

            });

        }


        function check_min() {
            // var pattern = /^[0-9\.]*$/;
            // var minSalary = $("#salarymin").val()
            $('#salarymin').on("keyup", function() {
                // var minSalary = parseFloat($("#salarymin").val());
                var minSalary = $("#salarymin").val();
                if ((minSalary >= varmin) && (parseFloat($("#salarymax").val()) >= minSalary)) {

                    $("#minerror").hide();
                    $("#salarymin").css("border-bottom", "2px solid #34F458");
                    console.log(minSalary);
                } else {
                    $("#minerror").html("Should contain only number");
                    $("#minerror").show();
                    $("#salarymin").css("border-bottom", "2px solid #F90A0A");
                    error_min = true;
                }
            });

        }


        $("#mysalaryForm").on("submit", function() {

            // error_max = false;
            // error_min = false;
            check_max();
            check_min();

            if (error_max === false && error_min === false) {
                alert("Registration Successfull");
                return true;
            } else {
                alert("Please Fill the form Correctly");
                return false;
            }


        });

    });
