<style>

</style>
<div>
        <h2 class="sub-heading text-white">Vote Your Favourite Contestant - Week 2</h2>
    </div>
<?php foreach($contestants as $row){ ?>
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
                <div class="left__div">
                    <div class="photo__div text-center">
                        <img src='https://cdn.pixabay.com/photo/2016/05/28/05/40/question-mark-1421017_960_720.png'
                            style="height: 8em;" />
                    </div>
                    <div class="title__div text-center">
                        <div class="name__div">
                                <h4 class="text-white"><?php echo $row['name'] ?></h4>
                        </div>
                        <div class="profession__div text-center">
                            <h5 class="text-white" style="font-size:x-small;"><small>The information has not been formally released to the public.</small></h5>
                        </div>
                    </div>
                </div>
                <div class="right__div">
                    <div style="display: flex;
                    flex-direction: column;
                    align-items: center;">
                        <div class="send m-auto bg-white">
                            <a href="<?php echo base_url().'index.php/ml/Home/results' ?>">
                                <img src="<?php echo base_url().'assets/icons/vote2.png'; ?>" style="margin-bottom:5px;"/>
                            </a>
                        </div>
                        <span>Vote</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php } ?>