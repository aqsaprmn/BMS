const getTypeCustomer = () => {
    const typeUrl = `${url}/api/dashboard/typeCustomer`;

    const selectType = document.getElementById("type");

    $.ajax({
        type: "get",
        url: typeUrl,
        headers: {
            Authorization: access,
            "X-CSRF-TOKEN": _token,
            "Content-Type": "application/json",
        },
        dataType: "json",
        success: function (response) {
            const status = response.success;

            if (!status) {
                const text = response.message;

                Swal.fire({
                    title: "Error",
                    text,
                    icon: "error",
                });
            }

            const exitsOpt = selectType.innerHTML;

            let concateOpt = exitsOpt;

            const dataRes = response.data.map((item) => item.type);

            dataRes.forEach((item) => {
                const opt = `<option value="${item}">${item}</option>`;

                concateOpt = concateOpt.concat(opt);
            });

            selectType.innerHTML = concateOpt;
        },
        error: function (err) {
            console.log(err);

            Swal.fire({
                title: "Error",
                message: err,
                icon: "error",
            });

            return;
        },
    });
};

const chartSalesPerformance = (response) => {
    let chartSP;

    const success = response.success;

    if (!success) {
        const text = response.message;

        Swal.fire({
            title: "Error",
            text,
            icon: "error",
        });
    }

    const dataRes = response.data;

    const data = dataRes.map((item) => item.total);

    const labels = dataRes.map((item) => {
        const date = new Date(item.date).toLocaleDateString("id-ID", {
            year: "numeric",
            day: "2-digit",
            month: "2-digit",
        });

        const split = date.split("/");

        const go = new Date(`${split[1]}/${split[0]}/${split[2]}`);

        return go;
    });

    const datasets = [
        {
            label: "Sales Performance",
            data,
            borderColor: "rgb(75, 192, 192)",
            tension: 0.1,
            // backgroundColor: "rgb(75, 192, 192)",
            pointRadius: 5,
            pointBackgroundColor: "rgb(24, 192, 124)",
            showLine: true,
            // borderWidth: 2,
            fill: false,
        },
    ];

    const ctx = document.getElementById("sales-performance");

    chartSP = new Chart(ctx, {
        type: "line",
        data: {
            labels,
            datasets,
        },
        options: {
            legend: {
                display: false,
            },
            tooltips: {
                mode: "index",
                intersect: false,
                callbacks: {
                    title: function (tooltipItem, data) {
                        const index = tooltipItem[0].index;

                        const date = new Date(
                            data.labels[index]
                        ).toLocaleDateString("id-ID", {
                            year: "numeric",
                            day: "2-digit",
                            month: "short",
                        });

                        return date;
                    },
                    label: function (tooltipItem, data) {
                        const index = tooltipItem.index;

                        const datasetIndex = tooltipItem.datasetIndex;

                        const total = data.datasets[datasetIndex].data[index];

                        return `Total : ${total}`;
                    },
                },
            },
            hover: {
                mode: "nearest",
                intersect: true,
            },
            scales: {
                xAxes: [
                    {
                        gridLines: {
                            display: true,
                        },
                        type: "time",
                        time: {
                            unit: "day",
                        },
                        ticks: {
                            callback: function (_, index, values) {
                                const date = new Date(
                                    values[index].value
                                ).toLocaleDateString("id-ID", {
                                    year: "numeric",
                                    day: "2-digit",
                                    month: "short",
                                });

                                return date;
                            },
                        },
                    },
                ],
                yAxes: [
                    {
                        gridLines: {
                            display: true,
                        },
                        ticks: {
                            beginAtZero: true,
                            stepSize: 5,
                        },
                    },
                ],
            },
        },
    });

    return chartSP;
};

const chartTotalTypeCustomer = (response) => {
    let chartTTC;

    const success = response.success;

    if (!success) {
        const text = response.message;

        Swal.fire({
            title: "Error",
            text,
            icon: "error",
        });
    }

    const dataRes = response.data;

    const data = dataRes.map((item) => item.total);

    const labels = dataRes.map((item) => item.type);

    const datasets = [
        {
            label: "Total Customer /Tipe",
            data,
            backgroundColor: [
                "rgba(255, 0, 0, 0.1)",
                "rgba(0, 255,200, 0.1)",
                "rgba(200, 0, 200, 0.1)",
                "rgba(0, 255, 0, 0.1)",
                "rgba(0, 100, 50, 0.1)",
            ],
        },
    ];

    const ctx = document.getElementById("total-type-customer");

    chartTTC = new Chart(ctx, {
        type: "polarArea",
        data: {
            labels,
            datasets,
        },
        options: {
            legend: {
                align: "center",
                position: "right",
            },
            layout: {
                padding: {
                    top: 5,
                    bottom: 5,
                },
            },
            hover: {
                mode: "nearest",
                intersect: true,
            },
            elements: {
                arc: {
                    angle: 180,
                    borderColor: "black",
                    borderWidth: 1,
                },
            },
        },
    });

    return chartTTC;
};

const getDataApi = (url, method, filter = {}) => {
    let result;

    $.ajax({
        type: method,
        url: url,
        headers: {
            Authorization: access,
            "X-CSRF-TOKEN": _token,
            "Content-Type": "application/json",
        },
        async: false,
        data: filter,
        dataType: "json",
        success: function (response) {
            result = response;
        },
        error: function (err) {
            console.log(err);

            Swal.fire({
                title: "Error",
                text: err,
                icon: "error",
            });

            result = err;
        },
    });

    return result;
};

const dashboardSalesPerformance = (filter) => {
    const salesPerformanceUrl = `${url}/api/dashboard/salesPerformance`;

    return getDataApi(salesPerformanceUrl, "get", filter);
};

const dashboardTotalTypeCustomer = () => {
    const totalTypeCustomerUrl = `${url}/api/dashboard/totalTypeCustomer`;

    return getDataApi(totalTypeCustomerUrl, "get");
};

const dashboardActivities = () => {
    const activitiesUrl = `${url}/api/dashboard/activities`;

    return getDataApi(activitiesUrl, "get");
};

const checkDateLessThan = (start, end, act) => {
    const timesStart = new Date(start).getTime();
    const timesEnd = new Date(end).getTime();

    if (timesEnd < timesStart) {
        Swal.fire({
            title: "Perhatian!",
            text: "Tanggal akhir tidak boleh lebih rendah dari tanggal mulai.",
            icon: "warning",
        });

        return {
            success: false,
        };
    }

    return {
        success: true,
        data: act == "start" ? start : end,
    };
};

const dataInitGo = () => {
    const startDate = $("#startDate");
    const endDate = $("#endDate");

    const today = new Date().toLocaleDateString("id-ID", {
        year: "numeric",
        month: "2-digit",
        day: "2-digit",
    });

    const before = new Date();

    const beforeGo = before.setDate(before.getDate() - 7);

    const beforeAfter = new Date(beforeGo).toLocaleDateString("id-ID", {
        year: "numeric",
        month: "2-digit",
        day: "2-digit",
    });

    const splitToday = today.split("/");
    const splitBeforeAfter = beforeAfter.split("/");

    const startDateVal = `${splitBeforeAfter[2]}-${splitBeforeAfter[1]}-${splitBeforeAfter[0]}`;
    const endDateVal = `${splitToday[2]}-${splitToday[1]}-${splitToday[0]}`;

    startDate.val(startDateVal);
    endDate.val(endDateVal);
};

const reqInit = () => {
    dataInitGo();

    const time = $("#time").val();

    const type = $("#type").val();

    const startDate = $("#startDate").val();

    const endDate = $("#endDate").val();

    const filter = {
        startDate,
        endDate,
        time,
        type,
    };

    return filter;
};

const updateChartSalesPerformance = (chart, data, filter) => {
    let totalGo, labelsGo;
    if (filter.time == "Month") {
        totalGo = data.map((item) => {
            return item.total;
        });

        labelsGo = data.map((item) => {
            const date = new Date(
                `${item.year_at}-${
                    item.month_at.length == 1
                        ? `0${item.month_at}`
                        : item.month_at
                }-01`
            ).toLocaleDateString("id-ID", {
                year: "numeric",
                day: "2-digit",
                month: "2-digit",
            });

            const split = date.split("/");

            const go = new Date(`${split[1]}/${split[0]}/${split[2]}`);

            return go;
        });

        chart.options.scales.xAxes.forEach((item) => {
            item.time.unit = "month";
        });

        chart.options.scales.xAxes.forEach((item) => {
            item.ticks.callback = function (_, index, values) {
                const date = new Date(values[index].value).toLocaleDateString(
                    "id-ID",
                    {
                        year: "numeric",
                        month: "short",
                    }
                );

                return date;
            };
        });
    } else {
        totalGo = data.map((item) => {
            return item.total;
        });

        labelsGo = data.map((item) => {
            const date = new Date(item.date).toLocaleDateString("id-ID", {
                year: "numeric",
                day: "2-digit",
                month: "2-digit",
            });

            const split = date.split("/");

            const go = new Date(`${split[1]}/${split[0]}/${split[2]}`);

            return go;
        });

        chart.options.scales.xAxes.forEach((item) => {
            item.time.unit = "day";
        });

        chart.options.scales.xAxes.forEach((item) => {
            item.ticks.callback = function (_, index, values) {
                const date = new Date(values[index].value).toLocaleDateString(
                    "id-ID",
                    {
                        year: "numeric",
                        day: "2-digit",
                        month: "short",
                    }
                );

                return date;
            };
        });
    }

    chart.data.labels = labelsGo;
    chart.data.datasets.forEach((dataset) => {
        dataset.data = totalGo;
    });

    chart.update();
};

const eventInput = (chart, filter) => {
    $("#time").change(function (e) {
        e.preventDefault();

        const valTime = $(this).val();

        if (valTime == "Day") {
            $("#startDate").attr("type", "date");
            $("#endDate").attr("type", "date");

            dataInitGo();

            const startDate = $("#startDate").val();
            const endDate = $("#endDate").val();

            filter.startDate = startDate;
            filter.endDate = endDate;
        } else {
            $("#startDate").attr("type", "month");
            $("#endDate").attr("type", "month");

            const today = new Date().toLocaleDateString("id-ID", {
                year: "numeric",
                month: "2-digit",
            });

            const monthSplit = today.split("/");

            const month = `${monthSplit[1]}-${monthSplit[0]}`;

            $("#startDate").val(month);
            $("#endDate").val(month);
            filter.startDate = month;
            filter.endDate = month;
        }

        filter.time = valTime;

        const dataInit = dashboardSalesPerformance(filter);

        updateChartSalesPerformance(chart, dataInit.data, filter);
    });

    $("#type").change(function (e) {
        e.preventDefault();

        const valtype = $(this).val();

        filter.type = valtype;

        const dataInit = dashboardSalesPerformance(filter);

        updateChartSalesPerformance(chart, dataInit.data, filter);
    });

    $("#startDate").change(function (e) {
        e.preventDefault();

        const valstartDate = $(this).val();

        const valEndDate = $("#endDate").val();

        const check = checkDateLessThan(valstartDate, valEndDate, "start");

        if (!check.success) {
            return false;
        }

        filter.startDate = check.data;

        const dataInit = dashboardSalesPerformance(filter);

        updateChartSalesPerformance(chart, dataInit.data, filter);
    });

    $("#endDate").change(function (e) {
        e.preventDefault();

        const valEndDate = $(this).val();

        const valstartDate = $("#startDate").val();

        const check = checkDateLessThan(valstartDate, valEndDate, "end");

        if (!check.success) {
            return false;
        }

        filter.endDate = check.data;

        const dataInit = dashboardSalesPerformance(filter);

        updateChartSalesPerformance(chart, dataInit.data, filter);
    });
};

const showDashboardActivities = (data) => {
    const response = data;
    const activities = $("#activities");

    let dataLoop = "";

    response.data.forEach((item) => {
        dataLoop += `
            <div class="d-flex justify-start align-items-center py-2">
                <div class="avatar avatar-lg">
                    <img src="${url}/assets/images/faces/${item.user.image}">
                </div>
                <div class="name ms-4">
                    <h6 class="mb-1">${item.user.name}</h6>
                    <h6 class="text-muted mb-0 h-10 overflow-y-scroll">${item.desc}</h6>
                </div>
            </div>
        `;
    });

    activities.html(dataLoop);
};

$(document).ready(function () {
    getTypeCustomer();

    const filter = reqInit();

    const dataSalesPerformance = dashboardSalesPerformance(filter);

    const chartSP = chartSalesPerformance(dataSalesPerformance);

    eventInput(chartSP, filter);

    const dataTotalTypeCustomer = dashboardTotalTypeCustomer();

    chartTotalTypeCustomer(dataTotalTypeCustomer);

    const dataActivities = dashboardActivities();

    showDashboardActivities(dataActivities);
});
