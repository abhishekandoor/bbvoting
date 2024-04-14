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
    .contestant-card:hover{    
        background-color: #83a2ddbd;
        color: black;
        border-radius: 10px;

    }
    .fifth_container{
        display: flex;
        flex-direction: column;
        align-items: center;
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

foreach($contestants as $row){ 
    $converted_string = str_replace(" ", "_", $row['name']);
$converted_string = strtolower($converted_string);
$encryptedId = strtr($this->encryption->encrypt($row['id']), array('+' => '.', '=' => '-', '/' => '~'))
    ?>
    <a href="<?php echo base_url().'index.php/ml/Profile/'.$converted_string.'/'.$row['id']; ?>">

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center card-type contestant-card">
            <div class="d-flex py-2 align-items-center first_container">
                <img src="<?php echo base_url().'/'.$row['photo_url']; ?>" alt="" class="rounded me-3 card-list-img" width="50">
                <div class="me-3">
                    <p class="fs-14 mb-1">Name</p>
                    <span class=" font-w500 fs-16"><?php echo $row['name']; ?></span>
                </div>
            </div>
            <div class="me-3  second_container">
                <p class="fs-14 mb-1">Profession</p>
                <span class=" font-w500 fs-16"><?php echo $row['profession']; ?></span>
            </div>
            <div class="me-3 third_container">
                <p class="fs-14 mb-1">Age</p>
                <span class=" font-w500 fs-16"><?php echo $row['age']; ?></span>
            </div>
            <div class="me-3 fourth_container">
                <p class="fs-14 mb-1">Wage/Day</p>
                <span class=" font-w500 fs-16">₹xx000</span>
            </div>
            <div class="me-3 fifth_container">
                <p class="fs-14 mb-1">Status</p>
                <span class=" font-w500 fs-16">
                <?php if($row['status'] == 1){ ?>
                    <span class="badge badge-success">Active <span class="fa fa-check"></span></span>
                <?php }elseif($row['status'] == 2){ ?>
                    <span class="badge badge-danger">Ejected <span class="fa fa-ban"></span></span>
                <?php } elseif($row['status'] == 3){ ?>
                    <span class="badge badge-danger">Evicted <span class="fa fa-ban"></span></span>
                <?php } elseif($row['status'] == 4){ ?>
                    <span class="badge badge-danger">Quit <span class="fa fa-ban"></span></span>
                <?php }elseif($row['status'] == 5){ ?>
                    <span class="badge badge-warning">Hospitalized <span class="fa fa-hospital"></span></span>
                <?php } ?>
                </span>
            </div>
        </div></a>
        <?php } ?>

    </div>
</div>

<script>
</script>