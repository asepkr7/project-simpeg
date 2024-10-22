"use strict";

$("#modal-1").fireModal({ body: $("#exampleModal") });
$("#modal-2").fireModal({ body: "Modal body text goes here.", center: true });

let modal_3_body =
    '<p>Object to create a button on the modal.</p><pre class="language-javascript"><code>';
modal_3_body += "[\n";
modal_3_body += " {\n";
modal_3_body += "   text: 'Login',\n";
modal_3_body += "   submit: true,\n";
modal_3_body += "   class: 'btn btn-primary btn-shadow',\n";
modal_3_body += "   handler: function(modal) {\n";
modal_3_body += "     alert('Hello, you clicked me!');\n";
modal_3_body += "   }\n";
modal_3_body += " }\n";
modal_3_body += "]";
modal_3_body += "</code></pre>";
$("#modal-3").fireModal({
    title: "Modal with Buttons",
    body: modal_3_body,
    buttons: [
        {
            text: "Click, me!",
            class: "btn btn-primary btn-shadow",
            handler: function (modal) {
                alert("Hello, you clicked me!");
            },
        },
    ],
});

$("#modal-4").fireModal({
    footerClass: "bg-whitesmoke",
    body: "Add the <code>bg-whitesmoke</code> class to the <code>footerClass</code> option.",
    buttons: [
        {
            text: "No Action!",
            class: "btn btn-primary btn-shadow",
            handler: function (modal) {},
        },
    ],
});

$(document).ready(function () {
    $(".modal-5").click(function () {
        let diklatId = $(this).data("id");
        let modal = $("#uploadModal");
        modal.modal("show");

        // Set action attribute of the form dynamically
        let form = modal.find("#modal-upload");
        form.attr("action");
    });

    $("#modal-upload").submit(function (e) {
        e.preventDefault();
        let modal = $("#uploadModal");

        let formData = new FormData(this);
        console.log(formData);

        // DO AJAX HERE (using jQuery $.post)
        $.post({
            url: $(this).attr("action"),
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                form.stopProgress();
                modal
                    .find(".modal-body")
                    .prepend(
                        '<div class="alert alert-info alert-dismissible show fade"><div class="alert-body"><button class="close" data-dismiss="alert"><span>×</span> </button>' +
                            data.message +
                            "</div></div>"
                    );
            },
            error: function (xhr, status, error) {
                form.stopProgress();
                let errorMessage = "Terjadi kesalahan saat mengunggah berkas.";
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    const errors = xhr.responseJSON.errors;
                    errorMessage = Object.values(errors)[0];
                }
                modal
                    .find(".modal-body")
                    .prepend(
                        '<div class="alert alert-danger alert-dismissible show fade"><div class="alert-body"><button class="close" data-dismiss="alert"><span>×</span></button>' +
                            errorMessage +
                            "</div></div>"
                    );
            },
        });
    });
});
$("#modal-6").fireModal({
    body: "<p>Now you can see something on the left side of the footer.</p>",
    created: function (modal) {
        modal
            .find(".modal-footer")
            .prepend(
                '<div class="mr-auto"><a href="#">I\'m a hyperlink!</a></div>'
            );
    },
    buttons: [
        {
            text: "No Action",
            submit: true,
            class: "btn btn-primary btn-shadow",
            handler: function (modal) {},
        },
    ],
});

$(".oh-my-modal").fireModal({
    title: "My Modal",
    body: "This is cool plugin!",
});
