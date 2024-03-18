<div class="container">
        <h1 class="mt-5 mb-4 text-center text-white">Contestants  Z USER Vote</h1>
        <form id="saveCounterForm">
        <input type="hidden" name="csrf_saveMe" value="<?php echo $this->security->get_csrf_hash();?>">
            <?php foreach ($contestants as $contestant) : ?>
                <div class="mb-3">
                    <label for="counter_<?php echo $contestant['id']; ?>" class="form-label"><?php echo $contestant['name']; ?>:</label>
                    <input type="number" id="counter_<?php echo $contestant['id']; ?>" name="counters[<?php echo $contestant['id']; ?>]" class="form-control" required>
                </div>
            <?php endforeach; ?>
            <button type="submit" id="saveButton" class="btn btn-primary">Save</button>
        </form>

        <div id="message" class="mt-3"></div>
    </div>

    <script>
        $(document).ready(function() {
            $('#saveCounterForm').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('index.php/ml/Home/z_confedtial_login_user_save'); ?>",
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#message').html(response);
                    }
                });
            });
        });
    </script>