//Create New Record

// $(document).on("click", "#btn_create", function(e) {
//     e.preventDefault();

//     var firstname = $("#txt_firstname").val();
//     var lastname = $("#txt_lastname").val();
//     var create = $("#btn_create").val();

//     $.ajax({
//         url: "create.php",
//         type: "post",
//         data: {
//             studentfirstname: firstname,
//             studentlastname: lastname,
//             insertbutton: create,
//         },
//         success: function(response) {
//             fetch();
//             $("#message").html(response);
//         },
//     });

//     $("#insert_form")[0].reset();

//     //Fetch All Records

//     function fetch() {
//         $.ajax({
//             url: "read.php",
//             type: "get",
//             success: function(response) {
//                 $("#fetch").html(response);
//             },
//         });
//     }

//     fetch();
// });