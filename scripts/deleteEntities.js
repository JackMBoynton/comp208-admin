$(document).ready(function () {
  $(".delete_user").click(function (e) {
    // cancel the default action
    e.preventDefault();
    // variables passed from rows in table
    var parent = $(this).parent("td").parent("tr");
    var userId = $(this).attr("data-user-id");
    var username = $(this).attr("data-username");
    // creating of the bootbox dialog
    bootbox.dialog({
      // center modal
      centerVertical: true,
      // set modal message and title
      message: "You are about to Delete User ID: " + userId + ", username: " + username + ". Are you sure you want to proceed?",
      title: "Confirm Removal",
      buttons: {
        // confirm button
        confirm: {
          label: "Confirm",
          className: "btn-primary",
          callback: function () {
            $.ajax({
              type: "GET",
              url: "../users/deleteUser.php",
              data: "id=" + userId,
            })
              .done(function () {
                bootbox.alert({
                  message: "User successfully deleted.",
                  centerVertical: true
                });
                parent.fadeOut("slow");
              })
              .fail(function () {
                bootbox.alert("Error. User could not be deleted.");
              });
          },
        },
        // cancel button
        cancel: {
          label: "Cancel",
          className: "btn-primary",
          callback: function () {
            $(".bootbox").modal("hide");
          },
        },
      },
    });
  }),
  $(".delete_admin").click(function (e) {
    // cancel the default action
    e.preventDefault();
    // variables passed from rows in table
    var parent = $(this).parent("td").parent("tr");
    var userId = $(this).attr("data-admin-id");
    var username = $(this).attr("data-username");
    // creating of the bootbox dialog
    bootbox.dialog({
      // center modal
      centerVertical: true,
      // set modal message and title
      message: "You are about to Delete Admin ID: " + userId + ", username: " + username + ". Are you sure you want to proceed?",
      title: "Confirm Removal",
      buttons: {
        // confirm button
        confirm: {
          label: "Confirm",
          className: "btn-primary",
          callback: function () {
            $.ajax({
              type: "GET",
              url: "../admins/deleteAdmin.php",
              data: "id=" + userId,
            })
              .done(function () {
                bootbox.alert({
                  message: "Admin successfully deleted.",
                  centerVertical: true
                });
                parent.fadeOut("slow");
              })
              .fail(function () {
                bootbox.alert("Error. Admin could not be deleted.");
              });
          },
        },
        // cancel button
        cancel: {
          label: "Cancel",
          className: "btn-primary",
          callback: function () {
            $(".bootbox").modal("hide");
          },
        },
      },
    });
  }),
  $(".delete_product").click(function (e) {
    // cancel the default action
    e.preventDefault();
    // variables passed from rows in table
    var parent = $(this).parent("td").parent("tr");
    var productId = $(this).attr("data-product-id");
    var barcode = $(this).attr("data-barcode");
    // creating of the bootbox dialog
    bootbox.dialog({
      // center modal
      centerVertical: true,
      // set modal message and title
      message: "You are about to Delete Product ID: " + productId + ", Barcode: " + barcode + ". Are you sure you want to proceed?",
      title: "Confirm Removal",
      buttons: {
        // confirm button
        confirm: {
          label: "Confirm",
          className: "btn-primary",
          callback: function () {
            $.ajax({
              type: "GET",
              url: "../products/deleteProduct.php",
              data: "id=" + productId,
            })
              .done(function () {
                bootbox.alert({
                  message: "Product successfully deleted.",
                  centerVertical: true
                });
                parent.fadeOut("slow");
              })
              .fail(function () {
                bootbox.alert("Error. Product could not be deleted.");
              });
          },
        },
        // cancel button
        cancel: {
          label: "Cancel",
          className: "btn-primary",
          callback: function () {
            $(".bootbox").modal("hide");
          },
        },
      },
    });
  }),
  $(".accept_request").click(function (e) {
    // cancel the default action
    e.preventDefault();
    // variables passed from rows in table
    var parent = $(this).parent("td").parent("tr");
    var reqId = $(this).attr("data-request-id");
    var productName = $(this).attr("data-productName");
    // creating of the bootbox dialog
    bootbox.dialog({
      // center modal
      centerVertical: true,
      // set modal message and title
      message: "You are about to Accept Request ID: " + reqId + ", product name: " + productName + ". Are you sure you want to proceed?",
      title: "Confirm Acceptance",
      buttons: {
        // confirm button
        confirm: {
          label: "Confirm",
          className: "btn-primary",
          callback: function () {
            $.ajax({
              type: "GET",
              url: "../requests/acceptRequest.php",
              data: "id=" + reqId,
            })
              .done(function () {
                bootbox.alert({
                  message: "Product added successfully.",
                  centerVertical: true
                });
                parent.fadeOut("slow");
              })
              .fail(function () {
                bootbox.alert("Error. Product could not be added.");
              });
          },
        },
        // cancel button
        cancel: {
          label: "Cancel",
          className: "btn-primary",
          callback: function () {
            $(".bootbox").modal("hide");
          },
        },
      },
    });
  }),
  $(".decline_request").click(function (e) {
    // cancel the default action
    e.preventDefault();
    // variables passed from rows in table
    var parent = $(this).parent("td").parent("tr");
    var reqId = $(this).attr("data-request-id");
    var productName = $(this).attr("data-productName");
    // creating of the bootbox dialog
    bootbox.dialog({
      // center modal
      centerVertical: true,
      // set modal message and title
      message: "You are about to Decline Request ID: " + reqId + ", product name: " + productName + ". Are you sure you want to proceed?",
      title: "Confirm Decline",
      buttons: {
        // confirm button
        confirm: {
          label: "Confirm",
          className: "btn-primary",
          callback: function () {
            $.ajax({
              type: "GET",
              url: "../requests/declineRequest.php",
              data: "id=" + reqId,
            })
              .done(function () {
                bootbox.alert({
                  message: "Product declined successfully.",
                  centerVertical: true
                });
                parent.fadeOut("slow");
              })
              .fail(function () {
                bootbox.alert("Error. Product could not be declined.");
              });
          },
        },
        // cancel button
        cancel: {
          label: "Cancel",
          className: "btn-primary",
          callback: function () {
            $(".bootbox").modal("hide");
          },
        },
      },
    });
  });
});
