<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Dashboard-->

            <!--begin::Row-->
            <div class="row">

                <div class="col-xl-2">
                    <a href="<?= base_url() ?>cases-by-group/a-positive">
                        <div class="card card-custom bg-dark gutter-b" style="height: 150px">
                            <div class="card-body">
                                <i class="flaticon2 flaticon2-drop icon-2x text-danger"></i>
                                <div class="text-inverse-success font-weight-bolder font-size-h2 mt-3 counter-up"><?= $group_count['A+'] ?></div>
                                <a href="<?= base_url() ?>cases-by-group/a-positive" class="text-inverse-success font-weight-bold font-size-lg mt-1">A+</a>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-2">
                    <a href="<?= base_url() ?>cases-by-group/b-positive">
                        <div class="card card-custom bg-dark gutter-b" style="height: 150px">
                            <div class="card-body">
                                <i class="flaticon2 flaticon2-drop icon-2x text-danger"></i>
                                <div class="text-inverse-success font-weight-bolder font-size-h2 mt-3 counter-up"><?= $group_count['B+'] ?></div>
                                <a href="<?= base_url() ?>cases-by-group/b-positive" class="text-inverse-success font-weight-bold font-size-lg mt-1">B+</a>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-2">
                    <a href="<?= base_url() ?>cases-by-group/ab-positive">
                        <div class="card card-custom bg-dark gutter-b" style="height: 150px">
                            <div class="card-body">
                                <i class="flaticon2 flaticon2-drop icon-2x text-danger"></i>
                                <div class="text-inverse-success font-weight-bolder font-size-h2 mt-3 counter-up"><?= $group_count['AB+'] ?></div>
                                <a href="<?= base_url() ?>cases-by-group/ab-positive" class="text-inverse-success font-weight-bold font-size-lg mt-1">AB+</a>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-2">
                    <a href="<?= base_url() ?>cases-by-group/o-positive">
                        <div class="card card-custom bg-dark gutter-b" style="height: 150px">
                            <div class="card-body">
                                <i class="flaticon2 flaticon2-drop icon-2x text-danger"></i>
                                <div class="text-inverse-success font-weight-bolder font-size-h2 mt-3 counter-up"><?= $group_count['O+'] ?></div>
                                <a href="<?= base_url() ?>cases-by-group/o-positive" class="text-inverse-success font-weight-bold font-size-lg mt-1">O+</a>
                            </div>
                        </div>
                    </a>
                </div>


                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                    <a href="<?= base_url() ?>cases">
                        <div class="card card-custom bg-danger gutter-b" style="height: 150px">
                            <div class="card-body">
                                <!-- <i class="flaticon2 flaticon2-drop icon-2x text-white"></i> -->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M5.5,2 L18.5,2 C19.3284271,2 20,2.67157288 20,3.5 L20,6.5 C20,7.32842712 19.3284271,8 18.5,8 L5.5,8 C4.67157288,8 4,7.32842712 4,6.5 L4,3.5 C4,2.67157288 4.67157288,2 5.5,2 Z M11,4 C10.4477153,4 10,4.44771525 10,5 C10,5.55228475 10.4477153,6 11,6 L13,6 C13.5522847,6 14,5.55228475 14,5 C14,4.44771525 13.5522847,4 13,4 L11,4 Z" fill="#000000" opacity="0.3"/>
                                        <path d="M5.5,9 L18.5,9 C19.3284271,9 20,9.67157288 20,10.5 L20,13.5 C20,14.3284271 19.3284271,15 18.5,15 L5.5,15 C4.67157288,15 4,14.3284271 4,13.5 L4,10.5 C4,9.67157288 4.67157288,9 5.5,9 Z M11,11 C10.4477153,11 10,11.4477153 10,12 C10,12.5522847 10.4477153,13 11,13 L13,13 C13.5522847,13 14,12.5522847 14,12 C14,11.4477153 13.5522847,11 13,11 L11,11 Z M5.5,16 L18.5,16 C19.3284271,16 20,16.6715729 20,17.5 L20,20.5 C20,21.3284271 19.3284271,22 18.5,22 L5.5,22 C4.67157288,22 4,21.3284271 4,20.5 L4,17.5 C4,16.6715729 4.67157288,16 5.5,16 Z M11,18 C10.4477153,18 10,18.4477153 10,19 C10,19.5522847 10.4477153,20 11,20 L13,20 C13.5522847,20 14,19.5522847 14,19 C14,18.4477153 13.5522847,18 13,18 L11,18 Z" fill="#000000"/>
                                    </g>
                                </svg>
                                <div class="text-inverse-success font-weight-bolder font-size-h2 mt-3 counter-up"><?= $open_cases_count ?></div>
                                <a href="#" class="text-inverse-success font-weight-bold font-size-lg mt-1"> Open Cases</a>
                            </div>
                        </div>
                    </a>
                </div>

            </div>

            <div class="row">

                <div class="col-xl-2">
                    <a href="<?= base_url() ?>cases-by-group/a-negative">
                        <div class="card card-custom bg-dark gutter-b" style="height: 150px">
                            <div class="card-body">
                                <i class="flaticon2 flaticon2-drop icon-2x text-danger"></i>
                                <div class="text-inverse-success font-weight-bolder font-size-h2 mt-3 counter-up"><?= $group_count['A-'] ?></div>
                                <a href="<?= base_url() ?>cases-by-group/a-negative" class="text-inverse-success font-weight-bold font-size-lg mt-1">A-</a>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-2">
                    <a href="<?= base_url() ?>cases-by-group/b-negative">
                        <div class="card card-custom bg-dark gutter-b" style="height: 150px">
                            <div class="card-body">
                                <i class="flaticon2 flaticon2-drop icon-2x text-danger"></i>
                                <div class="text-inverse-success font-weight-bolder font-size-h2 mt-3 counter-up"><?= $group_count['B-'] ?></div>
                                <a href="<?= base_url() ?>cases-by-group/b-negative" class="text-inverse-success font-weight-bold font-size-lg mt-1">B-</a>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-2">
                    <a href="<?= base_url() ?>cases-by-group/ab-negative">
                        <div class="card card-custom bg-dark gutter-b" style="height: 150px">
                            <div class="card-body">
                                <i class="flaticon2 flaticon2-drop icon-2x text-danger"></i>
                                <div class="text-inverse-success font-weight-bolder font-size-h2 mt-3 counter-up"><?= $group_count['AB-'] ?></div>
                                <a href="<?= base_url() ?>cases-by-group/ab-negative" class="text-inverse-success font-weight-bold font-size-lg mt-1">AB-</a>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-2">
                    <a href="<?= base_url() ?>cases-by-group/o-negative">
                        <div class="card card-custom bg-dark gutter-b" style="height: 150px">
                            <div class="card-body">
                                <i class="flaticon2 flaticon2-drop icon-2x text-danger"></i>
                                <div class="text-inverse-success font-weight-bolder font-size-h2 mt-3 counter-up"><?= $group_count['O-'] ?></div>
                                <a href="<?= base_url() ?>cases-by-group/o-negative" class="text-inverse-success font-weight-bold font-size-lg mt-1">O-</a>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-4">
                    <a href="<?= base_url() ?>donors">
                        <div class="card card-custom bg-danger gutter-b" style="height: 150px">
                            <div class="card-body">
                                <!-- <i class="flaticon2 flaticon2-drop icon-2x text-white"></i> -->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24"/>
                                        <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                        <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                                    </g>
                                </svg>
                                <div class="text-inverse-success font-weight-bolder font-size-h2 mt-3 counter-up"><?= $eligible_donors_count ?></div>
                                <a href="#" class="text-inverse-success font-weight-bold font-size-lg mt-1"> Eligible Donors</a>
                            </div>
                        </div>
                    </a>
                </div>


            </div>
            <!--end::Row-->




            <!--end::Dashboard-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<!--end::Content-->


<script src="https://www.gstatic.com/charts/loader.js"></script>


<script type="text/javascript"> 


  "use strict";
  var KTGoogleChartsDemo = {
    init: function () {
        google.load("visualization", "1", { packages: ["corechart", "bar", "line"] }),
        google.setOnLoadCallback(function () {
            KTGoogleChartsDemo.runDemos();
        });
    },
    runDemos: function () {
        var e;
        !(function () {
            var e = new google.visualization.DataTable();
            e.addColumn("timeofday", "Time of Day"),
            e.addColumn("number", "Motivation Level"),
            e.addColumn("number", "Energy Level"),
            e.addRows([
                [{ v: [8, 0, 0], f: "8 am" }, 1, 0.25],
                [{ v: [9, 0, 0], f: "9 am" }, 2, 0.5],
                [{ v: [10, 0, 0], f: "10 am" }, 3, 1],
                [{ v: [11, 0, 0], f: "11 am" }, 4, 2.25],
                [{ v: [12, 0, 0], f: "12 pm" }, 5, 2.25],
                [{ v: [13, 0, 0], f: "1 pm" }, 6, 3],
                [{ v: [14, 0, 0], f: "2 pm" }, 7, 4],
                [{ v: [15, 0, 0], f: "3 pm" }, 8, 5.25],
                [{ v: [16, 0, 0], f: "4 pm" }, 9, 7.5],
                [{ v: [17, 0, 0], f: "5 pm" }, 10, 10],
                ]);
            var a = {
                title: "Motivation and Energy Level Throughout the Day",
                focusTarget: "category",
                hAxis: { title: "Time of Day", format: "h:mm a", viewWindow: { min: [7, 30, 0], max: [17, 30, 0] } },
                vAxis: { title: "Rating (scale of 1-10)" },
                colors: ["#6e4ff5", "#fe3995"],
            };
            new google.visualization.ColumnChart(document.getElementById("kt_gchart_1")).draw(e, a), new google.visualization.ColumnChart(document.getElementById("kt_gchart_2")).draw(e, a);
        })(),
        (e = new google.visualization.DataTable()).addColumn("number", "Day"),
        e.addColumn("number", "Guardians of the Galaxy"),
        e.addColumn("number", "The Avengers"),
        e.addColumn("number", "Transformers: Age of Extinction"),
        e.addRows([
            [1, 37.8, 80.8, 41.8],
            [2, 30.9, 69.5, 32.4],
            [3, 25.4, 57, 25.7],
            [4, 11.7, 18.8, 10.5],
            [5, 11.9, 17.6, 10.4],
            [6, 8.8, 13.6, 7.7],
            [7, 7.6, 12.3, 9.6],
            [8, 12.3, 29.2, 10.6],
            [9, 16.9, 42.9, 14.8],
            [10, 12.8, 30.9, 11.6],
            [11, 5.3, 7.9, 4.7],
            [12, 6.6, 8.4, 5.2],
            [13, 4.8, 6.3, 3.6],
            [14, 4.2, 6.2, 3.4],
            ]),
        new google.charts.Line(document.getElementById("kt_gchart_5")).draw(e, {
            chart: { title: "Box Office Earnings in First Two Weeks of Opening", subtitle: "in millions of dollars (USD)" },
            colors: ["#6e4ff5", "#f6aa33", "#fe3995"],
        }),
        (function () {
            var e = google.visualization.arrayToDataTable([
                ["Task", "Hours per Day"],
                ["Work", 11],
                ["Eat", 2],
                ["Commute", 2],
                ["Watch TV", 2],
                ["Sleep", 7],
                ]),
            a = { title: "My Daily Activities", colors: ["#fe3995", "#f6aa33", "#6e4ff5", "#2abe81", "#c7d2e7", "#593ae1"] };
            new google.visualization.PieChart(document.getElementById("kt_gchart_3")).draw(e, a),
            (a = { pieHole: 0.4, colors: ["#fe3995", "#f6aa33", "#6e4ff5", "#2abe81", "#c7d2e7", "#593ae1"] }),
            new google.visualization.PieChart(document.getElementById("kt_gchart_4")).draw(e, a);
        })();
    },
};
KTGoogleChartsDemo.init();




</script>