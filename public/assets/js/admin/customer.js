import process from "./request.js";

$(document).ready(function () {
    $("#customer").click(function (e) {
        const target = e.target;

        let form = target.closest("form");

        if (target.classList.contains("delete")) {
            Swal.fire({
                title: "Yakin hapus pelanggan ini?",
                text: "Pelanggan akan terhapus permanent!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya!",
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        } else if (target.classList.contains("confirm")) {
            Swal.fire({
                title: "Yakin untuk konfirmasi?",
                text: "Pelanggan akan melanjutkan proses Dispatcher!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya!",
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    });
});

let customer = document.querySelector("#customer");

if (customer) {
    let dataTableCustomer = new simpleDatatables.DataTable(customer);
}

$(function () {
    const churnButton = $(".churn");

    churnButton.click(function (e) {
        const titleEvent = this.checked ? "Churn" : "Aktivasi";

        Swal.fire({
            title: `Yakin pelanggan ini ${titleEvent}?`,
            text: `Pelanggan akan dilakukan proses ${titleEvent}!`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya!",
        }).then((result) => {
            if (!result.isConfirmed) {
                // console.log(this, this.checked);
                if (this.checked) {
                    this.checked = false;
                } else {
                    this.checked = true;
                }
            } else {
                processChurn(this, e);
            }
        });

        function processChurn(that) {
            const customerId = $(e.target).attr("data-customer-id");
            const churnAct = that.checked ? "Y" : "N";

            console.log(customerId, "Ignore this, Get Customer ID!");

            const data = {
                customer_id: customerId,
                churn: churnAct,
                _token: _token,
            };

            const result = process(data, churnUrl, function (e) {
                if (e.status != "success") {
                    Swal.fire({
                        title: "Error",
                        text: e.message,
                        icon: "error",
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Ok!",
                    });

                    that.checked = false;

                    return false;
                }

                Swal.fire({
                    title: "Sukses",
                    text: e.message,
                    icon: "success",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Ok!",
                });
            });

            return false;
        }
    });
});
