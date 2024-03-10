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
.popular_number , .gamer_number{
    right: -0.15em;
    font-size: 5em;
    color: yellow;
    font-weight: bold;
    position: absolute;
    font-style: italic;
    bottom: -0.6em;
}
.main_container{
    min-height:100vh;
}
.fourth_container , .third_container , .second_container {
    margin-bottom : 10em;
}
@media only screen and (max-width: 767px) {
  
    .trending_wrapper_child {
        width: 32%;
        /* padding:3em; */
    }
    .trending_number,.popular_number,.gamer_number{
        font-size: 2em;
    }
    .second_container{
        margin-top :8em;
    }
    .sub-heading{
        display: flex;
    flex-direction: column;
    }
}
</style>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

<div class="main_container">
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
                                <img src='https://cdn.pixabay.com/photo/2016/05/28/05/40/question-mark-1421017_960_720.png'
                                    style="height: 8em;" />
                            </div>
                            <div class="title__div text-center">
                                <div class="name__div">
                                    <h4 class="text-white"><?php echo $row['name'] ?></h4>
                                </div>
                                <div class="profession__div text-center">
                                    <h5 class="text-white" style="font-size:1em;"><small><?php echo $row['profession']; ?></small></h5>
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
                                    <span class="total_percentage"><?php echo $votes_array[$row['id']]['vote_count'] ? $votes_array[$row['id']]['vote_count'] : 0 ?> <span class="votes_count_label"> votes</span>
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
        <h2 class="sub-heading">Top Trending Contestants-Week 2 

            <small style="float:right;font-size:.5em;">*Based on Social Media AI Analysis</small>
        </h2>
    </div>
    <div class="trending_wrapper row">
        <div class="trending_wrapper_child">
            <div class="card">
                <img class="card-img-top img-fluid"
                    src='https://cdn.pixabay.com/photo/2016/05/28/05/40/question-mark-1421017_960_720.png'
                    alt="Card image cap">
                <div class="card-header">
                    <h5 class="card-title">Card title</h5>
                    <span class="trending_number">
                        <span style="font-weight: 600;">#</span>1
                    </span>
    
                </div>
            </div>
        </div>
        <div class="trending_wrapper_child">
            <div class="card">
                <img class="card-img-top img-fluid"
                    src='https://cdn.pixabay.com/photo/2016/05/28/05/40/question-mark-1421017_960_720.png'
                    alt="Card image cap">
                <div class="card-header">
                    <h5 class="card-title">Card title</h5>
                    <span class="trending_number">
                        <span style="font-weight: 600;">#</span>2
                    </span>
                </div>
            </div>
        </div>
        <div class="trending_wrapper_child">
            <div class="card">
                <img class="card-img-top img-fluid"
                    src='https://cdn.pixabay.com/photo/2016/05/28/05/40/question-mark-1421017_960_720.png'
                    alt="Card image cap">
                <div class="card-header">
                    <h5 class="card-title">Card title</h5>
                    <span class="trending_number">
                        <span style="font-weight: 600;">#</span>3
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="third_container">
    <div>
        <h2 class="sub-heading">Top Popular Contestants-Week 2</h2>
    </div>
    <div class="trending_wrapper row">
        <div class="trending_wrapper_child">
            <div class="card">
                <img class="card-img-top img-fluid"
                    src='https://cdn.pixabay.com/photo/2016/05/28/05/40/question-mark-1421017_960_720.png'
                    alt="Card image cap">
                <div class="card-header">
                    <h5 class="card-title">Card title</h5>
                    <span class="popular_number">
                        <span style="font-weight: 600;"></span>1
                    </span>
    
                </div>
            </div>
        </div>
        <div class="trending_wrapper_child">
            <div class="card">
                <img class="card-img-top img-fluid"
                    src='https://cdn.pixabay.com/photo/2016/05/28/05/40/question-mark-1421017_960_720.png'
                    alt="Card image cap">
                <div class="card-header">
                    <h5 class="card-title">Card title</h5>
                    <span class="popular_number">
                        <span style="font-weight: 600;"><Trending/span>2
                    </span>
                </div>
            </div>
        </div>
        <div class="trending_wrapper_child">
            <div class="card">
                <img class="card-img-top img-fluid"
                    src='https://cdn.pixabay.com/photo/2016/05/28/05/40/question-mark-1421017_960_720.png'
                    alt="Card image cap">
                <div class="card-header">
                    <h5 class="card-title">Card title</h5>
                    <span class="popular_number">
                        <span style="font-weight: 600;"></span>3
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="fourth_container">
    <div>
        <h2 class="sub-heading">Top Gamers- Week 2</h2>
    </div>
    <div class="trending_wrapper row">
        <div class="trending_wrapper_child">
            <div class="card">
                <img class="card-img-top img-fluid"
                    src='https://cdn.pixabay.com/photo/2016/05/28/05/40/question-mark-1421017_960_720.png'
                    alt="Card image cap">
                <div class="card-header">
                    <h5 class="card-title">Card title</h5>
                    <span class="gamer_number">
                        <span style="font-weight: 600;"></span>1
                    </span>
    
                </div>
            </div>
        </div>
        <div class="trending_wrapper_child">
            <div class="card">
                <img class="card-img-top img-fluid"
                    src='https://cdn.pixabay.com/photo/2016/05/28/05/40/question-mark-1421017_960_720.png'
                    alt="Card image cap">
                <div class="card-header">
                    <h5 class="card-title">Card title</h5>
                    <span class="gamer_number">
                        <span style="font-weight: 600;"><Trending/span>2
                    </span>
                </div>
            </div>
        </div>
        <div class="trending_wrapper_child">
            <div class="card">
                <img class="card-img-top img-fluid"
                    src='https://cdn.pixabay.com/photo/2016/05/28/05/40/question-mark-1421017_960_720.png'
                    alt="Card image cap">
                <div class="card-header">
                    <h5 class="card-title">Card title</h5>
                    <span class="gamer_number">
                        <span style="font-weight: 600;"></span>3
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
</script>