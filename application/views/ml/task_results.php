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
    margin-right:5em;
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
.second_container,.table-view-container {
    margin-bottom: 3em;
}
.contestant_name_label{
    font-weight:500 !important;
}
.back_wrapper{
        display: flex;
        align-items: baseline;
    }
    .back_btn{
        margin-right:1em;
        color: #fff;
        cursor:pointer;
    }
    .Result-heading{
        color:#fff;
    }

.ai_msg{
    align-items: end;
}
@media only screen and (max-width: 767px) {
      .back_wrapper{
            align-items: center;
        }

    .trending_wrapper_child {
        width: 48%;
        margin-right:0em;
        /* padding:3em; */
    }
    .contestant_name_label{
        font-weight:500 !important;
        font-size:1em !important;
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
    .ai_msg{
        align-items: start !important;
    }
}
</style>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

<?php $this->load->view('back_button'); ?>


<div class="second_container">
    <div class="task_wrapper row">
        <?php 
          if(count($captaincy_task) > 0){
        foreach($captaincy_task as $row){ ?>
        <div class="trending_wrapper_child">
            <div class="card">
                <img class="card-img-top img-fluid" src='<?php echo base_url().'/'.$row['photo_url']; ?>'
                    alt="Card image cap">
                <div class="card-header">
                    <h5 class="card-title contestant_name_label"><?php echo $row['name']; ?></h5>

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
        <h2 class="sub-heading">Weekly Task - <?php echo $week_name; ?></h2>
    </div>
    <div class="task_wrapper row">
        <?php 
          if(count($weekly_task) > 0){
        foreach($weekly_task as $row){ ?>
        <div class="trending_wrapper_child">
            <div class="card">
                <img class="card-img-top img-fluid" src='<?php echo base_url().'/'.$row['photo_url']; ?>'
                    alt="Card image cap">
                <div class="card-header">
                    <h5 class="card-title contestant_name_label"><?php echo $row['name']; ?></h5>
                    

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
        <h2 class="sub-heading">Daily Task - Day <?php echo $daily_task[0]['day']; ?></h2>
    </div>
    <div class="task_wrapper row">
        <?php 
          if(count($daily_task) > 0){
        foreach($daily_task as $row){ ?>
        <div class="trending_wrapper_child">
            <div class="card">
                <img class="card-img-top img-fluid" src='<?php echo base_url().'/'.$row['photo_url']; ?>'
                    alt="Card image cap">
                <div class="card-header">
                    <h5 class="card-title contestant_name_label"><?php echo $row['name']; ?></h5>

                </div>
            </div>
        </div>
        <?php }
        }else{
            echo '<div class="text-center text-danger">No Data Found!</div>';
        } ?>


    </div>
</div>





<script>

</script>