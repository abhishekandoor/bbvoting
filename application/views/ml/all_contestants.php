<style>
    .first_container{
        width: 28%;
    }
    .second_container,.third_container,.fourth_container,.fifth_container{
        width:18%;
    }
    .first_container{
        /* margin-bottom:10em; */
    }
    .vote_panel{
        margin-bottom:5em;
    }
    @media only screen and (max-width: 767px) {
        .first_container{
            width:100%;
        }
        .second_container,.third_container,.fourth_container,.fifth_container{
            width:auto;
        }
    }
</style>

<?php $this->load->view('back_button'); ?>

<div class="text-center vote_panel"><a class="btn btn-outline-primary btn-rounded mt-3 px-5" href="<?php echo base_url() . 'index.php/ml/Home' ?>">Click Here to Vote Your Favorite Contestant</a></div>


<div class="card">
    <div class="card-body pb-0 pt-2">
        <?php 

foreach($contestants as $row){ ?>

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center card-type">
            <div class="d-flex py-2 align-items-center first_container">
                <img src="https://cdn.pixabay.com/photo/2016/05/28/05/40/question-mark-1421017_960_720.png" alt="" class="rounded me-3 card-list-img" width="50">
                <div class="me-3">
                    <p class="fs-14 mb-1">Name</p>
                    <span class=" font-w500 fs-16"><?php echo $row['name'] ?></span>
                </div>
            </div>
            <div class="me-3  second_container">
                <p class="fs-14 mb-1">Profession</p>
                <span class=" font-w500 fs-16"><?php echo $row['profession'] ?></span>
            </div>
            <div class="me-3 third_container">
                <p class="fs-14 mb-1">Age</p>
                <span class=" font-w500 fs-16"><?php echo '27'; ?></span>
            </div>
            <div class="me-3 fourth_container">
                <p class="fs-14 mb-1">Wage/Day</p>
                <span class=" font-w500 fs-16">25000</span>
            </div>
            <div class="me-3 fifth_container">
                <p class="fs-14 mb-1">Status</p>
                <span class=" font-w500 fs-16">
                <span class="badge badge-success">Active</span>
                </span>
            </div>
        </div>
        <?php } ?>

    </div>
</div>

<script>
</script>