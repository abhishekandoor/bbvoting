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
    justify-content: space-between;
}

.trending_wrapper_child {
    width: 25%;
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
.second_container {
    margin-bottom: 10em;
}

@media only screen and (max-width: 767px) {

    .trending_wrapper_child {
        width: 32%;
        /* padding:3em; */
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
        margin-top: 8em;
    }

    .sub-heading {
        display: flex;
        flex-direction: column;
    }
}
</style>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

<div class="main_container">
    <!-- <div class="text-center vote_panel">
        <button type="button" onclick="saveResults();" class="btn btn-rounded btn-secondary" style="
    background: yellow;
    color: #000;
"><span class="btn-icon-start text-warning" style="
    background: #000;
    color: yellow;
"><i class="fa fa-download " style="color: yellow;"></i>
            </span>Download Result as Image</button>
    </div> -->

    <?php $this->load->view('back_button'); ?>
    <div class="row">
        <?php foreach($contestants as $row){
            $votes = $votes_array[$row['id']]['vote_count'] ? $votes_array[$row['id']]['vote_count'] : 0;
            $total_percentage = $votes/$total_weekly_vote*100;
            ?>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
            <div class="card  wallet">
                <div class="boxs">
                    <span class="box one"></span>
                    <span class="box two"></span>
                    <span class="box three"></span>
                    <span class="box four"></span>
                </div>
                <div class="card-body border-0 pe-5">
                    <div class="main-div d-flex align-items-center justify-content-between">
                        <div class="left__div w-100">
                            <div class="photo__div text-center">
                                <img src='<?php echo base_url().'/'.$row['photo_url']; ?>'
                                    style="height: 8em;" />
                            </div>
                            <div class="title__div text-center">
                                <div class="name__div">
                                    <h4 class="text-white"><?php echo $row['name'] ?></h4>
                                </div>
                                <div class="profession__div text-center">
                                    <h5 class="text-white" style="font-size:1em;">
                                        <small><?php echo $row['profession']; ?></small></h5>
                                </div>
                            </div>
                        </div>
                        <div class="right__div w-100 text-center">
                            <div class="voted_panel">
                                <?php if($voted_contestant_id == $row['id']){ ?>
                                <span class="material-symbols-outlined voted_icon">
                                    verified
                                </span>
                                <span class="voted_label">voted</span>
                                <?php } ?>
                                <div>
                                    <span class="total_percentage"><?php echo round($total_percentage).'%'; ?>
                                    </span>
                                </div>

                                <div>
                                    <span
                                        class="total_percentage"><?php echo $votes_array[$row['id']]['vote_count'] ? $votes_array[$row['id']]['vote_count'] : 0 ?>
                                        <span class="votes_count_label"> votes</span>
                                    </span>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
<div class="second_container">
    <div>
        <h2 class="sub-heading">Top Trending Contestants

            <small style="float:right;font-size:.5em;display:flex;flex-direction: column;align-items: end;">
                <span>*Based on Social Media AI Analysis</span>
                <small>Last Updated on <?php echo $last_updated; ?></small>
            </small>
        </h2>
    </div>
    <div class="trending_wrapper row">
        <?php 
          if(count($top_trending) > 0){
        foreach($top_trending as $row){ ?>
        <div class="trending_wrapper_child">
            <div class="card">
                <img class="card-img-top img-fluid"
                    src='<?php echo base_url().'/'.$row['photo_url']; ?>'
                    alt="Card image cap">
                <div class="card-header">
                    <h5 class="card-title"><?php echo $row['name']; ?></h5>
                    <span class="trending_number">
                        <span style="font-weight: 600;">#</span><?php echo $row['trending_number']; ?>
                    </span>

                </div>
            </div>
        </div>
        <?php }
        }else{
            echo '<div class="text-center text-danger">No Data Found!</div>';
        } ?>


    </div>
</div>

<div class="third_container">
    <div>
        <h2 class="sub-heading">Top Popular Contestants - <?php echo $week->week_name; ?></h2>
    </div>
    <div class="trending_wrapper row">
        <?php 
        if(count($top_popular) > 0){
            foreach($top_popular as $row){ ?>

        <div class="trending_wrapper_child">
            <div class="card">
                <img class="card-img-top img-fluid"
                    src='<?php echo base_url().'/'.$row['photo_url']; ?>'
                    alt="Card image cap">
                <div class="card-header">
                    <h5 class="card-title"><?php echo $row['name']; ?></h5>
                    <span class="popular_number">
                        <span style="font-weight: 600;"></span><?php echo $row['popular_number']; ?>
                    </span>

                </div>
            </div>
        </div>
        <?php }
        }else{
            echo '<div class="text-center text-danger">No Data Found!</div>';
        } ?>


    </div>
</div>


<div class="fourth_container">
    <div>
        <h2 class="sub-heading">Top Gamers - <?php echo $week->week_name; ?></h2>
    </div>
    <div class="trending_wrapper row">
        <?php  
        if(count($top_gamers) > 0){
        foreach($top_gamers as $row){ ?>
        <div class="trending_wrapper_child">
            <div class="card">
                <img class="card-img-top img-fluid"
                    src='<?php echo base_url().'/'.$row['photo_url']; ?>'
                    alt="Card image cap">
                <div class="card-header">
                    <h5 class="card-title"><?php echo $row['name']; ?></h5>
                    <span class="gamer_number">
                        <span style="font-weight: 600;"></span><?php echo $row['position_number']; ?>
                    </span>

                </div>
            </div>
        </div>
        <?php }
        }else{
            echo '<div class="text-center text-danger">No Data Found!</div>';
        } ?>
    </div>
</div>

<div class="modal fade" id="result_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
            <?php foreach($contestants as $row){
            $votes = $votes_array[$row['id']]['vote_count'] ? $votes_array[$row['id']]['vote_count'] : 0;
            $total_percentage = $votes/$total_weekly_vote*100;
            ?>
                <h6 class="mt-4">Code editor
                    <span class="pull-end">90%</span>
                </h6>
                <div class="progress">
                    <div class="progress-bar bg-info progress-animated" style="width: 90%; height:6px;" role="progressbar">
                        <span class="sr-only">60% Complete</span>
                    </div>
                </div>
            <?php } ?>
            </div>
        </div>
    </div>
</div>


<script>
$(document).ready(function() {
    $('#downloadBtn').click(function() {
        html2canvas($('#htmlContent')[0]).then(function(canvas) {
            var imageData = canvas.toDataURL("image/png");
            var downloadLink = document.createElement("a");
            downloadLink.href = imageData;
            downloadLink.download = 'converted_image.png';
            document.body.appendChild(downloadLink);
            downloadLink.click();
            document.body.removeChild(downloadLink);
        });
    });
});

function saveResults() {
    $('#result_modal').modal('show');
}
</script>