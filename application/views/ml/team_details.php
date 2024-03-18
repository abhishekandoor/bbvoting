<style>
.total_percentage {
    color: white;
    font-size: 1.3em;
    font-weight: bold;
}

.voted_icon {
    color: yellow;
    font-size: 2.2em;

}

.voted_label {
    color: yellow;
    font-size: 1.2em;
}

.voted_panel {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
    margin-left: 3em;
}

.votes_count_label {
    font-size: .9em;
    font-weight: 500;
}

.Result-heading {
    color: white;
}

.sub-heading {
    color: white;
}

.trending_wrapper {
    display: flex;
    /* justify-content: space-between; */
}

.trending_wrapper_child {
    width: 25%;
    margin-right: 5em;
}

.trending_number {
    font-size: 5em;
    color: yellow;
    font-weight: bold;
    position: absolute;
    right: -0.5em;
    font-style: italic;
    bottom: -0.6em;
}

.popular_number,
.gamer_number {
    right: -0.15em;
    font-size: 5em;
    color: yellow;
    font-weight: bold;
    position: absolute;
    font-style: italic;
    bottom: -0.6em;
}

.main_container {
    min-height: 60vh;
    margin-bottom: 5em;
}

.fourth_container,
.third_container,
.second_container,
.table-view-container {
    margin-bottom: 3em;
}

.contestant_name_label {
    font-weight: 500 !important;
}

.back_wrapper {
    display: flex;
    align-items: baseline;
}

.back_btn {
    margin-right: 1em;
    color: #fff;
    cursor: pointer;
}

.Result-heading {
    color: #fff;
}

.ai_msg {
    align-items: end;
}

.team-icon {
    font-size: 4em;
}

@media only screen and (max-width: 767px) {
    .back_wrapper {
        align-items: center;
    }

    .trending_wrapper_child {
        width: 48%;
        margin-right: 0em;
        /* padding:3em; */
    }

    .contestant_name_label {
        font-weight: 500 !important;
        font-size: 1em !important;
    }

    .trending_number,
    .popular_number,
    .gamer_number {
        font-size: 2em;
    }

    .main_container {
        margin-bottom: 3em;
    }

    .second_container {
        /* margin-top: 2em; */
    }

    .sub-heading {
        display: flex;
        flex-direction: column;
    }

    .ai_msg {
        align-items: start !important;
    }

}
</style>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

<div class="back_wrapper">
    <a class="back_btn" href="<?php echo base_url().'index.php/ml/Home/go_back'; ?>">
        <span class="material-symbols-outlined">
            keyboard_backspace
        </span>
    </a>
    <h2 class="Result-heading"><?php echo $page_title; ?>
        <?php echo $kitchen_team[0]['is_power_team'] == 1 ? '(Power Team)' :""; ?> </h2>
</div>


<div class="fourth_container">
    <div class="task_wrapper row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body py-3 py-md-2 px-4">
                    <div class="row">
                        <!--column-->
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                            <a href="<?php echo base_url().'index.php/ml/Home/power_team';?>">
                                <div class="card mt-1 mt-md-3">
                                    <div class="card-body p-3">
                                        <div class="align-items-center h-100 d-flex flex-wrap">
                                            <div class="d-inline-block position-relative donut-chart-sale me-2">

                                                <span class="material-symbols-outlined team-icon">shield_person</span>

                                            </div>
                                            <div class=" ">
                                                <h4 class="fs-18 font-w600 mb-1 text-break text-white"> Power Team</h4>
                                                <!-- <span class="fs-14">$5,412</span> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>

                        </div>
                        <!--/column-->
                        <!--column-->
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                            <a href="<?php echo base_url().'index.php/ml/Home/other_bedroom_team/2';?>">

                                <div class="card mt-3">
                                    <div class="card-body p-3">
                                        <div class="align-items-center h-100 d-flex flex-wrap">
                                            <div class="d-inline-block position-relative donut-chart-sale me-2">
                                                <span class="material-symbols-outlined team-icon">raven</span>

                                            </div>
                                            <div class="">
                                                <h4 class="fs-18 font-w600 mb-1 text-break text-white">Nest </h4>
                                                <!-- <span class="fs-14">$3,784</span> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!--/column-->
                        <!--column-->
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                            <a href="<?php echo base_url().'index.php/ml/Home/other_bedroom_team/3';?>">

                                <div class="card mt-3">
                                    <div class="card-body p-3">
                                        <div class="align-items-center h-100 d-flex flex-wrap">
                                            <div class="d-inline-block position-relative donut-chart-sale me-2">
                                                <span
                                                    class="material-symbols-outlined team-icon">radio_button_checked</span>

                                            </div>
                                            <div class=" ">
                                                <h4 class="fs-18 font-w600 mb-1 text-break text-white">Den</h4>
                                                <!-- <span class="fs-14">$3,784</span> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!--/column-->
                        <!--column-->
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                            <a href="<?php echo base_url().'index.php/ml/Home/other_bedroom_team/4';?>">

                                <div class="card mt-3">
                                    <div class="card-body p-3">
                                        <div class="align-items-center h-100 d-flex flex-wrap ">
                                            <div class="d-inline-block position-relative donut-chart-sale me-2">
                                                <span class="material-symbols-outlined team-icon">subway</span>

                                            </div>
                                            <div class=" ">
                                                <h4 class="fs-18 font-w600 mb-1 text-break text-white">Tunnel</h4>
                                                <!-- <span class="fs-14">$3,784</span> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!--/column-->
                    </div>
                    <!-- --/row-- -->
                </div>
            </div>
        </div>
    </div>
</div>



<div class="fourth_container">
    <div class="task_wrapper row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body py-3 py-md-2 px-4">
                    <div class="row">
                        <!--column-->
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                            <a href="<?php echo base_url().'index.php/ml/Home/working_team/1';?>">
                                <div class="card mt-1 mt-md-3">
                                    <div class="card-body p-3">
                                        <div class="align-items-center h-100 d-flex flex-wrap">
                                            <div class="d-inline-block position-relative donut-chart-sale me-2">
                                                <span class="material-symbols-outlined team-icon">cooking</span>

                                            </div>
                                            <div class=" ">
                                                <h4 class="fs-18 font-w600 mb-1 text-break text-white">Cooking Team</h4>
                                                <!-- <span class="fs-14">$5,412</span> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!--/column-->
                        <!--column-->
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                            <a href="<?php echo base_url().'index.php/ml/Home/working_team/2';?>">
                                <div class="card mt-3">
                                    <div class="card-body p-3">
                                        <div class="align-items-center h-100 d-flex flex-wrap">
                                            <div class="d-inline-block position-relative donut-chart-sale me-2">
                                                <span class="material-symbols-outlined team-icon">faucet</span>

                                            </div>
                                            <div class="">
                                                <h4 class="fs-18 font-w600 mb-1 text-break text-white">Vessel Cleaning
                                                </h4>
                                                <!-- <span class="fs-14">$3,784</span> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!--/column-->
                        <!--column-->
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                            <div class="card mt-3">
                                <a href="<?php echo base_url().'index.php/ml/Home/working_team/3';?>">
                                    <div class="card-body p-3">
                                        <div class="align-items-center h-100 d-flex flex-wrap">
                                            <div class="d-inline-block position-relative donut-chart-sale me-2">
                                                <span class="material-symbols-outlined team-icon">mop</span>

                                            </div>
                                            <div class=" ">
                                                <h4 class="fs-18 font-w600 mb-1 text-break text-white">House Cleanig
                                                </h4>
                                                <!-- <span class="fs-14">$3,784</span> -->
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!--/column-->
                        <!--column-->
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                            <a href="<?php echo base_url().'index.php/ml/Home/working_team/4';?>">
                                <div class="card mt-3">
                                    <div class="card-body p-3">
                                        <div class="align-items-center h-100 d-flex flex-wrap ">
                                            <div class="d-inline-block position-relative donut-chart-sale me-2">
                                                <span class="material-symbols-outlined team-icon">bathroom</span>
                                            </div>
                                            <div class=" ">
                                                <h4 class="fs-18 font-w600 mb-1 text-break text-white">Toilet Cleaning
                                                </h4>
                                                <!-- <span class="fs-14">$3,784</span> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!--/column-->
                    </div>
                    <!-- --/row-- -->
                </div>
            </div>
        </div>
    </div>
</div>






<script>

</script>